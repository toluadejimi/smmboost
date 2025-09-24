<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserProfileUpdateRequest;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\BankAccount;
use App\Models\Notice;
use App\Models\NotificationTemplate;
use App\Models\Order;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    use Upload;

    protected object $user;

    protected string $theme;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function saveToken(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        try {
            Auth::user()
                ->fireBaseToken()
                ->create([
                    'token' => $request->token,
                ]);
            return response()->json([
                'msg' => 'token saved successfully.',
            ]);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function index()
    {
        try {
            $data['firebaseNotify'] = config('firebase');
            $currency = Currency::where('code', optional($this->user)->currency)->first();
            $data['walletBalance'] = optional($this->user)->balance;

            $startOfYear = Carbon::now()->startOfYear();
            $endOfYear = Carbon::now()->endOfYear();

            $deposits = Deposit::query()
                ->where('user_id', $this->user->id)
                ->where('status', '!=', 0)
                ->whereNull('depositable_type')
                ->whereBetween('created_at', [$startOfYear, $endOfYear])
                ->latest()
                ->get();

            $startOfLast7Days = Carbon::now()->subDays(7);
            $data['totalYearDeposits'] = $deposits->sum('payable_amount_in_base_currency'); //payable_amount_in_base_currency
            $data['totalLast7DaysDeposits'] = $deposits->whereBetween('created_at', [$startOfLast7Days, Carbon::now()])
                ->sum('payable_amount_in_base_currency');

            $monthlyDeposits = $deposits->groupBy(function ($deposit) {
                return Carbon::parse($deposit->created_at)->format('m');
            })->map(function ($group) {
                return $group->sum('payable_amount_in_base_currency');
            });
            $monthsInYear = range(1, 12);
            $monthlyDeposits = collect($monthsInYear)->mapWithKeys(function ($month) use ($monthlyDeposits, $currency) {
                $monthName = date('M', mktime(0, 0, 0, $month, 1));
                $amount = $monthlyDeposits->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0);
                $conversionRate = $currency ? $currency->conversion_rate : 1;
                return [$monthName => $amount * $conversionRate];
            });

            $data['monthlyDeposits'] = $monthlyDeposits;

            $currentMonth = Carbon::now()->format('M');
            $data['currentMonthDeposit'] = $monthlyDeposits->get($currentMonth);

            $currentYear = now()->format('Y');
            $transactions = Transaction::where('user_id', $this->user->id)
                ->where('created_at', '>=', Carbon::now()->subMonths(12))
                ->select(
                    'transactions.*',
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('YEAR(created_at) as year'),
                    'trx_type',
                    'amount'
                )
                ->whereYear('created_at', $currentYear)
                ->orderBy('month', 'asc')
                ->get();
            $data['transactions'] = $transactions->take(5);

            $recent_orders = Order::where('user_id', $this->user->id)
                ->where('created_at', '>=', Carbon::now()->subMonths(12))
                ->select(
                    'orders.*',
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('YEAR(created_at) as year')
                )
                ->whereYear('created_at', $currentYear)
                ->orderBy('month', 'asc')
                ->get();
            $data['recent_orders'] = $recent_orders->take(5);

            for ($month = 1; $month <= 12; $month++) {
                $transactionsOfMonth = $transactions->where('month', $month);
                $totalTransaction = $transactionsOfMonth->sum('amount');
                $conversionRate = $currency ? $currency->conversion_rate : 1;
                $data['totalTransaction'][] = getAmount($totalTransaction * $conversionRate);
                $totalSend = $transactionsOfMonth->where('trx_type', '-')->sum('amount');
                $data['totalSend'][] = getAmount($totalSend * $conversionRate);
                $totalReceive = $transactionsOfMonth->where('trx_type', '+')->sum('amount');
                $data['totalReceived'][] = getAmount($totalReceive * $conversionRate);
                $data['months'][] = date('M', mktime(0, 0, 0, $month, 1));
            }


            $data['tickets'] = collect(SupportTicket::where('user_id', $this->user->id)
                ->selectRaw("COUNT(*) as total,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as answered,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as closed")
                ->first()
                ->toArray());

            $data['orders'] = collect(Order::where('user_id', $this->user->id)
                ->selectRaw("COUNT(*) as total,
                SUM(CASE WHEN status = 'processing' THEN 1 ELSE 0 END) as processing,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'canceled' THEN 1 ELSE 0 END) as canceled")
                ->first()
                ->toArray());

            $data['thisMonthOrders'] = Order::where('user_id', $this->user->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            $data['totalFunded'] = Deposit::where('user_id', $this->user->id)
                ->where('status', 1)
                ->whereNull('depositable_type')
                ->sum('payable_amount_in_base_currency');

            $data['pendingFundings'] = Deposit::where('user_id', $this->user->id)
                ->where('status', 0) // 0 = pending
                ->whereNull('depositable_type')
                ->sum('payable_amount_in_base_currency');

            $data['totalSpent'] = Transaction::where('user_id', $this->user->id)
                ->where('trx_type', '-') // sent
                ->whereYear('created_at', now()->year)
                ->sum('amount');

            $data['totalSmmOrders'] = Order::count();

            $conversionRate = $currency ? $currency->conversion_rate : 1;

            $data['totalFunded'] = getAmount($data['totalFunded'] * $conversionRate);
            $data['pendingFundings'] = getAmount($data['pendingFundings'] * $conversionRate);
            $data['totalSpent'] = getAmount($data['totalSpent'] * $conversionRate);

            $totalOrders = $data['orders']['total'] ?? 0;
            $completedOrders = $data['orders']['completed'] ?? 0;

            $data['successRate'] = $totalOrders > 0
                ? round(($completedOrders / $totalOrders) * 100, 2)
                : 0;

            return view(template() . 'user.dashboard', $data, compact('transactions', 'currency'));
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong.');
        }
    }

     public function support()
    {
        $data['walletBalance'] = optional($this->user)->balance;

        // dd($data['api_token']);
        return view(template() . 'user.support', $data);
    }

    public function profile()
    {
        $data['walletBalance'] = optional($this->user)->balance;
        $data['api_token'] = Auth::user()->api_token;
        $data['countries'] = config('country');
        $data['languages'] = Language::orderBy('id', 'asc')->get();

        // dd($data['api_token']);
        return view(template() . 'user.profile.my_profile', $data);
    }

    public function profileImageUpdate(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png',
        ]);
        $user = Auth::user();
        if ($request->hasFile('file')) {
            $size = config('filelocation.user_profile.size');
            $image = $this->fileUpload($request->file, config('filelocation.user_profile.path'), null, $size, 'webp', 90, $user->image, $user->image_driver);
        }
        $user->update([
            'image' => $image['path'] ?? $user->image,
            'image_driver' => $image['driver'] ?? $user->image_driver
        ]);
        return response([
            'success' => true
        ]);
    }

    public function profileUpdate(UserProfileUpdateRequest $request)
    {
        $data = $request->validated();
        try {
            $user = auth()->user();
            $response = $user->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'phone_code' => $data['phone_code'],
                'address_one' => $data['address'],
                'state' => $data['address'],
                'country' => $data['country'],
                'country_code' => $data['country_code'],
                'zip_code' => $data['zipcode'],
                'time_zone' => $data['time_zone'],
                'language_id' => $data['language'],
            ]);

            throw_if(!$response, 'Something went wrong, While updating user profile data');
            return back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    public function passwordSetting()
    {
        $data['walletBalance'] = optional($this->user)->balance;
        return view(template() . 'user.profile.password_setting', $data);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6',
        ]);
        try {
            if (Hash::check($request->current_password, $this->user->password)) {
                $this->user->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('success', 'Password changes successfully.');
            } else {
                throw new \Exception('Current password did not match');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function notificationSettings()
    {
        $data['notificationTemplates'] = NotificationTemplate::where('notify_for', 0)
            ->where('template_key', '!=', 'ADD_BALANCE')
            ->where('template_key', '!=', 'CHILD_PANEL_USER_ADD_BALANCE')
            ->where('template_key', '!=', 'CHILD_PANEL_ADMIN_REPLIED_TICKET')
            ->get()->unique('template_key');
        return view(template() . 'user.notification_settings.index', $data);
    }

    public function notificationPermission(Request $request)
    {
        try {
            $templates = $request->input('templates', []);
            foreach ($templates as $templateId => $templateData) {
                $template = NotificationTemplate::find($templateId);
                $status = [
                    'mail' => $templateData['mail'] ?? '0',
                    'sms' => $templateData['sms'] ?? '0',
                    'in_app' => $templateData['in_app'] ?? '0',
                    'push' => $templateData['push'] ?? '0',
                ];
                $template->update([
                    'status' => $status
                ]);
            }
            return back()->with('success', 'Permissions updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, Please try again.');
        }
    }


    public function addFund(Request $request)
    {
        $bankAccount = optional(auth()->user())->bankAccount;
        $currency = Currency::where('code', optional($this->user)->currency)->first();
        $data['gateways'] = Gateway::where('status', 1)
            ->where('id', '!=', 43)
            ->orderBy('sort_by', 'ASC')->get();
        $data['walletBalance'] = optional($this->user)->balance;
        $userId = Auth::id();
        $search = $request->all();
        $deposits = Deposit::with(['depositable', 'gateway'])
            ->where('user_id', $userId)
            ->where('status', '!=', 0)
            ->when(!empty($search['transaction_id']), function ($query) use ($search) {
                $query->where('trx_id', 'like', '%' . $search['transaction_id'] . '%');
            })
            ->when(!empty($search['gateway']), function ($query) use ($search) {
                $query->whereHas('gateway', function ($qry) use ($search) {
                    return $qry->where('name', 'like', '%' . $search['gateway'] . '%');
                });
            })
            ->when(!empty($search['status']), function ($query) use ($search) {
                $query->where('status', $search['status']);
            })
            ->when(isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
                return $query->whereBetween('created_at', [$search['from_date'], $search['to_date']]);
            })
            ->when(isset($search['from_date']) && !isset($search['to_date']), function ($query) use ($search) {
                return $query->whereDate('created_at', isset($search['from_date']));
            })
            ->when(!isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
                return $query->whereDate('created_at', $search['to_date']);
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view(template() . 'user.fund.add_fund', $data, compact('deposits', 'bankAccount', 'currency'));
    }

    public function fund(Request $request)
    {
        $search = $request->all();
        $userId = Auth::id();
        $currency = Currency::where('code', auth()->user()->currency)->first();
        $deposits = Deposit::with(['depositable', 'gateway'])
            ->where('user_id', $userId)
            ->where('status', '!=', 0)
            ->when(!empty($search['transaction_id']), function ($query) use ($search) {
                $query->where('trx_id', 'like', '%' . $search['transaction_id'] . '%');
            })
            ->when(!empty($search['gateway']), function ($query) use ($search) {
                $query->whereHas('gateway', function ($qry) use ($search) {
                    return $qry->where('name', 'like', '%' . $search['gateway'] . '%');
                });
            })
            ->when(!empty($search['status']), function ($query) use ($search) {
                $query->where('status', $search['status']);
            })
            ->when(isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
                return $query->whereBetween('created_at', [$search['from_date'], $search['to_date']]);
            })
            ->when(isset($search['from_date']) && !isset($search['to_date']), function ($query) use ($search) {
                return $query->whereDate('created_at', isset($search['from_date']));
            })
            ->when(!isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
                return $query->whereDate('created_at', $search['to_date']);
            })
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view(template() . 'user.fund.index', compact('deposits', 'currency'));
    }

    // public function transactionHistory(Request $request)
    // {
    //     $search = $request->all();
    //     $currency = Currency::where('code', auth()->user()->currency)->first();
    //     $transactions = Transaction::where('user_id', $this->user->id)
    //         ->when(!empty($search['transaction_id']), function ($query) use ($search) {
    //             $query->where('trx_id', 'like', '%' . $search['transaction_id'] . '%');
    //         })
    //         ->when(!empty($search['remarks']), function ($query) use ($search) {
    //             $query->where('remarks', $search['remarks']);
    //         })
    //         ->when(isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
    //             return $query->whereBetween('created_at', [$search['from_date'], $search['to_date']]);
    //         })
    //         ->when(isset($search['from_date']) && !isset($search['to_date']), function ($query) use ($search) {
    //             return $query->whereDate('created_at', isset($search['from_date']));
    //         })
    //         ->when(!isset($search['from_date']) && isset($search['to_date']), function ($query) use ($search) {
    //             return $query->whereDate('created_at', $search['to_date']);
    //         })
    //         ->orderBy('id', 'desc')->paginate(15);
    //     return view(template() . 'user.transaction.index', compact('transactions', 'currency'));
    // }

    public function transactionHistory(Request $request)
    {
        $user = auth()->user();

        // Fetch filters from request
        $search = $request->input('search');
        $status = $request->input('status');
        $type = $request->input('type');
        $fromDate = $request->input('date_from');
        $toDate = $request->input('date_to');

        // Get currency and wallet balance
        $walletBalance = optional($this->user)->balance;

        // Build transaction query
        $transactionsQuery = Transaction::where('user_id', $user->id);

        if (!empty($search)) {
            $transactionsQuery->where(function ($query) use ($search) {
                $query->where('trx_id', 'like', "%$search%")
                    ->orWhere('remarks', 'like', "%$search%");
            });
        }

        if (!empty($status)) {
            $transactionsQuery->where('status', $status);
        }

        if (!empty($type)) {
            $transactionsQuery->where('type', $type);
        }

        if ($fromDate && $toDate) {
            $transactionsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $transactionsQuery->whereDate('created_at', $fromDate);
        } elseif ($toDate) {
            $transactionsQuery->whereDate('created_at', $toDate);
        }

        $transactions = $transactionsQuery->orderByDesc('id')->paginate(15);

        // Aggregate data
        $totalCredit = Transaction::where('user_id', $user->id)->where('trx_type', '+')->sum('amount');
        $totalDebit = Transaction::where('user_id', $user->id)->where('trx_type', '-')->sum('amount');
        $totalTransactions = Transaction::where('user_id', $user->id)->count();

        return view(template() . 'user.transaction.index', [
            'transactions' => $transactions,
            'walletBalance' => $walletBalance,
            'totalCredit' => $totalCredit,
            'totalDebit' => $totalDebit,
            'totalTransactions' => $totalTransactions,
        ]);
    }


    public function selectedCurrency(Request $request)
    {
        $currency = Currency::where('code', $request->currency)->first();
        $this->user->update([
            'currency' => $currency->code
        ]);

        return response([
            'success' => true
        ]);
    }

    public function notice()
    {
        $data['notices'] = Notice::orderBy('id', 'desc')->get();
        return view(template() . 'user.notice.index', $data);
    }

    public function generateBankAccount()
    {
        $user = auth()->user();

        if (!$user->phone) {
            redirect()->route('user.profile.setting')->with('error', 'You neeed to enter your phone number to proceed with account creation!');
        }

        if ($user->bankAccount) {
            redirect()->route('user.profile')->with('error', 'You already have an account!');
        }

        // $notify[] = ['error', 'Unable to create your bank account right now!'];
        // return to_route('user.home')->withNotify($notify);


        $url = 'https://api.paymentpoint.co/api/v1/createVirtualAccount';

        $customerEmail = $user->email;
        $customerName = $user->username;
        $customerPhoneNumber = $user->mobile;
        $bankCode = ['20946'];
        // $businessId = "5ffa1af1ab6797934e7d32c6864cd5baa0d12003";
        $businessId = "5ffa1af1ab6797934e7d32c6864cd5baa0d12004";

        // Prepare the request headers
        $headers = [
            'Authorization' => 'Bearer 82ea824e0f9c8192336bedcce23da44d978b6f3c614dcd0e44d7dc986678fdbe788bb0a633325590eeccea8f11dcd7be3a3459a501c7bf6bf41074bf',
            'Content-Type' => 'application/json',
            'api-key' => 'bffdb690a342ef3155c3d6040db50b3418cb2bb2',
        ];

        // Prepare the request body
        $data = [
            'email' => $customerEmail,
            'name' => $customerName,
            'phoneNumber' => $customerPhoneNumber,
            'bankCode' => $bankCode,
            'businessId' => $businessId,
        ];

        // Make the API request using Laravel's HTTP client
        $response = Http::withHeaders($headers)
            ->post($url, $data);

        Log::info('Payment Point API Response:', ['response' => $response->body()]);

        // dd($response->json());

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();

            // dd($data);

            if (count($data['errors']) > 0) {
                return back()->with('error', "Unable to create your bank account!");
            }
            // Extract bank account information from the response
            $bankAccount = $data['bankAccounts'][0];  // Assuming only one account

            BankAccount::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'bank_code' => $bankAccount['bankCode'],
                    'account_number' => $bankAccount['accountNumber'],
                    'account_name' => $bankAccount['accountName'],
                    'bank_name' => $bankAccount['bankName'],
                    'reserved_account_id' => $bankAccount['Reserved_Account_Id']
                ]
            );

            return back()->with('success', 'Your bank acccount has been created successfully!');
        } else {
            $data = $response->json();

            if ($data['message'] === "The phone number field must be 11 digits.") {
                $error_message = 'Your account could not be generated because your phone number is not 11 digits';
            } else {
                $error_message = 'Unable to create your bank account!';
            }

            return back()->with('error', $error_message);
        }
    }

    public function referral()
    {
        $userId = Auth::id();
        $data['title'] = "My Referrals";
        $data['directReferralUsers'] = getDirectReferralUsers($userId);
        return view(template() . 'user.referral.index', $data);
    }


    public function referralBonus()
    {
        $referralBonus = $this->user->referralBonusLog()->latest()->with('bonusBy:id,firstname,lastname')->paginate(15);
        return view(template() . 'user.referral.bonus', compact('referralBonus'));
    }

    public function getReferralUser(Request $request)
    {
        $data = getDirectReferralUsers($request->userId);
        $directReferralUsers = $data->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'count_direct_referral' => count(getDirectReferralUsers($user->id)),
                'joined_at' => dateTime($user->created_at),
            ];
        });

        return response()->json(['data' => $directReferralUsers]);
    }
}

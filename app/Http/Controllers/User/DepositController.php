<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\GetChildPanel;
use Illuminate\Http\Request;
use App\Traits\PaymentValidationCheck;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{

    use PaymentValidationCheck, GetChildPanel;

    public function supportedCurrency(Request $request)
    {
        $gateway = Gateway::where('id', $request->gateway)->first();
        return response([
            'success' => true,
            'data' => $gateway->supported_currency,
            'currencyType' => $gateway->currency_type,
            'currency' => $gateway->receivable_currencies[0]->name ?? $gateway->receivable_currencies[0]->currency,
            'min_amount' => $gateway->receivable_currencies[0]->min_limit,
        ]);
    }

    public function checkAmount(Request $request)
    {
        if ($request->ajax()) {
            $amount = $request->amount;
            $selectedCurrency = $request->selected_currency;
            $selectGateway = $request->select_gateway;
            $selectedCryptoCurrency = $request->selectedCryptoCurrency;
            $data = $this->checkAmountValidate($amount, $selectedCurrency, $selectGateway, $selectedCryptoCurrency);
            return response()->json($data);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function checkAmountValidate($amount, $selectedCurrency, $selectGateway, $selectedCryptoCurrency = null)
    {

        $selectGateway = Gateway::where('id', $selectGateway)->where('status', 1)->first();
        if (!$selectGateway) {
            return ['status' => false, 'message' => "Payment method not available for this transaction"];
        }

        $requestCurrency = $selectedCryptoCurrency ? $selectedCryptoCurrency : $selectedCurrency;

        if (999 < $selectGateway->id) {
            $isCrypto = false;
        } else {
            $isCrypto = (checkTo($selectGateway->currencies, $requestCurrency) == 1) ? true : false;
        }

        if ($isCrypto == false) {
            $selectedCurrency = array_search($selectedCurrency, $selectGateway->supported_currency);
            if ($selectedCurrency !== false) {
                $selectedPayCurrency = $selectGateway->supported_currency[$selectedCurrency];
            } else {
                return ['status' => false, 'message' => "Please choose the currency you'd like to use for payment"];
            }
        }

        if ($isCrypto == true) {
            $selectedCurrency = array_search($selectedCryptoCurrency, $selectGateway->supported_currency);
            if ($selectedCurrency !== false) {
                $selectedPayCurrency = $selectGateway->supported_currency[$selectedCurrency];
            } else {
                return ['status' => false, 'message' => "Please choose the currency you'd like to use for payment"];
            }
        }

        if ($selectGateway) {
            $receivableCurrencies = $selectGateway->receivable_currencies;

            // dd(collect($receivableCurrencies)->where('name', $selectedPayCurrency)->first());

            if (is_array($receivableCurrencies)) {
                if ($selectGateway->id < 999) {
                    $currencyInfo = collect($receivableCurrencies)->where('name', $selectedPayCurrency)->first();
                } else {
                    if ($isCrypto == false) {
                        $currencyInfo = collect($receivableCurrencies)->where('currency', $selectedPayCurrency)->first();
                    } else {
                        $currencyInfo = collect($receivableCurrencies)->where('currency', $selectedCryptoCurrency)->first();
                    }
                }
            } else {
                return null;
            }
        }

        $currencyType = $selectGateway->currency_type;
        $limit = $currencyType == 0 ? 8 : 2;
        $amount = getAmount($amount, $limit);
        $status = false;

        if ($currencyInfo) {
            $percentage = getAmount($currencyInfo->percentage_charge, $limit);
            $percentage_charge = getAmount(($amount * $percentage) / 100, $limit);
            $fixed_charge = getAmount($currencyInfo->fixed_charge, $limit);
            $min_limit = getAmount($currencyInfo->min_limit, $limit);
            $max_limit = getAmount($currencyInfo->max_limit, $limit);
            $charge = getAmount($percentage_charge + $fixed_charge, $limit);
        }

        $basicControl = basicControl();
        $payable_amount = getAmount($amount + $charge, $limit);
        $amount_in_base_currency = getAmount($payable_amount / $currencyInfo->conversion_rate ?? 1, $limit);

        if ($amount < $min_limit || $amount > $max_limit) {
            $message = "minimum payment $min_limit and maximum payment limit $max_limit";
        } else {
            $status = true;
            $message = "Amount : $amount" . " " . $selectedPayCurrency;
        }

        $data['status'] = $status;
        $data['message'] = $message;
        $data['fixed_charge'] = $fixed_charge;
        $data['percentage'] = $percentage;
        $data['percentage_charge'] = $percentage_charge;
        $data['min_limit'] = $min_limit;
        $data['max_limit'] = $max_limit;
        $data['payable_amount'] = $payable_amount;
        $data['charge'] = $charge;
        $data['amount'] = $amount;
        $data['conversion_rate'] = $currencyInfo->conversion_rate ?? 1;
        $data['amount_in_base_currency'] = number_format($amount_in_base_currency, 2);
        $data['currency'] = (!$isCrypto) ? ($currencyInfo->name ?? $currencyInfo->currency) : $cryptoCurrency ?? 'USD';
        $data['base_currency'] = $basicControl->base_currency;
        $data['currency_limit'] = $limit;

        return $data;
    }


    public function paymentRequest(Request $request)
    {
        $amount = $request->amount;
        $gateway = $request->gateway_id;
        $currency = $request->supported_currency;
        $cryptoCurrency = $request->supported_crypto_currency;
//        $childPanel = $this->childPanel();


        if($gateway === "1012"){


            $trx_id = "VEREMZ".date('myhis');

            $deposit = Deposit::create([
                'user_id' => Auth::user()->id,
                'payment_method_id' => $request->gateway_id,
                'payment_method_currency' => "NGN",
                'amount' => $amount,
                'percentage_charge' => 0,
                'fixed_charge' => 0,
                'payable_amount' => $amount,
                'base_currency_charge' => "NGN",
                'payable_amount_in_base_currency' => "NGN",
                'status' => 0,
                'type' => 0,
                'trx_id' => $trx_id,
            ]);

            if($deposit){

                $key = env('WEBKEY');
                $email = Auth::user()->email;
                $url = "https://web.sprintpay.online/pay?amount=$amount&key=$key&ref=$trx_id&email=$email";

                return redirect()->away($url);


            }




        }

        try {
            if($gateway === "43"){
                return to_route('user.payment.process.paymentpoint');
            }

            $checkAmountValidate = $this->validationCheck($amount, $gateway, $currency, $cryptoCurrency);

            if ($checkAmountValidate['status'] == 'error') {
                return back()->with('error', $checkAmountValidate['msg']);
            }

            $deposit = Deposit::create([
                'user_id' => Auth::user()->id,
                'payment_method_id' => $checkAmountValidate['data']['gateway_id'],
                'payment_method_currency' => $checkAmountValidate['data']['currency'],
                'amount' => $amount,
                'percentage_charge' => $checkAmountValidate['data']['percentage_charge'],
                'fixed_charge' => $checkAmountValidate['data']['fixed_charge'],
                'payable_amount' => $checkAmountValidate['data']['payable_amount'],
                'base_currency_charge' => $checkAmountValidate['data']['base_currency_charge'],
                'payable_amount_in_base_currency' => $checkAmountValidate['data']['payable_amount_base_in_currency'],
                'status' => 0,
                'type' => isset($childPanel) ? 0 : 1,
            ]);

            return redirect(route('user.payment.process', $deposit->trx_id));

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }










    }


    public function fund_user(request $request)
    {


       $trx = Deposit::where('trx_id', $request->order_id)->first();
       if($trx){

           if($trx->status === 0){

               Deposit::where('trx_id', $request->order_id)->update([
                   'status' => 1,
               ]);

               $user = User::where('email', $request->email)->first();
               $ttr =new Transaction();
               $ttr ->transactional_type = "App\Models\Deposit";
               $ttr ->user_id = $user->id;
               $ttr ->amount = $request->amount;
               $ttr ->balance = $user->balance + $request->amount;
               $ttr ->charge = 0;
               $ttr ->trx_type = "+";
               $ttr ->remarks = "Sprintpay Deposit successful";
               $ttr ->save();


               User::where('email', $request->email)->increment('balance', $request->amount);

               return response()->json([
                   'status' => true,
                   'message' => "Deposit successful",
               ]);

           }

           return response()->json([
               'status' => false,
               'message' => "Transaction already successful",
           ],422);


       }



        return response()->json([
            'status' => false,
            'message' => "No transaction made",
        ],422);



    }
}

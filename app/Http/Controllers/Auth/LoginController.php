<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserSystemInfo;
use App\Http\Controllers\Controller;
use App\Models\ContentDetails;
use App\Models\User;
use App\Models\UserLogin;
use App\Providers\RouteServiceProvider;
use App\Traits\PageSeo;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Facades\App\Services\Google\GoogleRecaptchaService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{

    use AuthenticatesUsers, PageSeo;

    protected $maxAttempts = 3;
    protected $decayMinutes = 5;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = getTheme() === "reallysimplesocial"? "/" : RouteServiceProvider::HOME;
    }

    public function showLoginForm(Request $request)
    {
        $data['siteKey'] = config('services.recaptcha.site_key');
        $selectedTheme = getTheme();
        $slug = 'login';
        $data['pageSeo'] = $this->pageSeoData($slug, $selectedTheme);
        $data['footer'] = footerData();
        $data['loginContent'] = ContentDetails::with('content')
            ->whereHas('content', function ($query) use ($slug, $selectedTheme) {
                $query->where('theme', $selectedTheme)->where('name', $slug)->where('type', 'single');
            })
            ->first();

        return view(template() . 'auth.login', $data);
    }


    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function login(Request $request)
    {
        $basicControl = basicControl();
        $rules[$this->username()] = 'required';
        $rules ['password'] = 'required';
        if ($basicControl->manual_recaptcha == 1 && $basicControl->manual_recaptcha_login == 1) {
            $rules['captcha'] = ['required',
                Rule::when((!empty($request->captcha) && strcasecmp(session()->get('captcha'), $_POST['captcha']) != 0), ['confirmed']),
            ];
        }

        if ($basicControl->google_recaptcha == 1 && $basicControl->google_recaptcha_login == 1) {
            GoogleRecaptchaService::responseRecaptcha($request['g-recaptcha-response']);
            $rules['g-recaptcha-response'] = 'sometimes|required';
        }

        $message['captcha.confirmed'] = "The captcha does not match.";
        $message['g-recaptcha-response.required'] = "The g-recaptcha is required.";
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt([$this->username() => $request->username, 'password' => $request->password, 'child_panel_id' => null], $request->remember_me)) {
                return $this->sendLoginResponse($request);
            } else {
                return back()->with('error', 'You are banned from this application. Please contact with system Administrator.');
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard('admin')->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }


    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->last_seen = Carbon::now();
        $user->two_fa_verify = ($user->two_fa == 1) ? 0 : 1;
        $user->save();

        $info = @json_decode(json_encode(getIpInfo()), true);
        $ul['user_id'] = $user->id;

        $ul['longitude'] = (!empty(@$info['long'])) ? implode(',', $info['long']) : null;
        $ul['latitude'] = (!empty(@$info['lat'])) ? implode(',', $info['lat']) : null;
        $ul['country_code'] = (!empty(@$info['code'])) ? implode(',', $info['code']) : null;
        $ul['location'] = (!empty(@$info['city'])) ? implode(',', $info['city']) . (" - " . @implode(',', @$info['area']) . "- ") . @implode(',', $info['country']) . (" - " . @implode(',', $info['code']) . " ") : null;
        $ul['country'] = (!empty(@$info['country'])) ? @implode(',', @$info['country']) : null;

        $ul['ip_address'] = UserSystemInfo::get_ip();
        $ul['browser'] = UserSystemInfo::get_browsers();
        $ul['os'] = UserSystemInfo::get_os();
        $ul['get_device'] = UserSystemInfo::get_device();
        UserLogin::create($ul);


        if (config('demo.IS_DEMO')) {
            $checkUser = \App\Models\User::find(1);
            $checkUser->firstname = 'Alex';
            $checkUser->lastname = 'Hales';
            $checkUser->username = 'demouser';
            $checkUser->password = bcrypt('demouser');
            $checkUser->two_fa = 0;
            $checkUser->two_fa_verify = 1;
            $checkUser->status = 1;
            $checkUser->save();
        }
    }
}

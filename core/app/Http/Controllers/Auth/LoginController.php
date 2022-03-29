<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Extension;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function showLoginForm()
    {
        $pageTitle = "Sign In";
        $users = User::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        return view(activeTemplate() . 'user.auth.login', compact('pageTitle', 'users'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if(isset($request->captcha)){
            if(!captchaVerify($request->captcha, $request->captcha_secret)){
                $notify[] = ['error',"Invalid captcha"];
                return back()->withNotify($notify)->withInput();
            }
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {
        $customRecaptcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
        $validation_rule = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if ($customRecaptcha) {
            $validation_rule['captcha'] = 'required';
        }

        $request->validate($validation_rule);

    }

    public function logout()
    {
        $this->guard('web')->logout();

        // request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return redirect()->route('user.login')->withNotify($notify);
    }


    public function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
            $this->guard()->logout();
            $notify[] = ['error','Your account has been deactivated.'];
            return redirect()->route('user.login')->withNotify($notify);
        }


        $user = auth()->user();
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',',$info['long']);
            $userLogin->latitude =  @implode(',',$info['lat']);
            $userLogin->city =  @implode(',',$info['city']);
            $userLogin->country_code = @implode(',',$info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;
        
        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return redirect()->route('user.home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $name=explode('@',$user->getEmail());
            $findUser = User::where('email', $user->getEmail())->first();

            if ($findUser) {

                \Auth::guard('web')->loginUsingId($findUser->id);
                return redirect()->route('profile','dashboard')->with('success', 'You are logged in successfully.');
            } else {

                $user_data = array(
                    'firstname' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'],
                    // 'username' => strtolower(preg_replace("/\s+/", "", $user->user['name'])),
                    'username' => $name[0],
                    'email' => $user->user['email'],
                    // 'user_dp' => $user->getAvatar(),
                    'image' => $user->user['picture'],
                    // 'login_type' => 'G',
                    'status' => 1,
                    'ev' => 1,
                    'sv' => 1,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                );
                $user_id=User::insertGetId($user_data);
                \Auth::guard('web')->loginUsingId($user_id);
                return redirect()->route('profile','dashboard');
                
            }
        } catch (Exception $e) {
            return redirect()->route('user.login');
        }
    }
}

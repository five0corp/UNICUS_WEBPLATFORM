<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('regStatus')->except('registrationNotAllowed');

        $this->activeTemplate = activeTemplate();
    }

    public function showRegistrationForm()
    {
        $pageTitle = "Sign Up";
        $users = User::where('status', 1)->orderBy('id', 'DESC')->limit(4)->get();
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobile_code = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view($this->activeTemplate . 'user.auth.register', compact('pageTitle','mobile_code','countries', 'users'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $general = GeneralSetting::first();
        $password_validation = Password::min(6);
        if ($general->secure_password) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
        $countryData = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        // $countryCodes = implode(',', array_keys($countryData));
        // $mobileCodes = implode(',',array_column($countryData, 'dial_code'));
        // $countries = implode(',',array_column($countryData, 'country'));
        $validate = Validator::make($data, [
            // 'firstname' => 'sometimes|required|string|max:50',
            // 'lastname' => 'sometimes|required|string|max:50',
            'email' => 'required|string|email|max:90|unique:users',
            // 'mobile' => 'required|string|max:50|unique:users',
            'password' => ['required','confirmed',$password_validation],
            'username' => 'required|alpha_num|unique:users|min:6',
            'captcha' => 'sometimes|required',
            // 'mobile_code' => 'required|in:'.$mobileCodes,
            // 'country_code' => 'required|in:'.$countryCodes,
            // 'country' => 'required|in:'.$countries,
            'agree' => $agree,
       
        ]);
        
        
        return $validate;
    }

    public function register(Request $request)
    {
        $res=$this->validator($request->all())->validate();
        // $exist = User::where('mobile',$request->mobile_code.$request->mobile)->first();
        // if ($exist) {
        //     $notify[] = ['error', 'The mobile number already exists'];
        //     return back()->withNotify($notify)->withInput();
        // }

        // if (isset($request->captcha)) {
        //     if (!captchaVerify($request->captcha, $request->captcha_secret)) {
        //         $notify[] = ['error', "Invalid captcha"];
        //         return back()->withNotify($notify)->withInput();
        //     }
        // }
        $data=[
            'email' => $res['email'],
            'password' =>$res['password'],
            'username' => $res['username'],
             'ev' => 0,
             'agree' => $res['agree'],
            ];
        event(new Registered($user = $this->create($data)));

        //$this->guard()->login($user);

        //start send mail
        if (\Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
       
        $url = URL::temporarySignedRoute(
            'user.email-verify',
            now()->addMinutes(30),
            ['user' => $user->id]
        );

        $site_title = 'Unicus';
        $mailBody = '
                    <p>Dear <b>' . $user->username . '</b>,</p>
                    <p style="font-size:16px;color:#333333;line-height:24px;margin:0">Click the below button for Email Verification.</p>
                    <p style="color:#333333;font-size:16px;line-height:24px;margin:0;padding-bottom:23px;margin-top:20px;text-align:center">
                        <a style="padding:10px;background:#007bff;color:#fff;border-radius:5px;cursor:pointer;text-decoration:none;" href="' . $url . '"> Verify Email </a>
                    </p>
                    <br/><br/>
                    <p style="color:#333333;font-size:16px;line-height:24px;margin:0;padding-bottom:23px">Thank you<br />' . $site_title . '<br/></p>
                    ';
     
        $array = array('subject' => 'Welcome to ' . $site_title, 'view' => 'emails.company_panel', 'body' => $mailBody);

        if (strpos($_SERVER['SERVER_NAME'], "localhost") === false && strpos($_SERVER['SERVER_NAME'], "unify1") === false) {
            Mail::to($user->email)->send(new SendMail($array));
        }
        return redirect(route('user.register'))->with('success','Mail has been sent to your email address. Please check email to varify your email.'); 
        //end send mail
        // return $this->registered($request, $user)
        //     ?: redirect($this->redirectPath());
    }

    public function emailVerify($id){
        User::where('id',$id)->update(['ev'=> 1]);
        return redirect()->route('user.login')->with('success','Email Verified Successfully.Please Sign in!');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $general = GeneralSetting::first();
        $user = new User();
        // $user->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        // $user->lastname = isset($data['lastname']) ? $data['lastname'] : null;
        $user->email = strtolower(trim($data['email']));
        $user->password = Hash::make($data['password']);
        $user->username = trim($data['username']);
        // $user->country_code = $data['country_code'];
        // $user->mobile = $data['mobile_code'].$data['mobile'];
        // $user->address = [
        //     'address' => '',
        //     'state' => '',
        //     'zip' => '',
        //     'country' => isset($data['country']) ? $data['country'] : null,
        //     'city' => ''
        // ];
        $user->status = 1;
        $user->ev = $general->ev ? 0 : 1;
        $user->sv = $general->sv ? 0 : 1;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
        $adminNotification->save();

        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
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


        return $user;
    }

    public function checkUser(Request $request){
        $exist['data'] = null;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email',$request->email)->first();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = User::where('mobile',$request->mobile)->first();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = User::where('username',$request->username)->first();
            $exist['type'] = 'username';
        }
        return response($exist);
    }

    public function registered()
    {
        return redirect()->route('user.home');
    }

}

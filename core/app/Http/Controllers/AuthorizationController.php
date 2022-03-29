<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


class AuthorizationController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }
    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->ver_code_send_at) return false;
        if ($user->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->ver_code !== $code) return false;
        return true;
    }


    public function authorizeForm()
    {

        if (auth()->check()) {
            $user = auth()->user();
            $user_id = $user->id;
            if (!$user->status) {
                \Auth::logout();
            } elseif (!$user->ev || $user->env == 0) {
                if (\Auth::guard('web')->check()) {
                    \Auth::guard('web')->logout();
                }
                $user = User::find($user_id);
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
                return redirect(route('user.login'))->with('success', 'Your email is not verified. Mail has been sent to your email address. Please check email to varify your email.');

                // if (!$this->checkValidCode($user, $user->ver_code)) {
                //     $user->ver_code = verificationCode(6);
                //     $user->ver_code_send_at = Carbon::now();
                //     $user->save();
                //     sendEmail($user, 'EVER_CODE', [
                //         'code' => $user->ver_code
                //     ]);
                // }
                // $pageTitle = 'Email verification form';
                // return view($this->activeTemplate.'user.auth.authorization.email', compact('user', 'pageTitle'));
            } elseif (!$user->sv) {
                if (!$this->checkValidCode($user, $user->ver_code)) {
                    $user->ver_code = verificationCode(6);
                    $user->ver_code_send_at = Carbon::now();
                    $user->save();
                    sendSms($user, 'SVER_CODE', [
                        'code' => $user->ver_code
                    ]);
                }
                $pageTitle = 'SMS verification form';
                return view($this->activeTemplate . 'user.auth.authorization.sms', compact('user', 'pageTitle'));
            } elseif (!$user->tv) {
                $pageTitle = 'Google Authenticator';
                return view($this->activeTemplate . 'user.auth.authorization.2fa', compact('user', 'pageTitle'));
            } else {
                return redirect()->route('user.home');
            }
        }

        return redirect()->route('user.login');
    }

    public function sendVerifyCode(Request $request)
    {
        $user = Auth::user();


        if ($this->checkValidCode($user, $user->ver_code, 2)) {
            $target_time = $user->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $target_time - time();
            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);
        }
        if (!$this->checkValidCode($user, $user->ver_code)) {
            $user->ver_code = verificationCode(6);
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        } else {
            $user->ver_code = $user->ver_code;
            $user->ver_code_send_at = Carbon::now();
            $user->save();
        }



        if ($request->type === 'email') {
            sendEmail($user, 'EVER_CODE', [
                'code' => $user->ver_code
            ]);

            $notify[] = ['success', 'Email verification code sent successfully'];
            return back()->withNotify($notify);
        } elseif ($request->type === 'phone') {
            sendSms($user, 'SVER_CODE', [
                'code' => $user->ver_code
            ]);
            $notify[] = ['success', 'SMS verification code sent successfully'];
            return back()->withNotify($notify);
        } else {
            throw ValidationException::withMessages(['resend' => 'Sending Failed']);
        }
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email_verified_code' => 'required'
        ]);


        $email_verified_code = str_replace(' ', '', $request->email_verified_code);
        $user = Auth::user();

        if ($this->checkValidCode($user, $email_verified_code)) {
            $user->ev = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->route('user.home');
        }
        throw ValidationException::withMessages(['email_verified_code' => 'Verification code didn\'t match!']);
    }

    public function smsVerification(Request $request)
    {
        $request->validate([
            'sms_verified_code' => 'required',
        ]);


        $sms_verified_code =  str_replace(' ', '', $request->sms_verified_code);

        $user = Auth::user();
        if ($this->checkValidCode($user, $sms_verified_code)) {
            $user->sv = 1;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            return redirect()->route('user.home');
        }
        throw ValidationException::withMessages(['sms_verified_code' => 'Verification code didn\'t match!']);
    }
    public function g2faVerification(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'code' => 'required',
        ]);
        $code = str_replace(' ', '', $request->code);
        $response = verifyG2fa($user, $code);
        if ($response) {
            $notify[] = ['success', 'Verification successful'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }
}

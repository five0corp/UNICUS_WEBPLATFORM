<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Rootsoft\IPFS\Clients\IPFSClient;
use App\Mail\SendMail;

class TestController extends Controller
{


    public function index()
    {
        $client = new IPFSClient('127.0.0.1', 5001);
        try {
            $response = $client->add(Utils::tryFopen('assets/images/won.glb', 'r'), '1234.glb', ['pin' => true]);
            //$contents = $client->pin($response['Hash']);
            $contents = $client->cat($response['Hash']);
            dd($response);
        } catch (\Exception $e) {
            dd($e);
        }
        dd($ipfs);
    }

    public function view()
    {
        return view('templates.basic.test');
    }

    public function mailsend(Request $request)
    {
        $user = User::find(7);
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
        // dd($mailBody);
        // $ref_id
        $array = array('subject' => 'Welcome to ' . $site_title, 'view' => 'emails.company_panel', 'body' => $mailBody);

        if (strpos($_SERVER['SERVER_NAME'], "localhost") === false && strpos($_SERVER['SERVER_NAME'], "unify1") === false) {
            Mail::to($user->email)->send(new SendMail($array));
        }

        echo 'done';
        exit;
    }

    public function emailVerify($id){
        User::where('id',$id)->update(['ev'=> 1]);
        return redirect()->route('user.login')->with('success','Email Verified Successfully.');
    }
}

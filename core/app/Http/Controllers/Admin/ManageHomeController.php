<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTextEditor;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class ManageHomeController extends Controller
{
    public function index(){
        $home= HomeTextEditor::first();
        $id=1;
        $body='';
        if($home){
            $body=$home->body;
        }
        $pageTitle = 'Home Text Editor';
        return view('admin.homeTextEditor', compact('pageTitle','id', 'body'));
    }

    public function update(Request $request){
        $body=$request->body;
        $home=HomeTextEditor::first();
        if($home){
            HomeTextEditor::where('id',1)->update(['body'=>$body]);
        }else{
            HomeTextEditor::insert(['body'=>$body]);
        }
        $notify[] = ['success', 'Updated Successfully!'];
        return back()->withNotify($notify);
    }

    public function socialLink(){
        $links= SocialMediaLink::first();
        $id=1;       
        $pageTitle = 'Social Media Links';
        return view('admin.socialLinks', compact('pageTitle','id', 'links'));
    }

    public function updateSocialLink(Request $request){
        $links=SocialMediaLink::first();
        if($links){
            SocialMediaLink::where('id',1)->update([
                'blog_link'=>($request->blog_link== null) ? '' : $request->blog_link,
                'telegram_link'=>($request->telegram_link ==null) ? '' : $request->telegram_link,
                'twitter_link'=>($request->twitter_link==null) ? '' : $request->twitter_link,
                'medium_link'=>($request->medium_link==null) ? '' : $request->medium_link
            ]);
        }else{
            SocialMediaLink::insert([
                'blog_link'=>($request->blog_link== null) ? '' : $request->blog_link,
                'telegram_link'=>($request->telegram_link ==null) ? '' : $request->telegram_link,
                'twitter_link'=>($request->twitter_link==null) ? '' : $request->twitter_link,
                'medium_link'=>($request->medium_link==null) ? '' : $request->medium_link
            ]);
        }
        $notify[] = ['success', 'Updated Successfully!'];
        return back()->withNotify($notify);
    }
}

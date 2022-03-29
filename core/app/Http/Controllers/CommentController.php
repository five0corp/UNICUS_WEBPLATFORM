<?php

namespace App\Http\Controllers;

use App\Models\CommunityComment;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {
        if(! Auth::user()){
            return redirect()->route('user.login');
        }
        $request->validate([
            'comment' => 'required',
            'blog_id' => 'required'
        ]);
        $user = Auth::user();
        $commentObj = new CommunityComment();
        // $review = new Review();
        $commentObj->user_id = $user->id;
        $commentObj->comment = $request->comment;
        $commentObj->blog_id = $request->blog_id;
        $commentObj->save();
        $notify[] = ['success', 'Thanks for putting your review.'];
        return back()->withNotify($notify);
    }
}

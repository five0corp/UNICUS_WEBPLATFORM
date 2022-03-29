<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Specification;
use App\Rules\FileTypeValidate;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function __construct()
    {
       
    }
    
    public function index()
    {
        $pageTitle = "Add Community";
        if(!auth()->user()){
            return redirect()->route('user.login');
        }
        return view('templates.basic.add-community',compact('pageTitle'));
    }

    public function store(Request $request){
        
        $request->validate([
            'type' => 'required',
            'title' => 'required',

        ]);
        $user_id=auth()->user()->id;
        $blog = new Blog();
        $blog->type = $request->type;
        $blog->title = $request->title;
        $blog->user_id = $user_id;
        $blog->description = $request->description;
        if ($request->hasFile('image')) {
            $path = imagePath()['blog']['path'];
            $size = imagePath()['blog']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $blog->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $blog->save();
        $notify[] = ['success', 'Blog has been created'];
        return redirect()->route('community')->withNotify($notify);
    }

    public function announcementDetail($id){
        $pageTitle = "Announcement Details";
        $announcement = Blog::find($id);
        return view('templates.basic.announcement-detail',compact('announcement','pageTitle'));
    }
}

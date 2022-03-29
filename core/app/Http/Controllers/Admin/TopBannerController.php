<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTextEditor;
use App\Models\TopBanner;
use Illuminate\Http\Request;

class TopBannerController extends Controller
{
    public function index(){
        $banner= TopBanner::first();
        $id=1;
        $title='';
        $link='';
        $image='';
        $active='';
        if($banner){
            $title=$banner->title;
            $link=$banner->link;
            $image=$banner->image;
            $active=$banner->active;
        }
        $pageTitle = 'Top Banner';
        return view('admin.topBanner', compact('pageTitle','id', 'image','link','active'));
    }

    public function update(Request $request){
        $link=$request->link;
        $active=$request->active;
        $home=TopBanner::first();
        $image="";
        if ($request->hasFile('image')) {
            $path = imagePath()['slider']['path'];
            $size = imagePath()['slider']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if($home){
            if($image==""){
                $image=$home->image;
            }
            TopBanner::where('id',1)->update(['link'=>$link,'image'=>$image,'active'=>$active]);
        }else{
            TopBanner::insert(['link'=>$link,'image'=>$image,'active'=>$active]);
        }
        
        $notify[] = ['success', 'Updated Successfully!'];
        return back()->withNotify($notify);
    }

}

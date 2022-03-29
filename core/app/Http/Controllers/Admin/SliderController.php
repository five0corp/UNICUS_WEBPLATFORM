<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Slider";
        $emptyMessage = "No data found";
        $sliders = Slider::latest()->paginate(getPaginate());
        return view('admin.slider.index', compact('pageTitle', 'emptyMessage', 'sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'image'=>  ['required','image',new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'rank' => 'required'
        ]);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->rank = $request->rank;

        if ($request->hasFile('image')) {
            $path = imagePath()['slider']['path'];
            $size = imagePath()['slider']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $slider->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        // $brand->status = $request->status ? 1: 0;
        $slider->save();
        $notify[] = ['success', 'Slider has been created'];
        return back()->withNotify($notify);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:sliders,id',
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'rank' => 'required'
        ]);
        $slider = Slider::findOrFail($request->id);
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->rank = $request->rank;

        if ($request->hasFile('image')) {
            $path = imagePath()['slider']['path'];
            $size = imagePath()['slider']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $slider->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $slider->save();
        $notify[] = ['success', 'Slider has been updated'];
        return back()->withNotify($notify);
    }

    public function delete($id){
        $pageTitle = "Delete slider image";
       
        Slider::where('id',$id)->delete();
        $notify[] = ['success', 'Slider image has been deleted'];
        return back()->withNotify($notify);
       
    }
}

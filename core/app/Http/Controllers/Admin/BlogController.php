<?php

namespace App\Http\Controllers\Admin;

use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CommunityCategory;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function templates()
    {
        $pageTitle = 'Templates';
        $temPaths = array_filter(glob('core/resources/views/templates/*'), 'is_dir');
        foreach ($temPaths as $key => $temp) {
            $arr = explode('/', $temp);
            $tempname = end($arr);
            $templates[$key]['name'] = $tempname;
            $templates[$key]['image'] = asset($temp) . '/preview.jpg';
        }
        $extra_templates = json_decode(getTemplates(), true);
        return view('admin.frontend.templates', compact('pageTitle', 'templates', 'extra_templates'));

    }

    public function templatesActive(Request $request)
    {
        $general = GeneralSetting::first();

        $general->active_template = $request->name;
        $general->save();

        $notify[] = ['success', 'Updated successfully'];
        return back()->withNotify($notify);
    }

    public function seoEdit()
    {
        $pageTitle = 'SEO Configuration';
        $seo = Frontend::where('data_keys', 'seo.data')->first();
        if(!$seo){
            $data_values = '{"keywords":["admin","blog"],"description":"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit","social_title":"WEBSITENAME","social_description":"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit","image":null}';
            $data_values = json_decode($data_values, true);
            $frontend = new Frontend();
            $frontend->data_keys = 'seo.data';
            $frontend->data_values = $data_values;
            $frontend->save();
        }
        return view('admin.frontend.seo', compact('pageTitle', 'seo'));
    }



    public function index()
    {
        $pageTitle = "Manage Blogs";
        $emptyMessage = "No data found";
        $blogs = Blog::latest()->paginate(getPaginate());
        return view('admin.blog.index', compact('pageTitle', 'emptyMessage', 'blogs'));
    }




    public function frontendContent(Request $request, $key)
    {
        $purifier = new \HTMLPurifier();
        $valInputs = $request->except('_token', 'image_input', 'key', 'status', 'type', 'id');
        foreach ($valInputs as $keyName => $input) {
            if (gettype($input) == 'array') {
                $inputContentValue[$keyName] = $input;
                continue;
            }
            $inputContentValue[$keyName] = $purifier->purify($input);
        }
        $type = $request->type;
        if (!$type) {
            abort(404);
        }
        $imgJson = @getPageSections()->$key->$type->images;
        $validation_rule = [];
        $validation_message = [];
        foreach ($request->except('_token', 'video') as $input_field => $val) {
            if ($input_field == 'has_image' && $imgJson) {
                foreach ($imgJson as $imgValKey => $imgJsonVal) {
                    $validation_rule['image_input.'.$imgValKey] = ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])];
                    $validation_message['image_input.'.$imgValKey.'.image'] = inputTitle($imgValKey).' must be an image';
                    $validation_message['image_input.'.$imgValKey.'.mimes'] = inputTitle($imgValKey).' file type not supported';
                }
                continue;
            }elseif($input_field == 'seo_image'){
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, $validation_message, ['image_input' => 'image']);
        if ($request->id) {
            $content = Frontend::findOrFail($request->id);
        } else {
            $content = Frontend::where('data_keys', $key . '.' . $request->type)->first();
            if (!$content || $request->type == 'element') {
                $content = new Frontend();
                $content->data_keys = $key . '.' . $request->type;
                $content->save();
            }
        }
        if ($type == 'data') {
            $inputContentValue['image'] = @$content->data_values->image;
            if ($request->hasFile('image_input')) {
                try {
                    $inputContentValue['image'] = uploadImage($request->image_input,imagePath()['seo']['path'], imagePath()['seo']['size'], @$content->data_values->image);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload the image.'];
                    return back()->withNotify($notify);
                }
            }
        }else{
            if ($imgJson) {
                foreach ($imgJson as $imgKey => $imgValue) {
                    $imgData = @$request->image_input[$imgKey];
                    if (is_file($imgData)) {
                        try {
                            $inputContentValue[$imgKey] = $this->storeImage($imgJson,$type,$key,$imgData,$imgKey,@$content->data_values->$imgKey);
                        } catch (\Exception $exp) {
                            $notify[] = ['error', 'Could not upload the image.'];
                            return back()->withNotify($notify);
                        }
                    } else if (isset($content->data_values->$imgKey)) {
                        $inputContentValue[$imgKey] = $content->data_values->$imgKey;
                    }
                }
            }
        }
        $content->data_values = $inputContentValue;
        $content->save();
        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }



    public function blogDetail( $id = null)
    {
        $pageTitle = ' Items';
       //$categories = CommunityCategory::get();
        if ($id) {
            $blog = Blog::findOrFail($id);
            return view('admin.blog.element', compact('pageTitle', 'blog','id'));
        }
        return view('admin.blog.element', compact( 'pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required',
            'title' => 'required',

        ]);
        $blog = new Blog();
        $blog->type = $request->type;
        $blog->title = $request->title;
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
        return back()->withNotify($notify);
    }

    public function update($id,Request $request){
        $request->validate([
            'type' => 'required',
            'title' => 'required',

        ]);
        
        $blog = Blog::findOrFail($id);
        $blog->type = $request->type;
        $blog->title = $request->title;
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
        $notify[] = ['success', 'Blog has been updated'];
        return back()->withNotify($notify);
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);
        $blog = Blog::findOrFail($request->id);
        $blog->delete();
        $notify[] = ['success', 'Blog has been removed.'];
        return back()->withNotify($notify);
    }


}

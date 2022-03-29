<?php

namespace App\Http\Controllers\Admin;

use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CommunityCategory;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage Articles";
        $emptyMessage = "No data found";
        $articles = Article::latest()->paginate(getPaginate());
        return view('admin.article.index', compact('pageTitle', 'emptyMessage', 'articles'));
    }



    public function detail( $id = null)
    {
        $pageTitle = ' Article';
       //$categories = CommunityCategory::get();
        if ($id) {
            $article = Article::findOrFail($id);
            return view('admin.article.element', compact('pageTitle', 'article','id'));
        }
        return view('admin.article.element', compact( 'pageTitle'));
    }

    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'label' => 'required',

        ]);
        $artical = new Article();
        $artical->label = $request->label;
        $artical->description = $request->description;
        if ($request->hasFile('image')) {
            $path = 'assets/images/article';
            try {
                $filename = uploadImage($request->image, $path);
                $artical->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $artical->save();
        $notify[] = ['success', 'Article has been created'];
        return back()->withNotify($notify);
    }

    public function update($id,Request $request){
        $request->validate([
            'description' => 'required',
            'label' => 'required',
        ]);
        
        $artical = Article::findOrFail($id);
        $artical->label = $request->label;
        $artical->description = $request->description;
        if ($request->hasFile('image')) {
            $path = 'assets/images/article';
            try {
                $filename = uploadImage($request->image, $path);
                $artical->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $artical->save();
        $notify[] = ['success', 'Article has been updated'];
        return back()->withNotify($notify);
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);
        $artical = Article::findOrFail($request->id);
        $artical->delete();
        $notify[] = ['success', 'Article has been removed.'];
        return back()->withNotify($notify);
    }


}

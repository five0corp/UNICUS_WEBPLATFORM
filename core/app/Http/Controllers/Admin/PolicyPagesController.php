<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PolicyPage;
use App\Models\Specification;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class PolicyPagesController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage Pages";
        $emptyMessage = "No data found";
        $pages = PolicyPage::latest()->paginate(getPaginate());
        return view('admin.policy-page.index', compact('pageTitle', 'emptyMessage', 'pages'));
    }

    public function create(){
        $pageTitle = "Create Pages";
        return view('admin.policy-page.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            // 'slug' => 'required'
        ]);
        $page = new PolicyPage();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = $request->slug;
        // $page->slug = \Str::slug($request->title);
        $page->save();
        $notify[] = ['success', 'Page has been created'];
        return back()->withNotify($notify);
    }

    public function edit($id){
        $pageTitle = "Edit Pages";
        $page = PolicyPage::find($id);
        return view('admin.policy-page.create', compact('pageTitle','page','id'));
    }


    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required|exists:policy_pages,id',
            'title' => 'required',
            'content' => 'required',
            // 'slug' => 'required'
        ]);
        $page = PolicyPage::findOrFail($request->id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = $request->slug;
        // $page->slug = \Str::slug($request->title);
        $page->save();
        $notify[] = ['success', 'Page has been updated'];
        return back()->withNotify($notify);
    }

    public function delete(Request $request){
        $id=$request->id;
        PolicyPage::where('id',$id)->delete();
        $notify[] = ['success', 'Page has been deleted'];
        return back()->withNotify($notify);

    }
}

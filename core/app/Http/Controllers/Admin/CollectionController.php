<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Specification;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage Collection";
        $emptyMessage = "No data found";
        $collections = Collection::latest()->paginate(getPaginate());
        return view('admin.collections.index', compact('pageTitle', 'emptyMessage', 'collections'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $collection = new Collection();

        if ($request->hasFile('image')) {
            $path = imagePath()['collection']['path'];
           
            try {
                $filename = uploadImage($request->image, $path);
                $collection->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $collection->name = $request->name;
   
        $collection->save();
        $notify[] = ['success', 'Collection has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:collections,id',
            'name' => 'required',
        ]);
        $collection = Collection::findOrFail($request->id);
        $collection->name = $request->name;
        if ($request->hasFile('image')) {
            $path = imagePath()['collection']['path'];
           
            try {
                $filename = uploadImage($request->image, $path);
                $collection->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $collection->save();
        $notify[] = ['success', 'Collection has been updated'];
        return back()->withNotify($notify);
    }

    public function delete(Request $request){
        $id=$request->id;
        Collection::where('id',$id)->delete();
        $notify[] = ['success', 'Collection has been deleted'];
        return back()->withNotify($notify);

    }
}

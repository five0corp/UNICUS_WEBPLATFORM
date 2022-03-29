<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Partner";
        $emptyMessage = "No data found";
        $partners = Partner::latest()->paginate(getPaginate());
        return view('admin.partner.index', compact('pageTitle', 'emptyMessage', 'partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'image'=>  ['required','image',new FileTypeValidate(['png'])]
        ]);
        $partner = new Partner();
        $partner->link = $request->link;
        $partner->active = $request->active;

        if ($request->hasFile('image')) {
            $path = 'assets/images/partner';
            try {
                $filename = uploadImage($request->image, $path);
                $partner->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        // $brand->status = $request->status ? 1: 0;
        $partner->save();
        $notify[] = ['success', 'Partner has been created'];
        return back()->withNotify($notify);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:partners,id',
            'link' => 'required'
        ]);
        $partner = Partner::findOrFail($request->id);
        $partner->link = $request->link;
        $partner->active = $request->active;

        if ($request->hasFile('image')) {
            $path = 'assets/images/partner';
            try {
                $filename = uploadImage($request->image, $path);
                $partner->image = $filename;
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $partner->save();
        $notify[] = ['success', 'Partner has been updated'];
        return back()->withNotify($notify);
    }
}

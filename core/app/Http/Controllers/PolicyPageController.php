<?php

namespace App\Http\Controllers;

use App\Models\PolicyPage;

class PolicyPageController extends Controller
{
   public function index($slug){
       $page=PolicyPage::where('slug',$slug)->first();
       $pageTitle=$slug;
       return view('templates.basic.page', compact('pageTitle', 'page'));
   }
}

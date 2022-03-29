<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Page;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Subcategory;
use App\Models\MetamaskTransactionPayment;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\SupportTicket;
use App\Models\HomeTextEditor;
use App\Models\ProductBidding;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\Article;
use App\Models\Collection;
use App\Models\CommunityComment;
use App\Models\SupportAttachment;
use App\Models\MetamaskTransaction;
use App\Models\Partner;
use App\Models\TopBanner;
use Illuminate\Support\Facades\DB;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();
        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();

        $categories= Category::where('status',1)->get();
        $latestProduct= Product::with('collection')->where('latest',1)->get();
        $fetauredProduct= Product::with('collection')->where('featured',1)->get();
        $partners= Partner::where('active',1)->get();
        $articls= Article::get();
        // $fetauredProduct= Product::where('featured',1)->whereDate('end_date','>=', Carbon::now()->toDateTimeString())->get();
        $sliders = Slider::get();
        $topBanner=TopBanner::first();
        // dd($fetauredProduct);
        $homeTextEditor= HomeTextEditor::first();

        $blogs = Blog::where('type', 'N')->orderBy('id','desc')->limit(3)->get();
        return view($this->activeTemplate . 'home', compact('pageTitle','partners','blogs','articls','topBanner','homeTextEditor', 'sections', 'sliders','fetauredProduct','latestProduct','categories'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact', compact('pageTitle'));
    }

    public function profile($username)
    {
        $user = User::where('username', $username)->where('status', 1)->firstOrFail();
        $pageTitle = $user->username . " Product list";
        $emptyMessage = "No data found";

        $reviews = Review::whereHas('product', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('user')->paginate(getPaginate());

        $reviewCount = $reviews->avg('starts');

        $totalSale = Order::where('status', '!=', 0)->whereHas('product', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();
        return view($this->activeTemplate . 'profile', compact('pageTitle', 'emptyMessage', 'user', 'totalSale', 'reviews', 'reviewCount'));
    }

    public function categoryProduct($id)
    {
        $category = Category::findOrFail($id);
        $pageTitle = ucfirst($category->name) . " Product list";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->with('product')->latest()->get();
        $products = Product::where('sub_category_id', $id)
            ->where('status', 1)
            ->whereDate('time_duration', '>', Carbon::now()->toDateTimeString())
            ->inRandomOrder()->with('order')
            ->paginate(getPaginate(12));
        return view($this->activeTemplate . 'product', compact('pageTitle', 'emptyMessage', 'products', 'brands'));
    }

    public function subCategoryProduct($id)
    {
        $subCategory = Subcategory::findOrFail($id);
        $pageTitle = ucfirst($subCategory->name) . " Product list";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->with('product')->latest()->get();
        $products = Product::where('sub_category_id', $id)
            ->where('status', 1)
            ->whereDate('time_duration', '>', Carbon::now()->toDateTimeString())
            ->inRandomOrder()->with('order')
            ->paginate(getPaginate(12));
        return view($this->activeTemplate . 'product', compact('pageTitle', 'emptyMessage', 'products', 'brands'));
    }

    public function product(Request $request)
    {
        if (session()->has('range')) {
            session()->forget('range');
        }
        $cat_id=0;
        $collection_id=0;
        if($request->cat){
            $cat_id=$request->cat;
        }
        if($request->collection){
            $collection_id=$request->collection;
        }

        $limit = 12;
        $pageTitle = "All product";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->with('product')->latest()->get();
        $products = Product::with('productBids','user','collection');
            //->where('is_start_auction', 1);
            // ->whereDate('end_date', '>', Carbon::now()->toDateTimeString());
        
        if ($request->search) {
            $products = $products->where('title', 'like', '%' . $request->search . '%');
        }
        if($cat_id>0){
            $products = $products->where('category_id',$cat_id);
        }
        if($collection_id>0){
            $products = $products->where('created_by',$collection_id);
        }
        $products = $products->with('order');
        // $products = $products->inRandomOrder()->with('order');
        $totalProducts = $products->count();
        $products = $products->paginate(getPaginate($limit));
        $load = $products->count();
        if ($request->page) {
            $page = $request->page;
            $loaded = (($page - 1) * $limit) + $load;
        } else {
            $page = 0;
            $loaded = $load;
        }
        
        $collections=Collection::get();
      
        if ($request->ajax) {
            $view = view('templates.basic.product-list', compact('products'))->render();
            return response()->json(['status' => 200, 'view' => $view, 'totalProducts' => $totalProducts, 'loaded' => $loaded]);
        }
        // dd($this->activeTemplate . 'product');
        return view($this->activeTemplate . 'product', compact('pageTitle', 'totalProducts','collections', 'loaded', 'emptyMessage', 'products', 'brands','cat_id','collection_id'));
    }

    public function productFilter(Request $request)
    {
        $request->validate([
            'sort' => 'nullable|in:1,2,3,4',
            'brand.*' => 'nullable|exists:brands,id',
            'category.*' => 'nullable|exists:categories,id'
        ]);
        $pageTitle = "Product Filter Search";
        $emptyMessage = "No data found";
        $brandId = $request->brand;
        $categoryId = $request->category;
        $sortId = $request->sort;
        $search = $request->search;
        $brands = Brand::where('status', 1)->with('product')->latest()->get();
        $products = Product::where('status', 1)
            ->whereDate('time_duration', '>', Carbon::now()->toDateTimeString());
        if ($request->category) {
            $products = $products->whereIn('category_id', $request->category);
        }
        if ($request->brand) {
            $products = $products->whereIn('brand_id', $request->brand);
        }
        if ($request->amount) {
            $amount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
            $amountArray = explode("-", $amount);
            if (session()->has('range')) {
                session()->forget('range');
            }
            session()->put('range', $amountArray);
            $products = $products->whereBetween('amount', $amountArray);
        }
        if ($request->sort) {
            if ($request->sort == 1) {
                $products = $products->orderby('id', 'DESC');
            }
            if ($request->sort == 2) {
                $products = $products->orderby('rating', 'DESC');
            }
            if ($request->sort == 3) {
                $products = $products->orderby('amount', 'DESC');
            }
            if ($request->sort == 4) {
                $products = $products->withCount('order')->orderby('order_count', 'DESC');
            }
        }
        if ($request->search) {
            $products = $products->whereJsonContains('keyword', $search)->orWhere('title', 'like', "%$search%");
        }
        $products = $products->with('order')->paginate(getPaginate(12));
        return view($this->activeTemplate . 'product', compact('pageTitle', 'emptyMessage', 'products', 'brands', 'categoryId', 'sortId', 'search', 'brandId'));
    }

    public function productDetails($id)
    {
        $pageTitle = "Product details";
        $product = Product::where('id', $id)
            //->where('status', 1)
            //->where('is_start_auction', 1)
            //->where('is_end_auction', 0)
            //->whereDate('end_date', '>', Carbon::now()->toDateTimeString())
            ->with('productSpecification.specification','collection', 'review.user')->firstOrFail();

            $date1 = new DateTime('now');
            $date2 = new DateTime($product->end_date);
            $difference = $date1->diff($date2);
       
            $diffInSeconds = $difference->s; //45
            $diffInMinutes = $difference->i; //23
            $diffInHours   = $difference->h; //8
            $diffInDays    = $difference->d; //21
            $diffInMonths  = $difference->m; //4
            $diffInYears   = $difference->y; //1
        
            $user = $product->user;
            $username = "";    
            if($user) {
                $username = $user->username;    
            }
            
        $relatedProducts = Product::where('status', 1)
        ->whereDate('time_duration', '>', Carbon::now()->toDateTimeString())
        //->where('user_id', $user->id)
        ->where('id', '!=', $id)
        ->limit(9)->inRandomOrder()->get();
        
        $user_id= (auth()->user()) ? auth()->user()->id : 0;
        $currentBid_amount = 0;

        $biddings = ProductBidding::selectRaw('SUM(bid_amount) as bid_amount, users.username as username, product_biddings.account_address')
                        ->join('users', 'users.id', '=', 'product_biddings.user_id')
                        ->where('product_biddings.product_id', $id)
                        ->where('users.status', 1)
                        ->groupBy('product_biddings.account_address')
                        ->orderBy('bid_amount', 'desc')->get();

        // return $biddings;
        
        if($product->count() > 0) {
            $currentBid = ProductBidding::with('user')
                        ->where('product_id',$id)
                        ->orderBy('created_at', 'desc')
                        ->first();
            
            $myBid = ProductBidding::where('user_id',$user_id)->where('product_id',$id)->orderBy('created_at', 'desc')->first();
            if($currentBid){
                $currentBid_amount=$currentBid->bid_amount;
            }else{
                $currentBid_amount=$product->start_price;
            }
        }
        $url= route('product.detail',$product->id);
        $shareButtons = \Share::page(
            $url,
            'Unicus',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        
        return view($this->activeTemplate . 'product_detail', compact('pageTitle','shareButtons','diffInDays','diffInHours','diffInMinutes','diffInSeconds','myBid','currentBid_amount','id', 'product','biddings', 'relatedProducts','user_id','username'));
    }

    // public function productDetails($id)
    // {
    //     $pageTitle = "Product details";
    //     $product = Product::where('id', $id)->where('status', 1)
    //         ->whereDate('end_date', '>', Carbon::now()->toDateTimeString())
    //         ->with('productSpecification.specification', 'review.user')->firstOrFail();

    //         $date1 = new DateTime('now');
    //         $date2 = new DateTime($product->end_date);
    //         $difference = $date1->diff($date2);
       
    //         $diffInSeconds = $difference->s; //45
    //         $diffInMinutes = $difference->i; //23
    //         $diffInHours   = $difference->h; //8
    //         $diffInDays    = $difference->d; //21
    //         $diffInMonths  = $difference->m; //4
    //         $diffInYears   = $difference->y; //1
        
    //         $user = $product->user;
    //         $relatedProducts = Product::where('status', 1)
    //         ->whereDate('time_duration', '>', Carbon::now()->toDateTimeString())
    //         //->where('user_id', $user->id)
    //         ->where('id', '!=', $id)
    //         ->limit(9)->inRandomOrder()->get();

    //     $user_id= (auth()->user()) ? auth()->user()->id : 0;
        
    //     $currentBid_amount=0;
    //     $biddings = ProductBidding::with('user')
    //                 ->where('product_id',$id)
    //                 ->orderBy('created_at', 'desc')->get();
    //     $currentBid = ProductBidding::with('user')
    //                 ->where('product_id',$id)
    //                 ->orderBy('created_at', 'desc')
    //                 ->first();
    //     $myBid = ProductBidding::where('user_id',$user_id)->where('product_id',$id)->orderBy('created_at', 'desc')->first();
    //     if($currentBid){
    //         $currentBid_amount=$currentBid->bid_amount;
    //     }else{
    //         $currentBid_amount=$product->start_price;
    //     }
        
    //     return view($this->activeTemplate . 'product_detail', compact('pageTitle','diffInDays','diffInHours','diffInMinutes','diffInSeconds','myBid','currentBid_amount','id', 'product','biddings', 'relatedProducts'));
    // }

    public function contactSubmit(Request $request)
    {
        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);
        $random = getNumber();
        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blog(Request $request)
    {
        $pageTitle = "Blog";
        $limit = 12;
        $blogs = Blog::where('type', 'N');
        // ->paginate(getPaginate());
        // dd($blogs);       
        $totalBlogs = $blogs->count();
        $blogs = $blogs->paginate(getPaginate($limit));
        $load = $blogs->count();

        $announcements = Blog::where('type','A')->orderBy('id','desc');
        $totalAnn = $announcements->count();
        $announcements = $announcements->paginate(getPaginate($limit));
        $loadAnn = $announcements->count();

        if ($request->page) {
            $page = $request->page;
            $loaded = (($page - 1) * $limit) + $load;
            $loadedAnn = (($page - 1) * $limit) + $loadAnn;
        } else {
            $page = 0;
            $loaded = $load;
            $loadedAnn = $loadAnn;
        }

        if ($request->ajax && $request->type=='B') {
            $view = view('templates.basic.blog-list', compact('blogs'))->render();
            return response()->json(['status' => 200, 'view' => $view, 'totalBlogs' => $totalBlogs, 'loaded' => $loaded]);
        }
        if ($request->ajax && $request->type=='A') {
            $view = view('templates.basic.announcement-list', compact('announcements'))->render();
            return response()->json(['status' => 200, 'view' => $view, 'totalAnn' => $totalAnn, 'loadedAnn' => $loadedAnn]);
        }
        return view($this->activeTemplate . 'blog', compact('blogs','announcements', 'pageTitle', 'totalBlogs', 'loaded','totalAnn','loadedAnn'));
    }

    public function blogDetails($id, $slug)
    {
        $pageTitle = "Blog Details";
        $blog = Blog::where('id', $id)->where('type', 'N')->firstOrFail();
        $recentBlogs = Blog::where('type', 'N')->orderby('id', 'DESC')->limit(8)->paginate(getPaginate());
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'recentBlogs'));
    }

    public function articleDetails($id)
    {
        $pageTitle = "Article Details";
        $artical = Article::where('id', $id)->firstOrFail();
        return view($this->activeTemplate . 'article_details', compact('artical', 'pageTitle'));
    }

    public function community(Request $request){
        $pageTitle = "Community";
        $limit = 12;
        $communities = Blog::where('type', 'C')->with('user');
        // ->paginate(getPaginate());
        // dd($blogs);
        $totalCommunities = $communities->count();
        $communities = $communities->orderBy('id','desc')->paginate(getPaginate($limit));
        $load = $communities->count();
        if ($request->page) {
            $page = $request->page;
            $loaded = (($page - 1) * $limit) + $load;
        } else {
            $page = 0;
            $loaded = $load;
        }

        if ($request->ajax) {
            $view = view('templates.basic.community-list', compact('communities'))->render();
            return response()->json(['status' => 200, 'view' => $view, 'totalCommunities' => $totalCommunities, 'loaded' => $loaded]);
        }
        return view('templates.basic.community', compact('communities', 'pageTitle', 'totalCommunities', 'loaded'));
    }

    public function communityDetails(Request $request, $id){
        $pageTitle = "Community Details";
        $blog = Blog::where('id', $id)->where('type', 'C')->firstOrFail();
        $recentComments = CommunityComment::where('blog_id',$id)->with('user')->orderby('id', 'DESC')->get();
        // $recentComments = CommunityComment::where('blog_id',$id)->with('user')->orderby('id', 'DESC')->limit(8)->paginate(getPaginate());
        return view($this->activeTemplate . 'community_details', compact('blog','id', 'pageTitle', 'recentComments'));
    }

    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        return response()->json('Cookie accepted successfully');
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }


    public function adclicked($id)
    {
        $ads = Advertisement::where('id', decrypt($id))->firstOrFail();
        $ads->click += 1;
        $ads->save();
        return redirect($ads->redirect_url);
    }


    public function footerMenu($slug, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle =  $data->data_values->title;
        return view($this->activeTemplate . 'menu', compact('data', 'pageTitle'));
    }
    
    public function my_nfts(Request $request) {
        if (!$request->user()) {
            return redirect()->route('user.login');
        }
        
        $data = MetamaskTransaction::select('metamask_transactions.*', 'products.title as product_name', 'product_biddings.bid_amount', 'products.symbol')
            ->join('product_biddings', 'product_biddings.id', '=', 'metamask_transactions.product_bidding_id')
            ->join('products', 'products.id', '=', 'metamask_transactions.product_id')
            ->paginate(10);
            
        $pageTitle = "My NFTs";

        return view($this->activeTemplate . 'metamask_transactions', compact('pageTitle', 'data'));
    }
    
    public function my_trans(Request $request) {
        if (!$request->user()) {
            return redirect()->route('user.login');
        }
        $user_id = auth()->user()->id;
        $data = ProductBidding::selectRaw('products.symbol, products.title as product_name, SUM(bid_amount) as bid_amount, users.firstname as username, products.updated_at as sold_at,products.image_hash as hash,products.id,product_biddings.account_address')
                                    ->join('users', 'users.id', '=', 'product_biddings.user_id')
                                    ->join('products', 'products.id', '=', 'product_biddings.product_id')
                                    ->where('products.status', 1)
                                    ->where('users.status', 1)
                                    ->where('products.user_id', $user_id)
                                    ->where('products.is_start_auction', 1)
                                    ->where('products.is_end_auction', 1)
                                    ->groupBy('product_biddings.account_address')
                                    ->orderBy('bid_amount', 'desc')->paginate(10);

        $pageTitle = "My Transactions";

        return view($this->activeTemplate . 'user_transactions', compact('pageTitle', 'data'));
    }
    
    public function transaction_details(Request $request, $id) {
        if (!$request->user()) {
            return redirect()->route('user.login');
        }

        $data = MetamaskTransactionPayment::where('id', $id)->first();
        $pageTitle = 'Transaction Details';
        return view($this->activeTemplate . 'transaction_details', compact('pageTitle', 'data'));
    }    
}

<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductBidding;
use App\Models\MetamaskTransaction;
use App\Models\MetamaskTransactionPayment;
use GuzzleHttp\Psr7\Utils;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\ProductReport;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Intervention\Image\Facades\Image;
use PhpParser\ErrorHandler\Collecting;
use Rootsoft\IPFS\Clients\IPFSClient;

class ProductController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Products";
        $emptyMessage = "No data found";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $products = Product::orderBy('id', 'DESC')->with('user', 'category', 'subCategory', 'brand')->paginate(getPaginate());
        
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'categorys','brands'));
    }

    public function start() {
        $pageTitle = "Start Auction";
        $emptyMessage = "No data found";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $products = Product::where('is_start_auction', 0)
            ->where('is_end_auction', 0)
            ->orderBy('id', 'DESC')
            ->with('user', 'category', 'subCategory', 'brand')
            ->paginate(getPaginate());        
        $button = 'Start Auction';
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'categorys','brands', 'button'));
    }

    public function started() {
        $pageTitle = "Started Auction";
        $emptyMessage = "No data found";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $products = Product::where('is_start_auction', 1)
            ->where('is_end_auction', 0)
            ->whereDate('end_date', '>', Carbon::now()->toDateTimeString())
            ->orderBy('id', 'DESC')->with('user', 'category', 'subCategory', 'brand')->paginate(getPaginate());        

        $button = '';
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'categorys','brands', 'button'));
    }

    public function end_auction() {
        $pageTitle = "End Auction";
        $emptyMessage = "No data found";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $products = Product::where('is_start_auction', 1)
            ->where('is_end_auction', 0)
            ->whereDate('end_date', '>=', Carbon::now()->toDateTimeString())
            ->orderBy('id', 'DESC')
            ->with('user', 'category', 'subCategory', 'brand')
            ->paginate(getPaginate());        
        
        $button = 'End Auction';
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'categorys','brands', 'button'));
        }

    public function processed() {
        $pageTitle = "Ended Auction";
        $emptyMessage = "No data found";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $products = Product::where('is_start_auction', 1)
            ->where('is_end_auction', 1)
            ->whereDate('end_date', '<=', Carbon::now()->toDateTimeString())
            ->orderBy('id', 'DESC')
            ->with('user', 'category', 'subCategory', 'brand')
            ->paginate(getPaginate());        
        
        $button = '';
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'categorys','brands','button'));    
    }

    public function updateProductAuctionStart(Request $request)
    {
        $product_id = $request->product_id;
        if($product_id > 0) {
          $product =  Product::where("id",$product_id)->first();
          $product->is_start_auction = 1;
          $product->save();
          
          $metamaskTransactionSql = MetamaskTransaction::where('product_id',$product_id)
                                        ->where('signature',$request->signature)
                                        ->where('transaction_hash',$request->transaction_hash)
                                        ->first();
            if(!$metamaskTransactionSql) {
                  $metamaskTransaction = new MetamaskTransaction();
                  $metamaskTransaction->product_id = $request->product_id;
                  $metamaskTransaction->hash = $request->hash;
                  $metamaskTransaction->transaction_hash = $request->transaction_hash;
                  $metamaskTransaction->signature = $request->signature;
                  $metamaskTransaction->event = "AS"; 
                  $metamaskTransaction->account_address = $request->account_address;
                  $metamaskTransaction->from_address = $request->from_address;
                  $metamaskTransaction->to_address = $request->to_address;
                  $metamaskTransaction->status = $request->status ? 1: 0;
                  $metamaskTransaction->timestamp = $request->timestamp;
                  $metamaskTransaction->block_no = $request->block_no;
                  $metamaskTransaction->amount = $request->amount;
                  $metamaskTransaction->save();
            }
        }
        echo "Done";
    }

    public function updateProductAuctionEnd(Request $request)
    {
        $product_id = $request->product_id;
        if($product_id > 0) {
          $product =  Product::where("id",$product_id)->first();
          $product->is_end_auction = 1;
          $product->save();
          
          $metamaskTransactionSql = MetamaskTransaction::where('product_id',$product_id)
                                        ->where('signature',$request->signature)
                                        ->where('transaction_hash',$request->transaction_hash)
                                        ->first();
          if(!$metamaskTransactionSql) {                              
              $metamaskTransaction = new MetamaskTransaction();
              $metamaskTransaction->product_id = $request->product_id;
              $metamaskTransaction->hash = $request->hash;
              $metamaskTransaction->transaction_hash = $request->transaction_hash;
              $metamaskTransaction->signature = $request->signature;
              $metamaskTransaction->event = "AE"; 
              $metamaskTransaction->account_address = $request->account_address;
              $metamaskTransaction->token_id = $request->token_id;
              $metamaskTransaction->from_address = $request->from_address;
              $metamaskTransaction->to_address = $request->to_address;
              $metamaskTransaction->status = $request->status ? 1: 0;
              $metamaskTransaction->block_no = $request->block_no;
              $metamaskTransaction->amount = $request->amount;
              $metamaskTransaction->save();
                $productUpdate = ProductBidding::where('product_id',$product_id)->where('account_address',$request->highestBidder)->first(); 
                $user_id = 0;
                if($productUpdate) {
                    $user_id = $productUpdate->user_id;
                }
                $productUpdate = Product::where('id',$product_id)->first();  
                $productUpdate->highest_bidding = $request->amount;
                $productUpdate->user_id = $user_id;
                $productUpdate->highest_bidder = $request->highestBidder;
                $productUpdate->nft_id = $request->token_id;
                $productUpdate->save();        
            
          }
          echo "Done";
        }
    }
    
    public function saveEndAuctionPaymentDetail(Request $request)
    {
        $metamaskTransactionPaymentsSql = MetamaskTransactionPayment::where('product_id',$request->product_id)
                                            ->where('signature',$request->signature)
                                            ->where('transaction_hash',$request->transaction_hash)
                                            ->first();
        
        if(!$metamaskTransactionPaymentsSql) {
            $MetamaskTransactionPayments = new MetamaskTransactionPayment();
            $MetamaskTransactionPayments->product_id = $request->product_id;
            $MetamaskTransactionPayments->hash = $request->hash;
            $MetamaskTransactionPayments->transaction_hash = $request->transaction_hash;
            $MetamaskTransactionPayments->signature = $request->signature;
            $MetamaskTransactionPayments->from_address = $request->from_address; 
            $MetamaskTransactionPayments->to_address = $request->to_address;
            $MetamaskTransactionPayments->amount = $request->amount;
            $MetamaskTransactionPayments->status = $request->status ? 1: 0;
            $MetamaskTransactionPayments->block_no = $request->block_no;
            $MetamaskTransactionPayments->save();
            
            $product =  Product::where("id",$request->product_id)->first();
            $product->status = 4;
            $product->save();
        }
        echo "Done";
    }

    public function create()
    {
        $pageTitle = "Add Product";
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $collections = Collection::get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $users = User::where('status', 1)->get();
        return view('admin.product.create', compact('pageTitle','users', 'categorys','brands','collections'));
    }

    public function edit($id)
    {
        $pageTitle = "Edit Product";
        $categorys = Category::with('subCategory')->where('status', 1)->select('id', 'name')->get(); 
        $collections = Collection::get(); 
        $subcategorys = Subcategory::select('id','category_id', 'name')->get(); 
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $product = Product::with('category', 'subCategory', 'brand','collection')->where('id',$id)->first();
        $users = User::where('status', 1)->get();
        // dd($users);
    //    dd($product);
        return view('admin.product.edit', compact('pageTitle','users','collections', 'product', 'categorys', 'subcategorys','id','brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'featured'=> 'nullable|in:1',
            'title'=> 'required|max:255',
            'sub_title'=> 'required|max:255',
            'start_price'=> 'required|numeric|gt:0',
            'sale_price'=> 'required|numeric|gt:0',
            // 'keywords' => 'required|array|max:15',
            'start_date'=> 'required|after_or_equal:today',
            'end_date'=> 'required|after_or_equal:today',
            'category_id'=> 'required|exists:categories,id',
            // 'sub_category'=> 'required|exists:subcategories,id',
            'brand'=> 'required|exists:brands,id',
            // 'image_type'=>  'required',
            // 'image'=>  'required',
            'image'=>  ['required','image',new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'description' => 'required',
            'pieces' => 'required'
        ]);
        // dd($request->all());
        $product = new Product();
        $product->title = $request->title;
        $product->sub_title = $request->sub_title;
        $product->category_id = $request->category_id;
        // $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->brand;
        $product->start_price = $request->start_price;
        $product->symbol = $request->symbol;
        $product->sale_price = $request->sale_price;
        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;
        $product->description = $request->description;
        $product->pieces = $request->pieces;
        $product->image_type = $request->image_type;
        $product->featured = $request->featured ? $request->featured : null;
        $product->latest = $request->latest ? $request->latest : null;
        $product->created_by = $request->created_by;
        // $product->user_id = $request->user_id;
        if ($request->hasFile('image')) {
            $path = imagePath()['product']['path'];
            $size = imagePath()['product']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $product->image = $filename;
                $product->image_type = 'N';

            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        // if($request->hasFile('glb_image')){
        //     $image = $request->glb_image;
        //     $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();
        //     $location='assets/images/product';
        //     $path = makeDirectory($location);
        //     if (!$path) throw new \Exception('File could not been created.');
        //     $image->move($location,$filename);
        //     $product->glb_image = $filename;
        //     $product->image_type = 'G';
        // }
        ini_set('memory_limit', '-1');
        if($request->hasFile('image_hash')){
            $image = $request->image_hash;
            $ext=$image->getClientOriginalExtension();
            $img_arr=array('jpg','png','jpeg');
            if($ext=='glb'){
                $type='G';
            }elseif(in_array($ext,$img_arr)){
                $type='I';
            }else{
                $type='V';
            }
        
            $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();
            $location='assets/images/product';
            $path = makeDirectory($location);
            if (!$path) throw new \Exception('File could not been created.');
            $image->move($location,$filename);
            // $product->image_hash = $filename;
            
                $client = new IPFSClient('127.0.0.1', 5001);
                // $response = $client->add($request->glb_image, 'test123.glb', ['pin' => true]);
                
                $response = $client->add(Utils::tryFopen($location.'/'.$filename, 'r'), $filename,['pin' => true]);
                // dd($response['Hash']);
                $product->image_hash = $response['Hash'];
                 $img="https://ipfs.io/ipfs/".$response['Hash'];
             
                $aJsonString=[
                      "name"=> $request->title,
                      "description"=> $request->description,
                      "image"=> $img
                      ];
     
                \Storage::disk('public')->put('images.json', json_encode($aJsonString));
                $jsonFile='core/storage/app/public/images.json';
                // dd($jsonFile);
                $response = $client->add(Utils::tryFopen($jsonFile,'r'),'metadata.json');
                // dd($response);
                
                $contents = $client->pin($response['Hash']);
               // $contents = $client->cat($response['Hash']);
                // dd($response);
                $product->meta_hash = $response['Hash'];
                $product->glb_filename = $filename;
            $product->image_type = $type;
        }
        $product->keyword = $request->keywords;
        $product->save();
        $notify[] = ['success', 'Product has been created'];
        return redirect(route('admin.product.index'))->withNotify($notify);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'featured'=> 'nullable|in:1',
            'title'=> 'required|max:255',
            'sub_title'=> 'required|max:255',
            'start_price'=> 'required|numeric|gt:0',
            'sale_price'=> 'required|numeric|gt:0',
            // 'keywords' => 'required|array|max:15',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'category_id'=> 'required|exists:categories,id',
            // 'sub_category'=> 'required|exists:subcategories,id',
            'brand'=> 'required|exists:brands,id',
            'image'=>  ['image',new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'description' => 'required',
            'pieces' => 'required'
        ]);
      
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->sub_title = $request->sub_title;
        $product->category_id = $request->category_id;
        // $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->brand;
        $product->start_price = $request->start_price;
        $product->symbol = $request->symbol;
        $product->sale_price = $request->sale_price;
        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;
        $product->description = $request->description;
        $product->pieces = $request->pieces;
        $product->featured = $request->featured ? $request->featured : null;
        $product->latest = $request->latest ? $request->latest : null;
        // $product->user_id = $request->user_id;
        $product->created_by = $request->created_by;
        
        if ($request->hasFile('image')) {
            $path = imagePath()['product']['path'];
            $size = imagePath()['product']['size'];
            try {
                $filename = uploadImage($request->image, $path, $size);
                $product->image = $filename;
                
                //   $client = new IPFSClient('127.0.0.1', 5001);
                // $response = $client->add($request->image, 'test.png', ['pin' => true]);
                // $contents = $client->pin($response['Hash']);
                // // $contents = $client->cat($response['Hash']);
                // $product->image = $response['Hash'];
                // dd($response);
                
            
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }


        ini_set('memory_limit', '-1');
        if($request->hasFile('image_hash')){
            $image = $request->image_hash;
            $ext=$image->getClientOriginalExtension();
            $img_arr=array('jpg','png','jpeg');
            if($ext=='glb'){
                $type='G';
            }elseif(in_array($ext,$img_arr)){
                $type='I';
            }else{
                $type='V';
            }
        
            $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();
            $location='assets/images/product';
            $path = makeDirectory($location);
            if (!$path) throw new \Exception('File could not been created.');
            $image->move($location,$filename);
            // $product->image_hash = $filename;
            
                $client = new IPFSClient('127.0.0.1', 5001);
                // $response = $client->add($request->glb_image, 'test123.glb', ['pin' => true]);
                
                $response = $client->add(Utils::tryFopen($location.'/'.$filename, 'r'), $filename,['pin' => true]);
                // dd($response['Hash']);
                $product->image_hash = $response['Hash'];
                $img="https://ipfs.io/ipfs/".$response['Hash'];
             
                $aJsonString=[
                      "name"=> $request->title,
                      "description"=> $request->description,
                      "image"=> $img
                      ];
                
     
                \Storage::disk('public')->put('images.json', json_encode($aJsonString));
                $jsonFile='core/storage/app/public/images.json';
                // dd($jsonFile);
                $response = $client->add(Utils::tryFopen($jsonFile,'r'),'metadata.json');
                // dd($response);
                
                $contents = $client->pin($response['Hash']);
               // $contents = $client->cat($response['Hash']);
                // dd($response);
                $product->meta_hash = $response['Hash'];
                $product->glb_filename = $filename;
                $product->image_type = $type;
        }
        
        // if($request->hasFile('glb_image')){
        //     $image = $request->glb_image;
        //     $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();
        //     $location='assets/images/product';
        //     $path = makeDirectory($location);
        //     if (!$path) throw new \Exception('File could not been created.');
        //     $image->move($location,$filename);
        //     $product->glb_image = $filename;
            
        //         $client = new IPFSClient('127.0.0.1', 5001);
        //         // $response = $client->add($request->glb_image, 'test123.glb', ['pin' => true]);
                
        //         $response = $client->add(Utils::tryFopen('assets/images/product/'.$filename, 'r'), $filename, ['pin' => true]);
        //         $contents = $client->pin($response['Hash']);
        //         // $contents = $client->cat($response['Hash']);
        //         // dd($response['Hash']);
        //         $product->glb_image = $response['Hash'];
        //         $product->glb_filename = $filename;
        //     $product->image_type = 'G';
        // }

        $product->keyword = $request->keywords;
        $product->save();
        $notify[] = ['success', 'Product has been updated'];
        return redirect(route('admin.product.index'))->withNotify($notify);
    }

    public function detail($id)
    {
        $pageTitle = "Manage product detail";
        $product = Product::where('id',$id)->with('productSpecification.specification')->firstOrFail();
        return view('admin.product.detail', compact('pageTitle', 'product'));
    }

    public function pending()
    {
        $pageTitle = "All pending products";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = Product::where('status', 0)->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products','brands', 'categorys'));
    }

    public function approved()
    {
        $pageTitle = "All approved products";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = Product::where('status', 1)->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        // $products = Product::where('status', 1)->with('user', 'category', 'subCategory', 'brand')->whereDate('time_duration','>', Carbon::now()->toDateTimeString())->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products','brands', 'categorys'));
    }

    public function cancel()
    {
        $pageTitle = "All cancel products";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = Product::where('status', 2)->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products','brands', 'categorys'));
    }

    public function expired()
    {
        $pageTitle = "All expired products";
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = Product::where('status',3)->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        // $products = Product::whereDate('time_duration','<=', Carbon::now()->toDateTimeString())->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products', 'brands', 'categorys'));
    }

    public function approvBy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);
        $product = Product::findOrFail($request->id);
        $product->status = 1;
        $product->save();
        $notify[] = ['success', 'Product has been approved'];
        return back()->withNotify($notify);
    }

    public function cancelBy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);
        $product = Product::findOrFail($request->id);
        $product->status = 2;
        $product->save();
        $notify[] = ['success', 'Product has been cancel'];
        return back()->withNotify($notify);
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        // $products = Product::whereHas('user',function($q) use ($search){
        //     $q->where('username', 'like', "%$search%");
        // })->orWhere('title', 'like', "%$search%");
        $products = Product::where('title', 'like', "%$search%");
        $pageTitle = '';
        if($scope == 'pending'){
            $products = $products->where('status', 0);
        }elseif($scope == 'approved'){
            $products = $products->where('status', 1);
            // $products = $products->where('status', 1)->whereDate('time_duration','>', Carbon::now()->toDateTimeString());
        }elseif($scope == 'cancel'){
            $products = $products->where('status', 2);
        }elseif($scope == 'expired'){
            $products = $products->whereDate('time_duration','<=', Carbon::now()->toDateTimeString());
        }
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = $products->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        $pageTitle = 'Product Search - ' . $search;
        $emptyMessage = 'No data found';
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        return view('admin.product.index', compact('pageTitle', 'emptyMessage','brands', 'products', 'categorys', 'search'));
    }

    public function productCategorySearch(Request $request, $scope)
    {
        if($request->category_id==0){
            return redirect()->route('admin.product.index');
        }
        $category = Category::where('status', 1)->where('id', $request->category_id)->firstOrFail();
        $categoryId = $category->id;
        $pageTitle =  $category->name .' '.$scope.' products list';
        $emptyMessage = "No data found";
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        $categorys = Category::where('status', 1)->select('id', 'name')->get(); 
        $products = Product::where('category_id', $category->id);
        if($scope == 'pending'){
            $products = $products->where('status', 0);
        }elseif($scope == 'approved'){
            $products = $products->where('status', 1);
            // $products = $products->where('status', 1)->whereDate('time_duration','>', Carbon::now()->toDateTimeString());;
        }elseif($scope == 'cancel'){
            $products = $products->where('status', 2);
        }elseif($scope == 'expired'){
            $products = $products->whereDate('time_duration','<=', Carbon::now()->toDateTimeString());
        }
        $products = $products->with('user', 'category', 'subCategory', 'brand')->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'brands','products', 'categorys', 'categoryId'));
    }
    

    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);
        $product = Product::findOrFail($request->id);
        $product->featured = 1;
        $product->save();
        $notify[] = ['success', 'Include this product featured list'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id'
        ]);
        $product = Product::findOrFail($request->id);
        $product->featured = 0;
        $product->save();
        $notify[] = ['success', 'Remove this product featured list'];
        return back()->withNotify($notify);
    }


    public function productReport()
    {
        $pageTitle = "Product Report List";
        $emptyMessage = "No data found";
        $reports = ProductReport::whereHas('product', function($q){
            $q->where('status', 1)->whereDate('time_duration','>', Carbon::now()->toDateTimeString());
        })->latest()->with('user', 'product')->paginate(getPaginate());
        return view('admin.product.report', compact('pageTitle', 'emptyMessage', 'reports'));
    }
    
    public function product_biddings(Request $request) {
        // $data = ProductBidding::select('product_biddings.*', 'products.title as product_name')
        //     ->join('products', 'products.id', '=', 'product_biddings.product_id')
        //     ->where('products.is_start_auction', 1)
        //     ->groupBy('product_biddings.product_id')
        //     ->orderby('product_biddings.bid_amount', 'DESC')
        //     ->get();
        $data = ProductBidding::select('product_biddings.*', 'products.title as product_name')
            ->join('products', 'products.id', '=', 'product_biddings.product_id')
            ->where('products.is_start_auction', 1)
            ->orderby('product_biddings.id', 'DESC')
            ->get();
        $pageTitle = "Bidding Products";
        $emptyMessage = "No data found";
        
        return view('admin.product.bidding_products', compact('pageTitle', 'emptyMessage', 'data'));
    }

    public function product_bidding_details(Request $request, $id) {
        $data = ProductBidding::select('product_biddings.*', 'products.title as product_name', 'products.start_date', 'products.symbol')
            ->join('products', 'products.id', '=', 'product_biddings.product_id')
            ->where('products.is_start_auction', 1)
            ->where('product_biddings.id', '=', $id)
            ->first();

        $pageTitle = "Bidding Product Details";
        $emptyMessage = "No data found";

        return view('admin.product.bidding_product_details', compact('pageTitle', 'emptyMessage', 'data'));
    }
    
    public function delete($id){
        $pageTitle = "Delete Product";
       
        $product = Product::where('id',$id)->delete();
        $notify[] = ['success', 'Product has been deleted'];
        return back()->withNotify($notify);
       
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\User;
use App\Models\MetamaskTransactionPayment;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Events\EnterBid;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\SupportTicket;
use App\Models\ProductBidding;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\SupportAttachment;
use Illuminate\Support\Facades\DB;
use App\Models\MetamaskTransaction;

class BidController extends Controller
{
    public function __construct()
    {
       // $this->activeTemplate = activeTemplate();
    }

    public function store(Request $request)
    {
        
        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $amount = $request->amount;
        $auctionEnded = Product::where('id',$product_id)
                                ->where('is_end_auction',1)
                                ->first();
        if($auctionEnded) {
            return response()->json(['status' => false,'msg' => "Sorry, you can't place bid now. Product is sold out.",'redirect' => 1]);
        }
        
        $productBiddingSql = ProductBidding::where('product_id',$product_id)
                                ->where('account_address',$request->account_address)
                                ->where('signature',$request->signature)
                                ->where('transaction_hash',$request->transaction_hash)
                                ->first();
        if(!$productBiddingSql) {
            $p_id=ProductBidding::insertGetId([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'account_address' => $request->account_address,
                'signature' => $request->signature,
                'transaction_hash' => $request->transaction_hash,
                'bid_amount' => $amount,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            $metamaskTransaction = new MetamaskTransaction();
            $metamaskTransaction->product_id = $request->product_id;
            $metamaskTransaction->hash = $request->hash;
            $metamaskTransaction->transaction_hash = $request->transaction_hash;
            $metamaskTransaction->signature = $request->signature;
            $metamaskTransaction->event = "PB"; 
            $metamaskTransaction->account_address = $request->account_address;
            $metamaskTransaction->product_bidding_id = $p_id;
            $metamaskTransaction->from_address = $request->from_address;
            $metamaskTransaction->to_address = $request->to_address;
            $metamaskTransaction->status = $request->status ? 1: 0;
            $metamaskTransaction->block_no = $request->block_no;
            $metamaskTransaction->amount = $amount;
            $metamaskTransaction->save();
            
            $highestBid = ProductBidding::selectRaw('SUM(bid_amount) as bid_amount')
                                    ->join('products', 'products.id', '=', 'product_biddings.product_id')
                                    // ->where('products.status', 1)
                                    ->where('product_biddings.user_id', $user_id)
                                    ->where('products.is_start_auction', 1)
                                    ->where('products.id', $product_id)
                                    ->groupBy('product_biddings.account_address')
                                    ->first();
                                 
            if($highestBid) {
                $check = Product::where('id',$product_id)->first();
                if($check) {
                    $productUpdate = Product::where('id',$product_id)->first();
                    if($highestBid->bid_amount > $productUpdate->highest_bidding) {
                        $productUpdate->highest_bidding = $highestBid->bid_amount;
                        $productUpdate->user_id = $user_id;
                        $productUpdate->highest_bidder = $request->from_address;
                        $productUpdate->save();        
                    }
                }
            }
            $user=auth()->user();
            $productBid=ProductBidding::find($p_id);
            broadcast(new EnterBid($productBid,$user))->toOthers();
            $username=auth()->user()->username;
        }
        return response()->json(['status' => true,'user_id'=>$user_id,'username'=>$username,'product_id'=>$product_id,'amount'=>$amount,'msg' => "Your Bid has been placed successfully",'redirect' => 0]);
    }
    
    public function savePlaceBidPaymentDetailFunction(Request $request)
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
            
        }
        echo "Done";
    }

    public function myBids(){
        $user_id=auth()->user()->id;
        $pageTitle = "My Bids";
        $biddings = ProductBidding::orderBy('id', 'DESC')->with('product', 'user')->where('user_id',$user_id)->paginate(getPaginate());
        $emptyMessage = "No data found";
    // dd($biddings);
        return view('templates.basic.my-biddings', compact('biddings', 'emptyMessage','pageTitle'));
    }

    public function wonBids(){
        $user_id=auth()->user()->id;
        $pageTitle = "My Bids";
        $biddings = ProductBidding::orderBy('id', 'DESC')
                                    ->with('product', 'user')
                                    ->where('user_id',$user_id)
                                    ->where('status','A')
                                    ->paginate(getPaginate());
        $emptyMessage = "No data found";
    // dd($biddings);
        return view('templates.basic.won-biddings', compact('biddings', 'emptyMessage','pageTitle'));
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetamaskTransaction;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class TransactionController extends Controller
{ 
    public function index(Request $request)
    {
        $pageTitle = "Metamask Transactions";
        $emptyMessage = "No data found";
        $transactions = MetamaskTransaction::with('product','productBidding')->orderBy('created_at','desc')->orderBy('product_id','desc')->paginate(getPaginate());
        return view('admin.transactions.index',compact('pageTitle','transactions','emptyMessage'));
    } 

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $transactions = MetamaskTransaction::with('product','productBidding')->join('products','products.id','=','metamask_transactions.product_id')->where(function ($transaction) use ($search) {
            $transaction->Where('hash', 'like', "%$search%")
                ->orWhere('transaction_hash', 'like', "%$search%")
                ->orWhere('signature', 'like', "%$search%")
                ->orWhere('account_address', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%");;
        });
        

        $transactions = $transactions->paginate(getPaginate());
        $pageTitle = 'Metamask Transaction Payment';
        $emptyMessage = 'No search result found';
        return view('admin.transactions.index', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'transactions'));
    } 
}
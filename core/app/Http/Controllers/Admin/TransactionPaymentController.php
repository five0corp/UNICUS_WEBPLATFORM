<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetamaskTransactionPayment;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class TransactionPaymentController extends Controller
{ 
    public function index(Request $request)
    {
        if ($request->has('hash')) {
            $hash = $request->hash;
            $pageTitle = "Metamask Transaction Payment ";
            $emptyMessage = "No data found";
            $transactionPayments = MetamaskTransactionPayment::with('product')
                ->where('transaction_hash', $hash)
                ->orderBy('created_at','desc')
                ->orderBy('product_id','desc')
                ->paginate(getPaginate());
            return view('admin.transactionPayments.index',compact('pageTitle','transactionPayments','emptyMessage'));
        } else {
            $pageTitle = "Metamask Transaction Payment ";
            $emptyMessage = "No data found";
            $transactionPayments = MetamaskTransactionPayment::with('product')->orderBy('created_at','desc')->orderBy('product_id','desc')->paginate(getPaginate());
            return view('admin.transactionPayments.index',compact('pageTitle','transactionPayments','emptyMessage'));
        }

    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $transactionPayments = MetamaskTransactionPayment::with('product')->join('products','products.id','=','metamask_transaction_payments.product_id')->where(function ($transactionPayment) use ($search) {
            $transactionPayment->where('from_address', 'like', "%$search%")
                ->orWhere('to_address', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%");
        });
        

        $transactionPayments = $transactionPayments->paginate(getPaginate());
        $pageTitle = 'Metamask Transaction Payment';
        $emptyMessage = 'No search result found';
        return view('admin.transactionPayments.index', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'transactionPayments'));
    }
}
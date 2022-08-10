<?php

namespace App\Http\Controllers;

use App\Models\ECash;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function allTransactions(Request $request){
        $transactions = [];
        if (isset($request->search)){
            $transactions = Transaction::whereAccount($request->search)->get();
        } else {
            $transactions = Transaction::orderBy('id', 'DESC')->take(100)->get();
        }
        $vendors = ECash::all();
        return view('system.transactions.index', compact(['transactions', 'vendors']));
    }

    public function makeTransaction(Request $request){
        $vendor = $request->vendor;
        $account = $request->account;
        $amount = $request->amount;
        if (Transaction::insert(['vendor' => $vendor, 'account' => $account, 'amount' => $amount])){
            toastr('Transaction added!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allTransactions']);
    }

    public function deleteTransaction($id){
        if (Transaction::whereId($id)->delete()){
            toastr('Transaction deleted!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allTransactions']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ECash;
use Illuminate\Http\Request;

class ECashController extends Controller
{
    public function allECash(){
        $eCash = ECash::all();
        return view('system.e-cash.index', compact(['eCash']));
    }

    public function createECash(Request $request){
        $name = $request->name;
        if (ECash::insert(['name' => $name])){
            toastr('New vendor created!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allECash']);
    }

    public function updateECash(Request $request, $id){
        $name = $request->name;
        if (ECash::whereId($id)->update(['name' => $name])){
            toastr('Vendor updated!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allECash']);
    }

    public function deleteECash($id){
        if (ECash::whereId($id)->delete()){
            toastr('Vendor deleted!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allECash']);
    }
}

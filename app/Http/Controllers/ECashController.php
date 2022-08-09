<?php

namespace App\Http\Controllers;

use App\Models\ECash;
use Illuminate\Http\Request;

class ECashController extends Controller
{
    public function allECash(){
        $eCash = ECash::all();
        return view('system.category.index', compact(['eCash']));
    }

    public function newECash(){
        return view('system.category.new');
    }

    public function createECash(Request $request){
        $name = $request->name;
        $metadata = serializeMetadata(explode("\n" ,$request->metadata));
        if (Category::insert(['name' => $name, 'metadata' => $metadata])){
            toastr('Category created!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }

    public function editECash($id){
        $category = Category::whereId($id)->first();
        return view('system.category.edit', compact(['category']));
    }

    public function updateECash(Request $request, $id){
        $name = $request->name;
        $metadata = serializeMetadata(explode("\n" ,$request->metadata));
        if (Category::whereId($id)->update(['name' => $name, 'metadata' => $metadata])){
            toastr('Category updated!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }

    public function deleteECash($id){
        if (Category::whereId($id)->delete()){
            toastr('Category deleted!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }

    public function findCategory($id){
        return Category::whereId($id)->first();
    }
}

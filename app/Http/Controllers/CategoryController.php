<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories(){
        $categories = Category::all();
        return view('system.category.index', compact(['categories']));
    }

    public function newCategory(){
        return view('system.category.new');
    }

    public function createCategory(Request $request){
        $name = $request->name;
        $metadata = serializeMetadata(explode("\n" ,$request->metadata));
        if (Category::insert(['name' => $name, 'metadata' => $metadata])){
            toastr('Category created!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }

    public function editCategory($id){
        $category = Category::whereId($id)->first();
        return view('system.category.edit', compact(['category']));
    }

    public function updateCategory(Request $request, $id){
        $name = $request->name;
        $metadata = serializeMetadata(explode("\n" ,$request->metadata));
        if (Category::whereId($id)->update(['name' => $name, 'metadata' => $metadata])){
            toastr('Category updated!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }

    public function deleteCategory($id){
        if (Category::whereId($id)->delete()){
            toastr('Category deleted!', 'success');
        } else {
            toastr('Something went wrong!', 'error');
        }
        return redirect()->action([get_class(), 'allCategories']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function allProducts(){
        $products = Product::orderBy('id', 'DESC')->get();
        return view('system.products.index', compact(['products']));
    }

    function newProduct(){
        return view('system.products.new');
    }

    function createProduct(Request $request){
        $filePath = $request->image;
        $check = [
            'product_code' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'discount' => ['required', 'integer',],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $data = [
            'product_code' => $request->product_code,
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'description' => $request->description
        ];
        if($filePath != 'undefined'){
            $check['image'] = ['nullable','image', 'mimes:jpeg,jpg,png,webp'];
            $data['image'] = $request->image->store('public/product-image');
        }
        if($request->validate($check)){
            $result = Product::insert($data);
            echo json_encode([
                'success' => $result,
                'redirect_url' => route('product.all')
            ]);
        }
    }

    function editProduct($id = null){
        $product = Product::where('id', $id)->first();
        return view('system.products.edit', compact(['product']));
    }

    function updateProduct(Request $request, $id){
        $product = Product::where('id', $id)->first();
        $filePath = $request->image;
        $check = [
            'product_code' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'discount' => ['required', 'integer',],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string']
        ];
        $data = [
            'product_code' => $request->product_code,
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'short_description' => $request->short_description,
            'description' => $request->description
        ];
        if($filePath != 'undefined'){
            $check['image'] = ['nullable','image', 'mimes:jpeg,jpg,png,webp'];
            $data['image'] = $request->image->store('public/product-image');
            Storage::delete($product->image);
        }
        if($request->validate($check)){
            $result = Product::whereId($id)->update($data);
            echo json_encode([
                'success' => $result,
                'redirect_url' => route('product.edit',['id' => $id])
            ]);
        }
    }

    function deleteProduct($id){
        $product = Product::where('id', $id)->first();
        Product::whereId($id)->delete();
        if(Storage::delete($product->image)){
            echo json_encode([
                'success' => true,
                'redirect_url' => route('product.all')
            ]);
        }
    }
}

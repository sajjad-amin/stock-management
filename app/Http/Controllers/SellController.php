<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use Illuminate\Http\Request;

class SellController extends Controller
{
    function getAll(){
        $products = Product::orderBy('id', 'DESC')->get();
        $sells = Sell::orderBy('id', 'DESC')->take(100)->get();
        return view('system.sell.index', compact(['products', 'sells']));
    }
    function sell(Request $request){
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $sell_price = $request->sell_price;
        $discount = $request->discount;
        $product = Product::where('id', $product_id)->first();
        $remove_price = 0;
        if($discount > 0){
            $remove_price = ($discount/100) * ($sell_price * $quantity);
        }
        if(Product::whereId($product_id)->update(['quantity' => $product->quantity - $quantity])){
            $sold = Sell::insert([
                'product_id' => $product_id,
                'product_code' => $product->product_code,
                'quantity' => $quantity,
                'price' => $product->price * $quantity,
                'sell_price' => $sell_price * $quantity - $remove_price,
                'discount' => $discount,
                'interest' => ($sell_price * $quantity - $remove_price) - ($product->price * $quantity)
            ]);
            if($sold){
                return redirect()->action([get_class($this), 'getAll']);
            }
        }
    }
    function returnProduct(Request $request){
        $sold_product = Sell::where('id', $request->id)->first();
        $product = Product::where('id', $sold_product->product_id)->first();
        if(Product::whereId($product->id)->update(['quantity' => $product->quantity + $sold_product->quantity])){
            if(Sell::whereId($sold_product->id)->delete()){
                return redirect()->action([get_class($this), 'getAll']);
            }
        }
    }
}

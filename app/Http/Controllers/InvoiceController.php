<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showInvoice($data){
        $ids = json_decode(base64_decode($data));
        $invoiceData = [];
        foreach ($ids as $id){
            $sell = Sell::whereId($id)->first();
            $product = Product::whereId($sell->product_id)->first();
            $invoiceData[] = [
                'name' => $product->title,
                'quantity' => $sell->quantity,
                'unit_price' => $product->sell_price,
                'price' => $sell->quantity * $product->sell_price
            ];
        }
        return view('system.invoice.index', compact(['invoiceData']));
    }
}

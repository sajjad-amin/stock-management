<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sell;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showInvoice(Request $request, $data){
        $ids = json_decode(base64_decode($data));
        $invoiceData = [];
        foreach ($ids as $id){
            $sell = Sell::whereId($id)->first();
            $product = Product::whereId($sell->product_id)->first();
            $invoiceData[] = [
                'name' => $product->title,
                'quantity' => $sell->quantity,
                'unit_price' => $product->sell_price,
                'price' => $sell->sell_price
            ];
        }
        if(isset($request->print)){
            $customerData = [
                'date' => $request->date,
                'name' => $request->name,
                'address' => $request->address,
                'mobile' => $request->mobile
            ];
            $pdf = Pdf::loadView('system.invoice.invoice', compact(['invoiceData', 'customerData']));
            return $pdf->stream('invoice.pdf');
//            return view('system.invoice.invoice', compact(['invoiceData', 'customerData']));
        }else{
            return view('system.invoice.index', compact(['invoiceData']));
        }
    }
}

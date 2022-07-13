<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function allProducts(){
        return view('system.products.index');
    }

    function newProduct(){
        return view('system.products.new');
    }

    function editProduct(){
        return view('system.products.edit');
    }
}

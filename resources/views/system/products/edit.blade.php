@extends('layouts.dashboard')
@section('title', 'Edit Product')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Edit Product</h1>
        </div>
        @if(isset($product))
        <form id="product-form" method="post">
            @csrf
            <input name="targetUrl" type="hidden" value="{{route('product.update',['id'=>$product->id])}}">
            <input name="actionEvent" type="hidden" value="edit">
            <div class="form-group row">
                <div class="col-md-2">
                    <img id="image-display" src="{{ str_replace('public', 'storage', url($product->image != null ? $product->image : asset('images/dummy-image.webp'))) }}" alt="" class="img img-thumbnail">
                </div>
                <div class="col-sm-10">
                    <br>
                    <input name="image" type="file" class="btn btn-primary" id="image">
                </div>
            </div>
            <div class="form-group row">
                <label for="product-code" class="col-md-2 col-form-label">Product Code</label>
                <div class="col-sm-10">
                    <input name="product-code" type="text" class="form-control" id="product-code" value="{{$product->product_code}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input name="title" type="text" class="form-control" id="title" value="{{$product->title}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-2 col-form-label">Price</label>
                <div class="col-md-2">
                    <input name="price" type="number" class="form-control" id="price" value="{{$product->price}}">
                </div>
                <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                <div class="col-md-2">
                    <input name="quantity" type="number" class="form-control" id="quantity" value="{{$product->quantity}}">
                </div>
                <label for="discount" class="col-md-2 col-form-label">Discount</label>
                <div class="col-md-2">
                    <select name="discount" class="form-control" id="discount">
                        <option value="0">None</option>
                        @for($i = 1; $i <= 100; $i++)
                            <option @if($i == $product->discount) selected @endif value="{{$i}}">{{$i}} %</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="short-description" class="col-md-2 col-form-label">Short Description</label>
                <div class="col-sm-10">
                    <textarea name="short-description" rows="3" class="form-control" id="short-description">{{$product->short_description}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" rows="8" class="form-control" id="description">{{$product->description}}</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right mb-3" value="Update">
        </form>
            <button onClick="deleteProduct(`{{route('product.delete',['id' => $product->id])}}`)" class="btn btn-danger float-right mr-3">Delete</button>
        @else
        @endif
    </div>
@endsection
@section('script')
@endsection

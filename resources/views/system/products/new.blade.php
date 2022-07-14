@extends('layouts.dashboard')
@section('title', 'New Product')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>New Product</h1>
        </div>
        <form id="product-form" method="post">
            @csrf
            <input name="targetUrl" type="hidden" value="{{route('product.new.create')}}">
            <input name="actionEvent" type="hidden" value="create">
            <div class="form-group row">
                <div class="col-md-2">
                    <img id="image-display" src="{{asset('images/dummy-image.webp')}}" alt="" class="img img-thumbnail">
                </div>
                <div class="col-sm-10">
                    <br>
                    <input name="image" type="file" class="btn btn-primary" id="image">
                </div>
            </div>
            <div class="form-group row">
                <label for="product-code" class="col-md-2 col-form-label">Product Code</label>
                <div class="col-sm-10">
                    <input name="product-code" type="text" class="form-control" id="product-code">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input name="title" type="text" class="form-control" id="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-2 col-form-label">Price</label>
                <div class="col-sm-2">
                    <input name="price" type="number" class="form-control" id="price">
                </div>
                <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                <div class="col-md-2">
                    <input name="quantity" type="number" class="form-control" id="quantity">
                </div>
                <label for="discount" class="col-md-2 col-form-label">Discount</label>
                <div class="col-sm-2">
                    <select name="discount" class="form-control" id="discount">
                        <option value="0">None</option>
                        @for($i = 1; $i <= 100; $i++)
                            <option value="{{$i}}">{{$i}} %</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="short-description" class="col-md-2 col-form-label">Short Description</label>
                <div class="col-sm-10">
                    <textarea name="short-description" rows="3" class="form-control" id="short-description"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" rows="8" class="form-control" id="description"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Create">
        </form>
    </div>
@endsection
@section('script')
@endsection

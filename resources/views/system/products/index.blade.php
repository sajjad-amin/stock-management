@extends('layouts.dashboard')
@section('title', 'All Products')
@section('content')
    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th></th>
                <th scope="col">Product Code</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <th><img class="img img-thumbnail list-image" src="{{ str_replace('public', 'storage', url($product->image != null ? $product->image : asset('images/dummy-image.webp'))) }}" alt="" title="" /></th>
                    <td>{{$product->product_code}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount}} %</td>
                    <td><a href="{{route('product.edit',['id' => $product->id])}}" type="button" class="btn btn-primary">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
@endsection

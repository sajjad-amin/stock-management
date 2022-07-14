@extends('layouts.dashboard')
@section('title', 'Sell')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Products</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th></th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Available</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <form action="{{route('sell.sell')}}" method="post">
                                    @csrf
                                    <input name="product_id" type="hidden" value="{{$product->id}}">
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <th><img class="img img-thumbnail list-image" src="{{ str_replace('public', 'storage', url($product->image != null ? $product->image : asset('images/dummy-image.webp'))) }}" alt="" title="" /></th>
                                        <td>
                                            {{$product->product_code}}
                                        </td>
                                        <td>
                                            {{$product->title}}
                                        </td>
                                        <td>
                                            {{$product->quantity}}
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            <select name="quantity" class="form-control" id="quantity">
                                                @for($i = 1; $i <= $product->quantity; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <input name="sell_price" type="number" class="form-control" id="sell_price" value="{{$product->sell_price}}">
                                        </td>
                                        <td>
                                            <select name="discount" class="form-control" id="discount">
                                                <option value="0">None</option>
                                                @for($i = 1; $i <= 100; $i++)
                                                    <option @if($i == $product->discount) selected @endif value="{{$i}}">{{$i}} %</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-success" value="Sell">
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Resent Sells</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Product Code</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sells as $item)
                                <form action="{{route('sell.return')}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input name="id" type="hidden" value="{{$item->id}}">
                                    <tr>
                                        <td>
                                            {{$item->product_code}}
                                        </td>
                                        <td>
                                            {{$item->quantity}}
                                        </td>
                                        <td>
                                            {{$item->sell_price}}
                                        </td>
                                        <td>
                                            {{$item->discount}} %
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-danger" value="Return">
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

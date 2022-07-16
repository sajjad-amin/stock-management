@extends('layouts.dashboard')
@section('title', 'Sell')
@section('style')
    <style>
        #recentSells {
            position: absolute;
            right: 0;
            display: none;
            box-shadow: 1px 1px 50px 30px rgba(0,0,0,0.33);
            -webkit-box-shadow: 1px 1px 50px 30px rgba(0,0,0,0.33);
            -moz-box-shadow: 1px 1px 49px 30px rgba(0,0,0,0.33);
            overflow-y: scroll;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <button id="recentSellsBtn" class="btn btn-success">Show Recent Sells</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <input type="text" class="form-control mr-3 ml-3" placeholder="Search product" id="search" autofocus>
                        </div>
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
                            <tbody id="productTable">
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
            <div id="recentSells" class="card mt-3 mr-3">
                <div class="card-header">
                    <h5 class="text-center">Resent Sells</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <input type="text" class="form-control mr-3 ml-3" placeholder="Search product" id="recentSellsSearch">
                    </div>
                    <table class="table table-dark">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">Product Code</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Selling Date</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody id="recentSellsTable">
                        @foreach($sells as $item)
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
                                    {{$item->created_at->format('d M, Y | h:i A')}}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Print</button>
                                </td>
                                <td>
                                    <form action="{{route('sell.return')}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input name="id" type="hidden" value="{{$item->id}}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Return">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#recentSellsBtn').click(function (){
                $('#recentSells').toggle();
                $(this).text(function(i, text){
                    return text === "Show Recent Sells" ? "Hide Recent Sells" : "Show Recent Sells";
                });
            });
            $("#search").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#productTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
            $("#recentSellsSearch").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#recentSellsTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection

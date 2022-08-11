@extends('layouts.dashboard')
@section('title', 'Invoice')
@section('style')
@endsection
@section('content')
    <div class="container">
        <br>
        <br>
        <h1 class="text-center">Rikta Telecom</h1>
        <div class="container text-center">
            <p>Proprietor: Alamgir Biswash</p>
            <p>Main road tin rastar mor, VIVO, OPPO Showroom, Tala, Shatkhira. <br> Mobile: Jahangir - 01715757535 (Executive), Alamgir - 01728015250</p>
        </div>
        <form method="get" target="_blank" class="m-3">
            <div class="mt-5">
                <input type="hidden" name="print" value="true">
                <div class="form-group row">
                    <label for="date" class="col-md-2 col-form-label">Date:</label>
                    <div class="col-sm-10">
                        <input name="date" type="date" class="form-control" id="date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer-name" class="col-md-2 col-form-label">Customer Name:</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" id="customer-name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer-address" class="col-md-2 col-form-label">Customer Address:</label>
                    <div class="col-sm-10">
                        <input name="address" type="text" class="form-control" id="customer-address">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer-mobile" class="col-md-2 col-form-label">Customer Mobile:</label>
                    <div class="col-sm-10">
                        <input name="mobile" type="text" class="form-control" id="customer-mobile">
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" style="width: 0;">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Unit Price</th>
                    <th scope="col" class="text-center">Price</th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0; @endphp
                @foreach($invoiceData as $data)
                    @php $total += $data['price'] @endphp
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$data['name']}}</td>
                        <td class="text-center">{{$data['quantity']}}</td>
                        <td class="text-center">{{$data['unit_price']}}</td>
                        <td class="text-center">{{$data['price']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row">Total:</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><strong>{{$total}}</strong></td>
                </tr>
                </tbody>
            </table>
            <input class="btn btn-success btn-sm float-right" type="submit" value="Print">
        </form>
    </div>
@endsection
@section('script')
@endsection

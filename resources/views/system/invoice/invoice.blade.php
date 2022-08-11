@extends('layouts.app')
@section('title', 'Invoice')
@section('style')
    <style>
        .info{
            margin-bottom: 20px;
        }
        .info td{
            padding: 0 5px 0 5px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Rikta Telecom</h1>
        <div class="container text-center">
            <p>Proprietor: Alamgir Biswash</p>
            <p>Main road tin rastar mor, VIVO, OPPO Showroom, Tala, Shatkhira. <br> Mobile: Jahangir - 01715757535 (Executive), Alamgir - 01728015250</p>
        </div>
        <hr>
        <div class="mt-3">
            @if(isset($customerData))
                <table class="info">
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td>{{$customerData['date']}}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$customerData['name']}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$customerData['address']}}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>:</td>
                        <td>{{$customerData['mobile']}}</td>
                    </tr>
                </table>
            @endif
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
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Invoice')
@section('content')
    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoiceData as $data)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$data['name']}}</td>
                    <td>{{$data['quantity']}}</td>
                    <td>{{$data['unit_price']}}</td>
                    <td>{{$data['price']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

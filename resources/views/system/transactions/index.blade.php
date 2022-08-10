@extends('layouts.dashboard')
@section('title', 'Transactions')
@section('style')
@endsection
@section('content')
    <div class="container">
        <form method="post" action="{{route('transactions.new.create')}}" class="mt-5">
            @csrf
            <div class="form-group row">
                <div class="col-md-2">
                    <select name="vendor" class="form-control">
                        @foreach($vendors as $vendor)
                            <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <input name="account" type="text" class="form-control" placeholder="Enter mobile number" required>
                </div>
                <div class="col-md-2">
                    <input name="amount" type="number" class="form-control" placeholder="Enter amount" required>
                </div>
                <div class="col-md-1">
                    <input type="submit" class="btn btn-success" value="+ Add">
                </div>
            </div>
        </form>
        <hr class="mt-5">
        <form action="" method="get">
            <div class="form-group row">
                <div class="col-sm-10">
                    <input name="search" type="text" class="form-control mr-3 ml-3" placeholder="Search number" autofocus>
                </div>
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-success" value="Search">
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vendor</th>
                <th scope="col">Mobile</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$transaction->vendor}}</td>
                    <td>{{$transaction->account}}</td>
                    <td>{{$transaction->amount}}</td>
                    <td>{{$transaction->created_at->format('d M, Y | h:i A')}}</td>
                    <td>
                        <form method="post" action="{{route('transactions.delete', ['id' => $transaction->id])}}"
                              class="delete">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-sm btn-danger" value="Remove">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $('.delete').submit(function (e) {
            return prompt('Type Confirm to delete this transaction') === 'Confirm';
        });
    </script>
@endsection

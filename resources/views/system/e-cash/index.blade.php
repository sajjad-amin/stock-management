@extends('layouts.dashboard')
@section('title', 'E-Cash')
@section('content')
    <div class="container">
        <ul class="list-group mt-5">
            @foreach($eCash as $vendor)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <form method="post" action="{{route('ecash.update', ['id' => $vendor->id])}}">
                            @csrf
                            @method('put')
                            <h5 class="vendorName">{{$vendor->name}}</h5>
                            <input name="name" type="text" class="form-control d-none edit" value="{{$vendor->name}}">
                        </form>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-primary mr-3 editBtn"><i class="fa fa-pencil"></i></button>
                            <form class="delete" method="post" action="{{route('ecash.delete',['id' => $vendor->id])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <form method="post" action="{{route('ecash.new.create')}}" class="mt-5">
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Enter vendor name" required>
                </div>
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-success float-right" value="+ Add Vendor">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('.delete').submit(function (e){
            return confirm('Are you sure?');
        });
        $('.editBtn').click(function (e){
            const parent = $(this).parent().parent();
            parent.find('.vendorName').remove();
            const edit = parent.find('.edit');
            edit.removeClass('d-none');
            edit.focus();
        });
    </script>
@endsection

@extends('layouts.dashboard')
@section('title', 'New Category')
@section('content')
    <div class="container">
        <form method="post" action="{{route('category.new.create')}}" class="mt-3 mb-3">
            @csrf
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="category_name">Category Name</label>
                </div>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="category_name" placeholder="category name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="attributes">Attributes</label>
                </div>
                <div class="col-sm-10">
                    <textarea name="metadata" rows="10" class="form-control" id="attributes" placeholder="Type attributes name. every attribute's name must be in a new line"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Create">
        </form>
    </div>
@endsection
@section('script')
@endsection

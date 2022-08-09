@extends('layouts.dashboard')
@section('title', 'Edit Category | '.$category->name)
@section('content')
    <div class="container">
        <form method="post" action="{{route('category.update',['id' => $category->id])}}" class="mt-3 mb-3">
            @csrf
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="category_name">Category Name</label>
                </div>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="category_name" value="{{$category->name}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea name="metadata" rows="10" class="form-control">@foreach(unserializeMetadata($category->metadata) as $md){{$md."\n"}}@endforeach</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Update">
        </form>
        <form method="post" id="delete" action="{{route('category.delete',['id' => $category->id])}}">
            @csrf
            @method("delete")
            <button type="submit" class="btn btn-danger float-right mr-3">Delete</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#delete').submit(function (e){
            return confirm('Are you sure?');
        });
    </script>
@endsection

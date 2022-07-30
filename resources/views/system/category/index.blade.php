@extends('layouts.dashboard')
@section('title', 'All Categories')
@section('content')
    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Attributes</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$category->name}}</td>
                    <td>
                        @foreach(unserializeMetadata($category->metadata) as $md)
                            {{$md}} <br>
                        @endforeach
                    </td>
                    <td><a href="{{route('category.edit',['id' => $category->id])}}" type="button" class="btn btn-primary">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
@endsection

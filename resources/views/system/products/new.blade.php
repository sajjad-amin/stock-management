@extends('layouts.dashboard')
@section('title', 'New Product')
@section('content')
    <div class="container-fluid">
        <form id="product-form" method="post" class="mt-3 mb-3">
            @csrf
            <input name="targetUrl" type="hidden" value="{{route('product.new.create')}}">
            <input name="actionEvent" type="hidden" value="create">
            <div class="form-group row">
                <div class="col-md-2">
                    <img id="image-display" src="{{asset('images/dummy-image.webp')}}" alt="" class="img img-thumbnail">
                </div>
                <div class="col-sm-10">
                    <br>
                    <input name="image" type="file" class="btn btn-primary" id="image">
                </div>
            </div>
            <div class="form-group row">
                <label for="product-code" class="col-md-2 col-form-label">Product Code</label>
                <div class="col-sm-10">
                    <input name="product-code" type="text" class="form-control" id="product-code">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input name="title" type="text" class="form-control" id="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-2 col-form-label">Price</label>
                <div class="col-sm-1">
                    <input name="price" type="number" class="form-control" id="price">
                </div>
                <label for="sell-price" class="col-md-1 col-form-label">Sell Price</label>
                <div class="col-sm-2">
                    <input name="sell-price" type="number" class="form-control" id="sell-price">
                </div>
                <label for="quantity" class="col-md-1 col-form-label">Quantity</label>
                <div class="col-md-2">
                    <input name="quantity" type="number" class="form-control" id="quantity">
                </div>
                <label for="discount" class="col-md-1 col-form-label">Discount</label>
                <div class="col-sm-2">
                    <select name="discount" class="form-control" id="discount">
                        <option value="0">None</option>
                        @for($i = 1; $i <= 100; $i++)
                            <option value="{{$i}}">{{$i}} %</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">Category</label>
                <div class="col-sm-4">
                    <select name="category" class="form-control" id="category">
                        <option value="0">Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="attributes"></div>
            <div class="form-group row">
                <label for="short-description" class="col-md-2 col-form-label">Short Description</label>
                <div class="col-sm-10">
                    <textarea name="short-description" rows="3" class="form-control" id="short-description"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" rows="8" class="form-control" id="description"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mt-5 mb-5 float-right" value="Create">
        </form>
    </div>
@endsection
@section('script')
    <script>
        const categories = {
            @foreach($categories as $category)
            {{$category->id}} : [
                @foreach(unserializeMetadata($category->metadata) as $md)
                '{{$md}}',
                @endforeach
            ],
            @endforeach
        };
        $(document.body).on('change', '#category', function(e) {
            $('#attributes').html('');
            const category = categories[e.target.value];
            let template = '';
            category.forEach(value => {
                const trimmedValue = value.replaceAll(' ', '_').toLowerCase();
                template += `<div class="form-group row">
                <label for="${trimmedValue}" class="col-md-2 col-form-label">${value}</label>
                <div class="col-sm-10">
                    <input type="hidden" id="category_id" value="${e.target.value}" >
                    <input name="${trimmedValue}" type="text" class="form-control attributes" id="${trimmedValue}">
                </div>
            </div>`;
            })
            $('#attributes').html(template);
        });
    </script>
@endsection

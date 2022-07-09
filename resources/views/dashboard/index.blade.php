@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <h1>@if($user->role == 1) Admin @else Client @endif</h1>
    </div>
@endsection
@section('script')
@endsection

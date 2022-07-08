@extends('layouts.app')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dashboardNavbar" aria-controls="dashboardNavbar" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="dashboardNavbar">
        <a class="navbar-brand" href="#">Home</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
        <div class="form-inline my-2 my-lg-0">
            @if(!\Illuminate\Support\Facades\Auth::user())
                <a href="{{route('login')}}" class="btn btn-outline-success my-2 mr-2 my-sm-0" >Login</a>
                <a href="{{route('register')}}" class="btn btn-outline-success my-2 my-sm-0" >Register</a>
            @else
                <a href="{{route('dashboard')}}" class="btn btn-outline-success my-2 my-sm-0" >Dashboard</a>
            @endif
        </div>
    </div>
</nav>

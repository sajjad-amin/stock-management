@extends('layouts.app')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#homeNavbar" aria-controls="homeNavbar" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="homeNavbar">
        <a class="navbar-brand" href="#">Home</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
        <div class="form-inline my-2 my-lg-0">
            @if(!\Illuminate\Support\Facades\Auth::user())
                <a href="{{route('login')}}" class="btn btn-outline-success my-2 mr-2 my-sm-0" >Login</a>
                <a href="{{route('register')}}" class="btn btn-outline-success my-2 my-sm-0" >Register</a>
            @else
                <div class="dropdown">
                    <button class="btn text-white" type="button" id="homeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="homeDropdown">
                        <a href="{{route('dashboard')}}" type="button" class="dropdown-item">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>

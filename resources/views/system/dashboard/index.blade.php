@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    @php
    use \App\Models\Sell;
    $sellToday = Sell::whereDate('created_at', now())->get()->sum('sell_price');
    $interestToday = Sell::whereDate('created_at', now())->get()->sum('interest');
    $last30daySell = Sell::whereBetween('created_at', [now()->subDays(30), now()])->get()->sum('sell_price');
    $last30daysInterest = Sell::whereBetween('created_at', [now()->subDays(30), now()])->get()->sum('interest');
    $last7daySell = Sell::whereBetween('created_at', [now()->subDays(7), now()])->get()->sum('sell_price');
    $last7daysInterest = Sell::whereBetween('created_at', [now()->subDays(7), now()])->get()->sum('interest');
    @endphp
    <div class="container-fluid">
        @can('admin')
            <div class="row m-3">
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Today</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>Sell</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$sellToday}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p>Interest</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$interestToday}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Last 7 Days</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>Sell</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$last7daySell}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p>Interest</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$last7daysInterest}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Last 30 Days</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>Sell</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$last30daySell}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p>Interest</p>
                                </div>
                                <div class="col-6">
                                    <p>{{$last30daysInterest}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection
@section('script')
@endsection

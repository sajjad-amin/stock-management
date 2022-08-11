@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    @php
        use \App\Models\Sell;
        use \App\Models\Transaction;
        // Product Data
        $sellToday = Sell::whereDate('created_at', now())->get()->sum('sell_price');
        $interestToday = Sell::whereDate('created_at', now())->get()->sum('interest');
        $last30daySell = Sell::whereBetween('created_at', [now()->subDays(30), now()])->get()->sum('sell_price');
        $last30daysInterest = Sell::whereBetween('created_at', [now()->subDays(30), now()])->get()->sum('interest');
        $last7daySell = Sell::whereBetween('created_at', [now()->subDays(7), now()])->get()->sum('sell_price');
        $last7daysInterest = Sell::whereBetween('created_at', [now()->subDays(7), now()])->get()->sum('interest');
        // E-Cash Data
        $eCashDataToday = [];
        $eCashDataYesterday = [];
        $eCashDataLastMonth = [];
        foreach ($vendors as $vendor){
            $eCashDataToday[] = [
                'vendor' => $vendor->name,
                'amount' => Transaction::whereDate('created_at', now())->whereVendor($vendor->name)->get()->sum('amount')
            ];
            $eCashDataYesterday[] = [
                'vendor' => $vendor->name,
                'amount' => Transaction::whereDate('created_at', now()->subDays(1))->whereVendor($vendor->name)->get()->sum('amount')
            ];
            $eCashDataLastMonth[] = [
                'vendor' => $vendor->name,
                'amount' => Transaction::whereBetween('created_at', [now()->subDays(30), now()])->whereVendor($vendor->name)->get()->sum('amount')
            ];
        }
    @endphp
    <div class="container-fluid">
        @can('admin')
            <h2 class="m-3">Product Sell</h2>
            <hr>
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
            <h2 class="m-3 mt-5">E-Cash Transactions</h2>
            <hr>
            <div class="row m-3">
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Today</h5>
                        </div>
                        <div class="card-body">
                            @foreach($eCashDataToday as $data)
                                <div class="row">
                                    <div class="col-6">
                                        <p>{{$data['vendor']}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{$data['amount']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Yesterday</h5>
                        </div>
                        <div class="card-body">
                            @foreach($eCashDataYesterday as $data)
                                <div class="row">
                                    <div class="col-6">
                                        <p>{{$data['vendor']}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{$data['amount']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Last 30 Days</h5>
                        </div>
                        <div class="card-body">
                            @foreach($eCashDataLastMonth as $data)
                                <div class="row">
                                    <div class="col-6">
                                        <p>{{$data['vendor']}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p>{{$data['amount']}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection
@section('script')
@endsection

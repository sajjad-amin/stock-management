<?php

namespace App\Http\Controllers;

use App\Models\ECash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $vendors = ECash::all();
        return view('system.dashboard.index', compact(['user', 'vendors']));
    }
}

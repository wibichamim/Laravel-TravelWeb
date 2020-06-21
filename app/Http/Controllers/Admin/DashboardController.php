<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TravelPackage;
use Illuminate\Http\Request;
use App\Transaction;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.dashboard', [
            'travel_package' => TravelPackage::count(),
            'total_transaction' => Transaction::count(),
            'transaction_pending' => Transaction::where('transaction_status','PENDING')->count(),
            'transaction_success' => Transaction::where('transaction_status','SUCCESS')->count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ChartSerivce;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected ChartSerivce $chartSerivce;

    public function __construct(ChartSerivce $chartSerivce){
        $this->chartSerivce = $chartSerivce;
    }
    public function index(): View {

        $user = auth()->user();
        $user->load('wallet.transactions', 'categories', 'wallet.savingRelation');

        $transactions = $user->wallet->transactions;
        $categories = $user->categories;
        $savings = $user->wallet->savingRelation()->get();

        $chartData = $this->chartSerivce->chartData($transactions);

        return view('dashboard', compact('transactions', 'categories', 'savings', 'chartData'));
    }
}

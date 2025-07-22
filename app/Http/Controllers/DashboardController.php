<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load('wallet.transactions', 'categories', 'wallet.savingRelation');

        $transactions = $user->wallet->transactions;
        $categories = $user->categories;
        $savings = $user->wallet->savingRelation()->get();

        $now = Carbon::now();
        $startCurrent = $now->copy()->startOfWeek();
        $endCurrent = $now->copy()->endOfWeek();
        $startPrevious = $now->copy()->subWeek()->startOfWeek();
        $endPrevious = $now->copy()->subWeek()->endOfWeek();

        $currentWeek = $transactions->whereBetween('transaction_date', [$startCurrent, $endCurrent]);
        $previousWeek = $transactions->whereBetween('transaction_date', [$startPrevious, $endPrevious]);

        $chartLabels = collect(range(0, 6))->map(function($i) use ($startCurrent) {
            return $startCurrent->copy()->addDays($i)->format('d');
        });

        $chartDataCurrent = $chartLabels->map(function($day) use ($currentWeek, $startCurrent) {
            return $currentWeek->filter(function($t) use ($day, $startCurrent) {
                return Carbon::parse($t->transaction_date)->format('d') == $day;
            })->sum('amount');
        });

        $chartDataPrevious = $chartLabels->map(function($day) use ($previousWeek, $startPrevious) {
            return $previousWeek->filter(function($t) use ($day, $startPrevious) {
                return Carbon::parse($t->transaction_date)->format('d') == $day;
            })->sum('amount');
        });

        return view('dashboard', compact('transactions', 'categories', 'savings', 'chartLabels', 'chartDataCurrent', 'chartDataPrevious'));
    }
}

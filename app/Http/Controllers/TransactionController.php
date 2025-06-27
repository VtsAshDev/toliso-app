<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index() : View
    {
       $wallet = auth()->user()->wallet;

//       $transactions = $wallet->transactions()->with('category')->get();$
        $transactions = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('wallets', 'transactions.wallet_id', '=', 'wallets.id')
            ->join('users', 'wallets.user_id', '=', 'users.id')
            ->where('users.id', auth()->id())
            ->select(
                'transactions.*',
                'categories.name as category_name',
                'categories.type as category_type',
            )
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $user = auth()->user();
        $categories = $user->categories()->get();
        return view('transactions.create',compact('categories'));
    }

    public function store(Request $request) : RedirectResponse
    {

        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'required|string|max:255',
            'value'            => 'required|numeric|min:0',
            'installments'     => 'nullable|integer|min:1',
            'is_recurring'     => 'required|boolean',
            'due_date'         => 'nullable|date',
            'transaction_date' => 'required|date',
        ]);


        $user = auth()->user();
        $user->wallet->transactions()->create([
            'category_id' => $request->category_id,
            'is_recurring' => $request->is_recurring,
            'description' => $request->description,
            'amount' => $request->value,
            'installments' => $request->installments,
            'due_date' =>  $request->due_date == null ? null : Carbon::parse($request->due_date),
            'transaction_date' => Carbon::parse($request->transaction_date),
        ]);

        return redirect()->route('transactions.index');
    }

}

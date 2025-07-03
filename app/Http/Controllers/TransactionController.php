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
    public function index(Request $request): View
    {
        $wallet = auth()->user()->wallet;
        $query = $wallet->transactions()->with('category');

        if ($request->filled('type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->get();

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

    public function edit(Transaction $transaction) : View
    {

        $user = auth()->user();

        $transaction = $user->wallet->transactions()->findOrFail($transaction->id);
        $categories = $user->categories()->get();

        return view('transactions.edit', compact('transaction','categories'));
    }

    public function update(Request $request, Transaction $transaction) : RedirectResponse
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

        $transaction->update([
            'category_id'      => $request->category_id,
            'is_recurring'     => $request->is_recurring,
            'description'     => $request->description,
            'amount'          => $request->value,
            'installments'    => $request->installments,
            'due_date'        => $request->due_date == null ? null : Carbon::parse($request->due_date),
            'transaction_date'=> Carbon::parse($request->transaction_date),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction) : RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted!');
    }
}

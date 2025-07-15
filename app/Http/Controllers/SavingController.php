<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavingController extends Controller
{
    public function index() : View
    {
        $user = auth()->user();

        $savings = $user->wallet->savingRelation()->get();

        $total = $user->wallet->savingRelation()->sum('balance');

        return view('savings.index', compact('savings', 'total'));
    }

    public function create() : View
    {
        return view('savings.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'balance' => 'required|numeric',
            'note' => 'required|string',
        ]);

        $user->wallet->savingRelation()->create($validated);


        return redirect()->route('savings.index')->with('success', 'Saving created successfully');
    }

    public function edit(int $id) : View
    {
        $user = auth()->user();

        $saving = $user->wallet->savingRelation()->findOrFail($id);

        return view('savings.edit', compact('saving'));
    }

    public function update(Request $request, int $id) : RedirectResponse
    {

        $user = auth()->user();

        $validated = $request->validate([
            'balance' => 'required|numeric',
            'note' => 'required|string',
        ]);

        $saving = $user->wallet->savingRelation()->findOrFail($id);

        $saving->update($validated);

        return redirect()->route('savings.index')->with('success', 'Saving updated successfully');
    }

    public function destroy(int $id) : RedirectResponse
    {
        $user = auth()->user();

        $saving = $user->wallet->savingRelation()->findOrFail($id);

        $saving->delete();

        return redirect()->route('savings.index')->with('success', 'Saving deleted successfully');
    }

}

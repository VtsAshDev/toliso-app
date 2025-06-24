<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = auth()->user()->categories()->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        return view('welcome', compact('category'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
       $request->validate([
            "name" => "required|string|max:255",
            "type" => "required|in:income,expense",
        ]);

       $user = auth()->user();

       $user->categories()->create([
           'name' => $request->name,
           'type' => $request->type,
       ]);
       return redirect()->route('categories.index');
    }

    public function edit(int $id): View
    {

        $category = auth()->user()->categories()->findorfail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {

        $request->validate([
            "name" => "required|string|max:255",
            "type" => "required|in:income,expense",
        ]);

        $user = auth()->user();

        $category = $user->categories()->findOrFail($id);

        $category->update([
           'name' => $request->name,
           'type' => $request->type,
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = auth()->user();

        $category = $user->categories()->findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with('Delete', 'Categoria Excluida com sucesso.');
    }

}

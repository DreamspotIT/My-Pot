<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5); 
        return view('content.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('content.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'rate_per_gram' => 'required|numeric|min:0',
            'rate_date' => 'required|date',
        ]);

        Category::create([
            'name' => $request->name,
            'rate_per_gram' => $request->rate_per_gram,
            'rate_date' => $request->rate_date,
        ]);

        return redirect()->route('category.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view('content.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'rate_per_gram' => 'required|numeric|min:0',
            'rate_date' => 'required|date',
        ]);

        $category->update([
            'name' => $request->name,
            'rate_per_gram' => $request->rate_per_gram,
            'rate_date' => $request->rate_date,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}

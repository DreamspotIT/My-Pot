<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory; // ✅ required
use App\Models\Category;    // ✅ required

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(5);
        return view('content.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('content.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategory.index')->with('success', 'Subcategory added successfully.');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('content.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());

        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy($id)
    {
        Subcategory::findOrFail($id)->delete();
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\GoldItem;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoldItemController extends Controller
{
    // Show all gold items
    public function index()
    {
        $goldItems = GoldItem::with(['category', 'subcategory'])->paginate(5);
        return view('content.gold.index', compact('goldItems'));
    }

    // Show form to create a new gold item
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('content.gold.create', compact('categories', 'subcategories'));
    }

    // Store new gold item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'weight' => 'required|numeric',
            'purity' => 'required|in:24K,22K,18K',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/gold_items', 'public');
            $validated['image'] = $path;
        }

        GoldItem::create($validated);

        return redirect()->route('gold-items.index')->with('success', 'Gold item added successfully.');
    }

    // Show form to edit gold item
    public function edit(GoldItem $goldItem)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('content.gold.edit', compact('goldItem', 'categories', 'subcategories'));
    }

    // Update existing gold item
    public function update(Request $request, GoldItem $goldItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'weight' => 'required|numeric',
            'purity' => 'required|in:24K,22K,18K',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($goldItem->image && Storage::disk('public')->exists($goldItem->image)) {
                Storage::disk('public')->delete($goldItem->image);
            }

            // Store new image
            $path = $request->file('image')->store('uploads/gold_items', 'public');
            $validated['image'] = $path;
        }

        $goldItem->update($validated);

        return redirect()->route('gold-items.index')->with('success', 'Gold item updated successfully.');
    }

    // Delete a gold item
    public function destroy(GoldItem $goldItem)
    {
        if ($goldItem->image && Storage::disk('public')->exists($goldItem->image)) {
            Storage::disk('public')->delete($goldItem->image);
        }

        $goldItem->delete();

        return redirect()->route('gold-items.index')->with('success', 'Gold item deleted.');
    }

    // Show single gold item
    public function show($id)
    {
        $goldItem = GoldItem::with(['category', 'subcategory'])->findOrFail($id);
        return view('content.gold.show', compact('goldItem'));
    }
}

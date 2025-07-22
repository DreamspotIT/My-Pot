<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\GoldItem;

class GoldItemController extends Controller
{
    // ✅ List All Gold Items
    public function index()
    {
        $items = GoldItem::all();
        return response()->json([
            'status' => true,
            'items' => $items
        ]);
    }

    // ✅ Store New Gold Item
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'weight'      => 'required|numeric',
            'purity'      => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $item = GoldItem::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'weight'      => $request->weight,
            'purity'      => $request->purity,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Gold item added successfully',
            'item' => $item
        ], 201);
    }

    // ✅ Show Specific Gold Item
    public function show($id)
    {
        $item = GoldItem::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Gold item not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'item' => $item
        ]);
    }

    // ✅ Update Gold Item
    public function update(Request $request, $id)
    {
        $item = GoldItem::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Gold item not found'
            ], 404);
        }

        $item->update($request->only(['name', 'price', 'weight', 'purity', 'description']));

        return response()->json([
            'status' => true,
            'message' => 'Gold item updated successfully',
            'item' => $item
        ]);
    }

    // ✅ Delete Gold Item
    public function destroy($id)
    {
        $item = GoldItem::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Gold item not found'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Gold item deleted successfully'
        ]);
    }
}

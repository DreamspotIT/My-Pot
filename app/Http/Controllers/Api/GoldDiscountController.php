<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\GoldDiscount;

class GoldDiscountController extends Controller
{
    public function index()
    {
        return response()->json(GoldDiscount::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'percentage' => 'required|numeric|min:0',
        ]);

        $discount = GoldDiscount::create($request->all());

        return response()->json(['message' => 'Discount added', 'data' => $discount]);
    }

    public function show($id)
    {
        $discount = GoldDiscount::find($id);

        if (!$discount) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        return response()->json($discount);
    }

    public function update(Request $request, $id)
    {
        $discount = GoldDiscount::find($id);

        if (!$discount) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $discount->update($request->all());

        return response()->json(['message' => 'Discount updated', 'data' => $discount]);
    }

    public function destroy($id)
    {
        $discount = GoldDiscount::find($id);

        if (!$discount) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $discount->delete();

        return response()->json(['message' => 'Discount deleted']);
    }
}


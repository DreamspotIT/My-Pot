<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\GoldOffer;

class GoldOfferController extends Controller
{
    public function index()
    {
        return response()->json(GoldOffer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $offer = GoldOffer::create($validated);

        return response()->json(['message' => 'Offer added successfully', 'offer' => $offer], 201);
    }

    public function show($id)
    {
        $offer = GoldOffer::find($id);
        return $offer ? response()->json($offer) : response()->json(['error' => 'Not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $offer = GoldOffer::find($id);
        if (!$offer) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $offer->update($validated);

        return response()->json(['message' => 'Offer updated successfully', 'offer' => $offer]);
    }

    public function destroy($id)
    {
        $offer = GoldOffer::find($id);
        if (!$offer) return response()->json(['error' => 'Not found'], 404);

        $offer->delete();

        return response()->json(['message' => 'Offer deleted successfully']);
    }
}


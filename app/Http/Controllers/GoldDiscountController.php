<?php

namespace App\Http\Controllers;

use App\Models\GoldDiscount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoldDiscountController extends Controller
{
    public function index()
    {
        $discounts = GoldDiscount::latest()->paginate(5);
        return view('content.gold_discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('content.gold_discounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'percentage' => 'required|numeric',
            'code' => 'nullable|string',
            'min_purchase' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Set is_active based on date range
        $today = Carbon::today();

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $validated['is_active'] = $today->between($start, $end);
        } else {
            $validated['is_active'] = false;
        }

        GoldDiscount::create($validated);

        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(GoldDiscount $discount)
    {
        return view('content.gold_discounts.edit', compact('discount'));
    }

    public function update(Request $request, GoldDiscount $discount)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'percentage' => 'required|numeric',
            'code' => 'nullable|string',
            'min_purchase' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        // Set is_active based on date range
        $today = Carbon::today();

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $validated['is_active'] = $today->between($start, $end);
        } else {
            $validated['is_active'] = false;
        }

        $discount->update($validated);

        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(GoldDiscount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
    public function show(GoldDiscount $discount)
    {
        return view('content.gold_discounts.show', compact('discount'));
    }

}

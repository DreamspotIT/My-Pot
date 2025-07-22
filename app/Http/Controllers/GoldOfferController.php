<?php
namespace App\Http\Controllers;

use App\Models\GoldOffer;
use Illuminate\Http\Request;

class GoldOfferController extends Controller
{
    public function index()
    {
        $offers = GoldOffer::paginate(5); // Show 5 offers per page
        return view('content.gold_offers.index', compact('offers'));
    }

    public function create()
    {
        return view('content.gold_offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        GoldOffer::create($request->all());
        return redirect()->route('gold-offers.index')->with('success', 'Gold Offer created successfully.');
    }

    public function edit(GoldOffer $gold_offer)
    {
        return view('content.gold_offers.edit', compact('gold_offer'));
    }

    public function update(Request $request, GoldOffer $gold_offer)
    {
        $request->validate([
            'title' => 'required',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $gold_offer->update($request->all());
        return redirect()->route('gold-offers.index')->with('success', 'Gold Offer updated successfully.');
    }

    public function destroy(GoldOffer $gold_offer)
    {
        $gold_offer->delete();
        return redirect()->route('gold-offers.index')->with('success', 'Offer deleted successfully.');
    }
public function show(GoldOffer $gold_offer)
{
    return view('content.gold_offers.show', compact('gold_offer'));
}

}

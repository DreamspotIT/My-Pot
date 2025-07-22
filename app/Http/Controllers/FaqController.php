<?php
namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Show list of FAQs
    public function index()
    {

        $faqs = Faq::paginate(5);
        return view('content.faqs.index', compact('faqs'));
    }

    // Show create form
    public function create()
    {
        return view('content.faqs.create');
    }

    // Store new FAQ
public function store(Request $request)
{
    $request->validate([
        'question' => 'required|string',
        'answer' => 'required|string',
        'status' => 'required|in:0,1',
    ]);

    Faq::create([
        'question' => $request->question,
        'answer' => $request->answer,
        'status' => $request->status,
    ]);

    return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
}

    // Show edit form
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('content.faqs.edit', compact('faq'));
    }

    // Update FAQ
public function update(Request $request, $id)
{
    $request->validate([
        'question' => 'required|string',
        'answer' => 'required|string',
        'status' => 'required|in:0,1',
    ]);

    $faq = Faq::findOrFail($id);
    $faq->update([
        'question' => $request->question,
        'answer' => $request->answer,
        'status' => $request->status,
    ]);

    return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
}
    // Delete FAQ
    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
    public function show($id)
{
    $faq = Faq::findOrFail($id);
    return view('content.faqs.show', compact('faq'));
}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    public function index()
    {
        $questions = FaqQuestion::with('category')->paginate(15);
        return view('admin.faq-questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = FaqCategory::all();
        return view('admin.faq-questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:5000',
        ]);

        FaqQuestion::create($validated);

        return redirect()->route('admin.faq-questions.index')->with('success', 'FAQ vraag aangemaakt!');
    }

    public function show(FaqQuestion $faqQuestion)
    {
        $faqQuestion->load('category');
        return view('admin.faq-questions.show', compact('faqQuestion'));
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        $categories = FaqCategory::all();
        return view('admin.faq-questions.edit', compact('faqQuestion', 'categories'));
    }

    public function update(Request $request, FaqQuestion $faqQuestion)
    {
        $validated = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:5000',
        ]);

        $faqQuestion->update($validated);

        return redirect()->route('admin.faq-questions.index')->with('success', 'FAQ vraag bijgewerkt!');
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        $faqQuestion->delete();
        return redirect()->route('admin.faq-questions.index')->with('success', 'FAQ vraag verwijderd!');
    }
}

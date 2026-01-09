<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::withCount('questions')->paginate(15);
        return view('admin.faq-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories',
        ]);

        FaqCategory::create($validated);

        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ categorie aangemaakt!');
    }

    public function show(FaqCategory $faqCategory)
    {
        $faqCategory->load('questions');
        return view('admin.faq-categories.show', compact('faqCategory'));
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq-categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faq_categories,name,' . $faqCategory->id,
        ]);

        $faqCategory->update($validated);

        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ categorie bijgewerkt!');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        // Check if category has questions
        if ($faqCategory->questions()->count() > 0) {
            return redirect()->back()->with('error', 'Kan categorie niet verwijderen omdat er nog vragen in zitten!');
        }

        $faqCategory->delete();
        return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ categorie verwijderd!');
    }
}

@extends('layouts.admin')

@section('title', 'FAQ Vraag')
@section('page-title', 'FAQ Vraag')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.faq-questions.edit', $faqQuestion) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Bewerken
            </a>
            <a href="{{ route('admin.faq-questions.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Terug
            </a>
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Categorie:</label>
            <p class="text-lg">{{ $faqQuestion->category->name }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Vraag:</label>
            <p class="text-lg font-semibold">{{ $faqQuestion->question }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Antwoord:</label>
            <div class="bg-gray-50 rounded p-4">
                <p class="whitespace-pre-wrap">{{ $faqQuestion->answer }}</p>
            </div>
        </div>
    </div>
</div>
@endsection



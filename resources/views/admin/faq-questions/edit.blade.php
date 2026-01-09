@extends('layouts.admin')

@section('title', 'FAQ Vraag Bewerken')
@section('page-title', 'FAQ Vraag Bewerken')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.faq-questions.update', $faqQuestion) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="faq_category_id" class="block text-sm font-medium text-gray-700 mb-2">Categorie</label>
            <select name="faq_category_id" id="faq_category_id" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('faq_category_id') border-red-500 @enderror">
                <option value="">Selecteer een categorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('faq_category_id', $faqQuestion->faq_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('faq_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Vraag</label>
            <input type="text" name="question" id="question" value="{{ old('question', $faqQuestion->question) }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('question') border-red-500 @enderror">
            @error('question')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Antwoord</label>
            <textarea name="answer" id="answer" rows="6" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('answer') border-red-500 @enderror">{{ old('answer', $faqQuestion->answer) }}</textarea>
            @error('answer')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Opslaan
            </button>
            <a href="{{ route('admin.faq-questions.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Annuleren
            </a>
        </div>
    </form>
</div>
@endsection



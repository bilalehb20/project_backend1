@extends('layouts.admin')

@section('title', 'FAQ Categorie')
@section('page-title', 'FAQ Categorie')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-4">{{ $faqCategory->name }}</h2>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.faq-categories.edit', $faqCategory) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Bewerken
            </a>
            <a href="{{ route('admin.faq-categories.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Terug
            </a>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold mb-4">Vragen in deze categorie ({{ $faqCategory->questions->count() }})</h3>
        @if($faqCategory->questions->count() > 0)
            <div class="space-y-4">
                @foreach($faqCategory->questions as $question)
                    <div class="border rounded p-4">
                        <h4 class="font-semibold mb-2">{{ $question->question }}</h4>
                        <p class="text-gray-600">{{ $question->answer }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Geen vragen in deze categorie.</p>
        @endif
    </div>
</div>
@endsection



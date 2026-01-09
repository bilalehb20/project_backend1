@extends('layouts.admin')

@section('title', 'FAQ Categorie Bewerken')
@section('page-title', 'FAQ Categorie Bewerken')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.faq-categories.update', $faqCategory) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $faqCategory->name) }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Opslaan
            </button>
            <a href="{{ route('admin.faq-categories.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Annuleren
            </a>
        </div>
    </form>
</div>
@endsection



@extends('layouts.admin')

@section('title', 'Nieuw Nieuwsitem')
@section('page-title', 'Nieuw Nieuwsitem')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titel</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
            <textarea name="content" id="content" rows="10" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Afbeelding</label>
            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/gif" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('image') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-1">JPG, PNG of GIF. Max 5MB.</p>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Publicatiedatum</label>
            <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('published_at') border-red-500 @enderror">
            @error('published_at')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Opslaan
            </button>
            <a href="{{ route('admin.news.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Annuleren
            </a>
        </div>
    </form>
</div>
@endsection



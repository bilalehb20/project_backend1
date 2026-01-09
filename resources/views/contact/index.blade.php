@extends('layouts.public')

@section('title', 'Contact - Telefoon Webshop')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold mb-8">Neem Contact Op</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-md border-gray-300 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full rounded-md border-gray-300 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Onderwerp</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required class="w-full rounded-md border-gray-300 @error('subject') border-red-500 @enderror">
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Bericht</label>
                <textarea name="message" id="message" rows="6" required class="w-full rounded-md border-gray-300 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full px-6 py-3 light-blue-bg text-white rounded-md hover:bg-light-blue-hover transition">
                Verzenden
            </button>
        </form>
    </div>
</div>
@endsection



@extends('layouts.admin')

@section('title', 'Contactbericht')
@section('page-title', 'Contactbericht')

@section('content')
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-6">
    <!-- Message Info -->
    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Van:</label>
                <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $contactMessage->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Email:</label>
                <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $contactMessage->email }}</p>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Onderwerp:</label>
                <p class="mt-1 font-semibold text-gray-800 dark:text-gray-200">{{ $contactMessage->subject }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Datum:</label>
                <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $contactMessage->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Status:</label>
                <p class="mt-1">
                    @if($contactMessage->read)
                        <span class="px-2 py-1 text-xs rounded bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Gelezen</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">Ongelezen</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Message Content -->
    <div>
        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Bericht:</label>
        <div class="bg-gray-50 dark:bg-gray-700 rounded p-4">
            <p class="whitespace-pre-wrap text-gray-800 dark:text-gray-200">{{ $contactMessage->message }}</p>
        </div>
    </div>

    <!-- Reply Section -->
    @if($contactMessage->reply)
        <div>
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Antwoord:</label>
            <div class="bg-blue-50 dark:bg-blue-900/30 rounded p-4">
                <p class="whitespace-pre-wrap text-gray-800 dark:text-gray-200">{{ $contactMessage->reply }}</p>
            </div>
        </div>
    @endif

    <!-- Reply Form -->
    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Antwoord Verzenden</h3>
        <form method="POST" action="{{ route('admin.contact-messages.reply', $contactMessage) }}" class="space-y-4">
            @csrf
            <div>
                <label for="reply" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Antwoord:</label>
                <textarea name="reply" id="reply" rows="6" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('reply') border-red-500 @enderror">{{ old('reply', $contactMessage->reply) }}</textarea>
                @error('reply')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Verzenden
                </button>
                <a href="{{ route('admin.contact-messages.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    Terug
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


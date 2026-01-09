@extends('layouts.admin')

@section('title', 'Contactberichten')
@section('page-title', 'Contactberichten')

@section('content')
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Naam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Onderwerp</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Datum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Acties</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($messages as $message)
                <tr class="{{ !$message->read ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $message->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $message->email }}</td>
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ Str::limit($message->subject, 40) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($message->read)
                            <span class="px-2 py-1 text-xs rounded bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Gelezen</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">Ongelezen</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ $message->created_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">Bekijken</a>
                        <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Weet u zeker dat u dit bericht wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Geen berichten gevonden</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $messages->links() }}
</div>
@endsection


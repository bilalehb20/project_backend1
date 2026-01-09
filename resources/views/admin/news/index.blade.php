@extends('layouts.admin')

@section('title', 'Nieuwsbeheer')
@section('page-title', 'Nieuwsbeheer')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Nieuw Nieuwsitem
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Titel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Publicatiedatum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Acties</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($news as $newsItem)
                <tr>
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200">{{ $newsItem->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ $newsItem->published_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.news.edit', $newsItem) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">Bewerken</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $newsItem) }}" class="inline" onsubmit="return confirm('Weet u zeker dat u dit nieuwsitem wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $news->links() }}
</div>
@endsection



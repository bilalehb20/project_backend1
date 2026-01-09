@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Gebruikers</h3>
        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['users_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Admins</h3>
        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['admins_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Producten</h3>
        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['products_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Nieuwsitems</h3>
        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $stats['news_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">FAQ Categorieën</h3>
        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stats['faq_categories_count'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Ongelezen Berichten</h3>
        <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $stats['unread_messages_count'] }}</p>
    </div>
</div>
@endsection



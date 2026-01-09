@extends('layouts.admin')

@section('title', 'Nieuwe Gebruiker')
@section('page-title', 'Nieuwe Gebruiker')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Gebruikersnaam</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('username') border-red-500 @enderror">
            @error('username')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Wachtwoord</label>
            <input type="password" name="password" id="password" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Rol</label>
            <select name="role" id="role" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Gebruiker</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birthday" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Verjaardag</label>
            <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('birthday') border-red-500 @enderror">
            @error('birthday')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="about_me" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-2">Over Mij</label>
            <textarea name="about_me" id="about_me" rows="4" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 @error('about_me') border-red-500 @enderror">{{ old('about_me') }}</textarea>
            @error('about_me')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Opslaan
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                Annuleren
            </a>
        </div>
    </form>
</div>
@endsection



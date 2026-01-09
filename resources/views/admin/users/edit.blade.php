@extends('layouts.admin')

@section('title', 'Gebruiker Bewerken')
@section('page-title', 'Gebruiker Bewerken')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Gebruikersnaam</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('username') border-red-500 @enderror">
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Wachtwoord (laat leeg om niet te wijzigen)</label>
            <input type="password" name="password" id="password" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
            <select name="role" id="role" required class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Gebruiker</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="birthday" class="block text-sm font-medium text-gray-700 mb-2">Verjaardag</label>
            <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('birthday') border-red-500 @enderror">
            @error('birthday')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="about_me" class="block text-sm font-medium text-gray-700 mb-2">Over Mij</label>
            <textarea name="about_me" id="about_me" rows="4" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('about_me') border-red-500 @enderror">{{ old('about_me', $user->about_me) }}</textarea>
            @error('about_me')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Opslaan
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Annuleren
            </a>
        </div>
    </form>
</div>
@endsection



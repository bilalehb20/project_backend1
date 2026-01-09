@extends('layouts.public')

@section('title', 'Profiel Bewerken')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-200">Profiel Bewerken</h1>

    <!-- Profile Information Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Profiel Informatie</h2>
        
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <!-- Profile Photo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profielfoto</label>
                <div class="flex items-center space-x-4">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-3xl">
                            👤
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/jpeg,image/png,image/jpg,image/gif" class="block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-light-blue file:text-white hover:file:bg-light-blue-hover dark:file:bg-light-blue dark:hover:file:bg-light-blue-hover">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, PNG of GIF. Max 2MB.</p>
                        @error('profile_photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-light-blue focus:ring-light-blue @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gebruikersnaam</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-light-blue focus:ring-light-blue @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-light-blue focus:ring-light-blue @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Birthday -->
            <div>
                <label for="birthday" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Verjaardag</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-light-blue focus:ring-light-blue @error('birthday') border-red-500 @enderror">
                @error('birthday')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- About Me -->
            <div>
                <label for="about_me" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Over Mij</label>
                <textarea name="about_me" id="about_me" rows="4" maxlength="1000" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-light-blue focus:ring-light-blue @error('about_me') border-red-500 @enderror">{{ old('about_me', $user->about_me) }}</textarea>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maximaal 1000 tekens</p>
                @error('about_me')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-2 light-blue-bg text-white rounded-md hover:bg-light-blue-hover transition">
                    Opslaan
                </button>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-green-600">
                        Profiel succesvol bijgewerkt!
                    </p>
                @endif
            </div>
        </form>
    </div>

    <!-- Update Password Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Wachtwoord Wijzigen</h2>
        @include('profile.partials.update-password-form')
    </div>

    <!-- Delete Account Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Account Verwijderen</h2>
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection

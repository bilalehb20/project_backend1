@extends('layouts.public')

@section('title', $user->name . ' - Profiel')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="phone-gradient p-8 text-white">
            <div class="flex items-center space-x-6">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full border-4 border-white">
                @else
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center text-4xl">
                        👤
                    </div>
                @endif
                <div>
                    <h1 class="text-4xl font-bold">{{ $user->name }}</h1>
                    <p class="text-xl opacity-90">@{{ $user->username }}</p>
                    @if($user->birthday)
                        <p class="text-sm opacity-75">Geboortedatum: {{ $user->birthday->format('d M Y') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-8">
            @if($user->about_me)
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Over Mij</h2>
                    <p class="text-gray-700">{{ $user->about_me }}</p>
                </div>
            @endif

            <!-- Mijn Likes Sectie -->
            @auth
                @if(auth()->id() === $user->id && isset($allLikes) && $allLikes->count() > 0)
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Mijn Likes</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($allLikes as $likedItem)
                                @if($likedItem['type'] === 'product')
                                    @php $product = $likedItem['item']; @endphp
                                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden product-card group relative">
                                        <!-- Product Image -->
                                        <div class="relative bg-gray-50 dark:bg-gray-700 h-48 flex items-center justify-center overflow-hidden">
                                            @if($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                                <img src="{{ asset('storage/' . $product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="object-contain max-w-full max-h-48 p-4"
                                                     loading="lazy">
                                            @else
                                                <span class="text-6xl">📱</span>
                                            @endif
                                            <!-- Like Button -->
                                            <button type="button"
                                                    class="like-button absolute top-3 right-3 p-2.5 rounded-full bg-white dark:bg-gray-800 shadow-lg z-10 liked" 
                                                    data-id="{{ $product->id }}" 
                                                    data-type="Product"
                                                    aria-label="Unlike product">
                                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <h3 class="text-lg font-bold mb-2 text-gray-800 dark:text-gray-200">{{ $product->name }}</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->brand->name }}</p>
                                            <p class="text-xl font-bold text-[#0056FF] dark:text-[#3399FF] mb-4">€{{ number_format($product->price, 2, ',', '.') }}</p>
                                            <a href="{{ route('products.show', $product) }}" class="cta-button text-[#0056FF] dark:text-[#3399FF] hover:text-[#0044CC] dark:hover:text-[#4DB3FF] font-medium inline-flex items-center gap-2">
                                                Bekijk Details →
                                            </a>
                                        </div>
                                    </div>
                                @elseif($likedItem['type'] === 'news')
                                    @php $news = $likedItem['item']; @endphp
                                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden product-card group relative">
                                        <!-- News Image -->
                                        <div class="relative h-48 overflow-hidden bg-gray-200 dark:bg-gray-700">
                                            @if($news->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($news->image))
                                                <img src="{{ asset('storage/' . $news->image) }}" 
                                                     alt="{{ $news->title }}" 
                                                     class="w-full h-full object-cover"
                                                     loading="lazy">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="text-6xl">📱</span>
                                                </div>
                                            @endif
                                            <!-- Like Button -->
                                            <button type="button"
                                                    class="like-button absolute top-3 right-3 p-2.5 rounded-full bg-white dark:bg-gray-800 shadow-lg z-10 liked" 
                                                    data-id="{{ $news->id }}" 
                                                    data-type="News"
                                                    aria-label="Unlike news">
                                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $news->published_at->format('d M Y') }}</p>
                                            <h3 class="text-lg font-bold mb-3 text-gray-800 dark:text-gray-200 line-clamp-2">{{ $news->title }}</h3>
                                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ Str::limit($news->content, 100) }}</p>
                                            <a href="{{ route('news.show', $news) }}" class="cta-button text-[#0056FF] dark:text-[#3399FF] hover:text-[#0044CC] dark:hover:text-[#4DB3FF] font-medium inline-flex items-center gap-2">
                                                Lees meer →
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @elseif(auth()->id() === $user->id)
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Mijn Likes</h2>
                        <p class="text-gray-600 dark:text-gray-400">Je hebt nog geen items geliked. Begin met het liken van producten of nieuws items!</p>
                    </div>
                @endif
            @endauth

            <!-- Favoriete Producten (Backward Compatibility) -->
            @if($favoriteProducts->count() > 0 && (!auth()->check() || auth()->id() !== $user->id))
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Favoriete Producten</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($favoriteProducts as $product)
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 product-card">
                                <h3 class="font-semibold mb-2 text-gray-800 dark:text-gray-200">{{ $product->name }}</h3>
                                <p class="font-bold text-[#0056FF] dark:text-[#3399FF]">€{{ number_format($product->price, 2, ',', '.') }}</p>
                                <a href="{{ route('products.show', $product) }}" class="text-[#0056FF] dark:text-[#3399FF] hover:text-[#0044CC] dark:hover:text-[#4DB3FF] hover:underline text-sm">Bekijk →</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @auth
                @if(auth()->id() === $user->id)
                    <div class="mt-8">
                        <a href="{{ route('profile.edit') }}" class="px-6 py-3 light-blue-bg text-white rounded-md hover:bg-light-blue-hover inline-block">
                            Profiel Bewerken
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection



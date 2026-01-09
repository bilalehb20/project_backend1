@extends('layouts.public')

@section('title', $product->name . ' - Telefoon Webshop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
                @php
                    $imageUrl = $product->getProductImageUrl();
                @endphp
                @if($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full rounded-lg object-contain bg-gray-50 dark:bg-gray-700 p-8" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg" style="display: none;">
                        <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                    </div>
                @else
                    <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-4 text-gray-800 dark:text-gray-200">{{ $product->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $product->brand->name }} - {{ $product->category->name }}</p>
                <p class="text-4xl font-bold mb-6 text-[#0056FF] dark:text-[#3399FF]">€{{ number_format($product->price, 2, ',', '.') }}</p>
                
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Beschrijving</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $product->description }}</p>
                </div>

                <div class="flex items-center space-x-4 mb-6">
                    @auth
                        <button type="button"
                                id="like-button-{{ $product->id }}" 
                                class="like-button flex items-center space-x-2 px-6 py-3 rounded-lg {{ $isLiked ? 'bg-red-500 dark:bg-red-600' : 'bg-gray-200 dark:bg-gray-700' }} text-white hover:opacity-90 transition-all duration-200 hover:scale-105 active:scale-95"
                                data-id="{{ $product->id }}" 
                                data-type="Product">
                            <svg id="like-icon-{{ $product->id }}" class="w-5 h-5 {{ $isLiked ? 'text-white' : 'text-gray-600 dark:text-gray-300' }}" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $isLiked ? 'Geliked' : 'Like' }}</span>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Login om te liken
                        </a>
                    @endauth
                    <span class="text-gray-600 dark:text-gray-400" id="likes-count-{{ $product->id }}">{{ $product->likes_count }} likes</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



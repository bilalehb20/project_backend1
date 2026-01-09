@extends('layouts.public')

@section('title', 'Mijn Favorieten - PhoneShop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-2">Mijn Favorieten</h1>
        <p class="text-gray-600 dark:text-gray-400">Hier zie je alle producten en nieuws items die je hebt geliked.</p>
    </div>

    @if($allFavorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($allFavorites as $favorite)
                @if($favorite['type'] === 'product')
                    @php $product = $favorite['item']; @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden product-card group relative favorite-item">
                        <!-- Product Image -->
                        <div class="relative bg-gray-50 dark:bg-gray-700 h-48 flex items-center justify-center overflow-hidden">
                            @if($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-card-image object-contain max-w-full max-h-48 p-4"
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
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold mb-2 text-gray-800 dark:text-gray-200 product-card-title">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->brand->name }}</p>
                            <p class="text-xl font-bold text-[#0056FF] dark:text-[#3399FF] mb-4 product-card-price">€{{ number_format($product->price, 2, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product) }}" class="cta-button text-[#0056FF] dark:text-[#3399FF] hover:text-[#0044CC] dark:hover:text-[#4DB3FF] font-medium inline-flex items-center gap-2">
                                Bekijk Details →
                            </a>
                        </div>
                    </div>
                @elseif($favorite['type'] === 'news')
                    @php $news = $favorite['item']; @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden product-card group relative favorite-item">
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
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Content -->
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
    @else
        <div class="text-center py-16">
            <div class="text-6xl mb-4">❤️</div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Je hebt nog geen favorieten</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Begin met het liken van producten of nieuws items die je interessant vindt!</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-[#0056FF] dark:bg-[#3399FF] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#0044CC] dark:hover:bg-[#4DB3FF] transition-colors">
                Ontdek Producten
            </a>
        </div>
    @endif
</div>

{{-- 
    Like functionality is handled by event delegation in resources/js/app.js
    No inline script needed - prevents duplicate event listeners
--}}
@endsection


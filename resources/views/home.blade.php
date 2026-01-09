@extends('layouts.public')

@section('title', 'Home - PhoneShop')

@section('content')
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="relative hero-gradient-bg py-20 md:py-24 lg:py-28 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 hero-pattern"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="hero-fade-in text-4xl md:text-5xl lg:text-6xl font-bold mb-6 hero-title">Welkom bij PhoneShop</h1>
            <p class="hero-fade-in hero-fade-in-delay-1 text-xl md:text-2xl lg:text-3xl mb-4 opacity-95 font-medium hero-subtitle">De Bescherming, Zonder Compromis.</p>
            <p class="hero-fade-in hero-fade-in-delay-1 text-lg md:text-xl mb-10 opacity-80 hero-text">Ontdek de nieuwste telefoons en accessoires</p>
            <a href="{{ route('products.index') }}" class="hero-fade-in hero-fade-in-delay-2 inline-block hero-cta-button px-8 py-4 rounded-xl font-semibold cta-button shadow-lg hover:shadow-2xl">
                Ontdek Onze Collectie
            </a>
        </div>
    </div>

    <!-- Product Category Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200 scroll-reveal">Bladeren per categorie</h2>
        <div class="relative" style="min-height: 220px;">
            <button onclick="scrollCategories('left')" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-20 bg-white dark:bg-gray-800 rounded-full p-3 shadow-xl hover:shadow-2xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border-2 border-light-blue-dark dark:border-light-blue group" aria-label="Scroll links">
                <svg class="w-6 h-6 md:w-7 md:h-7 text-light-blue-dark dark:text-light-blue group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <div class="scroll-container pb-4" id="categories-scroll" style="overflow-x: auto; overflow-y: visible; scroll-behavior: smooth;">
                <div class="flex space-x-6 px-4" style="min-width: max-content; display: flex;">
                @foreach($brandsWithProducts as $brand)
                    <a href="{{ route('products.index', ['brand' => $brand->id]) }}" class="flex-shrink-0 w-36 sm:w-40 md:w-44 group scroll-reveal category-brand-card" style="display: inline-block; visibility: visible; opacity: 1;">
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden product-card border border-gray-200 dark:border-gray-700 relative shadow-sm hover:shadow-lg transition-shadow" style="height: 220px; min-width: 144px; display: flex; flex-direction: column;">
                            <!-- Product Image -->
                            <div class="relative h-36 sm:h-40 bg-gray-50 dark:bg-gray-700 overflow-hidden flex items-center justify-center category-image-container">
                                @php
                                    $brandImageUrl = $brand->featured_product ? $brand->featured_product->getProductImageUrl() : null;
                                @endphp
                                @if($brandImageUrl)
                                    <img src="{{ $brandImageUrl }}" 
                                         alt="{{ $brand->featured_product->name }}" 
                                         class="w-full h-full object-contain p-3 category-image"
                                         loading="lazy"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700" style="display: none;">
                                        <span class="text-sm text-gray-400 dark:text-gray-500 font-medium">{{ $brand->name }}</span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                        <span class="text-sm text-gray-400 dark:text-gray-500 font-medium">{{ $brand->name }}</span>
                                    </div>
                                @endif
                                <!-- Hover Overlay -->
                                <div class="category-overlay">
                                    <div class="category-overlay-content">
                                        <p class="text-white text-xs sm:text-sm font-semibold mb-1.5 line-clamp-2">{{ $brand->featured_product ? Str::limit($brand->featured_product->name, 30) : $brand->name }}</p>
                                        @if($brand->featured_product)
                                            <p class="text-white text-xs mb-2 font-medium">€{{ number_format($brand->featured_product->price, 2, ',', '.') }}</p>
                                        @endif
                                        <span class="inline-block bg-white text-gray-800 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md">
                                            Bekijk
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Brand Name -->
                            <div class="p-3 flex-grow flex items-center justify-center min-h-[60px]">
                                <p class="text-center font-bold text-gray-800 dark:text-gray-200 group-hover:text-light-blue-dark transition-colors text-xs sm:text-sm md:text-base line-clamp-2">{{ $brand->name }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
                
                @foreach($categoriesWithProducts as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="flex-shrink-0 w-36 sm:w-40 md:w-44 group scroll-reveal category-brand-card" style="display: inline-block; visibility: visible; opacity: 1;">
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden product-card border border-gray-200 dark:border-gray-700 relative shadow-sm hover:shadow-lg transition-shadow" style="height: 220px; min-width: 144px; display: flex; flex-direction: column;">
                            <!-- Product Image -->
                            <div class="relative h-36 sm:h-40 bg-gray-50 dark:bg-gray-700 overflow-hidden flex items-center justify-center category-image-container">
                                @php
                                    $categoryImageUrl = $category->featured_product ? $category->featured_product->getProductImageUrl() : null;
                                @endphp
                                @if($categoryImageUrl)
                                    <img src="{{ $categoryImageUrl }}" 
                                         alt="{{ $category->featured_product->name }}" 
                                         class="w-full h-full object-contain p-3 category-image"
                                         loading="lazy"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700" style="display: none;">
                                        <span class="text-sm text-gray-400 dark:text-gray-500 font-medium">{{ $category->name }}</span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                        <span class="text-sm text-gray-400 dark:text-gray-500 font-medium">{{ $category->name }}</span>
                                    </div>
                                @endif
                                <!-- Hover Overlay -->
                                <div class="category-overlay">
                                    <div class="category-overlay-content">
                                        <p class="text-white text-xs sm:text-sm font-semibold mb-1.5 line-clamp-2">{{ $category->featured_product ? Str::limit($category->featured_product->name, 30) : $category->name }}</p>
                                        @if($category->featured_product)
                                            <p class="text-white text-xs mb-2 font-medium">€{{ number_format($category->featured_product->price, 2, ',', '.') }}</p>
                                        @endif
                                        <span class="inline-block bg-white text-gray-800 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md">
                                            Bekijk
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Category Name -->
                            <div class="p-3 flex-grow flex items-center justify-center min-h-[60px]">
                                <p class="text-center font-bold text-gray-800 dark:text-gray-200 group-hover:text-light-blue-dark transition-colors text-xs sm:text-sm md:text-base line-clamp-2">
                                    @if($category->name === 'Aangepaste Hoesjes') Aangepast
                                    @elseif($category->name === 'Manga Editie & Meer') Manga
                                    @else {{ $category->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
            <button onclick="scrollCategories('right')" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-20 bg-white dark:bg-gray-800 rounded-full p-3 shadow-xl hover:shadow-2xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border-2 border-light-blue-dark dark:border-light-blue group" aria-label="Scroll rechts">
                <svg class="w-6 h-6 md:w-7 md:h-7 text-light-blue-dark dark:text-light-blue group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

        <!-- Featured Products -->
        <section class="mb-16">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 scroll-reveal mb-6">Populaire Producten</h2>
                <a href="{{ route('products.index', ['category' => 'hoesjes']) }}" class="inline-block hero-cta-button px-8 py-4 rounded-xl font-semibold cta-button shadow-lg hover:shadow-2xl transition-all duration-300">
                    Bekijk alle hoesjes →
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full" x-data="scrollReveal()">
                @forelse($featuredProducts as $product)
                    @php
                        $isLiked = auth()->check() && $product->likes()->where('user_id', auth()->id())->exists();
                    @endphp
                    <a href="{{ route('products.show', $product) }}" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden product-card flex flex-col h-full w-full scroll-reveal group">
                        <!-- Image Container -->
                        <div class="relative bg-gray-50 dark:bg-gray-700 h-[220px] flex items-center justify-center overflow-hidden w-full product-card-image-container">
                            @php
                                $imageUrl = $product->getProductImageUrl();
                            @endphp
                            @if($imageUrl)
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $product->name }}" 
                                     class="object-contain max-w-full max-h-[220px] p-4 product-card-image" 
                                     loading="lazy"
                                     onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700" style="display: none;">
                                    <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                    <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                                </div>
                            @endif
                            <!-- Favorite Icon -->
                            @auth
                                <button type="button"
                                        class="like-button absolute top-3 right-3 p-2.5 rounded-full bg-white dark:bg-gray-800 shadow-lg z-10 {{ $isLiked ? 'liked' : '' }}" 
                                        data-id="{{ $product->id }}" 
                                        data-type="Product"
                                        aria-label="Like product">
                                    <svg class="w-5 h-5 {{ $isLiked ? 'text-red-500' : 'text-gray-400 dark:text-gray-500' }}" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            @endauth
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="mb-3 flex-grow flex items-center justify-center">
                                <p class="text-lg font-bold text-gray-800 dark:text-gray-200 text-center">{{ $product->brand->name }}</p>
                            </div>
                            <div class="flex items-center justify-center mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                <span class="text-sm text-light-blue-dark font-semibold transition-colors">
                                    Bekijk →
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-gray-500 dark:text-gray-400 text-center py-12">Geen producten beschikbaar.</p>
                @endforelse
            </div>
        </section>

        <!-- Latest News -->
        <section id="home-news-section" class="mb-16">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 scroll-reveal mb-6">Laatste Nieuws</h2>
                <a href="{{ route('news.index') }}" class="inline-block hero-cta-button px-8 py-4 rounded-xl font-semibold cta-button shadow-lg hover:shadow-2xl transition-all duration-300">
                    Bekijk alle nieuws →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="scrollReveal()" x-init="init()">
                @forelse($latestNews as $index => $newsItem)
                    <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden product-card border border-gray-200 dark:border-gray-700 scroll-reveal group news-article-card" style="visibility: visible !important; display: block !important; opacity: 1 !important;">
                        <div class="relative overflow-hidden h-48">
                            @if($newsItem->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($newsItem->image))
                                <img src="{{ asset('storage/' . $newsItem->image) }}" 
                                     alt="{{ $newsItem->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $newsItem->published_at->format('d M Y') }}</p>
                            <h3 class="text-xl font-semibold mb-3 text-gray-800 dark:text-gray-200 group-hover:text-light-blue-dark transition-colors line-clamp-2">{{ $newsItem->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ Str::limit($newsItem->content, 100) }}</p>
                            <a href="{{ route('news.show', $newsItem) }}" class="cta-button text-light-blue-dark hover:text-light-blue-hover font-medium inline-flex items-center gap-2">
                                Lees meer
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-3 text-gray-500 dark:text-gray-400 text-center py-12">Geen nieuws beschikbaar.</p>
                @endforelse
            </div>
        </section>

        <!-- CTA Section - Aangepaste Hoesjes -->
        <section class="mb-16">
            @php
                $customCasesCategory = \App\Models\Category::where('name', 'Aangepaste Hoesjes')->first();
            @endphp
            @if($customCasesCategory)
                <div class="bg-gradient-to-br from-[#2563EB] to-[#1d4ed8] dark:from-[#1e3a8a] dark:to-[#1e40af] rounded-xl overflow-hidden relative min-h-[300px] md:min-h-[350px] flex items-center category-banner scroll-reveal shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                    <div class="relative z-10 p-8 md:p-12 text-white w-full text-center">
                        <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 transition-transform">Aangepaste Hoesjes</h3>
                        <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">Personaliseer je telefoon met onze premium hoesjes. Unieke designs en perfecte bescherming in één.</p>
                        <a href="{{ route('products.index', ['category' => $customCasesCategory->id]) }}" class="inline-block bg-white text-[#2563EB] px-8 py-4 rounded-xl font-semibold cta-button shadow-lg hover:shadow-2xl hover:scale-105 transition-all hover:bg-gray-50">
                            Ontdek Collectie
                        </a>
                    </div>
                </div>
            @endif
        </section>
    </div>
</div>

<script>
function scrollCategories(direction) {
    const container = document.getElementById('categories-scroll');
    const scrollAmount = 300;
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

// Like functionality is handled in app.js via event listeners
</script>
@endsection



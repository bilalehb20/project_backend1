@extends('layouts.public')

@section('title', 'Products - PhoneShop')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Products</h1>

        <!-- Filters -->
        <div class="bg-gray-100 rounded-lg p-6 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op productnaam..." class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent">
                        <option value="">Alle categorieën</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                    <select name="brand" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-light-blue focus:border-transparent">
                        <option value="">Alle merken</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="px-6 py-2.5 light-blue-dark-bg text-white rounded-lg hover:bg-light-blue-hover cta-button font-semibold shadow-md">
                        FILTER
                    </button>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full" x-data="scrollReveal()">
            @forelse($products as $product)
                @php
                    $isLiked = auth()->check() && $product->likes()->where('user_id', auth()->id())->exists();
                @endphp
                <a href="{{ route('products.show', $product) }}" class="bg-white rounded-xl border border-gray-200 overflow-hidden product-card flex flex-col h-full w-full scroll-reveal group">
                    <!-- Image Container -->
                    <div class="relative bg-gray-50 h-[220px] flex items-center justify-center overflow-hidden w-full product-card-image-container">
                        @if($product->image && Storage::disk('public')->exists($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" 
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
                        <!-- Hover Overlay -->
                        <div class="product-card-overlay">
                            <div class="product-card-overlay-content">
                                <div class="text-white">
                                    <p class="text-2xl font-bold mb-2">€{{ number_format($product->price, 2, ',', '.') }}</p>
                                    <p class="text-sm mb-4 opacity-90">{{ Str::limit($product->description, 80) }}</p>
                                    <span class="inline-block bg-white text-gray-800 px-4 py-2 rounded-lg font-semibold text-sm">
                                        Bekijk Details →
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5 flex flex-col flex-grow">
                        <!-- Product Name and Brand -->
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-800 mb-1.5 line-clamp-2 min-h-[3rem] product-card-title">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 font-medium">{{ $product->brand->name }}</p>
                        </div>
                        
                        <!-- Category Tag -->
                        <div class="mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full light-blue-bg">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-5 line-clamp-2 flex-grow leading-relaxed">{{ Str::limit($product->description, 70) }}</p>
                        
                        <!-- Price and CTA -->
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <span class="text-xl font-bold product-card-price text-light-blue-dark">€{{ number_format($product->price, 2, ',', '.') }}</span>
                            <span class="text-sm text-light-blue-dark font-semibold group-hover:text-light-blue-hover transition-colors">
                                Details →
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Geen producten gevonden.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>

<script>
// Scroll Reveal functionality
function scrollReveal() {
    return {
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.querySelectorAll('.scroll-reveal').forEach(el => {
                    el.classList.add('revealed');
                });
                return;
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });
        }
    }
}

// Initialize scroll reveal on page load
document.addEventListener('DOMContentLoaded', () => {
    if (typeof Alpine !== 'undefined') {
        // Alpine will handle it
        return;
    }
    
    // Fallback if Alpine not available
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('.scroll-reveal').forEach(el => {
            el.classList.add('revealed');
        });
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.scroll-reveal').forEach(el => {
        observer.observe(el);
    });
});

// Like functionality is handled in app.js via event listeners
</script>
@endsection



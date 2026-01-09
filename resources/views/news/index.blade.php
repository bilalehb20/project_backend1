@extends('layouts.public')

@section('title', 'Nieuws - Telefoon Webshop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-gray-800 dark:text-gray-200">Laatste Nieuws</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="scrollReveal()">
        @forelse($news as $newsItem)
            <a href="{{ route('news.show', $newsItem) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden product-card scroll-reveal group block border border-gray-200 dark:border-gray-700">
                <div class="relative w-full h-48 overflow-hidden bg-gray-200 dark:bg-gray-700">
                    @if($newsItem->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($newsItem->image))
                        <img src="{{ asset('storage/' . $newsItem->image) }}" 
                             alt="{{ $newsItem->title }}" 
                             class="news-image w-full h-full object-cover"
                             loading="lazy"
                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-gray-200 dark:bg-gray-700 flex items-center justify-center" style="display: none;">
                            <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-gray-400 dark:text-gray-500 text-6xl">📱</span>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $newsItem->published_at->format('d M Y') }}</p>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800 dark:text-gray-200 group-hover:text-light-blue-dark transition-colors">{{ $newsItem->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">{{ Str::limit($newsItem->content, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="cta-button font-medium text-light-blue-dark hover:text-light-blue-hover inline-block">Lees meer →</span>
                        @auth
                            @php
                                $isLiked = auth()->check() && $newsItem->likes()->where('user_id', auth()->id())->exists();
                            @endphp
                            <button class="like-button flex items-center space-x-1 text-gray-500 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors {{ $isLiked ? 'text-red-500 dark:text-red-400' : '' }}"
                                    data-id="{{ $newsItem->id }}" 
                                    data-type="News">
                                <svg class="w-5 h-5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span id="likes-count-{{ $newsItem->id }}">{{ $newsItem->likes_count }} likes</span>
                            </button>
                        @else
                            <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $newsItem->likes_count }} likes</span>
                        @endauth
                    </div>
                </div>
            </a>
        @empty
            <p class="col-span-3 text-gray-500 dark:text-gray-400 text-center py-12">Geen nieuws beschikbaar.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>

<script>
// Scroll Reveal functionality (if Alpine not available)
if (typeof Alpine === 'undefined') {
    document.addEventListener('DOMContentLoaded', () => {
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
}
</script>
@endsection



@extends('layouts.public')

@section('title', $news->title . ' - Telefoon Webshop')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="relative w-full h-64 md:h-96 overflow-hidden bg-gray-200 dark:bg-gray-700">
            @if($news->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($news->image))
                <img src="{{ asset('storage/' . $news->image) }}" 
                     alt="{{ $news->title }}" 
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
        <div class="p-6 md:p-8">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $news->published_at->format('d M Y') }}</p>
            <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800 dark:text-gray-200">{{ $news->title }}</h1>
            
            <div class="flex items-center space-x-4 mb-6">
                @auth
                    <button id="like-button-news-{{ $news->id }}" 
                            class="like-button flex items-center space-x-2 px-4 py-2 rounded-lg {{ $isLiked ? 'bg-red-500 dark:bg-red-600' : 'bg-gray-200 dark:bg-gray-700' }} text-white hover:opacity-90 transition-all duration-200 hover:scale-105 active:scale-95"
                            data-id="{{ $news->id }}" 
                            data-type="News">
                        <svg id="like-icon-news-{{ $news->id }}" class="w-5 h-5 {{ $isLiked ? 'text-white' : 'text-gray-600 dark:text-gray-300' }}" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>{{ $isLiked ? 'Geliked' : 'Like' }}</span>
                        <span id="likes-count-{{ $news->id }}">{{ $news->likes_count }} likes</span>
                    </button>
                @else
                    <span class="text-gray-600 dark:text-gray-400">{{ $news->likes_count }} likes</span>
                @endauth
            </div>

            <div class="prose max-w-none mb-8">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $news->content }}</p>
            </div>

            <!-- Comments Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Reacties</h2>
                
                @auth
                    <form method="POST" action="{{ route('news.comments.store', $news) }}" class="mb-6">
                        @csrf
                        <textarea name="content" rows="3" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 mb-2 focus:border-light-blue-dark focus:ring-light-blue-dark" placeholder="Schrijf een reactie..."></textarea>
                        <button type="submit" class="px-4 py-2 light-blue-bg text-white rounded-md hover:bg-light-blue-hover transition-colors">Reactie plaatsen</button>
                    </form>
                @else
                    <p class="text-gray-600 dark:text-gray-400 mb-4"><a href="{{ route('login') }}" class="text-light-blue-dark hover:text-light-blue-hover hover:underline">Log in</a> om te reageren.</p>
                @endauth

                <div class="space-y-4">
                    @forelse($news->comments as $comment)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Nog geen reacties.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </article>
</div>
{{-- Like functionality handled by event delegation in resources/js/app.js --}}
@endsection



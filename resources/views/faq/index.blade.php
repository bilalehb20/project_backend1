@extends('layouts.public')

@section('title', 'Veelgestelde Vragen - PhoneShop')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold mb-4">Veelgestelde Vragen</h1>
    <p class="text-gray-600 mb-8">Hieronder vindt u de meest gestelde vragen. Klik op een vraag om het antwoord te zien.</p>

    <div class="space-y-8" x-data="scrollReveal()">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md p-6 scroll-reveal">
                <h2 class="text-2xl font-semibold mb-4 text-light-blue-dark">{{ $category->name }}</h2>
                <div class="space-y-4">
                    @foreach($category->questions as $question)
                        <div x-data="{ open: false }" class="border-b pb-4 last:border-b-0">
                            <button @click="open = !open" class="w-full text-left flex items-center justify-between py-2 hover:text-light-blue-dark transition">
                                <h3 class="text-lg font-semibold">{{ $question->question }}</h3>
                                <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="mt-2 text-gray-700"
                                 style="display: none;">
                                {{ $question->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



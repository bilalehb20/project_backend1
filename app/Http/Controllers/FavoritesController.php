<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display the user's favorites (liked items).
     * Redirects to home if user has no favorites.
     */
    public function index(Request $request)
    {
        // Check if user has any likes
        $likesCount = auth()->user()->likes()->count();
        
        if ($likesCount === 0) {
            // No favorites - redirect to home
            return redirect()->route('home')->with('info', 'Je hebt nog geen favorieten. Begin met het liken van producten of nieuws items!');
        }
        
        // Get all liked items for the authenticated user
        $likedProducts = Like::where('user_id', auth()->id())
            ->where('likeable_type', \App\Models\Product::class)
            ->with('likeable.brand', 'likeable.category')
            ->get()
            ->map(function($like) {
                return [
                    'like_id' => $like->id,
                    'item' => $like->likeable,
                    'type' => 'product'
                ];
            })
            ->filter(fn($item) => $item['item'] !== null);
        
        $likedNews = Like::where('user_id', auth()->id())
            ->where('likeable_type', \App\Models\News::class)
            ->with('likeable')
            ->get()
            ->map(function($like) {
                return [
                    'like_id' => $like->id,
                    'item' => $like->likeable,
                    'type' => 'news'
                ];
            })
            ->filter(fn($item) => $item['item'] !== null);
        
        // Merge and sort by creation date (newest first)
        $allFavorites = $likedProducts->concat($likedNews)
            ->sortByDesc(fn($item) => $item['item']->created_at ?? now())
            ->values();

        return view('favorites.index', compact('allFavorites'));
    }
}


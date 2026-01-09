<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Middleware is already applied in routes/web.php
    // Route::middleware('auth')->group(function () { ... })
    
    public function toggle(Request $request)
    {
        try {
            // STAP 2: Check authentication
            if (!auth()->check()) {
                return response()->json([
                    'error' => 'Unauthenticated'
                ], 401);
            }

            $request->validate([
                'likeable_type' => 'required|string',
                'likeable_id' => 'required|integer',
            ]);

            // STAP 3: Fix polymorphic type mapping
            $typeMap = [
                'Product' => \App\Models\Product::class,
                'News' => \App\Models\News::class,
            ];

            $requestedType = $request->likeable_type;
            $modelClass = $typeMap[$requestedType] ?? null;

            if (!$modelClass) {
                return response()->json([
                    'error' => 'Invalid likeable type. Allowed: Product, News'
                ], 400);
            }

            // Find the likeable model
            $likeable = $modelClass::find($request->likeable_id);

            if (!$likeable) {
                return response()->json([
                    'error' => ucfirst($requestedType) . ' not found'
                ], 404);
            }

            // STAP 4: Volledige correcte toggle-logic
            // Gebruik ALTIJD volledige class naam (App\Models\Product::class)
            $existingLike = Like::where([
                'user_id' => auth()->id(),
                'likeable_id' => $likeable->id,
                'likeable_type' => $modelClass, // Volledige class naam, NIET string "Product"
            ])->first();

            if ($existingLike) {
                $existingLike->delete();
                $liked = false;
            } else {
                Like::create([
                    'user_id' => auth()->id(), // Wordt nooit null omdat we auth()->check() hebben gedaan
                    'likeable_id' => $likeable->id,
                    'likeable_type' => $modelClass, // Volledige class naam
                ]);
                $liked = true;
            }

            // Refresh the likeable model to get updated count
            $likeable->refresh();
            $likesCount = $likeable->likes()->count();
            
            // STAP 2: Return total likes count for current user (for navbar update)
            $userLikesCount = auth()->user()->likes()->count();

            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount, // Count for this specific item
                'user_likes_count' => $userLikesCount, // Total likes count for current user (for navbar)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Like toggle error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'error' => 'An error occurred while toggling like',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $validated = $request->validated();
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Store new photo
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        } else {
            // Don't overwrite existing photo if no new one uploaded
            unset($validated['profile_photo']);
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Display public profile.
     */
    public function show(User $user): View
    {
        $user->load(['likes.likeable']);
        
        // Get all liked products
        $likedProducts = $user->likes()
            ->where('likeable_type', 'App\\Models\\Product')
            ->with('likeable')
            ->get()
            ->map(function($like) {
                return [
                    'like_id' => $like->id,
                    'item' => $like->likeable,
                    'type' => 'product'
                ];
            })
            ->filter(fn($item) => $item['item'] !== null);
        
        // Get all liked news items
        $likedNews = $user->likes()
            ->where('likeable_type', 'App\\Models\\News')
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
        
        // Merge and sort by creation date
        $allLikes = $likedProducts->concat($likedNews)
            ->sortByDesc(fn($item) => $item['item']->created_at ?? now())
            ->values();
        
        // Keep for backward compatibility
        $favoriteProducts = $likedProducts->pluck('item')->filter();

        return view('profile.show', compact('user', 'favoriteProducts', 'allLikes'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

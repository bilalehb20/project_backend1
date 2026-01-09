<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'brand_id',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }

    /**
     * Get product image URL based on product name
     * Matches exact product name to find the correct image
     */
    public function getProductImageUrl(): ?string
    {
        // If image exists in storage, use it (priority)
        if ($this->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        // Generate image URL based on product name and category
        // This will use external API to get product-specific images
        return $this->generateImageUrlFromName();
    }
    
    /**
     * Generate image URL from product name using external image service
     * Uses Unsplash Source API (no API key required, but rate limited)
     * For production, consider using Unsplash API with API key for better results
     */
    private function generateImageUrlFromName(): string
    {
        $categoryName = $this->category->name ?? '';
        $productName = $this->name;
        $brandName = $this->brand->name ?? '';

        // Build search query based on category and product name
        $searchQuery = $this->buildImageSearchQuery($productName, $brandName, $categoryName);

        // Use Unsplash Source API (free, no API key needed)
        // Format: https://source.unsplash.com/featured/800x800/?{search-query}
        // This will return a random image matching the search query
        $imageUrl = "https://source.unsplash.com/featured/800x800/?" . urlencode($searchQuery);

        return $imageUrl;
    }

    /**
     * Build search query for image API based on product name and category
     */
    private function buildImageSearchQuery(string $productName, string $brandName, string $categoryName): string
    {
        // For smartphones: use exact model name
        if ($categoryName === 'Smartphones') {
            // Clean product name and use it directly
            // e.g., "iPhone 15 Pro Max" -> "iPhone 15 Pro Max"
            return $productName;
        }

        // For hoesjes (cases): use product name + "phone case"
        if (in_array($categoryName, ['Aangepaste Hoesjes', 'Manga Editie & Meer'])) {
            // Extract phone model from name if possible, or use generic
            if (stripos($productName, 'iPhone') !== false) {
                // Extract iPhone model from name
                preg_match('/iPhone\s+\d+[^\s]*/', $productName, $matches);
                if (!empty($matches[0])) {
                    return $matches[0] . ' phone case';
                }
            }
            return 'phone case';
        }

        // For accessoires: use product name
        if ($categoryName === 'Accessoires') {
            return $productName;
        }

        // Fallback: use product name
        return $productName;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'title',
        'description',
        'property_type',
        'price',
        'deposit',
        'bedrooms',
        'bathrooms',
        'floor_area',
        'floor_number',
        'address',
        'city',
        'latitude',
        'longitude',
        'amenities',
        'status',
        'views_count',
        'is_featured',
        'is_verified',
    ];

    protected $casts = [
        'amenities' => 'array',
        'price' => 'decimal:2',
        'deposit' => 'decimal:2',
        'floor_area' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the landlord who owns this property
     */
    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    /**
     * Get all images for this property
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('sort_order');
    }

    /**
     * Get the primary image
     */
    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    /**
     * Get all saves/favorites for this property
     */
    public function saves(): HasMany
    {
        return $this->hasMany(SavedProperty::class);
    }

    /**
     * Get rentals for this property
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Get view records for this property
     */
    public function views(): HasMany
    {
        return $this->hasMany(PropertyView::class);
    }

    /**
     * Scope for available properties
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope for featured properties
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Check if property is saved by a user
     */
    public function isSavedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->saves()->where('user_id', $user->id)->exists();
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return '₱' . number_format($this->price, 2);
    }
}

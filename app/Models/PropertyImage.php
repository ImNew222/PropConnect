<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the property this image belongs to
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get full URL for the image
     */
    public function getUrlAttribute(): string
    {
        // If image_path is already a full URL, return it
        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }
        
        // Otherwise, generate URL from storage
        return asset('storage/' . $this->image_path);
    }
}

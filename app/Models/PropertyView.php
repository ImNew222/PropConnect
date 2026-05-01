<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'viewer_id',
        'ip_address',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    /**
     * Get the property that was viewed
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the viewer (if logged in)
     */
    public function viewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }

    /**
     * Record a view for a property
     */
    public static function recordView(Property $property, ?User $user = null, ?string $ip = null): self
    {
        $view = static::create([
            'property_id' => $property->id,
            'viewer_id' => $user?->id,
            'ip_address' => $ip,
            'viewed_at' => now(),
        ]);

        // Increment the counter on property
        $property->increment('views_count');

        return $view;
    }
}

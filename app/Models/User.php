<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'whatsapp',
        'facebook',
        'viber',
        'telegram',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Check if user is a landlord
     */
    public function isLandlord(): bool
    {
        return $this->role === 'landlord';
    }

    /**
     * Check if user is a renter
     */
    public function isRenter(): bool
    {
        return $this->role === 'renter';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if landlord is verified
     */
    public function isVerifiedLandlord(): bool
    {
        return $this->isLandlord() && $this->is_verified;
    }

    // ==================== RELATIONSHIPS ====================

    /**
     * Get properties owned by this landlord
     */
    public function properties(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Property::class, 'landlord_id');
    }

    /**
     * Get saved/favorited properties (for tenants)
     */
    public function savedProperties(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SavedProperty::class);
    }

    /**
     * Get rentals as a tenant
     */
    public function rentalsAsTenant(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rental::class, 'tenant_id');
    }

    /**
     * Get rentals as a landlord
     */
    public function rentalsAsLandlord(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rental::class, 'landlord_id');
    }

    /**
     * Get landlord verification documents
     */
    public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LandlordDocument::class);
    }

    /**
     * Check if user has saved a property
     */
    public function hasSaved(Property $property): bool
    {
        return $this->savedProperties()->where('property_id', $property->id)->exists();
    }

    /**
     * Get active rental (for tenant)
     */
    public function activeRental()
    {
        return $this->rentalsAsTenant()->where('status', 'active')->first();
    }
}

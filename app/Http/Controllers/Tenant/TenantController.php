<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\SavedProperty;
use Illuminate\Http\Request;

class TenantController extends Controller
{

    /**
     * Tenant dashboard home
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        $stats = [
            'saved_count' => $user->savedProperties()->count(),
            'active_rentals' => $user->rentalsAsTenant()->where('status', 'active')->count(),
            'past_rentals' => $user->rentalsAsTenant()->where('status', 'completed')->count(),
        ];
        
        // Get recently saved properties (favorites)
        $recentSaved = $user->savedProperties()
            ->with(['property.primaryImage', 'property.landlord'])
            ->latest()
            ->take(4)
            ->get()
            ->pluck('property');
        
        // Get recently viewed properties (last 10)
        $recentViewed = \App\Models\PropertyView::where('viewer_id', $user->id)
            ->with(['property.primaryImage', 'property.landlord'])
            ->orderBy('viewed_at', 'desc')
            ->take(10)
            ->get()
            ->pluck('property')
            ->unique('id')
            ->take(10);
        
        // Get landlords for chat list
        $landlords = \App\Models\User::where('role', 'landlord')
            ->limit(10)
            ->get();
        
        // Get active rental if any
        $activeRental = $user->rentalsAsTenant()
            ->with(['property.primaryImage', 'landlord'])
            ->where('status', 'active')
            ->first();
        
        return view('tenant.dashboard', compact('stats', 'recentSaved', 'recentViewed', 'landlords', 'activeRental'));
    }

    /**
     * Saved/favorited properties
     */
    public function saved()
    {
        $savedProperties = auth()->user()->savedProperties()
            ->with(['property.primaryImage', 'property.landlord'])
            ->latest()
            ->paginate(12);
        
        return view('tenant.saved', compact('savedProperties'));
    }

    /**
     * Save a property to favorites
     */
    public function saveProperty(Property $property)
    {
        $user = auth()->user();
        
        // Check if already saved
        $exists = SavedProperty::where('user_id', $user->id)
            ->where('property_id', $property->id)
            ->exists();
            
        if (!$exists) {
            SavedProperty::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
            ]);
            
            return response()->json(['saved' => true, 'message' => 'Property saved!']);
        }
        
        return response()->json(['saved' => true, 'message' => 'Already saved']);
    }

    /**
     * Remove a property from favorites
     */
    public function unsaveProperty(Property $property)
    {
        SavedProperty::where('user_id', auth()->id())
            ->where('property_id', $property->id)
            ->delete();
            
        return response()->json(['saved' => false, 'message' => 'Property removed from saved']);
    }

    /**
     * Toggle property favorite status
     */
    public function toggleProperty(Property $property)
    {
        $user = auth()->user();
        
        $saved = SavedProperty::where('user_id', $user->id)
            ->where('property_id', $property->id)
            ->first();
            
        if ($saved) {
            $saved->delete();
            return response()->json(['saved' => false, 'message' => 'Removed from favorites']);
        } else {
            SavedProperty::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
            ]);
            return response()->json(['saved' => true, 'message' => 'Added to favorites']);
        }
    }

    /**
     * Rental history
     */
    public function rentals()
    {
        $user = auth()->user();
        
        $activeRentals = $user->rentalsAsTenant()
            ->with(['property.primaryImage', 'landlord'])
            ->where('status', 'active')
            ->get();
            
        $pastRentals = $user->rentalsAsTenant()
            ->with(['property.primaryImage', 'landlord'])
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->paginate(10);
        
        return view('tenant.rentals', compact('activeRentals', 'pastRentals'));
    }
}

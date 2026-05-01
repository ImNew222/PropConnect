<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Ensure user is a landlord
     */
    private function ensureLandlord(): void
    {
        if (!auth()->user()->isLandlord()) {
            abort(403, 'Only landlords can access this area.');
        }
    }

    /**
     * Display a listing of the landlord's properties.
     */
    public function index()
    {
        $this->ensureLandlord();
        
        $properties = auth()->user()->properties()
            ->with(['images', 'primaryImage'])
            ->withCount('views')
            ->latest()
            ->paginate(10);

        return view('landlord.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $this->ensureLandlord();
        return view('landlord.properties.create');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $this->ensureLandlord();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'property_type' => 'required|in:studio,condo,apartment,house,hotel,room',
            'price' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'floor_area' => 'nullable|numeric|min:0',
            'floor_number' => 'nullable|integer',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'amenities' => 'nullable|array',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Handle amenities as JSON
        $validated['amenities'] = $request->amenities ?? [];
        $validated['landlord_id'] = auth()->id();
        $validated['status'] = 'available';

        $property = Property::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('landlord.properties.index')
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified property.
     */
    public function show(Property $property)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);
        
        $property->load(['images', 'rentals.tenant', 'views']);
        
        return view('landlord.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(Property $property)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);
        
        $property->load('images');
        
        return view('landlord.properties.edit', compact('property'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'property_type' => 'required|in:studio,condo,apartment,house,hotel,room',
            'price' => 'required|numeric|min:0',
            'deposit' => 'nullable|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'floor_area' => 'nullable|numeric|min:0',
            'floor_number' => 'nullable|integer',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'amenities' => 'nullable|array',
            'status' => 'required|in:available,rented,pending,inactive',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['amenities'] = $request->amenities ?? [];

        $property->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $existingCount = $property->images()->count();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'is_primary' => $existingCount === 0 && $index === 0,
                    'sort_order' => $existingCount + $index,
                ]);
            }
        }

        return redirect()
            ->route('landlord.properties.index')
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);

        // Delete associated images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();

        return redirect()
            ->route('landlord.properties.index')
            ->with('success', 'Property deleted successfully!');
    }

    /**
     * Delete a specific image from a property
     */
    public function deleteImage(Property $property, PropertyImage $image)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);

        if ($image->property_id !== $property->id) {
            abort(403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    /**
     * Set an image as primary
     */
    public function setPrimaryImage(Property $property, PropertyImage $image)
    {
        $this->ensureLandlord();
        $this->authorizeProperty($property);

        if ($image->property_id !== $property->id) {
            abort(403);
        }

        // Remove primary from all other images
        $property->images()->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image updated!');
    }

    /**
     * Ensure the landlord owns this property
     */
    private function authorizeProperty(Property $property): void
    {
        if ($property->landlord_id !== auth()->id()) {
            abort(403, 'You do not own this property.');
        }
    }
}

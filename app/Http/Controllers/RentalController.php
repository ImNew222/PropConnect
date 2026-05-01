<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyView;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display the rental listing page
     */
    public function index(Request $request)
    {
        return view('rental');
    }

    /**
     * API: Get properties with filtering
     */
    public function properties(Request $request)
    {
        $query = Property::with(['images', 'landlord'])
            ->where('status', 'available');

        // Filter by property type (supports multiple comma-separated types)
        if ($request->filled('type') && $request->type !== 'all') {
            $types = is_array($request->type) ? $request->type : explode(',', $request->type);
            // Case-insensitive filtering
            $types = array_map(function($t) { return strtolower(trim($t)); }, $types);
            $query->where(function($q) use ($types) {
                foreach ($types as $type) {
                    $q->orWhereRaw('LOWER(property_type) = ?', [$type]);
                }
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms') && $request->bedrooms !== 'any') {
            if ($request->bedrooms === '4+') {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }

        // Filter by bathrooms
        if ($request->filled('bathrooms') && $request->bathrooms !== 'any') {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Search by title or address (case-insensitive)
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(address) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(property_type) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter by amenities
        if ($request->filled('amenities')) {
            $amenities = is_array($request->amenities) ? $request->amenities : explode(',', $request->amenities);
            foreach ($amenities as $amenity) {
                $query->whereJsonContains('amenities', trim($amenity));
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $properties = $query->paginate($request->get('per_page', 12));

        // Transform for JSON response
        $data = $properties->map(function($property) {
            return [
                'id' => $property->id,
                'title' => $property->title,
                'description' => $property->description,
                'property_type' => $property->property_type,
                'price' => $property->price,
                'formatted_price' => $property->formatted_price,
                'bedrooms' => $property->bedrooms,
                'bathrooms' => $property->bathrooms,
                'floor_area' => $property->floor_area,
                'address' => $property->address,
                'city' => $property->city,
                'latitude' => $property->latitude,
                'longitude' => $property->longitude,
                'amenities' => $property->amenities ?? [],
                'is_featured' => $property->is_featured,
                'is_verified' => $property->is_verified,
                'views_count' => $property->views_count,
                'image' => $property->primaryImage 
                    ? $property->primaryImage->url 
                    : null,
                'landlord' => [
                    'name' => $property->landlord->name,
                    'phone' => $property->landlord->phone,
                    'verified' => $property->landlord->is_verified,
                ],
                'images' => $property->images->take(5)->map(fn($img) => $img->url)->values(),
                'is_saved' => auth()->check() ? $property->isSavedBy(auth()->user()) : false,
            ];
        });

        return response()->json([
            'properties' => $data,
            'pagination' => [
                'total' => $properties->total(),
                'per_page' => $properties->perPage(),
                'current_page' => $properties->currentPage(),
                'last_page' => $properties->lastPage(),
                'has_more' => $properties->hasMorePages(),
            ],
        ]);
    }

    /**
     * API: Get single property details
     */
    public function show(Property $property)
    {
        // Record view
        PropertyView::recordView(
            $property, 
            auth()->user(), 
            request()->ip()
        );

        $property->load(['images', 'landlord']);

        return response()->json([
            'id' => $property->id,
            'title' => $property->title,
            'description' => $property->description,
            'property_type' => $property->property_type,
            'price' => $property->price,
            'formatted_price' => $property->formatted_price,
            'deposit' => $property->deposit,
            'bedrooms' => $property->bedrooms,
            'bathrooms' => $property->bathrooms,
            'floor_area' => $property->floor_area,
            'floor_number' => $property->floor_number,
            'address' => $property->address,
            'city' => $property->city,
            'latitude' => $property->latitude,
            'longitude' => $property->longitude,
            'amenities' => $property->amenities ?? [],
            'status' => $property->status,
            'is_featured' => $property->is_featured,
            'is_verified' => $property->is_verified,
            'views_count' => $property->views_count,
            'images' => $property->images->map(fn($img) => [
                'url' => $img->url,
                'is_primary' => $img->is_primary,
            ]),
            'landlord' => [
                'id' => $property->landlord->id,
                'name' => $property->landlord->name,
                'phone' => $property->landlord->phone,
                'verified' => $property->landlord->is_verified,
            ],
            'is_saved' => auth()->check() ? $property->isSavedBy(auth()->user()) : false,
        ]);
    }

    /**
     * API: Get properties for map view
     */
    public function mapData(Request $request)
    {
        $properties = Property::select('id', 'title', 'price', 'latitude', 'longitude', 'property_type', 'bedrooms')
            ->where('status', 'available')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $properties->map(fn($p) => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$p->longitude, (float)$p->latitude],
                ],
                'properties' => [
                    'id' => $p->id,
                    'title' => $p->title,
                    'price' => $p->price,
                    'type' => $p->property_type,
                    'bedrooms' => $p->bedrooms,
                ],
            ]),
        ]);
    }
}

@extends('layouts.dashboard')

@section('title', 'Edit Property')

@section('content')
<div class="page-header">
    <div class="header-content">
        <a href="{{ route('landlord.properties.index') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            Back to Properties
        </a>
        <h1>Edit Property</h1>
    </div>
</div>

@if($errors->any())
<div class="alert alert-error">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('landlord.properties.update', $property) }}" method="POST" enctype="multipart/form-data" class="property-form">
    @csrf
    @method('PUT')
    
    <div class="form-grid">
        <!-- Basic Information -->
        <div class="form-section">
            <h2 class="section-title">Basic Information</h2>
            
            <div class="form-group">
                <label for="title">Property Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $property->title) }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $property->description) }}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="property_type">Property Type *</label>
                    <select id="property_type" name="property_type" required>
                        @foreach(['studio', 'apartment', 'condo', 'house', 'room', 'hotel'] as $type)
                            <option value="{{ $type }}" {{ old('property_type', $property->property_type) == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        @foreach(['available', 'rented', 'pending', 'inactive'] as $status)
                            <option value="{{ $status }}" {{ old('status', $property->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Pricing -->
        <div class="form-section">
            <h2 class="section-title">Pricing</h2>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Monthly Rent (₱) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $property->price) }}" 
                           required min="0" step="0.01">
                </div>
                
                <div class="form-group">
                    <label for="deposit">Security Deposit (₱)</label>
                    <input type="number" id="deposit" name="deposit" value="{{ old('deposit', $property->deposit) }}" 
                           min="0" step="0.01">
                </div>
            </div>
        </div>
        
        <!-- Specifications -->
        <div class="form-section">
            <h2 class="section-title">Specifications</h2>
            
            <div class="form-row three-col">
                <div class="form-group">
                    <label for="bedrooms">Bedrooms *</label>
                    <input type="number" id="bedrooms" name="bedrooms" 
                           value="{{ old('bedrooms', $property->bedrooms) }}" required min="0">
                </div>
                
                <div class="form-group">
                    <label for="bathrooms">Bathrooms *</label>
                    <input type="number" id="bathrooms" name="bathrooms" 
                           value="{{ old('bathrooms', $property->bathrooms) }}" required min="0">
                </div>
                
                <div class="form-group">
                    <label for="floor_area">Floor Area (m²)</label>
                    <input type="number" id="floor_area" name="floor_area" 
                           value="{{ old('floor_area', $property->floor_area) }}" min="0" step="0.01">
                </div>
            </div>
            
            <div class="form-group">
                <label for="floor_number">Floor Number</label>
                <input type="number" id="floor_number" name="floor_number" 
                       value="{{ old('floor_number', $property->floor_number) }}" min="0">
            </div>
        </div>
        
        <!-- Location -->
        <div class="form-section">
            <h2 class="section-title">Location</h2>
            
            <div class="form-group">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" value="{{ old('address', $property->address) }}" required>
            </div>
            
            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" value="{{ old('city', $property->city) }}" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $property->latitude) }}">
                </div>
                
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $property->longitude) }}">
                </div>
            </div>
        </div>
        
        <!-- Amenities -->
        <div class="form-section full-width">
            <h2 class="section-title">Amenities</h2>
            
            <div class="amenities-grid">
                @php
                    $amenitiesList = [
                        'wifi' => 'WiFi',
                        'parking' => 'Parking',
                        'aircon' => 'Air Conditioning',
                        'kitchen' => 'Kitchen',
                        'washer' => 'Washer',
                        'dryer' => 'Dryer',
                        'tv' => 'TV',
                        'pool' => 'Swimming Pool',
                        'gym' => 'Gym',
                        'security' => '24/7 Security',
                        'elevator' => 'Elevator',
                        'balcony' => 'Balcony',
                        'pet_friendly' => 'Pet Friendly',
                        'furnished' => 'Fully Furnished',
                    ];
                    $currentAmenities = old('amenities', $property->amenities ?? []);
                @endphp
                
                @foreach($amenitiesList as $key => $label)
                <label class="amenity-checkbox">
                    <input type="checkbox" name="amenities[]" value="{{ $key }}" 
                           {{ in_array($key, $currentAmenities) ? 'checked' : '' }}>
                    <span class="checkbox-custom"></span>
                    <span>{{ $label }}</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <!-- Existing Images -->
        @if($property->images->count() > 0)
        <div class="form-section full-width">
            <h2 class="section-title">Current Images</h2>
            
            <div class="existing-images">
                @foreach($property->images as $image)
                <div class="existing-image {{ $image->is_primary ? 'is-primary' : '' }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property image">
                    <div class="image-overlay">
                        @if(!$image->is_primary)
                        <form action="{{ route('landlord.properties.set-primary-image', [$property, $image]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-set-primary" title="Set as primary">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('landlord.properties.delete-image', [$property, $image]) }}" method="POST"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-image" title="Delete image">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @if($image->is_primary)
                        <span class="primary-badge">Primary</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Upload New Images -->
        <div class="form-section full-width">
            <h2 class="section-title">Add More Images</h2>
            
            <div class="image-upload-area" id="imageUploadArea">
                <input type="file" id="images" name="images[]" multiple accept="image/*" class="file-input">
                <div class="upload-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span>Click to upload or drag and drop</span>
                    <small>JPEG, PNG, WEBP up to 5MB each</small>
                </div>
                <div id="imagePreview" class="image-preview"></div>
            </div>
        </div>
    </div>
    
    <div class="form-actions">
        <a href="{{ route('landlord.properties.index') }}" class="btn-secondary">Cancel</a>
        <button type="submit" class="btn-primary">Update Property</button>
    </div>
</form>

<style>
/* Light Theme Styles for Edit Property */
.page-header { margin-bottom: 2rem; }
.back-link { display: inline-flex; align-items: center; gap: 0.25rem; color: #6b7280; text-decoration: none; font-size: 0.875rem; margin-bottom: 0.5rem; }
.back-link:hover { color: #1a1a2e; }
.back-link svg { width: 16px; height: 16px; }
.page-header h1 { font-size: 1.75rem; font-weight: 600; color: #1a1a2e; margin: 0; }

.alert { padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; }
.alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }
.alert-error ul { margin: 0; padding-left: 1.25rem; }
.alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #059669; }

.property-form { background: #ffffff; border-radius: 12px; border: 1px solid #e5e7eb; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04); }
.form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
.form-section { background: #f9fafb; border-radius: 10px; padding: 1.25rem; border: 1px solid #f0f0f0; }
.form-section.full-width { grid-column: 1 / -1; }
.section-title { font-size: 1rem; font-weight: 600; color: #1a1a2e; margin: 0 0 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb; }

.form-group { margin-bottom: 1rem; }
.form-group:last-child { margin-bottom: 0; }
.form-group label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem; }
.form-group input, .form-group select, .form-group textarea { width: 100%; padding: 0.75rem 1rem; background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; color: #1a1a2e; font-size: 0.9375rem; transition: border-color 0.2s, box-shadow 0.2s; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }
.form-group input::placeholder, .form-group textarea::placeholder { color: #9ca3af; }

.form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.form-row.three-col { grid-template-columns: repeat(3, 1fr); }

.amenities-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 0.75rem; }
.amenity-checkbox { display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; cursor: pointer; font-size: 0.875rem; color: #374151; transition: border-color 0.2s, background 0.2s; }
.amenity-checkbox:hover { border-color: #6366f1; background: #f5f3ff; }
.amenity-checkbox input { position: absolute; opacity: 0; }
.checkbox-custom { width: 18px; height: 18px; border: 2px solid #d1d5db; border-radius: 4px; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
.amenity-checkbox input:checked + .checkbox-custom { background: #6366f1; border-color: #6366f1; }
.amenity-checkbox input:checked + .checkbox-custom::after { content: ''; width: 5px; height: 10px; border: solid white; border-width: 0 2px 2px 0; transform: rotate(45deg); margin-top: -2px; }
.amenity-checkbox input:checked ~ span:last-child { color: #1a1a2e; font-weight: 500; }

.existing-images { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; }
.existing-image { position: relative; aspect-ratio: 1; border-radius: 10px; overflow: hidden; border: 2px solid transparent; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); }
.existing-image.is-primary { border-color: #6366f1; }
.existing-image img { width: 100%; height: 100%; object-fit: cover; }
.image-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; gap: 0.5rem; opacity: 0; transition: opacity 0.2s; }
.existing-image:hover .image-overlay { opacity: 1; }
.image-overlay button { width: 36px; height: 36px; border-radius: 50%; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.image-overlay svg { width: 18px; height: 18px; }
.btn-set-primary { background: #6366f1; color: white; }
.btn-delete-image { background: #ef4444; color: white; }
.primary-badge { position: absolute; bottom: 8px; left: 8px; background: #6366f1; color: white; font-size: 11px; padding: 2px 8px; border-radius: 4px; font-weight: 500; }

.image-upload-area { position: relative; border: 2px dashed #d1d5db; border-radius: 10px; padding: 2rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.2s; }
.image-upload-area:hover { border-color: #6366f1; background: #f5f3ff; }
.file-input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
.upload-placeholder svg { width: 48px; height: 48px; color: #9ca3af; margin-bottom: 0.75rem; }
.upload-placeholder span { display: block; color: #374151; margin-bottom: 0.25rem; }
.upload-placeholder small { color: #9ca3af; }
.image-preview { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1rem; }

.form-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; }
.btn-secondary { padding: 0.75rem 1.5rem; background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; font-size: 0.9375rem; font-weight: 500; cursor: pointer; text-decoration: none; transition: all 0.2s; }
.btn-secondary:hover { background: #f9fafb; border-color: #9ca3af; color: #1a1a2e; }
.btn-primary { padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border: none; border-radius: 8px; color: white; font-size: 0.9375rem; font-weight: 500; cursor: pointer; transition: all 0.2s; }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4); }

@media (max-width: 768px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-row, .form-row.three-col { grid-template-columns: 1fr; }
}
</style>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.style.cssText = 'width:100px;height:100px;border-radius:8px;overflow:hidden;';
            div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection

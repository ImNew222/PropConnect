@extends('layouts.dashboard')

@section('title', 'Add New Property')

@section('content')
<div class="page-header">
    <div class="header-content">
        <a href="{{ route('landlord.properties.index') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            Back to Properties
        </a>
        <h1>Add New Property</h1>
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

<form action="{{ route('landlord.properties.store') }}" method="POST" enctype="multipart/form-data" class="property-form">
    @csrf
    
    <div class="form-grid">
        <!-- Basic Information -->
        <div class="form-section">
            <h2 class="section-title">Basic Information</h2>
            
            <div class="form-group">
                <label for="title">Property Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                       placeholder="e.g., Modern Studio in IT Park">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" 
                          placeholder="Describe your property...">{{ old('description') }}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="property_type">Property Type *</label>
                    <select id="property_type" name="property_type" required>
                        <option value="studio" {{ old('property_type') == 'studio' ? 'selected' : '' }}>Studio</option>
                        <option value="apartment" {{ old('property_type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="condo" {{ old('property_type') == 'condo' ? 'selected' : '' }}>Condo</option>
                        <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="room" {{ old('property_type') == 'room' ? 'selected' : '' }}>Room</option>
                        <option value="hotel" {{ old('property_type') == 'hotel' ? 'selected' : '' }}>Hotel</option>
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
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required 
                           min="0" step="0.01" placeholder="15000">
                </div>
                
                <div class="form-group">
                    <label for="deposit">Security Deposit (₱)</label>
                    <input type="number" id="deposit" name="deposit" value="{{ old('deposit') }}" 
                           min="0" step="0.01" placeholder="30000">
                </div>
            </div>
        </div>
        
        <!-- Specifications -->
        <div class="form-section">
            <h2 class="section-title">Specifications</h2>
            
            <div class="form-row three-col">
                <div class="form-group">
                    <label for="bedrooms">Bedrooms *</label>
                    <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', 1) }}" 
                           required min="0" max="20">
                </div>
                
                <div class="form-group">
                    <label for="bathrooms">Bathrooms *</label>
                    <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', 1) }}" 
                           required min="0" max="10">
                </div>
                
                <div class="form-group">
                    <label for="floor_area">Floor Area (m²)</label>
                    <input type="number" id="floor_area" name="floor_area" value="{{ old('floor_area') }}" 
                           min="0" step="0.01" placeholder="45">
                </div>
            </div>
            
            <div class="form-group">
                <label for="floor_number">Floor Number</label>
                <input type="number" id="floor_number" name="floor_number" value="{{ old('floor_number') }}" 
                       min="0" placeholder="5">
            </div>
        </div>
        
        <!-- Location -->
        <div class="form-section">
            <h2 class="section-title">Location</h2>
            
            <div class="form-group">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required 
                       placeholder="e.g., Unit 501, The Residences at Greenbelt">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="city">City *</label>
                    <input type="text" id="city" name="city" value="{{ old('city', 'Cebu City') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" 
                           placeholder="10.3157">
                </div>
                
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" 
                           placeholder="123.8854">
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
                    $oldAmenities = old('amenities', []);
                @endphp
                
                @foreach($amenitiesList as $key => $label)
                <label class="amenity-checkbox">
                    <input type="checkbox" name="amenities[]" value="{{ $key }}" 
                           {{ in_array($key, $oldAmenities) ? 'checked' : '' }}>
                    <span class="checkbox-custom"></span>
                    <span>{{ $label }}</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <!-- Images -->
        <div class="form-section full-width">
            <h2 class="section-title">Property Images</h2>
            <p class="section-hint">Upload up to 10 images. First image will be the primary image.</p>
            
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
        <button type="submit" class="btn-primary">Create Property</button>
    </div>
</form>

<style>
/* Light Theme Styles for Create Property */
.page-header { margin-bottom: 2rem; }

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    color: #6b7280;
    text-decoration: none;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    transition: color 0.2s;
}

.back-link:hover { color: #1a1a2e; }
.back-link svg { width: 16px; height: 16px; }

.page-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0;
}

.alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-error ul { margin: 0; padding-left: 1.25rem; }

.property-form {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.form-section {
    background: #f9fafb;
    border-radius: 10px;
    padding: 1.25rem;
    border: 1px solid #f0f0f0;
}

.form-section.full-width { grid-column: 1 / -1; }

.section-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0 0 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #e5e7eb;
}

.section-hint {
    font-size: 0.875rem;
    color: #6b7280;
    margin: -0.5rem 0 1rem;
}

.form-group { margin-bottom: 1rem; }
.form-group:last-child { margin-bottom: 0; }

.form-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    color: #1a1a2e;
    font-size: 0.9375rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-group input::placeholder,
.form-group textarea::placeholder { color: #9ca3af; }

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-row.three-col { grid-template-columns: repeat(3, 1fr); }

.amenities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 0.75rem;
}

.amenity-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    font-size: 0.875rem;
    color: #374151;
}

.amenity-checkbox:hover {
    border-color: #6366f1;
    background: #f5f3ff;
}

.amenity-checkbox input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.checkbox-custom {
    width: 18px;
    height: 18px;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.amenity-checkbox input:checked + .checkbox-custom {
    background: #6366f1;
    border-color: #6366f1;
}

.amenity-checkbox input:checked + .checkbox-custom::after {
    content: '';
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
    margin-top: -2px;
}

.amenity-checkbox input:checked ~ span:last-child {
    color: #1a1a2e;
    font-weight: 500;
}

.image-upload-area {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    transition: border-color 0.2s, background 0.2s;
    cursor: pointer;
    background: #fafafa;
}

.image-upload-area:hover {
    border-color: #6366f1;
    background: #f5f3ff;
}

.file-input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.upload-placeholder svg {
    width: 48px;
    height: 48px;
    color: #9ca3af;
    margin-bottom: 0.75rem;
}

.upload-placeholder span {
    display: block;
    color: #374151;
    margin-bottom: 0.25rem;
}

.upload-placeholder small { color: #9ca3af; }

.image-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1rem;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.btn-secondary {
    padding: 0.75rem 1.5rem;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    color: #374151;
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-secondary:hover {
    background: #f9fafb;
    border-color: #9ca3af;
    color: #1a1a2e;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

@media (max-width: 768px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-row, .form-row.three-col { grid-template-columns: 1fr; }
    .form-actions { flex-direction: column-reverse; }
    .form-actions .btn-secondary,
    .form-actions .btn-primary { width: 100%; text-align: center; }
}
</style>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-image';
            div.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                ${index === 0 ? '<span class="primary-badge">Primary</span>' : ''}
            `;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

// Also add styles for preview images
const style = document.createElement('style');
style.textContent = `
.preview-image {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
}
.preview-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.primary-badge {
    position: absolute;
    bottom: 4px;
    left: 4px;
    background: #667eea;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
}
`;
document.head.appendChild(style);
</script>
@endsection

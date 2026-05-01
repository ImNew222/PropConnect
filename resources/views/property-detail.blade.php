<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo/logoo.jpeg') }}">
    <title>{{ $property->title }} - PropConnect</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@400;500;600;700&family=Audiowide&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sections/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/property-detail.css') }}">
    <!-- Mapbox GL JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/property-detail-map.css') }}">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <script>window.MAPBOX_ACCESS_TOKEN = '{{ config('services.mapbox.token') }}';</script>
</head>
<body class="has-dark-header">
    <!-- Accessibility: Skip link for keyboard users -->
<a href="#main-content" class="skip-link">Skip to main content</a>

@include('components.dark-header')

<main id="main-content">
    <!-- Image Gallery Section -->
    <section class="property-gallery-section">
        <!-- Back Button -->
        <a href="/rental" class="back-btn" title="Back to Properties">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
        </a>

        <!-- Favorite Button -->
        @auth
        <button class="favorite-btn {{ auth()->user()->hasSaved($property) ? 'active' : '' }}" 
                onclick="toggleFavorite({{ $property->id }})"
                id="fav-btn-{{ $property->id }}"
                title="Save Property">
            <svg viewBox="0 0 24 24" fill="{{ auth()->user()->hasSaved($property) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </button>
        @endauth
        
        <!-- Badge -->
        <span class="property-badge">For Rent</span>
        
        <!-- Gallery Component (database-ready) -->
        @include('components.property-gallery', [
            'images' => isset($property) && $property->images->count() > 0 
                ? $property->images->map(fn($img) => ['url' => $img->url, 'alt' => $property->title])
                : null
        ])
    </section>

    <!-- Property Content -->
    <section class="property-content">
        <div class="content-wrapper">
            <!-- Left Column: Info -->
            <div class="property-info">
                <!-- Location -->
                <div class="property-location">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $property->address ?? 'Cebu City' }}{{ $property->city ? ', ' . $property->city : '' }}
                </div>

                <!-- Price -->
                <div class="property-price">
                    {{ $property->formatted_price ?? '₱0.00' }}<span>/mo</span>
                </div>
                
                <!-- Property Title -->
                <h1 class="property-title">{{ $property->title ?? 'Property Details' }}</h1>

                <!-- Title & Description -->
                <div class="property-about">
                    <h2 class="section-title">About the house</h2>
                    <p class="property-description">
                        {{ $property->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Specs Grid -->
                <div class="property-specs">
                    <div class="spec-item">
                        <span class="spec-value">{{ $property->floor_area ? number_format($property->floor_area) : '0' }}</span>
                        <span class="spec-label">m²</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-value">{{ $property->bathrooms ?? '0' }}</span>
                        <span class="spec-label">baths</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-value">{{ $property->bedrooms ?? '0' }}</span>
                        <span class="spec-label">Beds</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-value">{{ $property->floor_number ?? '1' }}</span>
                        <span class="spec-label">Floor</span>
                    </div>
                </div>

                <!-- Landlord Contact -->
                <div class="landlord-section">
                    @php
                        $landlord = $property->landlord ?? null;
                        $landlordId = $landlord->id ?? 1;
                        $landlordName = $landlord->name ?? 'Property Owner';
                        $landlordPhone = $landlord->phone ?? null;
                        $landlordWhatsapp = $landlord->whatsapp ?? $landlordPhone;
                        $landlordFacebook = $landlord->facebook ?? null;
                    @endphp
                    <div class="landlord-actions">
                        @auth
                            <a href="{{ route('messages.chat', $landlordId) }}" class="landlord-btn">
                                <span class="avatar-circle">{{ strtoupper(substr($landlordName, 0, 1)) }}</span>
                                Landlord: {{ $landlordName }}
                            </a>
                            <a href="{{ route('messages.chat', $landlordId) }}" class="request-btn">Send Request</a>
                        @else
                            <a href="{{ route('login') }}" class="landlord-btn">
                                <span class="avatar-circle">{{ strtoupper(substr($landlordName, 0, 1)) }}</span>
                                Landlord: {{ $landlordName }}
                            </a>
                            <a href="{{ route('login') }}" class="request-btn">Login to Request</a>
                        @endauth
                    </div>
                    <div class="contact-icons">
                        <a href="/chat/landlord/{{ $landlordId }}" class="contact-icon" aria-label="Message">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </a>
                        @if($landlordWhatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $landlordWhatsapp) }}" target="_blank" class="contact-icon" aria-label="WhatsApp">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                        @endif
                        @if($landlordFacebook)
                        <a href="{{ $landlordFacebook }}" target="_blank" class="contact-icon" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                        @if($landlordPhone)
                        <span class="contact-phone">{{ $landlordPhone }}</span>
                        @endif
                    </div>
                </div>

                <!-- Details Row: Amenities, Features, Financial (side by side) -->
                <div class="details-row">
                    <!-- Amenities -->
                    <div class="amenities-section">
                        <h3 class="section-title">Amenities</h3>
                        @php
                            $amenities = $property->amenities ?? [];
                            $amenityIcons = [
                                'wifi' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0M12 20h.01"/></svg>',
                                'parking' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
                                'security' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                                'pool' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20M4 9a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V9z"/></svg>',
                            ];
                        @endphp
                        <div class="amenities-icons">
                            @foreach(array_slice($amenities, 0, 4) as $amenity)
                                <span class="amenity" title="{{ ucfirst(str_replace('_', ' ', $amenity)) }}">
                                    {!! $amenityIcons[strtolower($amenity)] ?? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>' !!}
                                </span>
                            @endforeach
                        </div>
                        <ul class="amenities-list">
                            @foreach($amenities as $amenity)
                                <li>{{ ucfirst(str_replace('_', ' ', $amenity)) }}</li>
                            @endforeach
                            @if(empty($amenities))
                                <li>No amenities listed</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Property Features -->
                    <div class="features-section">
                        <h3 class="section-title">Property Features</h3>
                        <ul class="features-list">
                            <li>Floor Area: {{ $property->floor_area ?? 0 }} sqm</li>
                            <li>{{ $property->bedrooms ?? 0 }} Bedrooms</li>
                            <li>{{ $property->bathrooms ?? 0 }} Toilet & Bath</li>
                            <li>Floor: {{ $property->floor_number ?? 'N/A' }}</li>
                            <li>Type: {{ ucfirst($property->property_type ?? 'Unknown') }}</li>
                        </ul>
                    </div>

                    <!-- Financial Details -->
                    <div class="financial-section">
                        <h3 class="section-title">Financial Details</h3>
                        <ul class="financial-list">
                            <li>Monthly Rent: {{ $property->formatted_price ?? '₱0.00' }}</li>
                            @if($property->deposit)
                                <li>Security Deposit: ₱{{ number_format($property->deposit, 2) }}</li>
                            @endif
                            <li>Status: {{ ucfirst($property->status ?? 'Available') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Map -->
            <div class="property-map">
                <!-- Interactive Mapbox Map -->
                <div class="property-detail-map" 
                     id="propertyDetailMap" 
                     data-lat="{{ $property->latitude ?? 10.3157 }}" 
                     data-lng="{{ $property->longitude ?? 123.8854 }}"
                     data-address="{{ $property->address ?? 'Property Location' }}">
                    
                    <!-- Map Style Toggle -->
                    <div class="map-controls-overlay">
                        <div class="map-style-toggle">
                            <button class="map-style-btn active" data-style="street">Street</button>
                            <button class="map-style-btn" data-style="satellite">Satellite</button>
                            <button class="map-style-btn" data-style="3d">3D</button>
                        </div>
                    </div>
                    
                    <!-- Expand Button -->
                    <button class="map-expand-btn" aria-label="Expand map">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Map Address -->
                <div class="map-address">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <div>
                        <span class="distance">{{ $property->city ?? 'Cebu City' }}</span>
                        <span class="address">{{ $property->address ?? 'Address not available' }}</span>
                    </div>
                </div>
                
                <!-- Map Actions -->
                <div class="map-actions-row">
                    <button class="get-directions-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L4.5 20.3l.7.7L12 17l6.8 4 .7-.7z"/>
                        </svg>
                        Get Directions
                    </button>
                    <button class="open-google-maps-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                        Google Maps
                    </button>
                </div>
                
                <!-- Travel Modes Panel (hidden until directions requested) -->
                <div class="travel-modes-panel">
                    <div class="travel-modes-header">Choose travel mode:</div>
                    <div class="travel-modes-btns">
                        <button class="travel-mode-btn active" data-mode="driving">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                                <path d="M5 11l1.5-4.5a2 2 0 0 1 1.9-1.5h7.2a2 2 0 0 1 1.9 1.5L19 11"/>
                                <path d="M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                                <circle cx="6.5" cy="15.5" r="1.5"/>
                                <circle cx="17.5" cy="15.5" r="1.5"/>
                            </svg>
                            <span>Driving</span>
                        </button>
                        <button class="travel-mode-btn" data-mode="walking">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                                <circle cx="12" cy="5" r="2"/>
                                <path d="M14 10l-2 8-3-3-2 5"/>
                                <path d="M10 10l2-2 4 4"/>
                            </svg>
                            <span>Walking</span>
                        </button>
                        <button class="travel-mode-btn" data-mode="transit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                                <rect x="4" y="3" width="16" height="16" rx="2"/>
                                <path d="M4 11h16"/>
                                <circle cx="8" cy="15" r="1"/>
                                <circle cx="16" cy="15" r="1"/>
                                <path d="M8 19l-2 2"/>
                                <path d="M16 19l2 2"/>
                            </svg>
                            <span>Transit</span>
                        </button>
                    </div>
                    <div class="directions-info" id="directionsInfo"></div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('javascript/property-detail.js') }}"></script>
<script src="{{ asset('javascript/property-detail-map.js') }}"></script>
<script src="{{ asset('javascript/dark-header.js') }}"></script>

<!-- Scripts -->
<script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
<script src="{{ asset('javascript/smooth-scroll.js') }}"></script>
</body>
</html>

{{--
    Property List Card Component
    Usage: @include('components.property-list-card', ['property' => $property])
    
    Expected $property format:
    [
        'id' => 1,
        'title' => 'Cozy Studio',
        'price' => 25000,
        'address' => 'Cebu City',
        'bedrooms' => 2,
        'bathrooms' => 1,
        'size' => 65,
        'image' => 'url/to/image.jpg',
        'amenities' => ['wifi', 'parking', 'security'],
    ]
--}}

@php
    $property = $property ?? [
        'id' => 'demo',
        'title' => 'Stylish Apartment in Downtown',
        'price' => 100321,
        'address' => 'Cebu City, Duljo Shabs Ext.',
        'bedrooms' => 2,
        'bathrooms' => 2,
        'size' => 100,
        'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600',
        'amenities' => ['wifi', 'parking', 'security', 'ac'],
    ];
@endphp

<article class="property-card" data-property-id="{{ $property['id'] }}">
    <!-- Image Section with Swiper -->
    <div class="property-image">
        <div class="image-swiper">
            <div class="swiper-slides">
                <img src="{{ $property['image'] }}" alt="{{ $property['title'] }}" class="swiper-slide active">
            </div>
            <div class="swiper-nav swiper-prev"></div>
            <div class="swiper-nav swiper-next"></div>
        </div>
        <span class="property-badge">For Rent</span>
        <div class="image-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    
    <!-- Details Section -->
    <div class="property-details">
        <div class="property-header">
            <div class="property-meta">
                <span class="property-type">Apartment</span>
                <span class="property-location">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $property['address'] }}
                </span>
            </div>
        </div>
        
        <h3 class="property-title">{{ $property['title'] }}</h3>
        
        <div class="property-price">
            <span class="price-amount">₱{{ number_format($property['price'], 2) }}</span>
            <span class="price-period">/mo</span>
        </div>
        
        <div class="property-specs">
            <span class="spec">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                {{ $property['bedrooms'] }} bed
            </span>
            <span class="spec">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="10" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                {{ $property['bathrooms'] }} bath
            </span>
            <span class="spec">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <path d="M3 9h18M9 21V9"/>
                </svg>
                {{ $property['size'] }} m²
            </span>
        </div>
        
        <div class="property-amenities">
            @if(in_array('wifi', $property['amenities']))
                <span class="amenity" title="WiFi">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0M12 20h.01"/>
                    </svg>
                </span>
            @endif
            @if(in_array('parking', $property['amenities']))
                <span class="amenity" title="Parking">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="10" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
            @endif
            @if(in_array('security', $property['amenities']))
                <span class="amenity" title="Security">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </span>
            @endif
            @if(in_array('ac', $property['amenities']))
                <span class="amenity" title="Air Conditioning">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 16a4 4 0 1 1 8 0M12 4v4M4 12h4M16 12h4M6.34 17.66l2.83-2.83M14.83 14.83l2.83 2.83"/>
                    </svg>
                </span>
            @endif
        </div>
    </div>
</article>

{{--
    Property Grid Card Component
    Usage: @include('components.property-grid-card', ['property' => $property])
--}}

@php
    $property = $property ?? [
        'id' => 'demo',
        'title' => 'Cozy Studio Unit',
        'price' => 25000,
        'address' => 'Cebu IT Park',
        'bedrooms' => 1,
        'bathrooms' => 1,
        'size' => 32,
        'images' => [
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400',
            'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400',
        ],
        'amenities' => ['wifi', 'parking'],
    ];
    $images = $property['images'] ?? [$property['image'] ?? ''];
@endphp

<article class="grid-card" data-property-id="{{ $property['id'] }}">
    <!-- Image Section with Swiper -->
    <div class="grid-image">
        <div class="grid-swiper">
            <div class="grid-slides">
                @foreach($images as $index => $image)
                    <div class="grid-slide {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $image }}" alt="{{ $property['title'] }} - Image {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
            <div class="grid-nav grid-prev"></div>
            <div class="grid-nav grid-next"></div>
            <div class="grid-dots">
                @foreach($images as $index => $image)
                    <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
                @endforeach
            </div>
        </div>
        <span class="grid-badge">For Rent</span>
    </div>
    
    <!-- Details Section -->
    <div class="grid-details">
        <div class="grid-price">₱{{ number_format($property['price']) }}<span>/mo</span></div>
        <h3 class="grid-title">{{ $property['title'] }}</h3>
        <p class="grid-location">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
            {{ $property['address'] }}
        </p>
        <div class="grid-specs">
            <span>{{ $property['bedrooms'] }} bed</span>
            <span>{{ $property['bathrooms'] }} bath</span>
            <span>{{ $property['size'] }} m²</span>
        </div>
        <div class="grid-amenities">
            @if(in_array('wifi', $property['amenities'] ?? []))
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" title="WiFi">
                    <path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0M12 20h.01"/>
                </svg>
            @endif
            @if(in_array('parking', $property['amenities'] ?? []))
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" title="Parking">
                    <rect x="3" y="11" width="18" height="10" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            @endif
            @if(in_array('security', $property['amenities'] ?? []))
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" title="Security">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            @endif
            @if(in_array('ac', $property['amenities'] ?? []))
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" title="AC">
                    <path d="M8 16a4 4 0 1 1 8 0M12 4v4M4 12h4M16 12h4"/>
                </svg>
            @endif
        </div>
    </div>
</article>

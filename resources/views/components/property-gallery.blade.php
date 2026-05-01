{{-- 
    Property Gallery Component
    Usage: @include('components.property-gallery', ['images' => $property->images])
    
    Expected $images format (from database):
    [
        ['url' => 'path/to/image.jpg', 'alt' => 'Living Room'],
        ['url' => 'path/to/image2.jpg', 'alt' => 'Bedroom'],
        ...
    ]
    
    For now using placeholder images until database is connected.
--}}

@php
    // Placeholder images - replace with $images from database
    $galleryImages = $images ?? [
        ['url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', 'alt' => 'Living Room'],
        ['url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400', 'alt' => 'Bedroom'],
        ['url' => 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400', 'alt' => 'Kitchen'],
        ['url' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=400', 'alt' => 'Bathroom'],
        ['url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400', 'alt' => 'Exterior'],
        ['url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400', 'alt' => 'Staircase'],
    ];
@endphp

<!-- Desktop Gallery Grid (hidden on mobile) -->
<div class="gallery-grid desktop-only">
    @if(count($galleryImages) > 0)
        <!-- Main Large Image -->
        <div class="gallery-main">
            <img src="{{ $galleryImages[0]['url'] }}" alt="{{ $galleryImages[0]['alt'] ?? 'Property Image' }}">
        </div>
    @endif
    
    @if(count($galleryImages) > 2)
        <!-- Second Column -->
        <div class="gallery-side">
            <div class="gallery-thumb">
                <img src="{{ $galleryImages[1]['url'] }}" alt="{{ $galleryImages[1]['alt'] ?? 'Property Image' }}">
            </div>
            <div class="gallery-thumb">
                <img src="{{ $galleryImages[2]['url'] }}" alt="{{ $galleryImages[2]['alt'] ?? 'Property Image' }}">
            </div>
        </div>
    @endif
    
    @if(count($galleryImages) > 4)
        <!-- Third Column -->
        <div class="gallery-third">
            <div class="gallery-thumb">
                <img src="{{ $galleryImages[3]['url'] }}" alt="{{ $galleryImages[3]['alt'] ?? 'Property Image' }}">
            </div>
            <div class="gallery-thumb">
                <img src="{{ $galleryImages[4]['url'] }}" alt="{{ $galleryImages[4]['alt'] ?? 'Property Image' }}">
            </div>
        </div>
    @endif
    
    @if(count($galleryImages) > 5)
        <!-- Fourth Column -->
        <div class="gallery-fourth">
            <div class="gallery-thumb tall">
                <img src="{{ $galleryImages[5]['url'] }}" alt="{{ $galleryImages[5]['alt'] ?? 'Property Image' }}">
            </div>
        </div>
    @endif
</div>

<!-- Mobile Swiper Gallery (hidden on desktop) -->
<div class="mobile-gallery-component mobile-only">
    <div class="mobile-swiper">
        <div class="mobile-slides">
            @foreach($galleryImages as $image)
                <div class="mobile-slide">
                    <img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? 'Property Image' }}">
                </div>
            @endforeach
        </div>
        <div class="mobile-nav mobile-prev"></div>
        <div class="mobile-nav mobile-next"></div>
        <div class="mobile-dots">
            @foreach($galleryImages as $index => $image)
                <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>
    </div>
</div>

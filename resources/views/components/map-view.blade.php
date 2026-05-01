{{--
    Map View Component
    Fullscreen Mapbox map with property markers
--}}

<!-- Mapbox Map Container -->
<div id="propertyMap" class="mapbox-map"></div>

<!-- Property Popup Template (hidden, used by JS) -->
<div id="mapPopupTemplate" class="map-popup-card" style="display: none;">
    <div class="popup-image">
        <img src="" alt="Property">
        <span class="popup-badge">For Rent</span>
        <button class="popup-favorite">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </button>
    </div>
    <div class="popup-content">
        <div class="popup-price">₱350,000</div>
        <div class="popup-specs">
            <span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg> 3
            </span>
            <span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="10" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg> 2
            </span>
            <span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                </svg> 110 m²
            </span>
        </div>
        <div class="popup-address">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
            <span>Cebu City, IT Park</span>
        </div>
    </div>
</div>

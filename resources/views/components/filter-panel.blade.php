{{--
    Filter Panel Component
    Contains: Toolbar + Expandable Filter Panel
--}}

<!-- Filter Toolbar -->
<div class="filter-toolbar">
    <div class="toolbar-left">
        <!-- Filters Button -->
        <button class="filter-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="6" y1="12" x2="18" y2="12"></line>
                <line x1="8" y1="18" x2="16" y2="18"></line>
            </svg>
            Filters
        </button>
        
        <!-- Category Tabs -->
        <div class="category-tabs">
            <button class="tab-btn active">All</button>
            <button class="tab-btn">Favorites</button>
        </div>
    </div>
    
    <div class="toolbar-right">
        <!-- View Toggle Icons -->
        <div class="view-toggles">
            <button class="view-btn" aria-label="Grid view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                </svg>
            </button>
            <button class="view-btn active" aria-label="List view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <button class="view-btn" aria-label="Map view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                    <line x1="8" y1="2" x2="8" y2="18"></line>
                    <line x1="16" y1="6" x2="16" y2="22"></line>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Filter Panel (expandable) -->
<div class="filter-panel" id="filterPanel">
    <!-- Buy/Rent Toggle -->
    <div class="filter-header">
        <div class="buy-rent-toggle">
            <button class="toggle-btn" data-type="buy">Buy</button>
            <button class="toggle-btn active" data-type="rent">Rent</button>
        </div>
    </div>
    
    <!-- Results & Map Toggle -->
    <div class="filter-meta">
        <span class="results-count">{{ $resultsCount ?? '256' }} results</span>
        <label class="map-toggle">
            Show on map
            <input type="checkbox" id="showMap">
            <span class="toggle-slider"></span>
        </label>
    </div>
    
    <!-- Rental Period -->
    <div class="filter-group">
        <h4 class="filter-label">Rental period</h4>
        <div class="checkbox-group">
            <label class="checkbox-item">
                <input type="checkbox" name="rental_period" value="long_term">
                <span class="checkmark"></span>
                Long term rent
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="rental_period" value="short_term">
                <span class="checkmark"></span>
                Short term rent
            </label>
        </div>
    </div>
    
    <!-- Price Range -->
    <div class="filter-group">
        <h4 class="filter-label">Price</h4>
        <div class="price-slider-container">
            <input type="range" id="priceRange" min="0" max="2000" value="760" class="price-slider">
        </div>
        <div class="price-inputs">
            <div class="price-input">
                <span class="currency">$</span>
                <input type="number" id="priceMin" value="280" min="0">
            </div>
            <span class="price-separator">—</span>
            <div class="price-input">
                <span class="currency">$</span>
                <input type="number" id="priceMax" value="760" max="10000">
            </div>
        </div>
    </div>
    
    <!-- Real Estate Type -->
    <div class="filter-group">
        <h4 class="filter-label">Real estate type</h4>
        <div class="checkbox-group">
            <label class="checkbox-item">
                <input type="checkbox" name="property_type" value="houses">
                <span class="checkmark"></span>
                Houses
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="property_type" value="condos">
                <span class="checkmark"></span>
                Condos
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="property_type" value="apartments">
                <span class="checkmark"></span>
                Apartments
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="property_type" value="commercial">
                <span class="checkmark"></span>
                Commercial
            </label>
        </div>
    </div>
    
    <!-- Bedrooms -->
    <div class="filter-group">
        <h4 class="filter-label">Bedrooms</h4>
        <div class="checkbox-group horizontal">
            <label class="checkbox-item">
                <input type="checkbox" name="bedrooms" value="1">
                <span class="checkmark"></span>
                1
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="bedrooms" value="2">
                <span class="checkmark"></span>
                2
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="bedrooms" value="3">
                <span class="checkmark"></span>
                3
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="bedrooms" value="4+">
                <span class="checkmark"></span>
                4 and more
            </label>
        </div>
    </div>
    
    <!-- Bathroom -->
    <div class="filter-group">
        <h4 class="filter-label">Bathroom</h4>
        <div class="button-group">
            <button class="option-btn active" data-value="any">Any</button>
            <button class="option-btn" data-value="combined">Combined</button>
            <button class="option-btn" data-value="separate">Separate</button>
        </div>
    </div>
    
    <!-- View -->
    <div class="filter-group">
        <h4 class="filter-label">View</h4>
        <div class="button-group">
            <button class="option-btn active" data-value="any">Any</button>
            <button class="option-btn" data-value="courtyard">Courtyard</button>
            <button class="option-btn" data-value="street">Street</button>
        </div>
    </div>
</div>

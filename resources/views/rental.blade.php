<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo/logoo.jpeg') }}">
    <title>Rentals - PropConnect</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@400;500;600;700&family=Audiowide&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sections/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rental.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gridlisting.css') }}">
    <!-- Mapbox GL CSS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mapbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mapview.css') }}">
</head>
<body class="has-dark-header">
<script>
    // Mapbox Configuration from Laravel .env
    window.MAPBOX_ACCESS_TOKEN = '{{ config('services.mapbox.token') }}';
</script>
    <!-- Accessibility: Skip link for keyboard users -->
<a href="#main-content" class="skip-link">Skip to main content</a>

@include('components.dark-header')

<main id="main-content">
    <section class="rental-section">
        <!-- Filter Toolbar Wrapper (for overlay positioning) -->
        <div class="filter-toolbar-wrapper">
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
            <!-- Rent Only Header -->
            <div class="filter-header">
                <div class="filter-title">
                    <h3>Filter Properties</h3>
                    <span class="rent-badge">For Rent</span>
                </div>
            </div>
            
            <!-- Results & Map Toggle -->
            <div class="filter-meta">
                <span class="results-count" id="filterResultsCount">Loading...</span>
                <label class="map-toggle">
                    Show on map
                    <input type="checkbox" id="showMap">
                    <span class="toggle-slider"></span>
                </label>
            </div>
            
            <!-- Price Range -->
            <div class="filter-group">
                <h4 class="filter-label">Price (₱/month)</h4>
                <div class="price-inputs">
                    <div class="price-input">
                        <span class="currency">₱</span>
                        <input type="number" id="priceMin" value="5000" min="0" step="1000" placeholder="Min">
                    </div>
                    <span class="price-separator">—</span>
                    <div class="price-input">
                        <span class="currency">₱</span>
                        <input type="number" id="priceMax" value="100000" max="500000" step="1000" placeholder="Max">
                    </div>
                </div>
            </div>
            
            <!-- Real Estate Type -->
            <div class="filter-group">
                <h4 class="filter-label">Property type</h4>
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="house">
                        <span class="checkmark"></span>
                        House
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="condo">
                        <span class="checkmark"></span>
                        Condo
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="apartment">
                        <span class="checkmark"></span>
                        Apartment
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="studio">
                        <span class="checkmark"></span>
                        Studio
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="hotel">
                        <span class="checkmark"></span>
                        Hotel
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="property_type" value="room">
                        <span class="checkmark"></span>
                        Room
                    </label>
                </div>
            </div>
            
            <!-- Bedrooms -->
            <div class="filter-group">
                <h4 class="filter-label">Bedrooms</h4>
                <div class="bedroom-options">
                    <button class="bedroom-btn active" data-value="any">Any</button>
                    <button class="bedroom-btn" data-value="1">1</button>
                    <button class="bedroom-btn" data-value="2">2</button>
                    <button class="bedroom-btn" data-value="3">3</button>
                    <button class="bedroom-btn" data-value="4+">4+</button>
                </div>
            </div>
            
            <!-- Bathrooms -->
            <div class="filter-group">
                <h4 class="filter-label">Bathrooms</h4>
                <div class="bedroom-options">
                    <button class="bathroom-btn active" data-value="any">Any</button>
                    <button class="bathroom-btn" data-value="1">1+</button>
                    <button class="bathroom-btn" data-value="2">2+</button>
                    <button class="bathroom-btn" data-value="3">3+</button>
                </div>
            </div>
            
            <!-- Apply Filters Button -->
            <div class="filter-actions">
                <button class="clear-filters-btn" id="clearFilters">Clear All</button>
                <button class="apply-filters-btn" id="applyFilters">Apply Filters</button>
            </div>
        </div>
        
        </div>
        <!-- End Filter Toolbar Wrapper -->
        
        <!-- Results Header with Sort -->
        <div class="results-header">
            <div class="results-left">
                <span class="results-count" id="resultsCount">6 properties found</span>
                
                <!-- Property Search Filter -->
                <div class="property-search-filter">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="propertySearch" placeholder="Search properties..." autocomplete="off">
                    <button id="clearPropertySearch" class="clear-search-btn" style="display: none;">×</button>
                </div>
            </div>
            
            <div class="sort-dropdown">
                <span class="sort-label">Sort by price</span>
                <select id="sortPrice">
                    <option value="low-high">Low to High</option>
                    <option value="high-low">High to Low</option>
                    <option value="newest">Newest First</option>
                </select>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
        </div>
            </div>
        </div>
        
        <!-- ========================================
             PROPERTY VIEWS - Separate containers for each view mode
             ======================================== -->
        
        <!-- LIST VIEW (Default - visible) -->
        <div class="view-container list-view-container" id="listViewContainer">
            <div class="property-listings" id="propertyListings">
                <!-- Properties loaded dynamically by property-loader.js -->
            </div>
        </div>
        <!-- End of LIST VIEW Container -->
        
        <!-- GRID VIEW (Hidden by default) -->
        <div class="view-container grid-view-container" id="gridViewContainer" style="display: none;">
            <div class="property-grid" id="gridListings">
                <!-- Grid cards loaded dynamically by property-loader.js -->
            </div>
        </div>
        <!-- End of GRID VIEW Container -->
        
        <!-- MAP VIEW (Split Screen - Hidden by default) -->
        <div class="mapview-container" id="mapviewContainer">
            <!-- Left: Map -->
            <div class="mapview-map">
                <div id="mapviewMapbox"></div>
            </div>
            
            <!-- Right: Property Cards -->
            <div class="mapview-cards">
                <div class="mapview-cards-header">
                    <h3>6 Properties Found</h3>
                </div>
                <div class="mapview-cards-grid" id="mapviewCardsGrid">
                    <!-- Cards rendered by JavaScript -->
                </div>
                <div class="mapview-pagination">
                    <button class="mapview-pagination-btn" disabled>Previous</button>
                    <span class="mapview-pagination-info">Page 1 of 1</span>
                    <button class="mapview-pagination-btn" disabled>Next</button>
                </div>
            </div>
        </div>
        <!-- End of MAP VIEW (Split Screen) Container -->
        
        <!-- FULL MAP VIEW (Full Featured Map - Hidden by default) -->
        <div class="view-container full-map-view-container" id="mapViewContainer" style="display: none;">
            <div class="full-map-wrapper">
                <!-- Main Map Container for mapbox.js -->
                <div id="propertyMap" class="property-map"></div>
                <!-- Controls (search box, 3D/satellite/terrain) added by mapbox.js -->
            </div>
        </div>
        <!-- End of FULL MAP VIEW Container -->
        
        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-btn" disabled>Previous</button>
            <span class="pagination-info">Page 1 of 3</span>
            <button class="pagination-btn">Next</button>
        </div>
        
    </section>
</main>

<script src="{{ asset('javascript/script.js') }}"></script>
<script src="{{ asset('javascript/filter.js') }}"></script>
<!-- Mapbox GL JS -->
<script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
<script src="{{ asset('javascript/mapbox.js') }}"></script>
<script src="{{ asset('javascript/mapview.js') }}"></script>

<!-- Scripts -->
<script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
<script src="{{ asset('javascript/smooth-scroll.js') }}"></script>

<!-- Property Loader (Dynamic API Integration) -->
<script src="{{ asset('javascript/property-loader.js') }}"></script>

<!-- Chat Navigation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make message buttons navigate to landlord chat
    document.querySelectorAll('.landlord-contact .contact-btn[aria-label="Message"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            // Get landlord name from the parent card
            const landlordInfo = this.closest('.landlord-info');
            const landlordName = landlordInfo.querySelector('.landlord-name').textContent;
            // Navigate to chat with landlord
            window.location.href = '/chat/landlord/1?name=' + encodeURIComponent(landlordName);
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========================================
    // FILTER PANEL LOGIC
    // ========================================
    
    const applyFiltersBtn = document.getElementById('applyFilters');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const filterResultsCount = document.getElementById('filterResultsCount');
    
    // Bedroom buttons
    const bedroomBtns = document.querySelectorAll('.bedroom-btn');
    bedroomBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            bedroomBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
    
    // Bathroom buttons
    const bathroomBtns = document.querySelectorAll('.bathroom-btn');
    bathroomBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            bathroomBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
    
    // Apply filters - Use global PropertyLoader
    function applyFilters() {
        if (window.propertyLoader) {
            // Close filter panel
            const filterPanel = document.getElementById('filterPanel');
            if (filterPanel) filterPanel.classList.remove('open');
            const filterBtn = document.querySelector('.filter-btn');
            if (filterBtn) filterBtn.classList.remove('active');
            
            // Trigger loader
            window.propertyLoader.applyFilters();
        } else {
            console.error('PropertyLoader not initialized');
        }
    }
    
    // Clear all filters
    function clearFilters() {
        // Reset price
        const priceMin = document.getElementById('priceMin');
        const priceMax = document.getElementById('priceMax');
        if (priceMin) priceMin.value = '5000';
        if (priceMax) priceMax.value = '100000';
        
        // Uncheck all property types
        document.querySelectorAll('input[name="property_type"]').forEach(cb => {
            cb.checked = false;
        });
        
        // Reset bedroom buttons
        bedroomBtns.forEach(b => b.classList.remove('active'));
        const anyBedroomBtn = document.querySelector('.bedroom-btn[data-value="any"]');
        if (anyBedroomBtn) anyBedroomBtn.classList.add('active');
        
        // Reset bathroom buttons
        bathroomBtns.forEach(b => b.classList.remove('active'));
        const anyBathroomBtn = document.querySelector('.bathroom-btn[data-value="any"]');
        if (anyBathroomBtn) anyBathroomBtn.classList.add('active');
        
        // Reload without filters
        applyFilters();
    }
    
    // Event listeners
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', applyFilters);
    }
    
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', clearFilters);
    }
    
    // Load initial count for the filter panel header
    async function loadInitialCount() {
        try {
            const response = await fetch('/api/properties?per_page=1');
            const data = await response.json();
            if (filterResultsCount) {
                filterResultsCount.textContent = `${data.pagination.total} results`;
            }
        } catch (e) {
            console.error('Failed to load count:', e);
        }
    }
    loadInitialCount();
});
</script>

<script src="{{ asset('javascript/dark-header.js') }}"></script>
</body>
</html>

// ========================================
// MAP VIEW - Interactive Split Screen
// ========================================

(function() {
    'use strict';
    
    // Properties will be loaded from API
    let properties = [];
    let map = null;
    let markers = [];
    let currentPopup = null;
    let propertiesLoaded = false;
    
    // Pagination state
    const CARDS_PER_PAGE = 8;
    let currentPage = 1;
    let totalPages = 1;
    
    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initMapViewToggle();
    });
    
    // Fetch properties from API with caching
    async function loadProperties() {
        if (propertiesLoaded && properties.length > 0) return properties;
        
        const CACHE_KEY = 'mapview_properties';
        const CACHE_TTL = 5 * 60 * 1000; // 5 minutes
        
        // Try cache first
        const cached = getCachedData(CACHE_KEY);
        if (cached) {
            properties = cached;
            propertiesLoaded = true;
            console.log('📍 Mapview: Using cached properties');
            return properties;
        }
        
        try {
            console.log('📍 Mapview: Fetching from API...');
            const response = await fetch('/api/properties?per_page=100');
            const data = await response.json();
            
            properties = (data.properties || []).map(p => ({
                id: p.id,
                title: p.title,
                price: parseFloat(p.price),
                priceFormatted: p.formatted_price,
                location: p.address,
                lat: parseFloat(p.latitude) || 10.3157,
                lng: parseFloat(p.longitude) || 123.8854,
                beds: p.bedrooms,
                baths: p.bathrooms,
                sqm: parseFloat(p.floor_area) || 0,
                image: p.image || getPlaceholderImage(p.id),
                type: capitalizeFirst(p.property_type)
            }));
            
            // Cache the data
            setCachedData(CACHE_KEY, properties, CACHE_TTL);
            
            propertiesLoaded = true;
            return properties;
        } catch (error) {
            console.error('Failed to load properties:', error);
            return [];
        }
    }
    
    // Cache helpers
    function getCachedData(key) {
        try {
            const cached = localStorage.getItem(key);
            if (!cached) return null;
            const { data, expiry } = JSON.parse(cached);
            if (Date.now() > expiry) {
                localStorage.removeItem(key);
                return null;
            }
            return data;
        } catch (e) {
            return null;
        }
    }
    
    function setCachedData(key, data, ttl) {
        try {
            localStorage.setItem(key, JSON.stringify({ data, expiry: Date.now() + ttl }));
        } catch (e) {
            console.warn('Cache storage failed:', e);
        }
    }
    
    function getPlaceholderImage(id) {
        const images = [
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400',
            'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=400',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400'
        ];
        return images[id % images.length];
    }
    
    function capitalizeFirst(str) {
        return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
    }
    
    // Toggle between views
    function initMapViewToggle() {
        const mapToggle = document.querySelector('.map-toggle input');
        const splitMapContainer = document.getElementById('mapviewContainer');
        const listContainer = document.getElementById('listViewContainer');
        const gridContainer = document.getElementById('gridViewContainer');
        
        if (!mapToggle || !splitMapContainer) return;
        
        mapToggle.addEventListener('change', function() {
            // Save the toggle state to localStorage
            localStorage.setItem('showMapEnabled', this.checked);
            
            // Check if we're currently in list view mode (not grid or full map)
            const currentView = localStorage.getItem('propertyViewMode');
            const isListViewMode = currentView === '1' || currentView === null;
            
            if (this.checked && isListViewMode) {
                // Show split-screen map alongside list
                splitMapContainer.style.display = 'flex';
                splitMapContainer.classList.add('active');
                // Hide the list container temporarily
                if (listContainer) listContainer.style.display = 'none';
                
                // Initialize map if not already done
                if (!map) {
                    initMap();
                } else {
                    map.resize();
                }
            } else if (!this.checked && isListViewMode) {
                // Hide split-screen map, show list
                splitMapContainer.style.display = 'none';
                splitMapContainer.classList.remove('active');
                if (listContainer) listContainer.style.display = 'block';
            }
        });
    }
    
    // Initialize Mapbox
    async function initMap() {
        const mapContainer = document.getElementById('mapviewMapbox');
        if (!mapContainer) return;
        
        // Show loading spinner
        const mapWrapper = mapContainer.parentElement;
        let loadingOverlay = document.getElementById('mapviewLoadingOverlay');
        if (!loadingOverlay && mapWrapper) {
            loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'mapviewLoadingOverlay';
            loadingOverlay.className = 'map-loading-overlay';
            loadingOverlay.innerHTML = `
                <div class="map-spinner"></div>
                <span>Loading properties...</span>
            `;
            mapWrapper.style.position = 'relative';
            mapWrapper.appendChild(loadingOverlay);
        }
        
        mapboxgl.accessToken = window.MAPBOX_ACCESS_TOKEN || '';
        
        map = new mapboxgl.Map({
            container: 'mapviewMapbox',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [123.8980, 10.3180], // Cebu City center
            zoom: 12
        });
        
        map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');
        
        map.on('load', async function() {
            await loadProperties();
            addMarkers();
            renderPropertyCards();
            setupSortHandler();
            
            // Hide loading spinner
            if (loadingOverlay) {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => loadingOverlay.remove(), 300);
            }
        });
    }
    
    // Add price markers to map
    function addMarkers() {
        // Clear existing markers
        markers.forEach(m => m.marker.remove());
        markers = [];
        
        properties.forEach(property => {
            // Create custom marker element
            const el = document.createElement('div');
            el.className = 'mapview-marker';
            el.setAttribute('data-property-id', property.id);
            el.innerHTML = formatPriceShort(property.price);
            
            // Create marker
            const marker = new mapboxgl.Marker({
                element: el,
                anchor: 'center'
            })
            .setLngLat([property.lng, property.lat])
            .addTo(map);
            
            // Click handler
            el.addEventListener('click', function() {
                showPopup(property);
                highlightCard(property.id);
                scrollToCard(property.id);
            });
            
            markers.push({ marker, property, element: el });
        });
    }
    
    // Format price for marker (compact: ₱15k, ₱120k)
    function formatPriceShort(price) {
        if (price >= 1000000) {
            return '₱' + (price / 1000000).toFixed(1) + 'M';
        } else if (price >= 1000) {
            return '₱' + Math.round(price / 1000) + 'k';
        }
        return '₱' + price;
    }
    
    // Show popup on marker click - In split view, we just highlight marker and scroll to card
    // (popup is disabled to prevent duplication with side panel)
    function showPopup(property) {
        // Close existing popup if any
        if (currentPopup) {
            currentPopup.remove();
            currentPopup = null;
        }
        
        // Reset all markers
        markers.forEach(m => m.element.classList.remove('active'));
        
        // Highlight clicked marker
        const markerData = markers.find(m => m.property.id === property.id);
        if (markerData) {
            markerData.element.classList.add('active');
        }
        
        // Center map on property
        if (map) {
            map.flyTo({
                center: [property.lng, property.lat],
                zoom: 14,
                essential: true
            });
        }
        
        // Note: We don't create a popup here because the side panel shows the card details
        // This prevents the duplication issue where both popup and card show same info
    }

    
    // Sort properties based on selected option
    function sortProperties(sortOption) {
        if (!sortOption || sortOption === 'newest') {
            // Default order (by ID, which is creation order)
            properties.sort((a, b) => b.id - a.id);
        } else if (sortOption === 'low-high') {
            properties.sort((a, b) => a.price - b.price);
        } else if (sortOption === 'high-low') {
            properties.sort((a, b) => b.price - a.price);
        }
    }
    
    // Setup sort dropdown handler
    function setupSortHandler() {
        const sortDropdown = document.getElementById('sortPrice');
        if (sortDropdown) {
            sortDropdown.addEventListener('change', function() {
                sortProperties(this.value);
                renderPropertyCards();
            });
        }
    }
    
    // Render property cards in right panel with pagination (8 cards per page)
    function renderPropertyCards() {
        const grid = document.getElementById('mapviewCardsGrid');
        if (!grid) return;
        
        // Calculate pagination
        totalPages = Math.ceil(properties.length / CARDS_PER_PAGE);
        const startIndex = (currentPage - 1) * CARDS_PER_PAGE;
        const endIndex = startIndex + CARDS_PER_PAGE;
        const currentProperties = properties.slice(startIndex, endIndex);
        
        // Update header count
        const header = document.querySelector('.mapview-cards-header h3');
        if (header) {
            header.textContent = `${properties.length} Properties Found`;
        }
        
        // Render current page cards
        grid.innerHTML = currentProperties.map(property => `
            <div class="mapview-card" data-property-id="${property.id}" data-price="${property.price}" onclick="window.mapviewFlyTo(${property.id})">
                <div class="mapview-card-image">
                    <img src="${property.image}" alt="${property.title}" onerror="this.parentElement.style.background='#ccc'">
                    <span class="mapview-card-badge">${property.type}</span>
                    <button class="mapview-card-favorite">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                </div>
                <div class="mapview-card-content">
                    <div class="mapview-card-price">${property.priceFormatted || '₱' + formatPrice(property.price)}/mo</div>
                    <div class="mapview-card-title">${property.title}</div>
                    <div class="mapview-card-location">${property.location}</div>
                    <div class="mapview-card-amenities">
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"/><path d="M21 7H3l2-4h14l2 4z"/></svg> ${property.beds}</span>
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> ${property.baths}</span>
                        <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg> ${property.sqm}</span>
                    </div>
                </div>
            </div>
        `).join('');
        
        // Update pagination controls
        updatePaginationControls();
    }
    
    // Update pagination buttons and info
    function updatePaginationControls() {
        const prevBtn = document.querySelector('.mapview-pagination-btn:first-child');
        const nextBtn = document.querySelector('.mapview-pagination-btn:last-child');
        const pageInfo = document.querySelector('.mapview-pagination-info');
        
        if (prevBtn) {
            prevBtn.disabled = currentPage <= 1;
            prevBtn.onclick = () => goToPage(currentPage - 1);
        }
        
        if (nextBtn) {
            nextBtn.disabled = currentPage >= totalPages;
            nextBtn.onclick = () => goToPage(currentPage + 1);
        }
        
        if (pageInfo) {
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        }
    }
    
    // Navigate to a specific page
    function goToPage(page) {
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderPropertyCards();
        
        // Scroll cards container to top
        const cardsContainer = document.querySelector('.mapview-cards');
        if (cardsContainer) {
            cardsContainer.scrollTop = 0;
        }
    }
    
    // Find the page that contains a specific property ID
    function findPageForProperty(propertyId) {
        const index = properties.findIndex(p => p.id === propertyId);
        if (index === -1) return 1;
        return Math.floor(index / CARDS_PER_PAGE) + 1;
    }
    
    // Highlight card when marker is clicked
    function highlightCard(propertyId) {
        // Remove highlight from all
        document.querySelectorAll('.mapview-card').forEach(card => {
            card.classList.remove('highlighted');
        });
        
        // Add highlight to selected
        const card = document.querySelector(`.mapview-card[data-property-id="${propertyId}"]`);
        if (card) {
            card.classList.add('highlighted');
        }
    }
    
    // Scroll to card in right panel - navigates to correct page first if needed
    function scrollToCard(propertyId) {
        // First, find which page contains this property
        const targetPage = findPageForProperty(propertyId);
        
        // If the property is on a different page, navigate there first
        if (targetPage !== currentPage) {
            currentPage = targetPage;
            renderPropertyCards();
        }
        
        // Wait a bit for the DOM to update, then scroll to the card
        setTimeout(() => {
            const card = document.querySelector(`.mapview-card[data-property-id="${propertyId}"]`);
            const cardsContainer = document.querySelector('.mapview-cards');
            
            if (card && cardsContainer) {
                // Highlight the card
                highlightCard(propertyId);
                
                // Calculate the offset of the card relative to the scroll container
                const cardOffsetTop = card.offsetTop;
                const containerHeight = cardsContainer.clientHeight;
                const cardHeight = card.offsetHeight;
                
                // Account for header height
                const header = cardsContainer.querySelector('.mapview-cards-header');
                const headerHeight = header ? header.offsetHeight : 0;
                
                // Calculate scroll position to center the card
                const scrollTarget = cardOffsetTop - headerHeight - (containerHeight / 2) + (cardHeight / 2);
                
                // Smooth scroll within the container only
                cardsContainer.scrollTo({
                    top: Math.max(0, scrollTarget),
                    behavior: 'smooth'
                });
            }
        }, 100);
    }
    
    // Fly to property on map when card is clicked
    window.mapviewFlyTo = function(propertyId) {
        const property = properties.find(p => p.id === propertyId);
        if (property && map) {
            map.flyTo({
                center: [property.lng, property.lat],
                zoom: 15,
                essential: true
            });
            showPopup(property);
            highlightCard(propertyId);
        }
    };
    
    // Format price with commas
    function formatPrice(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    
    // Expose init function globally for filter.js to call
    window.initMapView = async function() {
        const mapViewContainer = document.getElementById('mapviewContainer');
        if (mapViewContainer && mapViewContainer.classList.contains('active')) {
            if (!map) {
                await initMap();
            } else {
                await loadProperties();
                addMarkers();
                renderPropertyCards();
                map.resize();
            }
        }
    };
    
    // Cleanup map on page unload to prevent memory leaks
    function cleanupMapView() {
        if (currentPopup) {
            currentPopup.remove();
            currentPopup = null;
        }
        markers.forEach(marker => marker.remove());
        markers = [];
        if (map) {
            map.remove();
            map = null;
        }
    }
    
    window.addEventListener('beforeunload', cleanupMapView);
    window.addEventListener('pagehide', cleanupMapView);
    
})();

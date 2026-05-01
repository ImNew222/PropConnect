/* ========================================
   MAPBOX MAP - Compact UI with POI Layer
   ======================================== */

mapboxgl.accessToken = window.MAPBOX_ACCESS_TOKEN || '';

let map = null;
let markers = [];
let amenityMarkers = [];
let activePopup = null;
let selectedProperty = null;

// Properties loaded from API
let mapProperties = [];
let mapPropertiesLoaded = false;

const placeholderImages = [
    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400',
    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400',
    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400',
    'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=400',
    'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400'
];

async function loadMapProperties() {
    if (mapPropertiesLoaded && mapProperties.length > 0) return mapProperties;
    
    const CACHE_KEY = 'fullmap_properties';
    const CACHE_TTL = 5 * 60 * 1000; // 5 minutes
    
    // Try cache first
    const cached = getMapCachedData(CACHE_KEY);
    if (cached) {
        mapProperties = cached;
        mapPropertiesLoaded = true;
        console.log('🗺️ Full map: Using cached properties');
        return mapProperties;
    }
    
    try {
        console.log('🗺️ Full map: Fetching from API...');
        const response = await fetch('/api/properties?per_page=100');
        const data = await response.json();
        
        mapProperties = (data.properties || []).map(p => {
            const price = parseFloat(p.price);
            return {
                id: p.id,
                title: p.title,
                price: price,
                priceFormatted: formatPriceShort(price),
                bedrooms: p.bedrooms,
                bathrooms: p.bathrooms,
                size: parseFloat(p.floor_area) || 0,
                address: p.address,
                image: p.image || placeholderImages[p.id % placeholderImages.length],
                lat: parseFloat(p.latitude) || 10.3157,
                lng: parseFloat(p.longitude) || 123.8854
            };
        });
        
        // Cache the data
        setMapCachedData(CACHE_KEY, mapProperties, CACHE_TTL);
        
        mapPropertiesLoaded = true;
        return mapProperties;
    } catch (error) {
        console.error('Failed to load map properties:', error);
        return [];
    }
}

// Cache helpers for map
function getMapCachedData(key) {
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

function setMapCachedData(key, data, ttl) {
    try {
        localStorage.setItem(key, JSON.stringify({ data, expiry: Date.now() + ttl }));
    } catch (e) {
        console.warn('Cache storage failed:', e);
    }
}

function formatPriceShort(price) {
    if (price >= 1000000) return '₱' + (price / 1000000).toFixed(1) + 'M';
    if (price >= 1000) return '₱' + Math.round(price / 1000) + 'k';
    return '₱' + price;
}

// Amenity categories with SVG icons
const amenityIcons = {
    food: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>`,
    hospital: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z M12 8v8M8 12h8"/></svg>`,
    school: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 19.5 8-4.5 8 4.5M12 12l8-4.5L12 3 4 7.5l8 4.5z"/></svg>`,
    shop: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>`,
    bank: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="10" width="18" height="11" rx="2"/><path d="M12 2 2 7h20L12 2z"/></svg>`,
    gym: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 5v14M18 5v14M6 12h12M2 9v6M22 9v6"/></svg>`
};

// ========================================
// MAP INITIALIZATION
// ========================================

async function initPropertyMap() {
    const mapContainer = document.getElementById('propertyMap');
    if (!mapContainer || map) return;
    
    // Show loading spinner
    const mapWrapper = mapContainer.parentElement;
    let loadingOverlay = document.getElementById('mapLoadingOverlay');
    if (!loadingOverlay && mapWrapper) {
        loadingOverlay = document.createElement('div');
        loadingOverlay.id = 'mapLoadingOverlay';
        loadingOverlay.className = 'map-loading-overlay';
        loadingOverlay.innerHTML = `
            <div class="map-spinner"></div>
            <span>Loading properties...</span>
        `;
        mapWrapper.style.position = 'relative';
        mapWrapper.appendChild(loadingOverlay);
    }
    
    map = new mapboxgl.Map({
        container: 'propertyMap',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [123.9056, 10.3301],
        zoom: 13,
        pitch: 45,
        bearing: -15,
        antialias: true
    });
    
    map.addControl(new mapboxgl.NavigationControl({ visualizePitch: true }), 'bottom-right');
    map.addControl(new mapboxgl.FullscreenControl(), 'top-left');
    
    map.on('style.load', async () => {
        add3DBuildings();
        add3DTerrain();
        const properties = await loadMapProperties();
        addPropertyMarkers(properties);
        addMapControls();
        addSearchBox();
        
        // Hide loading spinner
        if (loadingOverlay) {
            loadingOverlay.style.opacity = '0';
            setTimeout(() => loadingOverlay.remove(), 300);
        }
    });
}

// ========================================
// SEARCH BOX
// ========================================

function addSearchBox() {
    const mapContainer = document.getElementById('mapViewContainer');
    if (!mapContainer || document.getElementById('mapSearchBox')) return;
    
    const searchBox = document.createElement('div');
    searchBox.id = 'mapSearchBox';
    searchBox.className = 'map-search-box';
    searchBox.innerHTML = `
        <div class="search-input-wrapper">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input type="text" id="mapSearchInput" placeholder="Search location...">
        </div>
        <div id="searchResults" class="search-results"></div>
    `;
    mapContainer.appendChild(searchBox);
    
    const input = document.getElementById('mapSearchInput');
    const results = document.getElementById('searchResults');
    let debounceTimer;
    
    input.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        const query = e.target.value.trim();
        if (query.length < 3) { results.style.display = 'none'; return; }
        debounceTimer = setTimeout(() => searchLocation(query), 300);
    });
}

async function searchLocation(query) {
    const results = document.getElementById('searchResults');
    try {
        const response = await fetch(
            `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(query)}.json?` +
            `access_token=${mapboxgl.accessToken}&country=ph&limit=5`
        );
        const data = await response.json();
        
        if (data.features?.length > 0) {
            results.innerHTML = data.features.map(f => `
                <div class="search-result-item" data-lng="${f.center[0]}" data-lat="${f.center[1]}">
                    <span class="result-name">${f.text}</span>
                    <span class="result-address">${f.place_name.split(',').slice(1,3).join(',')}</span>
                </div>
            `).join('');
            results.style.display = 'block';
            
            results.querySelectorAll('.search-result-item').forEach(item => {
                item.addEventListener('click', () => {
                    map.flyTo({ center: [parseFloat(item.dataset.lng), parseFloat(item.dataset.lat)], zoom: 16, pitch: 60, duration: 1500 });
                    document.getElementById('mapSearchInput').value = item.querySelector('.result-name').textContent;
                    results.style.display = 'none';
                });
            });
        } else {
            results.innerHTML = '<div class="no-results">No results</div>';
            results.style.display = 'block';
        }
    } catch (error) { console.error('Search error:', error); }
}

// ========================================
// ISOCHRONE
// ========================================

async function showIsochrone(lng, lat, minutes = 10, profile = 'walking') {
    try {
        if (map.getLayer('isochrone-fill')) map.removeLayer('isochrone-fill');
        if (map.getLayer('isochrone-outline')) map.removeLayer('isochrone-outline');
        if (map.getSource('isochrone')) map.removeSource('isochrone');
        
        const response = await fetch(
            `https://api.mapbox.com/isochrone/v1/mapbox/${profile}/${lng},${lat}?` +
            `contours_minutes=${minutes}&polygons=true&access_token=${mapboxgl.accessToken}`
        );
        const data = await response.json();
        
        if (data.features?.length > 0) {
            map.addSource('isochrone', { type: 'geojson', data: data });
            map.addLayer({ id: 'isochrone-fill', type: 'fill', source: 'isochrone', paint: { 'fill-color': '#4CAF50', 'fill-opacity': 0.15 }}, '3d-buildings');
            map.addLayer({ id: 'isochrone-outline', type: 'line', source: 'isochrone', paint: { 'line-color': '#4CAF50', 'line-width': 2 }}, '3d-buildings');
        }
    } catch (error) { console.error('Isochrone error:', error); }
}

function clearIsochrone() {
    if (map.getLayer('isochrone-fill')) map.removeLayer('isochrone-fill');
    if (map.getLayer('isochrone-outline')) map.removeLayer('isochrone-outline');
    if (map.getSource('isochrone')) map.removeSource('isochrone');
}

// ========================================
// GET NEARBY POIs FROM MAP TILES (Tilequery)
// ========================================

// Category filters based on Mapbox POI classes
const categoryFilters = {
    food: ['restaurant', 'cafe', 'bar', 'fast_food', 'food_and_drink', 'bakery', 'coffee'],
    hospital: ['hospital', 'clinic', 'doctor', 'pharmacy', 'medical', 'dentist'],
    school: ['school', 'college', 'university', 'education', 'kindergarten'],
    shop: ['shop', 'store', 'mall', 'supermarket', 'grocery', 'convenience', 'clothing'],
    bank: ['bank', 'atm', 'money'],
    gym: ['gym', 'fitness', 'sports', 'swimming']
};

// Colors for each category
const categoryColors = {
    food: '#e74c3c',
    hospital: '#3498db',
    school: '#9b59b6',
    shop: '#f39c12',
    bank: '#1abc9c',
    gym: '#e67e22'
};

async function getNearbyPOIs(lng, lat, radius = 500) {
    try {
        const response = await fetch(
            `https://api.mapbox.com/v4/mapbox.mapbox-streets-v8/tilequery/${lng},${lat}.json?` +
            `radius=${radius}&limit=50&layers=poi_label&access_token=${mapboxgl.accessToken}`
        );
        const data = await response.json();
        return data.features || [];
    } catch (error) {
        console.error('Tilequery error:', error);
        return [];
    }
}

// Show POIs filtered by selected categories
async function showNearbyPOIsFiltered(lng, lat, categories) {
    clearAmenityMarkers();
    
    if (!categories || categories.length === 0) return 0;
    
    const pois = await getNearbyPOIs(lng, lat, 500); // 500m = ~5 min walk
    let count = 0;
    
    pois.forEach(poi => {
        const poiClass = (poi.properties.class || poi.properties.type || '').toLowerCase();
        const poiMaki = (poi.properties.maki || '').toLowerCase();
        const poiName = poi.properties.name || poi.properties.name_en || '';
        
        if (!poiName) return;
        
        // Find which selected category this POI matches
        let matchedCategory = null;
        for (const cat of categories) {
            const filters = categoryFilters[cat] || [];
            if (filters.some(f => poiClass.includes(f) || poiMaki.includes(f))) {
                matchedCategory = cat;
                break;
            }
        }
        
        if (!matchedCategory) return;
        
        const icon = amenityIcons[matchedCategory] || amenityIcons.food;
        const color = categoryColors[matchedCategory] || '#e74c3c';
        
        const el = document.createElement('div');
        el.className = 'amenity-marker';
        el.innerHTML = icon;
        el.style.background = color;
        
        const marker = new mapboxgl.Marker({ element: el })
            .setLngLat(poi.geometry.coordinates)
            .setPopup(new mapboxgl.Popup({ offset: 20, className: 'poi-popup' }).setHTML(`
                <div class="poi-popup-content">
                    <div class="poi-icon" style="background: ${color}">${icon}</div>
                    <div class="poi-info">
                        <div class="poi-name">${poiName}</div>
                        <div class="poi-type">${poiClass.replace(/_/g, ' ')}</div>
                    </div>
                </div>
            `))
            .addTo(map);
        
        amenityMarkers.push(marker);
        count++;
    });
    
    return count;
}

function clearAmenityMarkers() {
    amenityMarkers.forEach(m => m.remove());
    amenityMarkers = [];
}

// ========================================
// COMPACT PROPERTY POPUP
// ========================================

function showPropertyPopup(property) {
    if (activePopup) activePopup.remove();
    selectedProperty = property;
    
    const popupHTML = `
        <div class="map-popup-card compact" onclick="goToProperty(${property.id})">
            <div class="popup-img" style="background-image: url('${property.image}')">
                <span class="popup-tag">For Rent</span>
            </div>
            <div class="popup-body">
                <div class="popup-price">₱${property.price.toLocaleString()}<span>/mo</span></div>
                <div class="popup-stats">
                    <span>${amenityIcons.food.replace('stroke-width="2"', 'stroke-width="2" class="stat-icon"')} ${property.bedrooms}</span>
                    <span>${property.bathrooms} bath</span>
                    <span>${property.size}m²</span>
                </div>
                <div class="popup-loc">${property.address}</div>
                
                <div class="popup-controls">
                    <div class="iso-row">
                        <button class="iso-btn active" data-min="5">5m</button>
                        <button class="iso-btn" data-min="10">10m</button>
                        <button class="iso-btn" data-min="15">15m</button>
                        <span class="divider"></span>
                        <button class="mode-btn active" data-mode="walking">${amenityIcons.gym}</button>
                        <button class="mode-btn" data-mode="driving">${amenityIcons.shop}</button>
                    </div>
                    <div class="amenity-row">
                        <button class="cat-btn" data-cat="food" title="Food">${amenityIcons.food}</button>
                        <button class="cat-btn" data-cat="hospital" title="Hospital">${amenityIcons.hospital}</button>
                        <button class="cat-btn" data-cat="school" title="School">${amenityIcons.school}</button>
                        <button class="cat-btn" data-cat="shop" title="Shop">${amenityIcons.shop}</button>
                        <button class="cat-btn" data-cat="bank" title="Bank">${amenityIcons.bank}</button>
                        <button class="cat-btn" data-cat="gym" title="Gym">${amenityIcons.gym}</button>
                    </div>
                    <div class="poi-count"></div>
                </div>
                <div class="click-hint">Click card to view details</div>
            </div>
        </div>
    `;
    
    activePopup = new mapboxgl.Popup({ closeButton: true, closeOnClick: false, maxWidth: '260px', offset: [0, -10] })
        .setLngLat([property.lng, property.lat])
        .setHTML(popupHTML)
        .addTo(map);
    
    showIsochrone(property.lng, property.lat, 5, 'walking');
    setTimeout(() => setupPopupListeners(property), 100);
    
    activePopup.on('close', () => {
        document.querySelectorAll('.price-marker').forEach(m => m.classList.remove('active'));
        clearIsochrone();
        clearAmenityMarkers();
        activePopup = null;
        selectedProperty = null;
    });
}

function setupPopupListeners(property) {
    const popup = document.querySelector('.mapboxgl-popup-content');
    if (!popup) return;
    
    // Stop click propagation on controls
    popup.querySelectorAll('.popup-controls').forEach(el => {
        el.addEventListener('click', e => e.stopPropagation());
    });
    
    // Isochrone buttons
    popup.querySelectorAll('.iso-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            popup.querySelectorAll('.iso-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const mode = popup.querySelector('.mode-btn.active')?.dataset.mode || 'walking';
            showIsochrone(property.lng, property.lat, parseInt(btn.dataset.min), mode);
        });
    });
    
    // Mode buttons
    popup.querySelectorAll('.mode-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            popup.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const minutes = parseInt(popup.querySelector('.iso-btn.active')?.dataset.min || 5);
            showIsochrone(property.lng, property.lat, minutes, btn.dataset.mode);
        });
    });
    
    // Category buttons - use Tilequery with actual category filter
    popup.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.stopPropagation();
            btn.classList.toggle('active');
            
            const activeCategories = Array.from(popup.querySelectorAll('.cat-btn.active')).map(b => b.dataset.cat);
            const countEl = popup.querySelector('.poi-count');
            
            if (activeCategories.length > 0) {
                countEl.textContent = 'Searching...';
                // Pass selected categories to filter POIs
                const count = await showNearbyPOIsFiltered(property.lng, property.lat, activeCategories);
                countEl.textContent = count > 0 ? `${count} places found` : 'No places found';
            } else {
                clearAmenityMarkers();
                countEl.textContent = '';
            }
        });
    });
}

// ========================================
// 3D BUILDINGS & TERRAIN
// ========================================

function add3DBuildings() {
    if (map.getLayer('3d-buildings')) return;
    const layers = map.getStyle().layers;
    let labelLayerId;
    for (let i = 0; i < layers.length; i++) {
        if (layers[i].type === 'symbol' && layers[i].layout['text-field']) { labelLayerId = layers[i].id; break; }
    }
    map.addLayer({
        id: '3d-buildings', source: 'composite', 'source-layer': 'building',
        filter: ['==', 'extrude', 'true'], type: 'fill-extrusion', minzoom: 14,
        paint: {
            'fill-extrusion-color': ['interpolate', ['linear'], ['get', 'height'], 0, '#e8e8e8', 50, '#c5c5c5', 100, '#a0a0a0', 200, '#808080'],
            'fill-extrusion-height': ['interpolate', ['linear'], ['zoom'], 14, 0, 14.5, ['get', 'height']],
            'fill-extrusion-base': ['interpolate', ['linear'], ['zoom'], 14, 0, 14.5, ['get', 'min_height']],
            'fill-extrusion-opacity': 0.8
        }
    }, labelLayerId);
}

function add3DTerrain() {
    if (!map.getSource('mapbox-dem')) {
        map.addSource('mapbox-dem', { type: 'raster-dem', url: 'mapbox://mapbox.mapbox-terrain-dem-v1', tileSize: 512, maxzoom: 14 });
    }
    map.setTerrain({ source: 'mapbox-dem', exaggeration: 1.5 });
    if (!map.getLayer('sky')) {
        map.addLayer({ id: 'sky', type: 'sky', paint: { 'sky-type': 'atmosphere', 'sky-atmosphere-sun': [0.0, 90.0], 'sky-atmosphere-sun-intensity': 15 }});
    }
}

// ========================================
// MAP CONTROLS
// ========================================

function addMapControls() {
    const mapContainer = document.getElementById('mapViewContainer');
    if (!mapContainer || document.getElementById('mapStyleControls')) return;
    
    const controlPanel = document.createElement('div');
    controlPanel.id = 'mapStyleControls';
    controlPanel.className = 'map-style-controls';
    controlPanel.innerHTML = `
        <button class="map-control-btn active" data-action="3d" title="3D">3D</button>
        <button class="map-control-btn" data-action="terrain" title="Terrain">T</button>
        <button class="map-control-btn" data-action="satellite" title="Satellite">S</button>
        <button class="map-control-btn" data-action="reset" title="Reset">↺</button>
    `;
    mapContainer.appendChild(controlPanel);
    controlPanel.querySelectorAll('.map-control-btn').forEach(btn => btn.addEventListener('click', () => handleMapControl(btn.dataset.action, btn)));
}

function handleMapControl(action, btn) {
    switch(action) {
        case '3d': toggle3DBuildings(btn); break;
        case 'terrain': toggleTerrain(btn); break;
        case 'satellite': toggleSatellite(btn); break;
        case 'reset': resetMapView(); break;
    }
}

function toggle3DBuildings(btn) {
    const layer = map.getLayer('3d-buildings');
    if (layer) {
        const vis = map.getLayoutProperty('3d-buildings', 'visibility');
        map.setLayoutProperty('3d-buildings', 'visibility', vis === 'none' ? 'visible' : 'none');
        btn.classList.toggle('active', vis === 'none');
    }
}

function toggleTerrain(btn) {
    if (map.getTerrain()) { map.setTerrain(null); btn.classList.remove('active'); }
    else { map.setTerrain({ source: 'mapbox-dem', exaggeration: 1.5 }); btn.classList.add('active'); }
}

async function toggleSatellite(btn) {
    const isSat = map.getStyle().name?.includes('Satellite');
    map.setStyle(isSat ? 'mapbox://styles/mapbox/streets-v12' : 'mapbox://styles/mapbox/satellite-streets-v12');
    btn.classList.toggle('active', !isSat);
    // Global style.load listener in initPropertyMap will handle rebuilding layers
}

function resetMapView() {
    map.flyTo({ center: [123.9056, 10.3301], zoom: 14, pitch: 45, bearing: -15, duration: 1500 });
    clearIsochrone();
    clearAmenityMarkers();
    if (activePopup) activePopup.remove();
}

// ========================================
// PROPERTY MARKERS
// ========================================

function addPropertyMarkers(properties) {
    // Remove old markers
    markers.forEach(m => m.remove());
    markers = [];
    
    // Remove old cluster layers/source if exist
    if (map.getLayer('clusters')) map.removeLayer('clusters');
    if (map.getLayer('cluster-count')) map.removeLayer('cluster-count');
    if (map.getLayer('unclustered-point')) map.removeLayer('unclustered-point');
    if (map.getSource('properties')) map.removeSource('properties');
    
    // Create GeoJSON from properties
    const geojson = {
        type: 'FeatureCollection',
        features: properties.map(p => ({
            type: 'Feature',
            geometry: { type: 'Point', coordinates: [p.lng, p.lat] },
            properties: { 
                id: p.id, 
                title: p.title, 
                price: p.price, 
                priceFormatted: p.priceFormatted,
                bedrooms: p.bedrooms,
                bathrooms: p.bathrooms,
                size: p.size,
                address: p.address,
                image: p.image
            }
        }))
    };
    
    // Add source with clustering
    map.addSource('properties', {
        type: 'geojson',
        data: geojson,
        cluster: true,
        clusterMaxZoom: 14, // Max zoom to cluster
        clusterRadius: 50 // Cluster radius in pixels
    });
    
    // Cluster circles
    map.addLayer({
        id: 'clusters',
        type: 'circle',
        source: 'properties',
        filter: ['has', 'point_count'],
        paint: {
            'circle-color': ['step', ['get', 'point_count'], '#667eea', 10, '#5a67d8', 30, '#4c51bf'],
            'circle-radius': ['step', ['get', 'point_count'], 20, 10, 30, 30, 40]
        }
    });
    
    // Cluster count label
    map.addLayer({
        id: 'cluster-count',
        type: 'symbol',
        source: 'properties',
        filter: ['has', 'point_count'],
        layout: {
            'text-field': '{point_count_abbreviated}',
            'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
            'text-size': 14
        },
        paint: { 'text-color': '#ffffff' }
    });
    
    // Click on cluster to zoom in
    map.on('click', 'clusters', (e) => {
        const features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
        const clusterId = features[0].properties.cluster_id;
        map.getSource('properties').getClusterExpansionZoom(clusterId, (err, zoom) => {
            if (err) return;
            map.easeTo({ center: features[0].geometry.coordinates, zoom: zoom });
        });
    });
    
    // Add individual markers for unclustered points
    if (window.propertyDataListener) {
        map.off('data', window.propertyDataListener);
    }
    
    window.propertyDataListener = (e) => {
        if (e.sourceId !== 'properties') return;
        // Wait for source loaded OR just tile load
        if (e.isSourceLoaded || (e.tile && e.tile.state === 'loaded')) {
             updateUnclusteredMarkers(properties);
        }
    };
    
    map.on('data', window.propertyDataListener);
    
    // Initial render - try immediately, but might need delay if source not ready
    updateUnclusteredMarkers(properties);
    // Also retry once briefly to catch race conditions where source loads fast but 'data' event missed/fired early
    setTimeout(() => updateUnclusteredMarkers(properties), 500);
    
    map.on('mouseenter', 'clusters', () => map.getCanvas().style.cursor = 'pointer');
    map.on('mouseleave', 'clusters', () => map.getCanvas().style.cursor = '');
}

function updateUnclusteredMarkers(properties) {
    // Remove existing unclustered markers
    markers.forEach(m => m.remove());
    markers = [];
    
    // Get visible unclustered features
    const features = map.querySourceFeatures('properties', { filter: ['!', ['has', 'point_count']] });
    
    features.forEach(feature => {
        const coords = feature.geometry.coordinates;
        const props = feature.properties;
        
        // Check if marker already exists at this location
        const existingMarker = markers.find(m => {
            const lngLat = m.getLngLat();
            return lngLat.lng === coords[0] && lngLat.lat === coords[1];
        });
        if (existingMarker) return;
        
        const el = document.createElement('div');
        el.className = 'price-marker';
        el.textContent = props.priceFormatted;
        el.dataset.id = props.id;
        
        const marker = new mapboxgl.Marker({ element: el, anchor: 'center' })
            .setLngLat(coords)
            .addTo(map);
        
        el.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.price-marker').forEach(m => m.classList.remove('active'));
            el.classList.add('active');
            
            // Find full property data
            const property = properties.find(p => p.id === props.id);
            if (property) {
                map.flyTo({ center: [property.lng, property.lat], zoom: 17, pitch: 60, bearing: 0, duration: 1000 });
                setTimeout(() => showPropertyPopup(property), 1000);
            }
        });
        
        markers.push(marker);
    });
}


function goToProperty(propertyId) { window.location.href = `/property/${propertyId}`; }

// ========================================
// INTEGRATION
// ========================================

// Expose initPropertyMap globally so filter.js can call it
window.initPropertyMap = initPropertyMap;

document.addEventListener('DOMContentLoaded', function() {
    const fullMapContainer = document.getElementById('mapViewContainer');
    if (fullMapContainer) {
        // Use MutationObserver to detect when the map container becomes visible
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    const isVisible = fullMapContainer.style.display !== 'none';
                    if (isVisible && !map) {
                        setTimeout(initPropertyMap, 100);
                    }
                }
            });
        });
        observer.observe(fullMapContainer, { attributes: true });
    }
    
    // Cleanup map on page unload to prevent memory leaks
    function cleanupMap() {
        if (activePopup) {
            activePopup.remove();
            activePopup = null;
        }
        markers.forEach(marker => marker.remove());
        markers = [];
        amenityMarkers.forEach(marker => marker.remove());
        amenityMarkers = [];
        if (map) {
            map.remove();
            map = null;
        }
    }
    
    window.addEventListener('beforeunload', cleanupMap);
    window.addEventListener('pagehide', cleanupMap);
});

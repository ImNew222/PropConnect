/* ========================================
   PROPERTY DETAIL MAP
   Interactive Mapbox map with directions
   ======================================== */

(function() {
    'use strict';
    
    // Get Mapbox token from window or use default
    const MAPBOX_TOKEN = window.MAPBOX_ACCESS_TOKEN || '';
    mapboxgl.accessToken = MAPBOX_TOKEN;
    
    let map = null;
    let marker = null;
    let userMarker = null;
    let directionsRoute = null;
    let userLocation = null;
    let isExpanded = false;
    
    // Map styles
    const mapStyles = {
        street: 'mapbox://styles/mapbox/streets-v12',
        satellite: 'mapbox://styles/mapbox/satellite-streets-v12',
        '3d': 'mapbox://styles/mapbox/standard'
    };
    
    // DOM Elements
    let mapContainer = null;
    let expandOverlay = null;
    let propertyLat = 10.3157;
    let propertyLng = 123.8854;
    let propertyAddress = '';
    
    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', init);
    
    function init() {
        mapContainer = document.getElementById('propertyDetailMap');
        if (!mapContainer) return;
        
        // Get property coordinates from data attributes
        propertyLat = parseFloat(mapContainer.dataset.lat) || 10.3157;
        propertyLng = parseFloat(mapContainer.dataset.lng) || 123.8854;
        propertyAddress = mapContainer.dataset.address || 'Property Location';
        
        initMap();
        setupControls();
        createExpandOverlay();
    }
    
    function initMap() {
        map = new mapboxgl.Map({
            container: 'propertyDetailMap',
            style: mapStyles.street,
            center: [propertyLng, propertyLat],
            zoom: 15,
            pitch: 45
        });
        
        // Add navigation controls
        map.addControl(new mapboxgl.NavigationControl(), 'top-right');
        
        // Add property marker
        const markerEl = document.createElement('div');
        markerEl.className = 'property-marker';
        markerEl.innerHTML = `
            <svg viewBox="0 0 24 24" fill="#e74c3c" stroke="#fff" stroke-width="2" width="40" height="40">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3" fill="#fff"/>
            </svg>
        `;
        
        marker = new mapboxgl.Marker(markerEl)
            .setLngLat([propertyLng, propertyLat])
            .setPopup(new mapboxgl.Popup().setHTML(`<strong>${propertyAddress}</strong>`))
            .addTo(map);
        
        // Enable 3D buildings on load
        map.on('load', () => {
            add3DBuildings();
        });
    }
    
    function add3DBuildings() {
        const layers = map.getStyle().layers;
        const labelLayerId = layers.find(
            (layer) => layer.type === 'symbol' && layer.layout['text-field']
        )?.id;
        
        if (!map.getLayer('3d-buildings')) {
            map.addLayer({
                'id': '3d-buildings',
                'source': 'composite',
                'source-layer': 'building',
                'filter': ['==', 'extrude', 'true'],
                'type': 'fill-extrusion',
                'minzoom': 15,
                'paint': {
                    'fill-extrusion-color': '#aaa',
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'min_height'],
                    'fill-extrusion-opacity': 0.6
                }
            }, labelLayerId);
        }
    }
    
    function setupControls() {
        // Style toggle buttons
        document.querySelectorAll('.map-style-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const style = btn.dataset.style;
                map.setStyle(mapStyles[style]);
                
                // Re-add 3D buildings after style change
                map.once('style.load', () => {
                    add3DBuildings();
                    if (directionsRoute) {
                        addRouteToMap(directionsRoute);
                    }
                });
                
                // Update active state
                document.querySelectorAll('.map-style-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
        
        // Expand button
        const expandBtn = document.querySelector('.map-expand-btn');
        if (expandBtn) {
            expandBtn.addEventListener('click', toggleExpand);
        }
        
        // Get directions button
        const directionsBtn = document.querySelector('.get-directions-btn');
        if (directionsBtn) {
            directionsBtn.addEventListener('click', getDirections);
        }
        
        // Open in Google Maps button
        const googleMapsBtn = document.querySelector('.open-google-maps-btn');
        if (googleMapsBtn) {
            googleMapsBtn.addEventListener('click', openInGoogleMaps);
        }
        
        // Travel mode buttons
        document.querySelectorAll('.travel-mode-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.travel-mode-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                if (userLocation) {
                    calculateRoute(btn.dataset.mode);
                }
            });
        });
    }
    
    function createExpandOverlay() {
        expandOverlay = document.createElement('div');
        expandOverlay.className = 'map-expand-overlay';
        expandOverlay.innerHTML = `
            <div class="expanded-map-container">
                <div class="expanded-map-header">
                    <h3>Property Location</h3>
                    <button class="close-expand-btn" aria-label="Close">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div id="expandedMap" class="expanded-map"></div>
                <div class="expanded-map-controls">
                    <div class="directions-panel" id="directionsPanel">
                        <div class="directions-info" id="directionsInfo"></div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(expandOverlay);
        
        // Close button
        expandOverlay.querySelector('.close-expand-btn').addEventListener('click', toggleExpand);
        expandOverlay.addEventListener('click', (e) => {
            if (e.target === expandOverlay) toggleExpand();
        });
    }
    
    function toggleExpand() {
        isExpanded = !isExpanded;
        expandOverlay.classList.toggle('active', isExpanded);
        document.body.style.overflow = isExpanded ? 'hidden' : '';
        
        if (isExpanded) {
            // Create expanded map
            setTimeout(() => {
                const expandedMapContainer = document.getElementById('expandedMap');
                if (!expandedMapContainer._map) {
                    const expandedMap = new mapboxgl.Map({
                        container: 'expandedMap',
                        style: mapStyles.street,
                        center: [propertyLng, propertyLat],
                        zoom: 15,
                        pitch: 45
                    });
                    
                    expandedMap.addControl(new mapboxgl.NavigationControl(), 'top-right');
                    expandedMap.addControl(new mapboxgl.FullscreenControl(), 'top-right');
                    
                    // Add marker
                    const markerEl = document.createElement('div');
                    markerEl.className = 'property-marker';
                    markerEl.innerHTML = `
                        <svg viewBox="0 0 24 24" fill="#e74c3c" stroke="#fff" stroke-width="2" width="50" height="50">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3" fill="#fff"/>
                        </svg>
                    `;
                    new mapboxgl.Marker(markerEl)
                        .setLngLat([propertyLng, propertyLat])
                        .addTo(expandedMap);
                    
                    expandedMap.on('load', () => {
                        add3DBuildingsToMap(expandedMap);
                    });
                    
                    expandedMapContainer._map = expandedMap;
                }
            }, 100);
        }
    }
    
    function add3DBuildingsToMap(targetMap) {
        const layers = targetMap.getStyle().layers;
        const labelLayerId = layers.find(
            (layer) => layer.type === 'symbol' && layer.layout['text-field']
        )?.id;
        
        if (!targetMap.getLayer('3d-buildings')) {
            targetMap.addLayer({
                'id': '3d-buildings',
                'source': 'composite',
                'source-layer': 'building',
                'filter': ['==', 'extrude', 'true'],
                'type': 'fill-extrusion',
                'minzoom': 15,
                'paint': {
                    'fill-extrusion-color': '#aaa',
                    'fill-extrusion-height': ['get', 'height'],
                    'fill-extrusion-base': ['get', 'min_height'],
                    'fill-extrusion-opacity': 0.6
                }
            }, labelLayerId);
        }
    }
    
    async function getDirections() {
        const directionsBtn = document.querySelector('.get-directions-btn');
        directionsBtn.textContent = 'Getting location...';
        directionsBtn.disabled = true;
        
        try {
            const position = await getCurrentPosition();
            userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            showUserOnMap();
            
        } catch (error) {
            console.error('Geolocation error:', error);
            // Fallback: Ask for manual address input
            showAddressInput();
        }
        
        directionsBtn.textContent = 'Get Directions';
        directionsBtn.disabled = false;
    }
    
    function showUserOnMap() {
        // Add user marker
        if (userMarker) userMarker.remove();
        const userEl = document.createElement('div');
        userEl.className = 'user-marker';
        userEl.innerHTML = `
            <div class="user-marker-dot"></div>
            <div class="user-marker-pulse"></div>
        `;
        userMarker = new mapboxgl.Marker(userEl)
            .setLngLat([userLocation.lng, userLocation.lat])
            .addTo(map);
        
        // Show travel mode panel
        document.querySelector('.travel-modes-panel').classList.add('active');
        
        // Calculate route with default mode (driving)
        calculateRoute('driving');
    }
    
    function showAddressInput() {
        // Remove existing input if any
        document.querySelector('.address-input-panel')?.remove();
        
        const panel = document.createElement('div');
        panel.className = 'address-input-panel active';
        panel.innerHTML = `
            <div class="address-input-header">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Enter your location:</span>
                <button class="close-address-input">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="address-input-row">
                <input type="text" class="address-input" placeholder="e.g. IT Park Cebu, Lahug">
            </div>
            <div class="address-suggestions"></div>
        `;
        
        document.querySelector('.property-map').appendChild(panel);
        
        // Close button
        panel.querySelector('.close-address-input').addEventListener('click', () => {
            panel.remove();
        });
        
        
        // Search on Enter or after typing
        const input = panel.querySelector('.address-input');
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && input.value) {
                geocodeAddress(input.value, panel);
            }
        });
        
        // Also search as user types (debounced)
        let searchTimeout;
        input.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            if (input.value.length > 2) {
                searchTimeout = setTimeout(() => geocodeAddress(input.value, panel), 500);
            }
        });
        
        // Focus input
        panel.querySelector('.address-input').focus();
    }
    
    async function geocodeAddress(address, panel) {
        const suggestionsEl = panel.querySelector('.address-suggestions');
        suggestionsEl.innerHTML = '<div class="searching">Searching...</div>';
        
        try {
            const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${MAPBOX_TOKEN}&country=ph&limit=5`;
            const response = await fetch(url);
            const data = await response.json();
            
            if (data.features && data.features.length > 0) {
                suggestionsEl.innerHTML = data.features.map(f => `
                    <div class="address-suggestion" data-lng="${f.center[0]}" data-lat="${f.center[1]}">
                        <strong>${f.text}</strong>
                        <span>${f.place_name}</span>
                    </div>
                `).join('');
                
                // Add click handlers
                suggestionsEl.querySelectorAll('.address-suggestion').forEach(item => {
                    item.addEventListener('click', () => {
                        userLocation = {
                            lat: parseFloat(item.dataset.lat),
                            lng: parseFloat(item.dataset.lng)
                        };
                        panel.remove();
                        showUserOnMap();
                    });
                });
            } else {
                suggestionsEl.innerHTML = '<div class="no-results">No results found</div>';
            }
        } catch (error) {
            console.error('Geocoding error:', error);
            suggestionsEl.innerHTML = '<div class="error">Search failed. Try again.</div>';
        }
    }
    
    function getCurrentPosition() {
        return new Promise((resolve, reject) => {
            if (!navigator.geolocation) {
                reject(new Error('Geolocation not supported'));
                return;
            }
            navigator.geolocation.getCurrentPosition(resolve, reject, {
                enableHighAccuracy: true,
                timeout: 10000
            });
        });
    }
    
    async function calculateRoute(mode) {
        if (!userLocation) return;
        
        const modeMap = {
            driving: 'driving',
            walking: 'walking',
            transit: 'driving' // Mapbox doesn't have transit, use driving as fallback
        };
        
        const profile = modeMap[mode] || 'driving';
        const url = `https://api.mapbox.com/directions/v5/mapbox/${profile}/${userLocation.lng},${userLocation.lat};${propertyLng},${propertyLat}?geometries=geojson&access_token=${MAPBOX_TOKEN}`;
        
        try {
            const response = await fetch(url);
            const data = await response.json();
            
            if (data.routes && data.routes.length > 0) {
                directionsRoute = data.routes[0];
                addRouteToMap(directionsRoute);
                showDirectionsInfo(directionsRoute, mode);
            }
        } catch (error) {
            console.error('Directions error:', error);
        }
    }
    
    function addRouteToMap(route) {
        // Remove existing route
        if (map.getSource('route')) {
            map.removeLayer('route-line');
            map.removeSource('route');
        }
        
        map.addSource('route', {
            type: 'geojson',
            data: {
                type: 'Feature',
                properties: {},
                geometry: route.geometry
            }
        });
        
        map.addLayer({
            id: 'route-line',
            type: 'line',
            source: 'route',
            layout: {
                'line-join': 'round',
                'line-cap': 'round'
            },
            paint: {
                'line-color': '#3b82f6',
                'line-width': 5,
                'line-opacity': 0.8
            }
        });
        
        // Fit bounds to show full route
        const coordinates = route.geometry.coordinates;
        const bounds = coordinates.reduce((bounds, coord) => {
            return bounds.extend(coord);
        }, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));
        
        map.fitBounds(bounds, { padding: 60 });
    }
    
    function showDirectionsInfo(route, mode) {
        const distance = (route.distance / 1000).toFixed(1);
        const duration = Math.round(route.duration / 60);
        
        const modeIcons = {
            driving: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M5 11l1.5-4.5a2 2 0 0 1 1.9-1.5h7.2a2 2 0 0 1 1.9 1.5L19 11"/><path d="M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/><circle cx="6.5" cy="15.5" r="1.5"/><circle cx="17.5" cy="15.5" r="1.5"/></svg>',
            walking: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><circle cx="12" cy="5" r="2"/><path d="M14 10l-2 8-3-3-2 5"/><path d="M10 10l2-2 4 4"/></svg>',
            transit: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><rect x="4" y="3" width="16" height="16" rx="2"/><path d="M4 11h16"/><circle cx="8" cy="15" r="1"/><circle cx="16" cy="15" r="1"/></svg>'
        };
        
        const infoEl = document.querySelector('.directions-info');
        if (infoEl) {
            infoEl.innerHTML = `
                <div class="route-summary">
                    <span class="route-mode">${modeIcons[mode]}</span>
                    <span class="route-distance">${distance} km</span>
                    <span class="route-duration">${duration} min</span>
                </div>
            `;
            infoEl.classList.add('active');
        }
    }
    
    function openInGoogleMaps() {
        const url = `https://www.google.com/maps/dir/?api=1&destination=${propertyLat},${propertyLng}`;
        window.open(url, '_blank');
    }
    
    // Cleanup on page unload
    function cleanup() {
        if (map) {
            map.remove();
            map = null;
        }
        if (expandOverlay) {
            expandOverlay.remove();
        }
    }
    
    window.addEventListener('beforeunload', cleanup);
    window.addEventListener('pagehide', cleanup);
})();

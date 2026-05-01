/**
 * Property Loader Module
 * Handles fetching properties from the API and rendering them dynamically
 */

class PropertyLoader {
    constructor() {
        this.currentPage = 1;
        this.isLoading = false;
        this.filters = {};
        this.container = document.getElementById('propertyListings');
        this.gridContainer = document.getElementById('gridListings');
        this.resultsCount = document.getElementById('resultsCount');
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        this.init();
    }

    init() {
        // Read URL parameters from homepage search
        this.parseUrlParams();
        
        // Load properties on page load
        this.loadProperties();
        
        // Setup event listeners
        this.setupFilterListeners();
        this.setupSortListener();
        this.setupSearchListener();
        this.setupViewToggle();
    }
    
    parseUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Text search query (from "Looking For" field)
        if (urlParams.has('q')) {
            this.filters.search = urlParams.get('q');
            // Also update the search input if it exists
            const searchInput = document.getElementById('propertySearch');
            if (searchInput) {
                searchInput.value = urlParams.get('q');
            }
        }
        
        // Property type filter (from Type dropdown)
        if (urlParams.has('type')) {
            this.filters.type = urlParams.get('type');
            // Check the corresponding checkbox if it exists
            const typeCheckbox = document.querySelector(`input[name="property_type"][value="${urlParams.get('type')}"]`);
            if (typeCheckbox) {
                typeCheckbox.checked = true;
            }
        }
        
        // Price range filter
        if (urlParams.has('price')) {
            const priceRange = urlParams.get('price');
            const [min, max] = priceRange.split('-');
            if (min) this.filters.min_price = min;
            if (max && max !== '+') this.filters.max_price = max;
            // Update price inputs
            const priceMin = document.getElementById('priceMin');
            const priceMax = document.getElementById('priceMax');
            if (priceMin && min) priceMin.value = min;
            if (priceMax && max && max !== '+') priceMax.value = max;
        }
        
        // Location filter
        if (urlParams.has('location')) {
            this.filters.city = urlParams.get('location').replace(/-/g, ' ');
        }
        
        console.log('PropertyLoader: Applied URL filters:', this.filters);
    }

    async loadProperties(append = false) {
        if (this.isLoading) return;
        this.isLoading = true;

        const cacheKey = `properties_page_${this.currentPage}_${JSON.stringify(this.filters)}`;
        const CACHE_TTL = 5 * 60 * 1000; // 5 minutes
        
        // Skip cache for filtered searches to always show fresh results
        const hasFilters = Object.keys(this.filters).length > 0;

        if (!append && !hasFilters) {
            // Try to show cached data immediately (only when no filters)
            const cached = this.getCachedData(cacheKey);
            if (cached) {
                this.clearContainers();
                this.renderProperties(cached.properties);
                this.updateResultsCount(cached.pagination.total);
                this.updatePagination(cached.pagination);
                this.ensureViewVisible();
            } else {
                this.showLoading();
            }
        } else {
            this.showLoading();
        }

        try {
            const params = new URLSearchParams({
                page: this.currentPage,
                per_page: 12,
                ...this.filters
            });

            console.log('PropertyLoader: Fetching /api/properties?' + params.toString());
            const response = await fetch(`/api/properties?${params}`);
            const data = await response.json();
            console.log('PropertyLoader: Got', data.properties?.length, 'properties');

            // Cache the response (but not for filtered results)
            if (!hasFilters) {
                this.setCachedData(cacheKey, data, CACHE_TTL);
            }

            if (!append) {
                this.clearContainers();
            }

            this.renderProperties(data.properties);
            this.updateResultsCount(data.pagination.total);
            this.updatePagination(data.pagination);
            
            // Ensure the active view container is visible after loading
            this.ensureViewVisible();
            
        } catch (error) {
            console.error('Failed to load properties:', error);
            this.showError();
        } finally {
            this.isLoading = false;
        }
    }
    
    ensureViewVisible() {
        // Get current view from localStorage or default to list (1)
        const viewMode = parseInt(localStorage.getItem('propertyViewMode') || '1');
        
        const listContainer = document.getElementById('listViewContainer');
        const gridContainer = document.getElementById('gridViewContainer');
        
        // Make sure the correct container is visible
        if (viewMode === 0 && gridContainer) {
            gridContainer.style.display = 'block';
        } else if (viewMode === 1 && listContainer) {
            listContainer.style.display = 'block';
        }
        
        // Dispatch event for other scripts to know properties are loaded
        document.dispatchEvent(new CustomEvent('propertiesLoaded'));
    }

    renderProperties(properties) {
        if (properties.length === 0) {
            this.showNoResults();
            return;
        }

        properties.forEach(property => {
            // Render in list view
            if (this.container) {
                this.container.appendChild(this.createListCard(property));
            }
            // Render in grid view
            if (this.gridContainer) {
                this.gridContainer.appendChild(this.createGridCard(property));
            }
        });
    }

    createListCard(property) {
        const article = document.createElement('article');
        article.className = 'property-card revealed';  // Add 'revealed' for immediate visibility
        article.dataset.propertyId = property.id;
        
        // Generate amenity tags (show up to 2 key amenities)
        const keyAmenities = ['pet_friendly', 'furnished', 'wifi', 'aircon', 'pool', 'gym'];
        const displayAmenities = (property.amenities || [])
            .filter(a => keyAmenities.includes(a))
            .slice(0, 2);
        
        const amenitiesHtml = displayAmenities.map(a => {
            const icons = {
                pet_friendly: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M4.5 11.5c.28 0 .5-.34.5-.75s-.22-.75-.5-.75-.5.34-.5.75.22.75.5.75zm4-2c.28 0 .5-.34.5-.75s-.22-.75-.5-.75-.5.34-.5.75.22.75.5.75zm7 0c.28 0 .5-.34.5-.75s-.22-.75-.5-.75-.5.34-.5.75.22.75.5.75zm4 2c.28 0 .5-.34.5-.75s-.22-.75-.5-.75-.5.34-.5.75.22.75.5.75zM12 9c-1.1 0-2 .9-2 2 0 .73.41 1.38 1 1.73V15c0 .55.45 1 1 1s1-.45 1-1v-2.27c.59-.35 1-1 1-1.73 0-1.1-.9-2-2-2z"/></svg>`,
                furnished: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="8"></rect><path d="M5 11V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4"></path></svg>`,
                wifi: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><circle cx="12" cy="20" r="1"></circle></svg>`,
                aircon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"></rect><path d="M8 21h8"></path><path d="M12 17v4"></path></svg>`,
                pool: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20"></path><path d="M2 16h20"></path></svg>`,
                gym: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 4v16M18 4v16M4 8h4M16 8h4M4 16h4M16 16h4"></path></svg>`
            };
            return `<span class="property-tag ${a}">
                ${icons[a] || ''}
                ${this.formatAmenity(a)}
            </span>`;
        }).join('');

        // Generate 3 placeholder images for swiper
        const placeholderImages = [
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400',
            'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=400',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400',
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400',
            'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400',
            'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=400'
        ];
        
        // Get 3 unique images for this property
        // Get images for swiper (use API images or fall back to placeholders)
        const imageIndex = property.id % placeholderImages.length;
        let propertyImages = [];
        
        if (property.images && property.images.length > 0) {
            propertyImages = property.images;
        } else if (property.image) {
            propertyImages = [property.image];
        } else {
            propertyImages = [
                placeholderImages[imageIndex],
                placeholderImages[(imageIndex + 1) % placeholderImages.length],
                placeholderImages[(imageIndex + 2) % placeholderImages.length]
            ];
        }

        // Truncate description
        const shortDesc = property.description 
            ? (property.description.length > 120 ? property.description.substring(0, 120) + '...' : property.description)
            : 'No description available.';

        // Generate static map image URL using Mapbox
        const lat = property.latitude || 10.3157;
        const lng = property.longitude || 123.8854;
        const mapToken = window.MAPBOX_ACCESS_TOKEN || '';
        const staticMapUrl = `https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/pin-s+667eea(${lng},${lat})/${lng},${lat},12,0/180x120@2x?access_token=${mapToken}`;

        // Generate swiper slides HTML
        const slidesHtml = propertyImages.map((img, idx) => 
            `<div class="swiper-slide ${idx === 0 ? 'active' : ''}" style="background-image: url('${img}'); background-size: cover; background-position: center;"></div>`
        ).join('');
        
        // Generate dots HTML
        const dotsHtml = propertyImages.map((_, idx) => 
            `<button class="swiper-dot ${idx === 0 ? 'active' : ''}" data-index="${idx}"></button>`
        ).join('');

        article.innerHTML = `
            <div class="property-image">
                <div class="image-swiper" data-current="0">
                    <div class="swiper-slides">
                        ${slidesHtml}
                    </div>
                    <button class="swiper-nav swiper-prev" aria-label="Previous image">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                    <button class="swiper-nav swiper-next" aria-label="Next image">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                    <div class="swiper-dots">
                        ${dotsHtml}
                    </div>
                </div>
                <button class="favorite-btn ${property.is_saved ? 'active' : ''}" 
                        data-property-id="${property.id}"
                        aria-label="${property.is_saved ? 'Remove from favorites' : 'Add to favorites'}">
                    <svg viewBox="0 0 24 24" fill="${property.is_saved ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </button>
            </div>
            
            <div class="property-details">
                <div class="property-header">
                    <div class="header-left">
                        <h3 class="property-title">${property.title}</h3>
                        <span class="property-badge">${this.capitalizeFirst(property.property_type)}</span>
                    </div>
                    <div class="property-price">${property.formatted_price}<small>/mo</small></div>
                </div>
                <p class="property-type">${property.address}</p>
                
                <div class="property-tags">
                    ${amenitiesHtml}
                </div>
                
                <div class="property-amenities">
                    <span class="amenity">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"></path><path d="M21 7H3l2-4h14l2 4z"></path></svg>
                        ${property.bedrooms}
                    </span>
                    <span class="amenity">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        ${property.bathrooms}
                    </span>
                    <span class="amenity">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect><path d="M3 9h18M9 21V9"></path></svg>
                        ${property.floor_area || '-'} m²
                    </span>
                </div>
                
                <div class="landlord-info">
                    <div class="landlord-avatar">
                        <div style="width:100%;height:100%;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:14px;border-radius:50%;">
                            ${property.landlord?.name?.charAt(0)?.toUpperCase() || 'L'}
                        </div>
                    </div>
                    <div class="landlord-details">
                        <div class="landlord-name">${property.landlord?.name || 'Landlord'}</div>
                        <div class="landlord-phone">${property.landlord?.phone || 'Contact via message'}</div>
                    </div>
                    <div class="landlord-contact">
                        <button class="contact-btn" aria-label="Message" onclick="event.stopPropagation();">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </button>
                        <button class="contact-btn" aria-label="Call" onclick="event.stopPropagation();">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="property-description">
                    <h5>Description</h5>
                    <p>${shortDesc}</p>
                </div>
                <span class="listing-date">Posted recently</span>
            </div>
            
            <div class="property-side">
                <div class="mapbox-container">
                    <img src="${staticMapUrl}" alt="Property location map" class="mini-map-image" loading="lazy">
                </div>
                <div class="location-info">
                    <div class="location-distance">Cebu City</div>
                    <div class="location-address">${property.address}</div>
                </div>
                <a href="/property/${property.id}" class="rent-cta" onclick="event.stopPropagation();">Rent</a>
            </div>
        `;

        // Setup favorite button
        const favBtn = article.querySelector('.favorite-btn');
        favBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.toggleFavorite(property.id, favBtn);
        });

        // Setup image swiper
        this.setupCardSwiper(article);

        // Make card clickable
        article.addEventListener('click', () => {
            window.location.href = `/property/${property.id}`;
        });

        return article;
    }

    setupCardSwiper(card) {
        const swiper = card.querySelector('.image-swiper');
        if (!swiper) return;
        
        const slides = swiper.querySelectorAll('.swiper-slide');
        const dots = swiper.querySelectorAll('.swiper-dot');
        const prevBtn = swiper.querySelector('.swiper-prev');
        const nextBtn = swiper.querySelector('.swiper-next');
        let current = 0;

        const goToSlide = (index) => {
            slides.forEach((s, i) => s.classList.toggle('active', i === index));
            dots.forEach((d, i) => d.classList.toggle('active', i === index));
            current = index;
        };

        prevBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            goToSlide(current > 0 ? current - 1 : slides.length - 1);
        });

        nextBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            goToSlide(current < slides.length - 1 ? current + 1 : 0);
        });

        dots.forEach((dot, idx) => {
            dot.addEventListener('click', (e) => {
                e.stopPropagation();
                goToSlide(idx);
            });
        });
    }

    createGridCard(property) {
        const article = document.createElement('article');
        article.className = 'grid-card revealed';  // Add 'revealed' for immediate visibility
        article.dataset.propertyId = property.id;

        // Generate 3 placeholder images for swiper
        const placeholderImages = [
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400',
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400',
            'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=400',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400',
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400',
            'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400',
            'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=400'
        ];
        
        // Get 3 unique images for this property
        // Get images for swiper (use API images or fall back to placeholders)
        const imageIndex = property.id % placeholderImages.length;
        let propertyImages = [];
        
        if (property.images && property.images.length > 0) {
            propertyImages = property.images;
        } else if (property.image) {
            propertyImages = [property.image];
        } else {
            propertyImages = [
                placeholderImages[imageIndex],
                placeholderImages[(imageIndex + 1) % placeholderImages.length],
                placeholderImages[(imageIndex + 2) % placeholderImages.length]
            ];
        }

        // Generate swiper slides HTML
        const slidesHtml = propertyImages.map((img, idx) => 
            `<div class="grid-slide ${idx === 0 ? 'active' : ''}" style="background-image: url('${img}'); background-size: cover; background-position: center;"></div>`
        ).join('');
        
        // Generate dots HTML
        const dotsHtml = propertyImages.map((_, idx) => 
            `<span class="dot ${idx === 0 ? 'active' : ''}" data-index="${idx}"></span>`
        ).join('');
        
        article.innerHTML = `
            <div class="grid-image">
                <div class="grid-swiper" data-current="0">
                    <div class="grid-slides">
                        ${slidesHtml}
                    </div>
                    <div class="grid-nav grid-prev">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </div>
                    <div class="grid-nav grid-next">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </div>
                <div class="image-dots">${dotsHtml}</div>
                <button class="favorite-btn ${property.is_saved ? 'active' : ''}" 
                        data-property-id="${property.id}">
                    <svg viewBox="0 0 24 24" fill="${property.is_saved ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </button>
            </div>
            <div class="grid-details">
                <div class="grid-price">${property.formatted_price}<span>/MO</span></div>
                <h3 class="grid-title">${property.title}</h3>
                <div class="grid-location">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    ${property.address}
                </div>
                <div class="grid-amenities">
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7"/>
                            <path d="M21 7H3l2-4h14l2 4z"/>
                        </svg>
                        ${property.bedrooms}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="10" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        ${property.bathrooms}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <path d="M3 9h18M9 21V9"/>
                        </svg>
                        ${property.floor_area || '-'}
                    </span>
                </div>
            </div>
        `;

        // Setup favorite button
        const favBtn = article.querySelector('.favorite-btn');
        favBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.toggleFavorite(property.id, favBtn);
        });

        // Setup grid swiper
        this.setupGridSwiper(article);

        // Make card clickable
        article.addEventListener('click', () => {
            window.location.href = `/property/${property.id}`;
        });

        return article;
    }

    setupGridSwiper(card) {
        const swiper = card.querySelector('.grid-swiper');
        if (!swiper) return;
        
        const slides = swiper.querySelectorAll('.grid-slide');
        const dots = card.querySelectorAll('.image-dots .dot');
        const prevBtn = swiper.querySelector('.grid-prev');
        const nextBtn = swiper.querySelector('.grid-next');
        let current = 0;

        const goToSlide = (index) => {
            slides.forEach((s, i) => s.classList.toggle('active', i === index));
            dots.forEach((d, i) => d.classList.toggle('active', i === index));
            current = index;
        };

        prevBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            goToSlide(current > 0 ? current - 1 : slides.length - 1);
        });

        nextBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            goToSlide(current < slides.length - 1 ? current + 1 : 0);
        });

        dots.forEach((dot, idx) => {
            dot.addEventListener('click', (e) => {
                e.stopPropagation();
                goToSlide(idx);
            });
        });
    }

    async toggleFavorite(propertyId, button) {
        const isCurrentlySaved = button.classList.contains('active');
        const endpoint = isCurrentlySaved 
            ? `/tenant/properties/${propertyId}/unsave`
            : `/tenant/properties/${propertyId}/save`;

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                }
            });

            if (response.ok) {
                button.classList.toggle('active');
                const svg = button.querySelector('svg');
                svg.setAttribute('fill', button.classList.contains('active') ? 'currentColor' : 'none');
            } else if (response.status === 401) {
                // Not logged in, redirect to login
                window.location.href = '/login';
            }
        } catch (error) {
            console.error('Failed to toggle favorite:', error);
        }
    }

    setupFilterListeners() {
        // Property type filter
        document.querySelectorAll('.checkbox-group input[name="property_type"]').forEach(input => {
            input.addEventListener('change', () => this.applyFilters());
        });

        // Price filter
        const priceMin = document.getElementById('priceMin');
        const priceMax = document.getElementById('priceMax');
        if (priceMin && priceMax) {
            [priceMin, priceMax].forEach(input => {
                input.addEventListener('change', () => this.applyFilters());
            });
        }

        // Bedrooms filter
        document.querySelectorAll('.checkbox-group.horizontal input[name="bedrooms"]').forEach(input => {
            input.addEventListener('change', () => this.applyFilters());
        });
    }

    setupSortListener() {
        const sortSelect = document.getElementById('sortPrice');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                const sortMap = {
                    'low-high': 'price_low',
                    'high-low': 'price_high',
                    'newest': 'latest'
                };
                this.filters.sort = sortMap[e.target.value] || 'latest';
                this.currentPage = 1;
                this.loadProperties();
            });
        }
    }

    setupSearchListener() {
        const searchInput = document.getElementById('propertySearch');
        const clearBtn = document.getElementById('clearPropertySearch');
        
        if (searchInput) {
            let debounceTimer;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    this.filters.search = e.target.value;
                    this.currentPage = 1;
                    this.loadProperties();
                }, 300);
                
                if (clearBtn) {
                    clearBtn.style.display = e.target.value ? 'block' : 'none';
                }
            });

            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    this.filters.search = '';
                    clearBtn.style.display = 'none';
                    this.loadProperties();
                });
            }
        }
    }

    setupViewToggle() {
        const viewBtns = document.querySelectorAll('.view-btn');
        viewBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // This is handled by existing view toggle JS
            });
        });
    }

    applyFilters() {
        // Collect property types
        const types = Array.from(document.querySelectorAll('.checkbox-group input[name="property_type"]:checked'))
            .map(input => input.value);
        if (types.length > 0) {
            this.filters.type = types.join(',');
        } else {
            delete this.filters.type;
        }

        // Price range
        const priceMin = document.getElementById('priceMin');
        const priceMax = document.getElementById('priceMax');
        if (priceMin?.value) this.filters.min_price = priceMin.value;
        if (priceMax?.value) this.filters.max_price = priceMax.value;

        // Bedrooms
        const bedrooms = document.querySelector('.checkbox-group.horizontal input[name="bedrooms"]:checked');
        if (bedrooms) {
            this.filters.bedrooms = bedrooms.value;
        } else {
            delete this.filters.bedrooms;
        }

        this.currentPage = 1;
        this.loadProperties();
    }

    clearContainers() {
        if (this.container) this.container.innerHTML = '';
        if (this.gridContainer) this.gridContainer.innerHTML = '';
    }

    showLoading() {
        const skeletonCard = `
            <div class="skeleton-card">
                <div class="skeleton-image skeleton-animate"></div>
                <div class="skeleton-content">
                    <div class="skeleton-title skeleton-animate"></div>
                    <div class="skeleton-price skeleton-animate"></div>
                    <div class="skeleton-address skeleton-animate"></div>
                    <div class="skeleton-amenities">
                        <div class="skeleton-amenity skeleton-animate"></div>
                        <div class="skeleton-amenity skeleton-animate"></div>
                        <div class="skeleton-amenity skeleton-animate"></div>
                    </div>
                </div>
            </div>
        `;
        const loadingHtml = `
            <div class="skeleton-loader">
                ${skeletonCard}
                ${skeletonCard}
                ${skeletonCard}
            </div>
        `;
        if (this.container) this.container.innerHTML = loadingHtml;
        if (this.gridContainer) this.gridContainer.innerHTML = loadingHtml;
    }

    showNoResults() {
        const noResultsHtml = `
            <div class="no-results">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <h3>No properties found</h3>
                <p>Try adjusting your filters or search criteria</p>
            </div>
        `;
        if (this.container) this.container.innerHTML = noResultsHtml;
        if (this.gridContainer) this.gridContainer.innerHTML = noResultsHtml;
    }

    showError() {
        const errorHtml = `
            <div class="error-state">
                <p>Failed to load properties. Please try again.</p>
                <button onclick="window.propertyLoader.loadProperties()">Retry</button>
            </div>
        `;
        if (this.container) this.container.innerHTML = errorHtml;
    }

    updateResultsCount(total) {
        if (this.resultsCount) {
            this.resultsCount.textContent = `${total} ${total === 1 ? 'property' : 'properties'} found`;
        }
    }

    updatePagination(pagination) {
        this.currentPage = pagination.current_page;
        this.totalPages = pagination.last_page;
        this.hasMore = pagination.has_more;
        
        // Get pagination elements
        const paginationContainer = document.querySelector('.pagination');
        const prevBtn = paginationContainer?.querySelector('.pagination-btn:first-child');
        const nextBtn = paginationContainer?.querySelector('.pagination-btn:last-child');
        const pageInfo = paginationContainer?.querySelector('.pagination-info');
        
        if (pageInfo) {
            pageInfo.textContent = `Page ${this.currentPage} of ${this.totalPages}`;
        }
        
        if (prevBtn) {
            prevBtn.disabled = this.currentPage <= 1;
            // Remove old listener and add new one
            const newPrevBtn = prevBtn.cloneNode(true);
            prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
            newPrevBtn.addEventListener('click', () => this.goToPage(this.currentPage - 1));
        }
        
        if (nextBtn) {
            nextBtn.disabled = this.currentPage >= this.totalPages;
            // Remove old listener and add new one
            const newNextBtn = nextBtn.cloneNode(true);
            nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
            newNextBtn.addEventListener('click', () => this.goToPage(this.currentPage + 1));
        }
    }
    
    goToPage(page) {
        if (page < 1 || page > this.totalPages || this.isLoading) return;
        this.currentPage = page;
        this.loadProperties();
        // Scroll to top of listings
        document.querySelector('.property-list, .property-grid')?.scrollIntoView({ behavior: 'smooth' });
    }

    formatAmenity(amenity) {
        return amenity.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    capitalizeFirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    
    // Cache helper methods for faster page loads
    getCachedData(key) {
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
    
    setCachedData(key, data, ttl) {
        try {
            const cacheItem = {
                data: data,
                expiry: Date.now() + ttl
            };
            localStorage.setItem(key, JSON.stringify(cacheItem));
        } catch (e) {
            // Quota exceeded or other error, ignore
            console.warn('Cache storage failed:', e);
        }
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.propertyLoader = new PropertyLoader();
});

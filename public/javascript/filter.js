// Filter Panel Toggle
document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.querySelector('.filter-btn');
    const filterPanel = document.getElementById('filterPanel');
    
    if (filterBtn && filterPanel) {
        // Toggle filter panel on button click
        filterBtn.addEventListener('click', function() {
            filterPanel.classList.toggle('open');
            filterBtn.classList.toggle('active');
        });
    }
    
    // Buy/Rent Toggle
    const buyRentBtns = document.querySelectorAll('.buy-rent-toggle .toggle-btn');
    buyRentBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            buyRentBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Option Buttons (Bathroom, View)
    const buttonGroups = document.querySelectorAll('.button-group');
    buttonGroups.forEach(group => {
        const buttons = group.querySelectorAll('.option-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    
    // Tab Buttons
    const tabGroups = document.querySelectorAll('.category-tabs, .action-tabs');
    tabGroups.forEach(group => {
        const tabs = group.querySelectorAll('.tab-btn, .action-btn');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    
    // View Toggle Buttons (Grid/List/Map) - SEPARATE CONTAINERS
    // Uses localStorage to persist view across page refreshes
    const viewBtns = document.querySelectorAll('.view-btn');
    const listContainer = document.getElementById('listViewContainer');
    const gridContainer = document.getElementById('gridViewContainer');
    const splitMapContainer = document.getElementById('mapviewContainer'); // Split screen map (for show-map toggle)
    const fullMapContainer = document.getElementById('mapViewContainer');   // Full featured map view
    
    // Function to switch views
    // 0 = Grid, 1 = List (Default), 2 = Full Map
    function switchView(viewIndex) {
        // Update button states
        viewBtns.forEach((b, i) => {
            b.classList.toggle('active', i === viewIndex);
        });
        
        // Hide all main containers first
        if (listContainer) listContainer.style.display = 'none';
        if (gridContainer) gridContainer.style.display = 'none';
        if (splitMapContainer) {
            splitMapContainer.style.display = 'none';
            splitMapContainer.classList.remove('active');
        }
        if (fullMapContainer) {
            fullMapContainer.style.display = 'none';
        }
        
        // Show pagination for grid/list, hide for map
        const pagination = document.querySelector('.pagination');
        const showMapCheckbox = document.getElementById('showMap');
        
        // Show the selected container
        if (viewIndex === 0 && gridContainer) {
            // Grid View
            gridContainer.style.display = 'block';
            if (pagination) pagination.style.display = 'flex';
        } else if (viewIndex === 1) {
            // List View (Default) - Check if showMap was enabled
            const showMapEnabled = localStorage.getItem('showMapEnabled') === 'true';
            
            if (showMapEnabled && splitMapContainer) {
                // Show split-screen map
                splitMapContainer.style.display = 'flex';
                splitMapContainer.classList.add('active');
                if (showMapCheckbox) showMapCheckbox.checked = true;
                if (pagination) pagination.style.display = 'flex';
                // Initialize split map if needed
                if (typeof initMapView === 'function') {
                    setTimeout(initMapView, 100);
                }
            } else if (listContainer) {
                // Show regular list
                listContainer.style.display = 'block';
                if (showMapCheckbox) showMapCheckbox.checked = false;
                if (pagination) pagination.style.display = 'flex';
            }
        } else if (viewIndex === 2 && fullMapContainer) {
            // Full Map View
            fullMapContainer.style.display = 'block';
            if (pagination) pagination.style.display = 'none';
            // Initialize the full featured map
            if (typeof initPropertyMap === 'function') {
                setTimeout(initPropertyMap, 100);
            }
        }
        
        // Save to localStorage
        localStorage.setItem('propertyViewMode', viewIndex);
    }
    
    // Restore saved view on page load (default to List view = 1)
    const savedView = localStorage.getItem('propertyViewMode');
    if (savedView !== null) {
        switchView(parseInt(savedView));
    } else {
        // Default to List view (index 1) if no preference saved
        switchView(1);
    }
    
    // Add click handlers
    viewBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            switchView(index);
        });
    });
    
    // Image Swiper
    document.querySelectorAll('.image-swiper').forEach(swiper => {
        const slides = swiper.querySelector('.swiper-slides');
        const slideItems = swiper.querySelectorAll('.swiper-slide');
        const dots = swiper.querySelectorAll('.swiper-dot');
        const prevBtn = swiper.querySelector('.swiper-prev');
        const nextBtn = swiper.querySelector('.swiper-next');
        
        let currentSlide = 0;
        const totalSlides = slideItems.length;
        
        function updateSlider() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentSlide);
            });
        }
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlider();
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlider();
            });
        }
        
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                currentSlide = i;
                updateSlider();
            });
        });
    });
    
    // Favorite Button Toggle
    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
    
    // ========================================
    // SCROLL REVEAL ANIMATION
    // Uses Intersection Observer for smooth card animations
    // ========================================
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                // Optional: stop observing after revealed (performance)
                // revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,      // Trigger when 10% of card is visible
        rootMargin: '0px 0px -50px 0px'  // Start animation slightly before card enters
    });
    
    // Observe all property cards (list view)
    document.querySelectorAll('.property-card').forEach(card => {
        revealObserver.observe(card);
    });
    
    // Observe all grid cards
    document.querySelectorAll('.grid-card').forEach(card => {
        revealObserver.observe(card);
    });
    
    // Re-observe cards when switching views
    const observeNewCards = () => {
        document.querySelectorAll('.property-card:not(.revealed), .grid-card:not(.revealed)').forEach(card => {
            revealObserver.observe(card);
        });
    };
    
    // Hook into view toggle to trigger animations
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Small delay to let container become visible
            setTimeout(observeNewCards, 50);
            // Re-init grid swipers when switching to grid view
            setTimeout(initGridSwipers, 100);
        });
    });
    
    // ========================================
    // GRID IMAGE SWIPER
    // Click left/right zones to navigate images
    // ========================================
    
    function initGridSwipers() {
        document.querySelectorAll('.grid-card').forEach(card => {
            const swiper = card.querySelector('.grid-swiper');
            if (!swiper) return;
            
            const slides = swiper.querySelector('.grid-slides');
            const slideItems = swiper.querySelectorAll('.grid-slide');
            const dots = card.querySelectorAll('.image-dots .dot');
            const prevBtn = swiper.querySelector('.grid-prev');
            const nextBtn = swiper.querySelector('.grid-next');
            
            // Skip if already initialized
            if (swiper.dataset.initialized) return;
            swiper.dataset.initialized = 'true';
            
            let currentSlide = 0;
            const totalSlides = slideItems.length;
            
            function goToSlide(index) {
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;
                currentSlide = index;
                slides.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    goToSlide(currentSlide - 1);
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    goToSlide(currentSlide + 1);
                });
            }
        });
    }
    
    // Initialize grid swipers on page load
    initGridSwipers();
    
    // ========================================
    // PROPERTY CARD CLICK NAVIGATION
    // Navigate to detail page when clicking on cards
    // ========================================
    
    function initCardNavigation() {
        // List view cards
        document.querySelectorAll('.property-card').forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', (e) => {
                // Don't navigate if clicking on swiper nav or buttons
                if (e.target.closest('.swiper-prev') || 
                    e.target.closest('.swiper-next') ||
                    e.target.closest('button')) {
                    return;
                }
                const propertyId = card.dataset.propertyId || 'demo';
                window.location.href = `/property/${propertyId}`;
            });
        });
        
        // Grid view cards
        document.querySelectorAll('.grid-card').forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', (e) => {
                // Don't navigate if clicking on swiper nav
                if (e.target.closest('.grid-prev') || 
                    e.target.closest('.grid-next')) {
                    return;
                }
                const propertyId = card.dataset.propertyId || 'demo';
                window.location.href = `/property/${propertyId}`;
            });
        });
    }
    
    initCardNavigation();
    
    // ========================================
    // PROPERTY SEARCH FILTER
    // Filters property cards by title/address/type
    // ========================================
    
    const propertySearch = document.getElementById('propertySearch');
    const clearSearchBtn = document.getElementById('clearPropertySearch');
    const resultsCount = document.getElementById('resultsCount');
    
    if (propertySearch) {
        let debounceTimer;
        
        propertySearch.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim().toLowerCase();
            
            // Show/hide clear button
            if (clearSearchBtn) {
                clearSearchBtn.style.display = query ? 'block' : 'none';
            }
            
            debounceTimer = setTimeout(() => filterProperties(query), 200);
        });
        
        // Clear button click
        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                propertySearch.value = '';
                clearSearchBtn.style.display = 'none';
                filterProperties('');
            });
        }
    }
    
    function filterProperties(query) {
        // Get all property cards (both list and grid)
        const listCards = document.querySelectorAll('.property-card');
        const gridCards = document.querySelectorAll('.grid-card');
        
        let visibleCount = 0;
        
        // Filter list view cards
        listCards.forEach(card => {
            const title = card.querySelector('.property-title')?.textContent?.toLowerCase() || '';
            const address = card.querySelector('.property-location')?.textContent?.toLowerCase() || '';
            const type = card.querySelector('.property-type')?.textContent?.toLowerCase() || '';
            const price = card.querySelector('.price-amount')?.textContent?.toLowerCase() || '';
            
            const searchText = `${title} ${address} ${type} ${price}`;
            const matches = !query || searchText.includes(query);
            
            card.style.display = matches ? '' : 'none';
            
            // Add highlight effect when searching
            if (query && matches) {
                card.classList.add('search-highlight');
            } else {
                card.classList.remove('search-highlight');
            }
            
            if (matches) visibleCount++;
        });
        
        // Filter grid view cards
        gridCards.forEach(card => {
            const title = card.querySelector('.grid-title')?.textContent?.toLowerCase() || '';
            const address = card.querySelector('.grid-location')?.textContent?.toLowerCase() || '';
            const price = card.querySelector('.grid-price')?.textContent?.toLowerCase() || '';
            
            const searchText = `${title} ${address} ${price}`;
            const matches = !query || searchText.includes(query);
            
            card.style.display = matches ? '' : 'none';
            
            // Add highlight effect when searching
            if (query && matches) {
                card.classList.add('search-highlight');
            } else {
                card.classList.remove('search-highlight');
            }
        });
        
        // Update results count
        if (resultsCount) {
            if (query) {
                resultsCount.textContent = `${visibleCount} ${visibleCount === 1 ? 'property' : 'properties'} found`;
            } else {
                // Reset to original count
                resultsCount.textContent = `${listCards.length} properties found`;
            }
        }
        
        // Highlight matching map markers too
        highlightMapMarkers(query);
    }
    
    function highlightMapMarkers(query) {
        const priceMarkers = document.querySelectorAll('.price-marker');
        
        priceMarkers.forEach(marker => {
            if (query) {
                // Get property info from data attributes
                const title = marker.dataset.title || '';
                const address = marker.dataset.address || '';
                const price = marker.dataset.price || '';
                
                const searchText = `${title} ${address} ${price}`;
                const matches = searchText.includes(query);
                
                if (matches) {
                    marker.classList.add('search-active');
                } else {
                    marker.classList.remove('search-active');
                }
            } else {
                marker.classList.remove('search-active');
            }
        });
    }
    
    // Cleanup IntersectionObserver on page unload to prevent memory leaks
    function cleanup() {
        if (revealObserver) {
            revealObserver.disconnect();
        }
    }
    
    window.addEventListener('beforeunload', cleanup);
    window.addEventListener('pagehide', cleanup);
});

// ========================================
// HOMEPAGE SEARCH - Property Search Integration
// Connects search bar to properties database
// ========================================

(function() {
    'use strict';
    
    // Wait for DOM to be fully ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const searchBtn = document.querySelector('.search-btn');
        const lookingForInput = document.getElementById('looking-for');
        const typeSelect = document.getElementById('type');
        const priceSelect = document.getElementById('price');
        const locationSelect = document.getElementById('location');
        
        if (!searchBtn) {
            console.log('Homepage search: No search button found');
            return;
        }
        
        console.log('Homepage search: Initializing...');
        
        // Load property data for dynamic options
        loadSearchOptions(typeSelect, priceSelect, locationSelect);
        
        // Handle search submission
        searchBtn.addEventListener('click', (e) => handleSearch(e, lookingForInput, typeSelect, priceSelect, locationSelect));
        
        // Also handle enter key in the text input
        if (lookingForInput) {
            lookingForInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    handleSearch(e, lookingForInput, typeSelect, priceSelect, locationSelect);
                }
            });
        }
    }
    
    async function loadSearchOptions(typeSelect, priceSelect, locationSelect) {
        try {
            console.log('Homepage search: Fetching properties...');
            const response = await fetch('/api/properties?per_page=100');
            const data = await response.json();
            const properties = data.properties || [];
            
            console.log('Homepage search: Got', properties.length, 'properties');
            
            if (properties.length > 0) {
                populateTypeOptions(typeSelect, properties);
                populatePriceRanges(priceSelect, properties);
                populateLocationOptions(locationSelect, properties);
            }
        } catch (error) {
            console.error('Homepage search: Error loading options', error);
        }
    }
    
    function populateTypeOptions(typeSelect, properties) {
        if (!typeSelect) return;
        
        // Get unique property types from data
        const types = [...new Set(properties.map(p => p.property_type).filter(Boolean))];
        console.log('Homepage search: Property types found:', types);
        
        // Clear and rebuild options
        typeSelect.innerHTML = '<option value="">Property Type</option>';
        
        types.forEach(type => {
            const option = document.createElement('option');
            option.value = type.toLowerCase();
            option.textContent = type.charAt(0).toUpperCase() + type.slice(1);
            typeSelect.appendChild(option);
        });
    }
    
    function populatePriceRanges(priceSelect, properties) {
        if (!priceSelect) return;
        
        const prices = properties.map(p => parseFloat(p.price)).filter(p => !isNaN(p));
        if (prices.length === 0) return;
        
        const minPrice = Math.min(...prices);
        const maxPrice = Math.max(...prices);
        console.log('Homepage search: Price range:', minPrice, '-', maxPrice);
        
        // Create price ranges in Philippine Peso
        priceSelect.innerHTML = '<option value="">Price Range</option>';
        
        const ranges = [
            { value: '0-10000', label: '₱0 - ₱10,000' },
            { value: '10000-20000', label: '₱10,000 - ₱20,000' },
            { value: '20000-30000', label: '₱20,000 - ₱30,000' },
            { value: '30000-50000', label: '₱30,000 - ₱50,000' },
            { value: '50000+', label: '₱50,000+' }
        ];
        
        ranges.forEach(range => {
            const option = document.createElement('option');
            option.value = range.value;
            option.textContent = range.label;
            priceSelect.appendChild(option);
        });
    }
    
    function populateLocationOptions(locationSelect, properties) {
        if (!locationSelect) return;
        
        // Use city field directly from API (more reliable than parsing address)
        const cities = [...new Set(properties.map(p => p.city).filter(Boolean))];
        console.log('Homepage search: Cities found:', cities);
        
        // Clear and rebuild
        locationSelect.innerHTML = '<option value="">All Locations</option>';
        
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.toLowerCase().replace(/\s+/g, '-');
            option.textContent = city;
            locationSelect.appendChild(option);
        });
    }
    
    function handleSearch(e, lookingForInput, typeSelect, priceSelect, locationSelect) {
        e.preventDefault();
        
        const params = new URLSearchParams();
        
        if (lookingForInput && lookingForInput.value.trim()) {
            params.set('q', lookingForInput.value.trim());
        }
        
        if (typeSelect && typeSelect.value) {
            params.set('type', typeSelect.value);
        }
        
        if (priceSelect && priceSelect.value) {
            params.set('price', priceSelect.value);
        }
        
        if (locationSelect && locationSelect.value) {
            params.set('location', locationSelect.value);
        }
        
        // Navigate to rental page with filters
        const queryString = params.toString();
        const url = '/rental' + (queryString ? '?' + queryString : '');
        console.log('Homepage search: Navigating to', url);
        window.location.href = url;
    }
})();

{{--
    Results Header Component
    Sort dropdown and results count
--}}

@php
    $resultsCount = $resultsCount ?? 6;
@endphp

<div class="results-header">
    <span class="results-count">{{ $resultsCount }} properties found</span>
    <div class="sort-dropdown">
        <span class="sort-label">Sort by price</span>
        <select id="sortPrice">
            <option value="low-high">Low to High</option>
            <option value="high-low">High to Low</option>
            <option value="newest">Newest First</option>
        </select>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9"/>
        </svg>
    </div>
</div>

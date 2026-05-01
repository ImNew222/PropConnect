@extends('layouts.dashboard')

@section('title', 'Saved Properties')

@section('content')
<div class="page-header">
    <div>
        <h1>Saved Properties</h1>
        <p class="subtitle">Properties you've saved for later</p>
    </div>
</div>

@if($savedProperties->count() > 0)
<div class="properties-grid">
    @foreach($savedProperties as $saved)
    @php $property = $saved->property; @endphp
    <div class="property-card">
        <a href="/property/{{ $property->id }}" class="property-link">
            <div class="property-image">
                @if($property->primaryImage)
                    <img src="{{ $property->primaryImage->url }}" alt="">
                @else
                    <div class="no-image">No Image</div>
                @endif
                <span class="property-type">{{ ucfirst($property->property_type) }}</span>
                <span class="status-badge {{ $property->status }}">{{ ucfirst($property->status) }}</span>
            </div>
            <div class="property-info">
                <h3>{{ $property->title }}</h3>
                <p class="address">{{ $property->address }}, {{ $property->city }}</p>
                <div class="specs">
                    <span>{{ $property->bedrooms }} beds</span>
                    <span>{{ $property->bathrooms }} baths</span>
                    <span>{{ $property->floor_area }} m²</span>
                </div>
                <div class="price">₱{{ number_format($property->price) }}<small>/mo</small></div>
            </div>
        </a>
        <div class="property-actions">
            <span class="saved-date">Saved {{ $saved->created_at->diffForHumans() }}</span>
            <button class="btn-unsave" onclick="unsaveProperty({{ $property->id }}, this)">
                <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                </svg>
                Unsave
            </button>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrapper">
    {{ $savedProperties->links() }}
</div>

@else
<div class="empty-state">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
    </svg>
    <h2>No saved properties</h2>
    <p>Start exploring and save properties you're interested in</p>
    <a href="/rental" class="btn-primary">Browse Properties</a>
</div>
@endif

<style>
.page-header {
    margin-bottom: 2rem;
}

.page-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.subtitle {
    color: var(--text-secondary);
    margin: 0.25rem 0 0;
}

.properties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.property-card {
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--border-color, #e5e7eb);
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.property-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
}

.property-link {
    display: block;
    text-decoration: none;
}

.property-image {
    position: relative;
    height: 180px;
    background: var(--bg-tertiary);
}

.property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--text-muted);
}

.property-type {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 0.25rem 0.75rem;
    background: rgba(0,0,0,0.7);
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
}

.status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.available {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.status-badge.rented {
    background: rgba(239, 68, 68, 0.9);
    color: white;
}

.property-info {
    padding: 1.25rem;
}

.property-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary, #111827);
    margin: 0 0 0.5rem;
}

.address {
    font-size: 0.875rem;
    color: var(--text-secondary, #4b5563);
    margin: 0 0 0.75rem;
}

.specs {
    display: flex;
    gap: 1rem;
    font-size: 0.8125rem;
    color: var(--text-muted, #6b7280);
    margin-bottom: 0.75rem;
}

.price {
    font-size: 1.25rem;
    font-weight: 700;
    color: #667eea;
}

.price small {
    font-size: 0.75rem;
    font-weight: 400;
    color: var(--text-secondary, #6b7280);
}

.property-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1.25rem;
    border-top: 1px solid var(--border-color, rgba(255,255,255,0.1));
}

.saved-date {
    font-size: 0.75rem;
    color: var(--text-muted, #9ca3af);
}

.btn-unsave {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    background: none;
    border: none;
    color: #f59e0b;
    cursor: pointer;
    font-size: 0.8125rem;
    padding: 0.5rem;
    border-radius: 6px;
    transition: all 0.2s;
}

.btn-unsave svg {
    width: 16px;
    height: 16px;
}

.btn-unsave:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    border: 1px dashed var(--border-color, #d1d5db);
}

.empty-state svg {
    width: 64px;
    height: 64px;
    color: var(--text-muted, #9ca3af);
    margin-bottom: 1rem;
}

.empty-state h2 {
    font-size: 1.25rem;
    color: var(--text-primary, #111827);
    margin: 0 0 0.5rem;
}

.empty-state p {
    color: var(--text-secondary, #6b7280);
    margin: 0 0 1.5rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
}
</style>

<script>
function unsaveProperty(propertyId, button) {
    fetch(`/tenant/properties/${propertyId}/unsave`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Remove the card
        button.closest('.property-card').remove();
        
        // If no more properties, reload to show empty state
        if (document.querySelectorAll('.property-card').length === 0) {
            location.reload();
        }
    });
}
</script>
@endsection

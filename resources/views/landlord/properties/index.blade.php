@extends('layouts.dashboard')

@section('title', 'My Properties')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1>My Properties</h1>
        <p class="subtitle">Manage your property listings</p>
    </div>
    <a href="{{ route('landlord.properties.create') }}" class="btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Add Property
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($properties->count() > 0)
<div class="properties-grid">
    @foreach($properties as $property)
    <div class="property-card">
        <div class="property-image">
            @if($property->primaryImage)
                <img src="{{ asset('storage/' . $property->primaryImage->image_path) }}" alt="{{ $property->title }}">
            @else
                <div class="no-image">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <span>No Image</span>
                </div>
            @endif
            <span class="status-badge status-{{ $property->status }}">{{ ucfirst($property->status) }}</span>
        </div>
        
        <div class="property-details">
            <h3 class="property-title">{{ $property->title }}</h3>
            <p class="property-address">{{ $property->address }}, {{ $property->city }}</p>
            
            <div class="property-specs">
                <span><strong>{{ $property->bedrooms }}</strong> beds</span>
                <span><strong>{{ $property->bathrooms }}</strong> baths</span>
                <span><strong>{{ $property->floor_area }}</strong> m²</span>
            </div>
            
            <div class="property-footer">
                <span class="price">{{ $property->formatted_price }}<small>/mo</small></span>
                <span class="views">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    {{ $property->views_count }} views
                </span>
            </div>
        </div>
        
        <div class="property-actions">
            <a href="{{ route('landlord.properties.edit', $property) }}" class="btn-action btn-edit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit
            </a>
            <form action="{{ route('landlord.properties.destroy', $property) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this property?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrapper">
    {{ $properties->links() }}
</div>

@else
<div class="empty-state">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <h2>No properties yet</h2>
    <p>Start by adding your first property listing</p>
    <a href="{{ route('landlord.properties.create') }}" class="btn-primary">
        Add Your First Property
    </a>
</div>
@endif

<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.page-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0;
}

.page-header .subtitle {
    color: #6b7280;
    margin: 0.25rem 0 0;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: transform 0.2s, box-shadow 0.2s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

.btn-primary svg {
    width: 18px;
    height: 18px;
}

.alert {
    padding: 1rem 1.25rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #059669;
}

.properties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 1.5rem;
}

.property-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: transform 0.2s, box-shadow 0.2s;
}

.property-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

.property-image {
    position: relative;
    height: 180px;
    background: #f5f5f7;
}

.property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #9ca3af;
}

.no-image svg {
    width: 48px;
    height: 48px;
    margin-bottom: 0.5rem;
}

.status-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-available {
    background: #10b981;
    color: white;
}

.status-rented {
    background: #3b82f6;
    color: white;
}

.status-pending {
    background: #f59e0b;
    color: white;
}

.status-inactive {
    background: #6b7280;
    color: white;
}

.property-details {
    padding: 1.25rem;
}

.property-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0 0 0.5rem;
}

.property-address {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0 0 1rem;
}

.property-specs {
    display: flex;
    gap: 1rem;
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 1rem;
}

.property-specs strong {
    color: #1a1a2e;
}

.property-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-size: 1.25rem;
    font-weight: 700;
    color: #6366f1;
}

.price small {
    font-size: 0.75rem;
    font-weight: 400;
    color: #9ca3af;
}

.views {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.875rem;
    color: #9ca3af;
}

.views svg {
    width: 16px;
    height: 16px;
}

.property-actions {
    display: flex;
    border-top: 1px solid #f0f0f0;
}

.btn-action {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem;
    background: transparent;
    border: none;
    color: #6b7280;
    font-size: 0.875rem;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    text-decoration: none;
}

.btn-action svg {
    width: 16px;
    height: 16px;
}

.btn-edit:hover {
    background: #eef2ff;
    color: #6366f1;
}

.btn-delete:hover {
    background: #fef2f2;
    color: #ef4444;
}

.btn-action + .btn-action,
.btn-action + form {
    border-left: 1px solid #f0f0f0;
}

form .btn-action {
    width: 100%;
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 4rem 2rem;
    text-align: center;
    background: #ffffff;
    border-radius: 12px;
    border: 2px dashed #e5e7eb;
}

.empty-state svg {
    width: 64px;
    height: 64px;
    color: #9ca3af;
    margin-bottom: 1rem;
}

.empty-state h2 {
    font-size: 1.25rem;
    color: #1a1a2e;
    margin: 0 0 0.5rem;
}

.empty-state p {
    color: #6b7280;
    margin: 0 0 1.5rem;
}

@media (max-width: 768px) {
    .properties-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

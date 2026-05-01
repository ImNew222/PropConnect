@extends('layouts.dashboard')

@section('title', 'My Rentals')

@section('content')
<div class="page-header">
    <h1>My Rentals</h1>
    <p class="subtitle">Your current and past rental history</p>
</div>

<!-- Active Rentals -->
@if($activeRentals->count() > 0)
<section class="section">
    <h2 class="section-title">Active Rentals</h2>
    <div class="rentals-list">
        @foreach($activeRentals as $rental)
        <div class="rental-card active">
            <div class="rental-image">
                @if($rental->property->primaryImage)
                    <img src="{{ $rental->property->primaryImage->url }}" alt="">
                @else
                    <div class="no-image">No Image</div>
                @endif
            </div>
            <div class="rental-content">
                <div class="rental-header">
                    <span class="status-badge active">Active</span>
                    <span class="rental-id">#{{ $rental->id }}</span>
                </div>
                <h3>{{ $rental->property->title }}</h3>
                <p class="address">{{ $rental->property->address }}, {{ $rental->property->city }}</p>
                
                <div class="rental-details">
                    <div class="detail">
                        <span class="label">Start Date</span>
                        <span class="value">{{ $rental->start_date->format('M d, Y') }}</span>
                    </div>
                    <div class="detail">
                        <span class="label">Monthly Rent</span>
                        <span class="value price">₱{{ number_format($rental->monthly_rent) }}</span>
                    </div>
                    <div class="detail">
                        <span class="label">Deposit Paid</span>
                        <span class="value">₱{{ number_format($rental->deposit_paid ?? 0) }}</span>
                    </div>
                </div>
                
                <div class="landlord-info">
                    <span class="label">Landlord:</span>
                    <span class="landlord-name">{{ $rental->landlord->name }}</span>
                </div>
            </div>
            <div class="rental-actions">
                <a href="/property/{{ $rental->property->id }}" class="btn-view">View Property</a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Past Rentals -->
<section class="section">
    <h2 class="section-title">Rental History</h2>
    
    @if($pastRentals->count() > 0)
    <div class="rentals-list">
        @foreach($pastRentals as $rental)
        <div class="rental-card past">
            <div class="rental-image">
                @if($rental->property->primaryImage)
                    <img src="{{ $rental->property->primaryImage->url }}" alt="">
                @else
                    <div class="no-image">No Image</div>
                @endif
            </div>
            <div class="rental-content">
                <div class="rental-header">
                    <span class="status-badge {{ $rental->status }}">{{ ucfirst($rental->status) }}</span>
                    <span class="rental-id">#{{ $rental->id }}</span>
                </div>
                <h3>{{ $rental->property->title }}</h3>
                <p class="address">{{ $rental->property->address }}</p>
                
                <div class="rental-details">
                    <div class="detail">
                        <span class="label">Period</span>
                        <span class="value">{{ $rental->start_date->format('M Y') }} - {{ $rental->end_date ? $rental->end_date->format('M Y') : 'N/A' }}</span>
                    </div>
                    <div class="detail">
                        <span class="label">Total Paid</span>
                        <span class="value">₱{{ number_format($rental->monthly_rent * ($rental->start_date->diffInMonths($rental->end_date ?? now()) ?: 1)) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="pagination-wrapper">
        {{ $pastRentals->links() }}
    </div>
    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
        </svg>
        <p>No rental history yet</p>
    </div>
    @endif
</section>

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

.section {
    margin-bottom: 2.5rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem;
}

.rentals-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.rentals-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.rental-card {
    display: flex;
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    border: 1px solid var(--border-color, #e5e7eb);
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.rental-card.active {
    border-color: #10b981;
}

.rental-image {
    width: 200px;
    min-height: 180px;
    flex-shrink: 0;
    background: var(--bg-tertiary);
}

.rental-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--text-muted, #9ca3af);
}

.rental-content {
    flex: 1;
    padding: 1.25rem;
}

.rental-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.status-badge.completed {
    background: rgba(59, 130, 246, 0.15);
    color: #3b82f6;
}

.status-badge.cancelled {
    background: rgba(107, 114, 128, 0.15);
    color: #9ca3af;
}

.rental-id {
    font-size: 0.75rem;
    color: var(--text-muted, #6b7280);
}

.rental-content h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary, #111827);
    margin: 0 0 0.25rem;
}

.address {
    font-size: 0.875rem;
    color: var(--text-secondary, #4b5563);
    margin: 0 0 1rem;
}

.rental-details {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
}

.detail {
    display: flex;
    flex-direction: column;
}

.detail .label {
    font-size: 0.75rem;
    color: var(--text-muted, #6b7280);
    margin-bottom: 0.25rem;
}

.detail .value {
    font-size: 0.9375rem;
    color: var(--text-primary, #111827);
    font-weight: 500;
}

.detail .value.price {
    color: #667eea;
    font-weight: 700;
}

.landlord-info {
    font-size: 0.875rem;
    color: var(--text-secondary, #4b5563);
}

.landlord-name {
    color: var(--text-primary, #111827);
    font-weight: 500;
}

.rental-actions {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    border-left: 1px solid var(--border-color, #e5e7eb);
}

.btn-view {
    padding: 0.75rem 1.25rem;
    background: transparent;
    border: 1px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    color: var(--text-secondary, #4b5563);
    text-decoration: none;
    font-size: 0.875rem;
    white-space: nowrap;
    transition: all 0.2s;
}

.btn-view:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.pagination-wrapper {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    border: 1px dashed var(--border-color, #d1d5db);
}

.empty-state svg {
    width: 48px;
    height: 48px;
    color: var(--text-muted, #9ca3af);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-secondary, #6b7280);
    margin: 0;
}

@media (max-width: 768px) {
    .rental-card {
        flex-direction: column;
    }
    
    .rental-image {
        width: 100%;
        height: 160px;
    }
    
    .rental-details {
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .rental-actions {
        border-left: none;
        border-top: 1px solid var(--border-color, #e5e7eb);
        justify-content: center;
    }
}
</style>
@endsection

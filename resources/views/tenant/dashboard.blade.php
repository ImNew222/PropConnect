@extends('layouts.dashboard')

@section('title', 'My Dashboard')

@section('content')
<div class="tenant-dashboard">
    <!-- Welcome Header -->
    <div class="welcome-header">
        <div>
            <h1>Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="subtitle">Here's what's happening with your rental journey</p>
        </div>
        <a href="/rental" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            Browse Properties
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon saved">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['saved_count'] }}</span>
                <span class="stat-label">Saved Properties</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['active_rentals'] }}</span>
                <span class="stat-label">Active Rentals</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon past">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['past_rentals'] }}</span>
                <span class="stat-label">Past Rentals</span>
            </div>
        </div>
    </div>

    <!-- Active Rental -->
    @if($activeRental)
    <section class="section">
        <h2 class="section-title">Your Current Rental</h2>
        <div class="active-rental-card">
            <div class="rental-image">
                @if($activeRental->property->primaryImage)
                    <img src="{{ $activeRental->property->primaryImage->url }}" alt="{{ $activeRental->property->title }}">
                @else
                    <div class="no-image">No Image</div>
                @endif
            </div>
            <div class="rental-info">
                <h3>{{ $activeRental->property->title }}</h3>
                <p class="address">{{ $activeRental->property->address }}</p>
                <div class="rental-details">
                    <span><strong>Start:</strong> {{ $activeRental->start_date->format('M d, Y') }}</span>
                    <span><strong>Rent:</strong> ₱{{ number_format($activeRental->monthly_rent) }}/mo</span>
                </div>
                <p class="landlord">Landlord: {{ $activeRental->landlord->name }}</p>
            </div>
            <a href="/property/{{ $activeRental->property->id }}" class="btn-view">View Details</a>
        </div>
    </section>
    @endif

    <!-- Recently Saved (Favorites) -->
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">❤️ Favorite Properties</h2>
            @if($recentSaved->count() > 0)
                <a href="{{ route('tenant.saved') }}" class="view-all">View All →</a>
            @endif
        </div>
        
        @if($recentSaved->count() > 0)
        <div class="properties-grid">
            @foreach($recentSaved as $property)
            <a href="/property/{{ $property->id }}" class="property-card">
                <div class="property-image">
                    @if($property->primaryImage)
                        <img src="{{ $property->primaryImage->url }}" alt="{{ $property->title }}">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                    <span class="property-type">{{ ucfirst($property->property_type) }}</span>
                </div>
                <div class="property-info">
                    <h3>{{ $property->title }}</h3>
                    <p class="address">{{ $property->address }}</p>
                    <div class="specs">
                        <span>{{ $property->bedrooms }} beds</span>
                        <span>{{ $property->bathrooms }} baths</span>
                        <span>{{ $property->floor_area }} m²</span>
                    </div>
                    <div class="price">₱{{ number_format($property->price) }}<small>/mo</small></div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
            </svg>
            <p>No favorite properties yet</p>
            <a href="/rental" class="btn-secondary">Browse Properties</a>
        </div>
        @endif
    </section>

    <!-- Recently Viewed -->
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">👁️ Recently Viewed</h2>
        </div>
        
        @if($recentViewed->count() > 0)
        <div class="properties-grid">
            @foreach($recentViewed as $property)
            @if($property)
            <a href="/property/{{ $property->id }}" class="property-card">
                <div class="property-image">
                    @if($property->primaryImage)
                        <img src="{{ $property->primaryImage->url }}" alt="{{ $property->title }}">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                    <span class="property-type">{{ ucfirst($property->property_type ?? 'property') }}</span>
                </div>
                <div class="property-info">
                    <h3>{{ $property->title ?? 'Property' }}</h3>
                    <p class="address">{{ $property->address ?? '' }}</p>
                    <div class="specs">
                        <span>{{ $property->bedrooms ?? 0 }} beds</span>
                        <span>{{ $property->bathrooms ?? 0 }} baths</span>
                    </div>
                    <div class="price">₱{{ number_format($property->price ?? 0) }}<small>/mo</small></div>
                </div>
            </a>
            @endif
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <p>No recently viewed properties</p>
            <a href="/rental" class="btn-secondary">Start Browsing</a>
        </div>
        @endif
    </section>

    <!-- Messages / Chat List -->
    <section class="section">
        <div class="section-header">
            <h2 class="section-title">💬 Messages</h2>
            <a href="{{ route('messages.index') }}" class="view-all">View All →</a>
        </div>
        
        <div class="chat-list-compact">
            @if($landlords->count() > 0)
                @foreach($landlords->take(5) as $landlord)
                @php
                    $userIds = [auth()->id(), $landlord->id];
                    sort($userIds);
                    $roomId = 'room_' . implode('_', $userIds);
                @endphp
                <a href="{{ route('messages.chat', $landlord->id) }}" class="chat-item-compact" data-room-id="{{ $roomId }}" data-user-id="{{ $landlord->id }}">
                    <div class="chat-avatar-compact">
                        @if($landlord->avatar)
                            <img src="{{ $landlord->avatar }}" alt="{{ $landlord->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                        @else
                            {{ strtoupper(substr($landlord->name, 0, 1)) }}
                        @endif
                        <span class="online-indicator"></span>
                    </div>
                    <div class="chat-info-compact">
                        <div class="flex justify-between items-center" style="display: flex; justify-content: space-between; width: 100%;">
                            <span class="chat-name-compact">{{ $landlord->name }}</span>
                            <span class="chat-role" id="time-{{ $landlord->id }}" style="font-size: 11px;"></span>
                        </div>
                        <span class="chat-role" id="preview-{{ $landlord->id }}">Loading...</span>
                    </div>
                    <svg class="chat-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
                @endforeach
            @else
                <div class="empty-state small">
                    <p>No landlords to message yet</p>
                </div>
            @endif
        </div>
    </section>
</div>

<script type="module">
    // Firebase Integration for fetching last messages
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import {
        getDatabase,
        ref,
        query,
        limitToLast,
        onValue
    } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";

    const firebaseConfig = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        projectId: "{{ config('services.firebase.project_id') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
        appId: "{{ config('services.firebase.app_id') }}"
    };

    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

    // Get all chat items and fetch their last messages
    document.querySelectorAll('.chat-item-compact').forEach(item => {
        const roomId = item.dataset.roomId;
        const userId = item.dataset.userId;
        
        if (!roomId) return;

        const messagesRef = ref(db, `rooms/${roomId}/messages`);
        const lastMsgQuery = query(messagesRef, limitToLast(1));
        
        onValue(lastMsgQuery, (snapshot) => {
            const previewEl = document.getElementById(`preview-${userId}`);
            const timeEl = document.getElementById(`time-${userId}`);
            
            if (snapshot.exists()) {
                let lastMsg = null;
                snapshot.forEach(child => {
                    lastMsg = child.val();
                });
                
                if (lastMsg) {
                    // Truncate message
                    let text = lastMsg.text || 'Image sent';
                    if (text.length > 30) {
                        text = text.substring(0, 30) + '...';
                    }
                    previewEl.textContent = text;
                    
                    // Format time
                    const date = new Date(lastMsg.timestamp);
                    const now = new Date();
                    const diffMs = now - date;
                    const diffMins = Math.floor(diffMs / 60000);
                    const diffHours = Math.floor(diffMs / 3600000);
                    const diffDays = Math.floor(diffMs / 86400000);
                    
                    if (diffMins < 1) {
                        timeEl.textContent = 'Just now';
                    } else if (diffMins < 60) {
                        timeEl.textContent = `${diffMins}m`;
                    } else if (diffHours < 24) {
                        timeEl.textContent = `${diffHours}h`;
                    } else {
                        timeEl.textContent = `${diffDays}d`;
                    }
                }
            } else {
                previewEl.textContent = 'Start a conversation';
                timeEl.textContent = '';
            }
        });
    });
</script>

<style>
.tenant-dashboard {
    padding: 0;
}

.welcome-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.welcome-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.welcome-header .subtitle {
    color: var(--text-secondary);
    margin: 0.25rem 0 0;
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

.btn-primary svg {
    width: 18px;
    height: 18px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    border: 1px solid var(--border-color, #e5e7eb);
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon svg {
    width: 24px;
    height: 24px;
}

.stat-icon.saved {
    background: rgba(245, 158, 11, 0.15);
    color: #f59e0b;
}

.stat-icon.active {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.stat-icon.past {
    background: rgba(59, 130, 246, 0.15);
    color: #3b82f6;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary, #111827);
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary, #4b5563);
}

.section {
    margin-bottom: 2rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem;
}

.section-header .section-title {
    margin: 0;
}

.view-all {
    color: #667eea;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
}

.active-rental-card {
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    border: 1px solid #10b981;
    display: flex;
    overflow: hidden;
    gap: 1.5rem;
    padding: 1rem;
    align-items: center;
}

.rental-image {
    width: 180px;
    height: 120px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.rental-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.rental-info {
    flex: 1;
}

.rental-info h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary, #111827);
    margin: 0 0 0.25rem;
}

.rental-info .address {
    color: var(--text-secondary, #4b5563);
    font-size: 0.875rem;
    margin: 0 0 0.5rem;
}

.rental-details {
    display: flex;
    gap: 1.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary, #4b5563);
    margin-bottom: 0.5rem;
}

.rental-details strong {
    color: var(--text-primary, #111827);
}

.landlord {
    font-size: 0.875rem;
    color: var(--text-muted, #6b7280);
    margin: 0;
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
}

.btn-view:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.properties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1rem;
}

.property-card {
    background: var(--card-bg, #ffffff);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--border-color, #e5e7eb);
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.property-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
}

.property-image {
    position: relative;
    height: 140px;
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
    color: var(--text-muted, #9ca3af);
    font-size: 0.875rem;
}

.property-type {
    position: absolute;
    top: 8px;
    left: 8px;
    padding: 0.25rem 0.75rem;
    background: rgba(0,0,0,0.7);
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
}

.property-info {
    padding: 1rem;
}

.property-info h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary, #111827);
    margin: 0 0 0.25rem;
}

.property-info .address {
    font-size: 0.8125rem;
    color: var(--text-secondary, #4b5563);
    margin: 0 0 0.5rem;
}

.specs {
    display: flex;
    gap: 0.75rem;
    font-size: 0.75rem;
    color: var(--text-muted, #6b7280);
    margin-bottom: 0.5rem;
}

.price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #667eea;
}

.price small {
    font-size: 0.75rem;
    font-weight: 400;
    color: var(--text-secondary, #6b7280);
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
    margin: 0 0 1rem;
}

.btn-secondary {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border: 1px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    color: var(--text-secondary, #4b5563);
    text-decoration: none;
}

@media (max-width: 768px) {
    .active-rental-card {
        flex-direction: column;
        text-align: center;
    }
    
    .rental-image {
        width: 100%;
        height: 160px;
    }
    
    .rental-details {
        justify-content: center;
    }
}

/* Chat List Compact */
.chat-list-compact {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.chat-item-compact {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 1rem 1.25rem;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-bottom: none;
    text-decoration: none;
    transition: all 0.2s;
}

.chat-item-compact:first-child {
    border-radius: 10px 10px 0 0;
}

.chat-item-compact:last-child {
    border-bottom: 1px solid #e5e5e5;
    border-radius: 0 0 10px 10px;
}

.chat-item-compact:only-child {
    border-radius: 10px;
    border-bottom: 1px solid #e5e5e5;
}

.chat-item-compact:hover {
    background: #fafafa;
}

.chat-avatar-compact {
    position: relative;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #3a3a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    flex-shrink: 0;
}

.online-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: #22c55e;
    border: 2px solid #fff;
    border-radius: 50%;
}

.chat-info-compact {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.chat-name-compact {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.chat-role {
    font-size: 14px;
    color: #888;
}

.chat-arrow {
    width: 18px;
    height: 18px;
    color: #888;
}

.empty-state.small {
    padding: 1.5rem;
}

.empty-state.small p {
    margin: 0;
    font-size: 15px;
}
</style>
@endsection

@extends('layouts.dashboard')

@section('title', 'Landlord Dashboard')

@section('content')
<div class="dashboard-content">
    <!-- Stats Overview -->
    <div class="welcome-section">
        <h1>Welcome back, {{ Auth::user()->name ?? 'Landlord' }}!</h1>
        <p>Here's what's happening with your properties today.</p>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">3</span>
                <span class="stat-label">Properties</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">127</span>
                <span class="stat-label">Total Views</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">5</span>
                <span class="stat-label">Inquiries</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">2</span>
                <span class="stat-label">Pending</span>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="quick-actions">
        <button class="action-btn primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Property
        </button>
    </div>
    
    <!-- My Properties -->
    <div class="section-header">
        <h2>My Properties</h2>
        <a href="#" class="view-all">View All</a>
    </div>
    
    <div class="properties-table">
        <table>
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="property-cell">
                        <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=100" alt="">
                        <span>Cozy Studio IT Park</span>
                    </td>
                    <td>₱25,000/mo</td>
                    <td><span class="status active">Active</span></td>
                    <td>45</td>
                    <td class="actions">
                        <button class="edit-btn" title="Edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="delete-btn" title="Delete">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="property-cell">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=100" alt="">
                        <span>Modern Condo Lahug</span>
                    </td>
                    <td>₱45,000/mo</td>
                    <td><span class="status active">Active</span></td>
                    <td>62</td>
                    <td class="actions">
                        <button class="edit-btn" title="Edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="delete-btn" title="Delete">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="property-cell">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=100" alt="">
                        <span>Family House Banilad</span>
                    </td>
                    <td>₱85,000/mo</td>
                    <td><span class="status paused">Paused</span></td>
                    <td>20</td>
                    <td class="actions">
                        <button class="edit-btn" title="Edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="delete-btn" title="Delete">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Recent Inquiries -->
    <div class="section-header">
        <h2>Recent Inquiries</h2>
        <span class="badge">2 new</span>
    </div>
    
    <div class="inquiries-list">
        <div class="inquiry-item unread">
            <div class="inquiry-avatar">JD</div>
            <div class="inquiry-content">
                <div class="inquiry-header">
                    <strong>John Doe</strong>
                    <span class="inquiry-time">2 hours ago</span>
                </div>
                <p>Interested in viewing "Cozy Studio IT Park"</p>
            </div>
        </div>
        <div class="inquiry-item unread">
            <div class="inquiry-avatar">MC</div>
            <div class="inquiry-content">
                <div class="inquiry-header">
                    <strong>Maria Cruz</strong>
                    <span class="inquiry-time">Yesterday</span>
                </div>
                <p>Is "Modern Condo Lahug" still available?</p>
            </div>
        </div>
        <div class="inquiry-item">
            <div class="inquiry-avatar">RL</div>
            <div class="inquiry-content">
                <div class="inquiry-header">
                    <strong>Robert Lee</strong>
                    <span class="inquiry-time">3 days ago</span>
                </div>
                <p>Question about parking for Family House</p>
            </div>
        </div>
    </div>
</div>
@endsection

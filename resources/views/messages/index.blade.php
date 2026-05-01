@extends('layouts.dashboard')

@section('title', 'Messages')

@section('content')
<div class="messages-page">
    <!-- Header -->
    <div class="page-header">
        <h1>Inbox</h1>
    </div>
    
    <!-- Search -->
    <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="search-input" placeholder="Search messages...">
    </div>
    
    <!-- Chat List -->
    <section class="section">
        <div class="section-header">
            <p class="section-label">{{ $listTitle }}</p>
        </div>
        
        @if($chatUsers->count() > 0)
            <div class="chat-list" id="chat-list">
                @foreach($chatUsers as $chatUser)
                    @php
                        $userIds = [auth()->id(), $chatUser->id];
                        sort($userIds);
                        $roomId = 'room_' . implode('_', $userIds);
                    @endphp
                    <a href="{{ route('messages.chat', $chatUser->id) }}" class="chat-item" data-room-id="{{ $roomId }}" data-user-id="{{ $chatUser->id }}">
                        <div class="chat-avatar">
                            @if($chatUser->avatar)
                                <img src="{{ $chatUser->avatar }}" alt="{{ $chatUser->name }}">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($chatUser->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="online-dot"></span>
                        </div>
                        <div class="chat-info">
                            <div class="chat-info-top">
                                <span class="chat-name">{{ $chatUser->name }}</span>
                                <span class="chat-time" id="time-{{ $chatUser->id }}">-</span>
                            </div>
                            <p class="chat-preview" id="preview-{{ $chatUser->id }}">Loading...</p>
                        </div>
                        <span class="unread-badge" id="badge-{{ $chatUser->id }}" style="display: none;">0</span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
                <p>No {{ strtolower($listTitle) }} found yet.</p>
            </div>
        @endif
    </section>
</div>

<style>
.messages-page {
    max-width: 600px;
}

.page-header {
    margin-bottom: 1.5rem;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.search-box {
    position: relative;
    margin-bottom: 1.5rem;
}

.search-box input {
    width: 100%;
    padding: 14px 14px 14px 48px;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    background: #fff;
    color: #1a1a1a;
    font-size: 16px;
}

.search-box input:focus {
    outline: none;
    border-color: #1a1a1a;
}

.search-box svg {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    color: #888;
}

.section {
    margin-bottom: 1.5rem;
}

.section-label {
    font-size: 13px;
    font-weight: 600;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.pinned-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    text-decoration: none;
    transition: all 0.2s;
}

.pinned-item:hover {
    border-color: #1a1a1a;
}

.ai-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #3a3a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.ai-avatar svg {
    width: 24px;
    height: 24px;
}

.pinned-info h3 {
    font-size: 17px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 4px;
}

.pinned-info p {
    font-size: 15px;
    color: #666;
    margin: 0;
}

.chat-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.chat-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-bottom: none;
    text-decoration: none;
    transition: all 0.2s;
}

.chat-item:first-child {
    border-radius: 12px 12px 0 0;
}

.chat-item:last-child {
    border-bottom: 1px solid #e5e5e5;
    border-radius: 0 0 12px 12px;
}

.chat-item:only-child {
    border-radius: 12px;
    border-bottom: 1px solid #e5e5e5;
}

.chat-item:hover {
    background: #fafafa;
}

.chat-avatar {
    position: relative;
    flex-shrink: 0;
}

.chat-avatar img,
.chat-avatar .avatar-placeholder {
    width: 52px;
    height: 52px;
    border-radius: 50%;
}

.chat-avatar .avatar-placeholder {
    background: #3a3a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 600;
    font-size: 18px;
}

.online-dot {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    background: #22c55e;
    border: 2px solid #fff;
    border-radius: 50%;
}

.chat-info {
    flex: 1;
    min-width: 0;
}

.chat-info-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.chat-name {
    font-size: 17px;
    font-weight: 600;
    color: #1a1a1a;
}

.chat-time {
    font-size: 13px;
    color: #888;
}

.chat-preview {
    font-size: 15px;
    color: #666;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
}

.unread-badge {
    min-width: 22px;
    height: 22px;
    background: #1a1a1a;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 6px;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
}

.empty-state svg {
    width: 48px;
    height: 48px;
    color: #888;
    margin-bottom: 1rem;
}

.empty-state p {
    color: #666;
    font-size: 16px;
    margin: 0;
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 24px;
    }
}
</style>

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
    const CURRENT_USER_ID = {{ auth()->id() }};

    // Get all chat items and fetch their last messages
    document.querySelectorAll('.chat-item').forEach(item => {
        const roomId = item.dataset.roomId;
        const userId = item.dataset.userId;
        
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
                    let text = lastMsg.text || '';
                    if (text.length > 40) {
                        text = text.substring(0, 40) + '...';
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
                        timeEl.textContent = `${diffMins}m ago`;
                    } else if (diffHours < 24) {
                        timeEl.textContent = `${diffHours}h ago`;
                    } else if (diffDays < 7) {
                        timeEl.textContent = `${diffDays}d ago`;
                    } else {
                        timeEl.textContent = date.toLocaleDateString();
                    }
                }
            } else {
                previewEl.textContent = 'Start a conversation...';
                timeEl.textContent = '';
            }
        });
    });
</script>
@endsection

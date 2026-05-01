@extends('layouts.dashboard')

@section('title', 'Chat with ' . $recipient->name)

@section('content')
<div class="chat-page">
    <!-- Chat Header -->
    <div class="chat-header">
        <a href="{{ route('messages.index') }}" class="back-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
        </a>
        <div class="recipient-info">
            <div class="recipient-avatar">
                {{ strtoupper(substr($recipient->name, 0, 1)) }}
            </div>
            <div>
                <h2>{{ $recipient->name }}</h2>
                <div class="recipient-status">
                    <span class="status-dot"></span>
                    <span>Online</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Messages Area -->
    <div class="messages-area" id="messages-list">
        <div id="loading-msg" class="loading-indicator">Loading history...</div>
    </div>
    
    <!-- Input Area -->
    <div class="input-area">
        <input type="text" id="msg-input" class="message-input" placeholder="Type a message...">
        <button id="send-btn" class="send-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
        </button>
    </div>
</div>

<style>
.chat-page {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 40px);
    max-width: 800px;
    margin: -20px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    overflow: hidden;
}

.chat-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 20px;
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
}

.back-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #1a1a1a;
    transition: background 0.2s;
}

.back-btn:hover {
    background: #f5f5f5;
}

.back-btn svg {
    width: 22px;
    height: 22px;
}

.recipient-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.recipient-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #3a3a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 600;
    font-size: 18px;
}

.recipient-info h2 {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
}

.recipient-status {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    color: #888;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #22c55e;
}

.messages-area {
    flex: 1;
    overflow-y: auto;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    background: #fafafa;
}

.loading-indicator {
    text-align: center;
    color: #888;
    font-size: 14px;
    padding: 10px;
    display: none;
}

.message {
    display: flex;
    align-items: flex-end;
    gap: 10px;
}

.message.sent {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #3a3a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    flex-shrink: 0;
}

.message-content {
    max-width: 70%;
}

.message-bubble {
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 16px;
    line-height: 1.5;
}

.message.received .message-bubble {
    background: #fff;
    color: #1a1a1a;
    border: 1px solid #e5e5e5;
    border-bottom-left-radius: 4px;
}

.message.sent .message-bubble {
    background: #1a1a1a;
    color: #fff;
    border-bottom-right-radius: 4px;
}

.message-time {
    font-size: 11px;
    color: #888;
    margin-top: 5px;
    opacity: 0;
    transition: opacity 0.2s;
}

.message:hover .message-time {
    opacity: 1;
}

.message.sent .message-time {
    text-align: right;
}

.input-area {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    background: #fff;
    border-top: 1px solid #e5e5e5;
}

.message-input {
    flex: 1;
    padding: 14px 18px;
    border: 1px solid #e5e5e5;
    border-radius: 24px;
    background: #fafafa;
    color: #1a1a1a;
    font-size: 16px;
}

.message-input:focus {
    outline: none;
    border-color: #1a1a1a;
    background: #fff;
}

.send-btn {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: none;
    background: #1a1a1a;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.15s, background 0.2s;
}

.send-btn:hover {
    transform: scale(1.05);
    background: #333;
}

.send-btn:active {
    transform: scale(0.95);
}

.send-btn svg {
    width: 22px;
    height: 22px;
}

@media (max-width: 768px) {
    .chat-page {
        margin: -20px;
        border-radius: 0;
        border: none;
        height: calc(100vh - 70px);
    }
    
    .recipient-info h2 {
        font-size: 16px;
    }
}
</style>

<script type="module">
    // Firebase Integration
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import {
        getDatabase,
        ref,
        push,
        query,
        limitToLast,
        onChildAdded,
        get,
        orderByKey,
        endBefore
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

    const ROOM_ID = "{{ $roomId }}";
    const CURRENT_USER_ID = {{ $currentUser->id }};
    const CURRENT_USER_NAME = "{{ $currentUser->name }}";
    const RECIPIENT_NAME = "{{ $recipient->name }}";
    const IS_LANDLORD = {{ $isLandlord ? 'true' : 'false' }};
    const SENDER_TYPE = IS_LANDLORD ? 'landlord' : 'customer';
    const PAGE_SIZE = 20;

    const messagesRef = ref(db, `rooms/${ROOM_ID}/messages`);

    const listEl = document.getElementById('messages-list');
    const inputEl = document.getElementById('msg-input');
    const sendBtn = document.getElementById('send-btn');
    const loaderEl = document.getElementById('loading-msg');

    let oldestKey = null;
    let isLoading = false;
    let isAllHistoryLoaded = false;

    const recentQuery = query(messagesRef, limitToLast(PAGE_SIZE));

    onChildAdded(recentQuery, (snapshot) => {
        const msg = snapshot.val();
        const key = snapshot.key;

        if (document.getElementById(key)) return;

        renderMessage(key, msg.text, false, msg.senderID, msg.senderType, msg.timestamp);

        if (!oldestKey) oldestKey = key;

        listEl.scrollTop = listEl.scrollHeight;
    });

    function renderMessage(id, text, prepend, senderID, senderType, timestamp) {
        const div = document.createElement('div');
        div.id = id;
        
        const date = new Date(timestamp);
        const isSent = senderID === CURRENT_USER_ID;
        
        div.className = `message ${isSent ? 'sent' : 'received'}`;
        
        const avatarLetter = isSent ? CURRENT_USER_NAME.charAt(0).toUpperCase() : RECIPIENT_NAME.charAt(0).toUpperCase();
        
        div.innerHTML = `
            <div class="message-avatar">${avatarLetter}</div>
            <div class="message-content">
                <div class="message-bubble">${text}</div>
                <div class="message-time">${date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
            </div>
        `;

        if (prepend) {
            const firstMsg = listEl.querySelector('.message');
            if (firstMsg) {
                listEl.insertBefore(div, firstMsg);
            } else {
                listEl.appendChild(div);
            }
        } else {
            listEl.appendChild(div);
        }
    }

    async function loadMoreMessages() {
        if (isLoading || isAllHistoryLoaded || !oldestKey) return;

        isLoading = true;
        loaderEl.style.display = 'block';

        const currentHeight = listEl.scrollHeight;

        const oldQuery = query(
            messagesRef,
            orderByKey(),
            endBefore(oldestKey),
            limitToLast(PAGE_SIZE)
        );

        try {
            const snapshot = await get(oldQuery);

            if (!snapshot.exists()) {
                isAllHistoryLoaded = true;
                loaderEl.textContent = "Start of conversation";
                return;
            }

            const updates = [];
            snapshot.forEach(child => {
                updates.push({ key: child.key, ...child.val() });
            });

            if (updates.length > 0) {
                oldestKey = updates[0].key;
            }

            updates.reverse().forEach(msg => {
                renderMessage(msg.key, msg.text, true, msg.senderID, msg.senderType, msg.timestamp);
            });

            const newHeight = listEl.scrollHeight;
            listEl.scrollTop = newHeight - currentHeight;

        } catch (error) {
            console.error("Error loading history:", error);
        } finally {
            isLoading = false;
            if (!isAllHistoryLoaded) loaderEl.style.display = 'none';
        }
    }

    listEl.addEventListener('scroll', () => {
        if (listEl.scrollTop === 0) {
            loadMoreMessages();
        }
    });

    sendBtn.addEventListener('click', () => {
        const text = inputEl.value.trim();
        if (!text) return;
        
        push(messagesRef, {
            text: text,
            senderID: CURRENT_USER_ID,
            senderType: SENDER_TYPE,
            timestamp: Date.now()
        });
        
        inputEl.value = '';
        inputEl.focus();
    });

    inputEl.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendBtn.click();
        }
    });
</script>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chat with {{ $landlordName ?? 'Landlord' }} - PropConnect</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
    <div class="chat-container">
        <!-- Chat Header -->
        <header class="chat-header">
            <a href="{{ url()->previous() }}" class="back-btn" aria-label="Go back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="chat-user-info">
                <h1 class="chat-user-name">{{ $landlordName ?? 'Property Owner' }}</h1>
                <div class="chat-user-status">
                    <span class="status-dot {{ $isOnline ? 'online' : 'offline' }}"></span>
                    <span class="status-text">{{ $isOnline ? 'ONLINE' : 'OFFLINE' }}</span>
                </div>
            </div>
            <button class="favorite-btn" aria-label="Add to favorites">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
            </button>
        </header>

        <!-- Chat Messages Area -->
        <main class="chat-messages" id="chatMessages">
            @php
                // Demo messages for prototype - these would come from database in production
                $demoMessages = [
                    ['sender' => 'landlord', 'message' => 'Hello! Thank you for your interest in my property.', 'time' => '5:10:09 PM', 'date' => 'Today'],
                    ['sender' => 'user', 'message' => 'Hi! I would like to inquire about the studio unit.', 'time' => '5:12:30 PM', 'date' => 'Today'],
                    ['sender' => 'landlord', 'message' => 'Of course! What would you like to know?', 'time' => '5:15:22 PM', 'date' => 'Today'],
                    ['sender' => 'landlord', 'message' => "The unit is fully furnished and includes utilities.", 'time' => '5:16:45 PM', 'date' => 'Today'],
                    ['sender' => 'user', 'message' => 'Is it available for viewing this weekend?', 'time' => '8:05:04 AM', 'date' => 'Today'],
                    ['sender' => 'user', 'message' => 'I can come by Saturday afternoon.', 'time' => '12:44:38 PM', 'date' => 'Today'],
                    ['sender' => 'landlord', 'message' => 'Yes, Saturday works! How about 2PM?', 'time' => '1:30:00 PM', 'date' => 'Today'],
                ];
            @endphp

            @foreach($demoMessages as $msg)
                @if($msg['sender'] === 'landlord')
                    <div class="message-group received">
                        <div class="sender-avatar">
                            <span class="avatar-letter">{{ strtoupper(substr($landlordName ?? 'L', 0, 1)) }}</span>
                        </div>
                        <div class="message-content">
                            <span class="sender-name">{{ $landlordName ?? 'Property Owner' }}</span>
                            <div class="message-bubble">{{ $msg['message'] }}</div>
                        </div>
                    </div>
                @else
                    <div class="message-group sent">
                        <div class="message-content">
                            <div class="message-bubble">{{ $msg['message'] }}</div>
                            <span class="message-time">{{ $msg['time'] }}</span>
                        </div>
                        <div class="sender-avatar user-avatar">
                            <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="You" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <span class="avatar-letter" style="display: none;">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </main>

        <!-- Chat Input Area -->
        <footer class="chat-input-area">
            <button class="attach-btn" aria-label="Attach file">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
            </button>
            <div class="input-wrapper">
                <input 
                    type="text" 
                    id="messageInput" 
                    class="message-input" 
                    placeholder="Message the concierge..."
                    autocomplete="off"
                >
                <button class="camera-btn" aria-label="Take photo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </button>
            </div>
            <button class="send-btn" id="sendBtn" aria-label="Send message">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </footer>
    </div>

    <script src="{{ asset('javascript/chat.js') }}"></script>
</body>
</html>

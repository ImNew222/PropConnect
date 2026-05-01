/**
 * Chat Interface JavaScript
 * Handles real-time chat functionality and UI interactions
 */

(function() {
    'use strict';

    // ========================================
    // DOM ELEMENTS
    // ========================================
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const favoriteBtn = document.querySelector('.favorite-btn');
    const attachBtn = document.querySelector('.attach-btn');
    const cameraBtn = document.querySelector('.camera-btn');

    // ========================================
    // STATE
    // ========================================
    let isTyping = false;
    let typingTimeout = null;

    // ========================================
    // HELPER FUNCTIONS
    // ========================================
    
    /**
     * Format current time for message timestamp
     */
    function getCurrentTime() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const period = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        return `${hours}:${minutes}:${seconds} ${period}`;
    }

    /**
     * Scroll to bottom of chat
     */
    function scrollToBottom() {
        chatMessages.scrollTo({
            top: chatMessages.scrollHeight,
            behavior: 'smooth'
        });
    }

    /**
     * Create a message element
     */
    function createMessageElement(text, isSent = true) {
        const messageGroup = document.createElement('div');
        messageGroup.className = `message-group ${isSent ? 'sent' : 'received'}`;
        
        if (isSent) {
            messageGroup.innerHTML = `
                <div class="message-content">
                    <div class="message-bubble">${escapeHtml(text)}</div>
                    <span class="message-time">${getCurrentTime()}</span>
                </div>
                <div class="sender-avatar user-avatar">
                    <span class="avatar-letter">U</span>
                </div>
            `;
        } else {
            const landlordName = document.querySelector('.chat-user-name')?.textContent || 'Landlord';
            const firstLetter = landlordName.charAt(0).toUpperCase();
            
            messageGroup.innerHTML = `
                <div class="sender-avatar">
                    <span class="avatar-letter">${firstLetter}</span>
                </div>
                <div class="message-content">
                    <span class="sender-name">${landlordName}</span>
                    <div class="message-bubble">${escapeHtml(text)}</div>
                </div>
            `;
        }
        
        return messageGroup;
    }

    /**
     * Create typing indicator element
     */
    function createTypingIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'message-group received';
        indicator.id = 'typingIndicator';
        
        const landlordName = document.querySelector('.chat-user-name')?.textContent || 'Landlord';
        const firstLetter = landlordName.charAt(0).toUpperCase();
        
        indicator.innerHTML = `
            <div class="sender-avatar">
                <span class="avatar-letter">${firstLetter}</span>
            </div>
            <div class="message-content">
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        
        return indicator;
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * Show typing indicator
     */
    function showTypingIndicator() {
        if (document.getElementById('typingIndicator')) return;
        
        const indicator = createTypingIndicator();
        chatMessages.appendChild(indicator);
        scrollToBottom();
    }

    /**
     * Hide typing indicator
     */
    function hideTypingIndicator() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) {
            indicator.remove();
        }
    }

    /**
     * Simulate AI/landlord response
     */
    function simulateResponse() {
        showTypingIndicator();
        
        // Simulated responses for prototype
        const responses = [
            "Thank you for your message! I'll get back to you shortly.",
            "That's a great question. Let me check the details for you.",
            "The property is still available. Would you like to schedule a viewing?",
            "Yes, the unit comes fully furnished with all amenities included.",
            "The lease terms are flexible. We can discuss what works best for you.",
            "I'll send you more photos of the property right away!",
            "Perfect! I'm available this weekend for a property tour.",
        ];
        
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        
        // Simulate typing delay (1.5-3 seconds)
        const typingDelay = 1500 + Math.random() * 1500;
        
        setTimeout(() => {
            hideTypingIndicator();
            
            const messageElement = createMessageElement(randomResponse, false);
            chatMessages.appendChild(messageElement);
            scrollToBottom();
        }, typingDelay);
    }

    // ========================================
    // EVENT HANDLERS
    // ========================================

    /**
     * Send message
     */
    function sendMessage() {
        const message = messageInput.value.trim();
        
        if (!message) return;
        
        // Create and append user message
        const messageElement = createMessageElement(message, true);
        chatMessages.appendChild(messageElement);
        
        // Clear input
        messageInput.value = '';
        
        // Scroll to bottom
        scrollToBottom();
        
        // Simulate response after a short delay
        setTimeout(simulateResponse, 500);
    }

    /**
     * Toggle favorite
     */
    function toggleFavorite() {
        favoriteBtn.classList.toggle('active');
        
        // Haptic feedback if supported
        if (navigator.vibrate) {
            navigator.vibrate(10);
        }
    }

    /**
     * Handle attachment
     */
    function handleAttachment() {
        // In a real app, this would open a file picker
        console.log('Attachment clicked - would open file picker');
        
        // Show a demo notification
        showNotification('Attachments coming soon!');
    }

    /**
     * Handle camera
     */
    function handleCamera() {
        // In a real app, this would open the camera
        console.log('Camera clicked - would open camera');
        
        showNotification('Camera feature coming soon!');
    }

    /**
     * Show notification toast
     */
    function showNotification(message) {
        // Create toast if it doesn't exist
        let toast = document.getElementById('toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'toast';
            toast.style.cssText = `
                position: fixed;
                bottom: 100px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                font-size: 14px;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;
            document.body.appendChild(toast);
        }
        
        toast.textContent = message;
        toast.style.opacity = '1';
        
        setTimeout(() => {
            toast.style.opacity = '0';
        }, 2000);
    }

    // ========================================
    // EVENT LISTENERS
    // ========================================

    // Send button click
    sendBtn?.addEventListener('click', sendMessage);

    // Enter key to send
    messageInput?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Favorite button
    favoriteBtn?.addEventListener('click', toggleFavorite);

    // Attachment button
    attachBtn?.addEventListener('click', handleAttachment);

    // Camera button
    cameraBtn?.addEventListener('click', handleCamera);

    // Focus input on load
    messageInput?.focus();

    // Scroll to bottom on load
    scrollToBottom();

    // ========================================
    // INITIALIZATION
    // ========================================
    console.log('Chat interface initialized');

})();

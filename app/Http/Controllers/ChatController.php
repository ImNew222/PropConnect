<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display the chat interface with a landlord
     *
     * @param int $landlordId
     * @return \Illuminate\View\View
     */
    public function landlord($landlordId)
    {
        // Get landlord details
        $landlord = User::find($landlordId);
        
        // For prototype - use defaults if landlord not found
        $landlordName = $landlord->name ?? 'Property Owner';
        
        // Simulated online status for prototype
        // In production, this would check last activity timestamp
        $isOnline = rand(0, 1) === 1;
        
        return view('chat.landlord', [
            'landlordId' => $landlordId,
            'landlordName' => $landlordName,
            'landlordAvatar' => $landlord->avatar ?? null,
            'isOnline' => $isOnline,
        ]);
    }
    
    /**
     * Display the AI chat interface
     *
     * @return \Illuminate\View\View
     */
    public function aiChat()
    {
        return view('chat.ai', [
            'assistantName' => 'PropConnect AI',
            'isOnline' => true, // AI is always online
        ]);
    }
    
    /**
     * API endpoint to send a message (for future implementation)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|integer',
            'message' => 'required|string|max:5000',
        ]);
        
        // For prototype - just return success
        // In production, this would store the message in database
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => [
                'id' => uniqid(),
                'text' => $request->message,
                'sent_at' => now()->toIso8601String(),
            ]
        ]);
    }
    
    /**
     * API endpoint to get chat history (for future implementation)
     *
     * @param int $landlordId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($landlordId)
    {
        // For prototype - return demo messages
        // In production, this would fetch from database
        $messages = [
            [
                'id' => 1,
                'sender_id' => $landlordId,
                'message' => 'Hello! Thank you for your interest in my property.',
                'sent_at' => now()->subHours(2)->toIso8601String(),
                'is_read' => true,
            ],
            [
                'id' => 2,
                'sender_id' => auth()->id() ?? 0,
                'message' => 'Hi! I would like to inquire about the studio unit.',
                'sent_at' => now()->subHours(1)->toIso8601String(),
                'is_read' => true,
            ],
        ];
        
        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }
    
    /**
     * Display the message list (inbox) for both users and landlords
     *
     * @return \Illuminate\View\View
     */
    public function messageList()
    {
        $user = auth()->user();
        $isLandlord = $user->role === 'landlord';
        
        // Get users to chat with (landlords see users, users see landlords)
        if ($isLandlord) {
            // Landlord sees list of customers (tenants)
            $chatUsers = User::where('role', '!=', 'landlord')
                ->where('id', '!=', $user->id)
                ->limit(10)
                ->get();
            $listTitle = 'Customers';
        } else {
            // User/Tenant sees list of landlords
            $chatUsers = User::where('role', 'landlord')
                ->limit(10)
                ->get();
            $listTitle = 'Landlords';
        }
        
        return view('messages.index', [
            'chatUsers' => $chatUsers,
            'listTitle' => $listTitle,
            'isLandlord' => $isLandlord,
        ]);
    }
    
    /**
     * Display individual chat with a recipient
     *
     * @param int $recipientId
     * @return \Illuminate\View\View
     */
    public function chat($recipientId)
    {
        $user = auth()->user();
        $recipient = User::find($recipientId);
        
        if (!$recipient) {
            abort(404, 'User not found');
        }
        
        $isLandlord = $user->role === 'landlord';
        
        // Create a unique room ID based on both user IDs (sorted for consistency)
        $userIds = [$user->id, $recipient->id];
        sort($userIds);
        $roomId = 'room_' . implode('_', $userIds);
        
        return view('messages.chat', [
            'recipient' => $recipient,
            'roomId' => $roomId,
            'isLandlord' => $isLandlord,
            'currentUser' => $user,
        ]);
    }
}

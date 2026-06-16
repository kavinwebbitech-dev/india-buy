<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function index($id)
    {
        $messages = Message::with('sender')
            ->where('enquiry_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Store new message
     */
    public function store(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $senderId = Auth::guard('vendor')->id() ?? Auth::id();
        $receiverId = ($senderId == $enquiry->sender_id)
            ? $enquiry->receiver_id
            : $enquiry->sender_id;
        // dd($senderId,$receiverId);

        $message = Message::create([
            'enquiry_id' => $id,
            'sender_id'  => $senderId,
            'receiver_id' => $receiverId,
            'message'    => $request->message,
            'is_read'    => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }


    // public function markAsRead($enquiryId)
    // {
    //     $updated = Message::where('enquiry_id', $enquiryId)
    //         ->where('receiver_id', auth()->id())
    //         ->where('is_read', 0)
    //         ->update([
    //             'is_read' => 1
    //         ]);

    //     return response()->json([
    //         'success' => true,
    //         'updated' => $updated
    //     ]);
    // }


    // public function markAsRead($enquiryId)
    // {
    //     $userId = Auth::guard('vendor')->id() ?: Auth::id();

    //     $updated = Message::where('enquiry_id', $enquiryId)
    //         ->where('receiver_id', $userId)
    //         ->where('is_read', 0)
    //         ->update([
    //             'is_read' => 1
    //         ]);

    //     return response()->json([
    //         'success' => true,
    //         'updated' => $updated
    //     ]);
    // }

    public function markAsRead($enquiryId)
{
    $userId = null;
    $guardType = null;

    if (Auth::guard('vendor')->check()) {
        $userId = Auth::guard('vendor')->id();
        $guardType = 'vendor';
    } elseif (Auth::check()) {
        $userId = Auth::id();
        $guardType = 'user';
    }

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
    }

    $enquiry = \App\Models\Enquiry::find($enquiryId);

    if (!$enquiry) {
        return response()->json(['success' => false, 'message' => 'Enquiry not found'], 404);
    }

    // ✅ Determine the correct receiver_id to match against
    // Only mark as read if current logged-in party is the actual receiver of this enquiry
    $updated = Message::where('enquiry_id', $enquiryId)
        ->where('receiver_id', $userId)
        ->where('is_read', 0)
        ->update(['is_read' => 1]);

    return response()->json([
        'success' => true,
        'updated' => $updated,
        'guard' => $guardType,
        'userId' => $userId,
        'enquiry_sender_id' => $enquiry->sender_id,
        'enquiry_receiver_id' => $enquiry->receiver_id,
    ]);
}
}

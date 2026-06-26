<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Quotation;
class ChatController extends Controller
{
    //
    // public function index($id)
    // {
    //     $messages = Message::with('sender')
    //         ->where('enquiry_id', $id)
    //         ->orderBy('id', 'asc')
    //         ->get();

    //     return response()->json($messages);
    // }
    public function index($id)
    {
        $messages = Message::with('sender')
            ->where('enquiry_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        foreach ($messages as $msg) {
            if (preg_match('/\[QUOTATION_ID:(\d+)\]/', $msg->message, $matches)) {
                $quotationId = $matches[1];
                
                $msg->quotation = Quotation::find($quotationId);
                
                $msg->clean_message = preg_replace('/\[QUOTATION_ID:\d+\]/', '', $msg->message);
                $msg->is_quotation = true;
            } else {
                $msg->clean_message = $msg->message;
                $msg->is_quotation = false;
            }
        }

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
  public function storeQuotation(Request $request, $id)
{
    $request->validate([
        'price' => 'required|numeric',
        'file'  => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048'
    ]);

    $enquiry = Enquiry::findOrFail($id);
    $senderId = Auth::guard('vendor')->id();

    if ($request->hasFile('file')) {

        // Upload Folder
        $destinationPath = public_path('uploads/quotations');

        // Create Folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Generate Unique File Name
        $file = $request->file('file');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move File
        $file->move($destinationPath, $fileName);

        // Store Relative Path in DB
        $filePath = 'uploads/quotations/' . $fileName;

        $quotation = Quotation::create([
            'enquiry_id' => $id,
            'vendor_id'  => $senderId,
            'price'      => $request->price,
            'file_path'  => $filePath,
        ]);

        $receiverId = ($senderId == $enquiry->sender_id)
            ? $enquiry->receiver_id
            : $enquiry->sender_id;

        Message::create([
            'enquiry_id' => $id,
            'sender_id'  => $senderId,
            'receiver_id'=> $receiverId,
            'message'    => "Sent a quotation of ₹" . number_format($request->price) .
                            " [QUOTATION_ID:" . $quotation->id . "]",
            'is_read'    => 0,
        ]);

        return response()->json([
            'success' => true,
            'path' => $filePath
        ]);
    }

    return response()->json(['success' => false], 400);
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
public function markAsRead($enquiryId)
{
    // dd(1);
    if (Auth::guard('vendor')->check()) {
        $userId = Auth::guard('vendor')->id();
    } elseif (Auth::check()) {
        $userId = Auth::id();
    } else {
        return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
    }
    $updated = Message::where('enquiry_id', $enquiryId)
        ->where('receiver_id', $userId)
        ->where('is_read', 0)
        ->update(['is_read' => 1]);
    // dd($enquiryId,$updated);

    return response()->json([
        'success' => true,
        'updated' => $updated,
        'userId' => $userId,
    ]);
}

//     public function markAsRead($enquiryId)
// {
//     $userId = null;
//     $guardType = null;

//     if (Auth::guard('vendor')->check()) {
//         $userId = Auth::guard('vendor')->id();
//         $guardType = 'vendor';
//     } elseif (Auth::check()) {
//         $userId = Auth::id();
//         $guardType = 'user';
//     }

//     if (!$userId) {
//         return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
//     }

//     $enquiry = \App\Models\Enquiry::find($enquiryId);

//     if (!$enquiry) {
//         return response()->json(['success' => false, 'message' => 'Enquiry not found'], 404);
//     }

//     // ✅ Determine the correct receiver_id to match against
//     // Only mark as read if current logged-in party is the actual receiver of this enquiry
//     $updated = Message::where('enquiry_id', $enquiryId)
//         ->where('receiver_id', $userId)
//         ->where('is_read', 0)
//         ->update(['is_read' => 1]);

//     return response()->json([
//         'success' => true,
//         'updated' => $updated,
//         'guard' => $guardType,
//         'userId' => $userId,
//         'enquiry_sender_id' => $enquiry->sender_id,
//         'enquiry_receiver_id' => $enquiry->receiver_id,
//     ]);
// }
}

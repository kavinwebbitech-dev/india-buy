<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Enquiry;

class UsersController extends Controller
{
    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $enquiries = Enquiry::with([
            'product',
             'service',
            'sender',
            'receiver'
        ])
        ->whereIn('id', function ($query) {
            $query->select('enquiry_id')
                ->from('chat_messages')
                ->where('receiver_id', auth()->id());
        })
        ->latest()
        ->paginate(10); 
       $sendenquiries = Enquiry::with([
            'product',
             'service',
            'sender',
            'receiver'
        ])
        ->where('sender_id', auth()->id())
        ->latest()
        ->paginate(10); 
        // dd( $enquiries,$sendenquiries, auth()->id());
        return view('auth.dashboard', compact('enquiries','sendenquiries'));
    }

    public function profileUpdate(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|digits_between:10,15',
        'address' => 'required|string',
        'state' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    // Image Upload
    if ($request->hasFile('image')) {

        // Delete old image
        if ($user->image && file_exists(public_path('uploads/profile/' . $user->image))) {

            unlink(public_path('uploads/profile/' . $user->image));
        }

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/profile'), $imageName);

        $user->profile_image = $imageName;
    }

    $user->name = $request->name;
    $user->phone = $request->mobile;
    $user->address = $request->address;
    $user->state = $request->state;
    $user->city = $request->city;

    $user->save();

    return back()->with('success', 'Profile Updated Successfully');
}

public function passwordUpdate(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

    // Check current password
    if (!Hash::check($request->current_password, $user->password)) {

        return back()->withErrors([
            'current_password' => 'Current password is incorrect'
        ]);
    }

    // Prevent same password update
    if (Hash::check($request->password, $user->password)) {

        return back()->withErrors([
            'password' => 'New password cannot be the same as the current password'
        ]);
    }

    // Update password
    $user->update([
        'password' => Hash::make($request->password)
    ]);

    return back()->with(
        'password_success',
        'Password Updated Successfully'
    );
}
}

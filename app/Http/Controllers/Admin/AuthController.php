<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorType;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'user_type' => 'admin'
        ])) {
            return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successfully!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        $vendors = Vendor::where('status', 1)->count();

        $users = User::where('user_type', 'user')->count();

        $products = Product::where('status', 1)
            // ->where('category_id', 1)
            ->count();

        $services = Service::where('status', 1)->count();

        $properties = Product::where('status', 1)
            ->where('category_id', 3)
            ->count();

        $category = Category::where('status', 1)->count();

        $subcategory = SubCategory::where('status', 1)->count();

        $vendortypes = VendorType::where('status', 1)->count();

        return view('admin.dashboard', compact(
            'vendors',
            'users',
            'products',
            'services',
            'properties',
            'category',
            'subcategory',
            'vendortypes'
        ));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('error', 'Admin Logout Successfully!');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',

        ]);

        // Update name
        $user->name = $request->name;

        // Update password if entered
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Upload image
        // if ($request->hasFile('profile_image')) {

        //     // Delete old image
        //     if ($user->profile_image && file_exists(public_path('uploads/' . $user->profile_image))) {
        //         unlink(public_path('uploads/' . $user->profile_image));
        //     }

        //     $extension = $request->file('profile_image')->getClientOriginalExtension();
        //     $fileName = time() . '.' . $extension;

        //     $request->file('profile_image')->move(public_path('uploads'), $fileName);

        //     // Save only image name
        //     $user->profile_image = $fileName;
        // }

        if ($request->hasFile('profile_image')) {

            if (
                $user->profile_image &&
                file_exists(public_path('uploads/' . $user->profile_image))
            ) {
                unlink(public_path('uploads/' . $user->profile_image));
            }

            $fileName = time() . '.' .
                $request->profile_image->getClientOriginalExtension();

            $request->profile_image->move(
                public_path('uploads'),
                $fileName
            );

            $user->profile_image = $fileName;
        }

        $user->save();
        // dd($request->file('profile_image'));

        return back()->with('success', 'Profile updated successfully');
    }

    public function settings()
    {
        $setting = Setting::first();
        return view('admin.settings', compact('setting'));
    }

    public function updateSettings(Request $request)
    {
        $setting = Setting::first();

        $request->validate([
            'site_name' => 'required',
            'admin_email' => 'required|email',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image'
        ]);

        if ($request->hasFile('logo')) {
            $setting->logo = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $setting->favicon = $request->file('favicon')->store('settings', 'public');
        }

        $setting->site_name = $request->site_name;
        $setting->admin_email = $request->admin_email;
        $setting->footer_text = $request->footer_text;
        $setting->save();

        return back()->with('success', 'Settings saved successfully');
    }
}

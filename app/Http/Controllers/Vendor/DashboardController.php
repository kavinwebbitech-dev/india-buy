<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Quotation; 
class DashboardController extends Controller
{
// public function manufacturerDashboard()
// {
//     // dd(7);
//     $userId = Auth::guard('vendor')->id();
//     // dd(Auth::guard('vendor')->id());
//      $enquiries = Enquiry::with([
//             'product',
//             'sender',
//             'service',
//             'receiver'
//         ])
//         ->where('receiver_id', $userId)
//         ->latest()
//         ->get();
//        $sendenquiries = Enquiry::with([
//             'product',
//             'sender',
//             'service',
//             'receiver'
//         ])
//         ->where('sender_id', $userId)
//         ->latest()
//         ->get();
//         // dd($enquiries,$sendenquiries,$userId);
//     return view('vendor.manufacturer.dashboard', compact('enquiries','sendenquiries'));
// }

public function manufacturerDashboard(Request $request)
{
    // 1. சரியான Vendor Guard மூலமாக லாகின் செய்த ID-ஐ எடுக்கிறோம்
    $userId = Auth::guard('vendor')->id(); 

    $query = Enquiry::with([
        'product',
        'sender',
        'service',
        'receiver'
    ])->where('receiver_id', $userId);

    // Search Filter
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->whereHas('sender', function ($sender) use ($search) {
                $sender->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhereHas('product', function ($product) use ($search) {
                $product->where('product_name', 'like', "%{$search}%");
            })
            ->orWhereHas('service', function ($service) use ($search) {
                $service->where('service_name', 'like', "%{$search}%");
            });
        });
    }

    // Last 7 Days Filter
    if ($request->sent_time == '7days') {
        $query->where('created_at', '>=', now()->subDays(7));
    }

    // Unread Filter
    if ($request->filter == 'unread') {
        $query->where('is_read', 0);
    }

    // Not Yet Replied Filter
    if ($request->filter == 'unreplied') {
        $query->where('is_replied', 0);
    }

    $enquiries = $query->latest()->paginate(10, ['*'], 'enquiries_page');

    $sendenquiries = Enquiry::with([
        'product',
        'sender',
        'service',
        'receiver'
    ])
    ->where('sender_id', $userId)
    ->where('is_read', 0)
    ->latest()
    ->paginate(10, ['*'], 'send_enquiries_page');

    $quotations = Quotation::with(['enquiry.receiver', 'enquiry.product', 'enquiry.service'])
        ->where('vendor_id', $userId) // auth()->id() க்குப் பதிலாக $userId
        ->latest()
        ->paginate(10, ['*'], 'quotations_page');

    // dd($quotations, $userId);

    return view('vendor.manufacturer.dashboard', compact('enquiries', 'sendenquiries', 'quotations'));
}

public function manufacturerProducts()
{
    return view('vendor.manufacturer.product_list');
}

public function manufacturerProfile()
{
  
    $vendor = Vendor::with([
        'vendorType',
        'businessType',
        'category',
        'subCategory'
    ])->findOrFail(Auth::guard('vendor')->id());

    $vendorTypes = VendorType::where('status', 1)->get();

    $businessTypes = BusinessType::where(
        'vendor_type_id',
        $vendor->vendor_type_id
    )->where('status', 1)->get();

    $categories = Category::where(
        'business_type_id',
        $vendor->business_id
    )->where('status', 1)->get();

    $subCategories = SubCategory::where(
        'category_id',
        $vendor->category_id
    )->where('status', 1)->get();

    return view(
        'vendor.profile',
        compact(
            'vendor',
            'vendorTypes',
            'businessTypes',
            'categories',
            'subCategories'
        )
    );
}

public function updateProfile(Request $request)
{
    $vendor = Vendor::findOrFail(
        Auth::guard('vendor')->id()
    );

    // =========================================
    // VALIDATION
    // =========================================

    $request->validate([

        'vendor_type_id'   => 'required|array',

        'vendor_type_id.*' => 'exists:vendor_types,id',

        'company_name'     => 'required|string|max:255',

        'about_us'         => 'required|string',

        'country'          => 'required|string|max:100',

        'state'            => 'required|string|max:100',

        'city'             => 'required|string|max:100',

        'address'          => 'required|string',

        'year_established' => 'required|numeric|digits:4',

        'phone'            => 'required|numeric|digits_between:10,15',

        'gst_no'           => 'required|string|max:15',

        'company_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp',

    ]);


    // =========================================
    // REMOVE DUPLICATE IDS
    // =========================================

    $vendorTypes = array_unique($request->vendor_type_id);

    sort($vendorTypes);

    $vendorTypeString = implode(',', $vendorTypes);


    // =========================================
    // CHECK DUPLICATE OTHER RECORDS
    // =========================================

    $alreadyVendor = Vendor::where('email', $vendor->email)
        ->where('id', '!=', $vendor->id)
        ->get();

    foreach ($alreadyVendor as $item) {

        $existingTypes = explode(',', $item->vendor_type_id);

        sort($existingTypes);

        if ($existingTypes == $vendorTypes) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Already registered with selected vendor types.'
                );
        }
    }


    // =========================================
    // LOGO UPLOAD
    // =========================================

    if ($request->hasFile('company_logo')) {

        if (
            !empty($vendor->company_logo) &&
            file_exists(
                public_path(
                    'uploads/vendor_logo/' .
                    $vendor->company_logo
                )
            )
        ) {

            unlink(
                public_path(
                    'uploads/vendor_logo/' .
                    $vendor->company_logo
                )
            );
        }

        $file = $request->file('company_logo');

        $fileName =
            time() . '_' .
            Str::random(10) . '.' .
            $file->getClientOriginalExtension();

        $file->move(
            public_path('uploads/vendor_logo'),
            $fileName
        );

        $vendor->company_logo = $fileName;
    }


    // =========================================
    // UPDATE DATA
    // =========================================

    $vendor->vendor_type_id = $vendorTypeString;

    $vendor->company_name     = $request->company_name;

    $vendor->about_us         = $request->about_us;

    $vendor->year_established = $request->year_established;

    $vendor->country          = $request->country;

    $vendor->state            = $request->state;

    $vendor->city             = $request->city;

    $vendor->address          = $request->address;

    $vendor->phone            = $request->phone;

    $vendor->gst_no           = $request->gst_no;

    $vendor->save();


    // =========================================
    // REDIRECT
    // =========================================

    return redirect()
        ->back()
        ->with(
            'success',
            'Profile updated successfully.'
        );
}

    public function serviceDashboard()
    {
      
        return view('vendor.service.dashboard');
    }

    public function realEstateDashboard()
    {
        return view('vendor.realestate.dashboard');
    }
}
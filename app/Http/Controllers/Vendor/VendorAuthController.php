<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessType;
use App\Models\VendorType;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class VendorAuthController extends Controller
{


    public function index()
    {
        

        return view('auth.vendor_index');
    }


    public function register()
    {
        $vendorTypes = VendorType::where('status', 1)->get();

        return view('auth.vendor_register', compact('vendorTypes'));
    }

   
    public function getBusinessTypes(Request $request)
    {
        $businessTypes = BusinessType::where('vendor_type_id', $request->vendor_type_id)
                            ->where('status', 1)
                            ->get();

        return response()->json($businessTypes);
    }

  
    public function getCategories(Request $request)
    {
        $categories = Category::where('business_type_id', $request->business_id)
                        ->where('status', 1)
                        ->get();

        return response()->json($categories);
    }

  
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)
                            ->where('status', 1)
                            ->get();

        return response()->json($subCategories);
    }



        public function registerSubmit(Request $request)
{
    // CHECK EMAIL EXISTS OR NOT
    $existingUser = User::where('email', $request->email)->first();

    // VALIDATION
    $request->validate([

        // 'vendor_type_id'   => 'required|exists:vendor_types,id',

        // 'business_id'      => 'required|exists:business_types,id',

        // 'category_id'      => 'required|exists:categories,id',

        // 'sub_category_id'  => 'required|exists:sub_categories,id',


        'company_name'     => 'required|string|max:255',

        'about_us'         => 'required|string|min:20',


        'country'          => 'required|string|max:100',

        'state'            => 'required|string|max:100',

        'city'             => 'required|string|max:100',

        'address'          => 'required|string|max:500',


        'year_established' => 'required|digits:4|integer|min:1900|max:' . date('Y'),


        'phone'            => 'required|digits_between:10,15',


        'gst_no'           => [
            'required',
            'string',
            'max:15',
        ],


        'email'            => [
            'required',
            'email',
            'max:255',
        ],


        // PASSWORD REQUIRED ONLY FOR NEW USER
        'password' => [
            Rule::requiredIf(!$existingUser),
            'nullable',
            'min:6',
            'confirmed'
        ],


        'company_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

    ], [

        // 'vendor_type_id.required'  => 'Please select vendor type.',

        // 'business_id.required'     => 'Please select business type.',

        // 'category_id.required'     => 'Please select category.',

        // 'sub_category_id.required' => 'Please select sub category.',

        'company_name.required'    => 'Company name is required.',

        'about_us.required'        => 'About us is required.',

        'country.required'         => 'Country is required.',

        'state.required'           => 'State is required.',

        'city.required'            => 'City is required.',

        'address.required'         => 'Address is required.',

        'phone.required'           => 'Phone number is required.',

        'email.required'           => 'Email is required.',

        'password.required'        => 'Password is required for new vendor account.',

        'password.confirmed'       => 'Confirm password does not match.',

    ]);


    DB::beginTransaction();

    try {

        // =========================================
        // USER CREATE OR EXISTING USER
        // =========================================

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            // NEW USER CREATE

            $user = new User();

            $user->name      = $request->company_name;

            $user->email     = $request->email;

            $user->phone     = $request->phone;

            $user->password  = Hash::make($request->password);

            $user->user_type = 'seller';

            $user->status    = 1;

            $user->save();

        } else {

            // EXISTING BUYER => BUYER + SELLER

            if ($user->user_type == 'buyer') {

                $user->user_type = 'both';

                $user->save();
            }
        }


        // =========================================
        // CHECK ALREADY REGISTERED
        // =========================================

        $alreadyVendor = Vendor::where('user_id', $user->id)
            ->where('vendor_type_id', $request->vendor_type_id)
            ->first();

        $vendorType = VendorType::find($request->vendor_type_id);

        if ($alreadyVendor) {

            return response()->json([

                'status' => false,

                'errors' => [
                    'email' => [
                        'You already registered for this vendor type ' .
                        $vendorType->vendor_name
                    ]
                ]

            ], 422);
        }


        // =========================================
        // OTP
        // =========================================

        $otp = rand(100000, 999999);


        // =========================================
        // LOGO UPLOAD
        // =========================================

        $logoName = null;

        if ($request->hasFile('company_logo')) {

            $file = $request->file('company_logo');

            $logoName = time() . '_' . Str::random(10) . '.' .
                        $file->getClientOriginalExtension();

            $file->move(public_path('uploads/vendor_logo'), $logoName);
        }


        // =========================================
        // SAVE VENDOR
        // =========================================

        $vendor = new Vendor();

        $vendor->user_id          = $user->id;

        // $vendor->vendor_type_id   = $request->vendor_type_id;

        // $vendor->business_id      = $request->business_id;

        // $vendor->category_id      = $request->category_id;

        // $vendor->sub_category_id  = $request->sub_category_id;

        $vendor->company_name     = $request->company_name;

        $vendor->company_logo     = $logoName;

        $vendor->about_us         = $request->about_us;

        $vendor->year_established = $request->year_established;

        $vendor->country          = $request->country;

        $vendor->state            = $request->state;

        $vendor->city             = $request->city;

        $vendor->address          = $request->address;

        $vendor->phone            = $request->phone;

        $vendor->email            = $request->email;

        $vendor->gst_no           = $request->gst_no;

        // PASSWORD FOR VENDOR LOGIN
        $vendor->password         = Hash::make(
            $request->password ?? '123456'
        );

        $vendor->otp              = $otp;

        $vendor->status           = 0;

        $vendor->save();


        // =========================================
        // SEND OTP MAIL
        // =========================================

        Mail::raw(
            "Your Vendor Registration OTP is: " . $otp,
            function ($message) use ($request) {

                $message->to($request->email)
                        ->subject('Vendor Registration OTP');
            }
        );


        DB::commit();


        // =========================================
        // SUCCESS RESPONSE
        // =========================================

        return response()->json([

            'status' => true,

            'message' => 'Vendor Registered Successfully',

            'redirect' => route('vendor.otp.page', $vendor->id)

        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([

            'status' => false,

            'message' => $e->getMessage()

        ], 500);
    }
}


public function otpPage($id)
{
    $vendor = Vendor::findOrFail($id);

    return view('auth.otp', compact('vendor'));
}


public function verifyOtp(Request $request, $id)
{
    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    $vendor = Vendor::find($id);

    if (!$vendor) {

        return back()->with('error', 'Vendor not found.');

    }

    if ($vendor->otp != $request->otp) {

        return back()->with('error', 'Invalid OTP.');

    }

    // VERIFIED
    $vendor->email_verify = 1;

    $vendor->otp = null;

    $vendor->email_verify_at = now();

    $vendor->save();

    return redirect()
        ->route('vendor.login')
        ->with('success', 'OTP Verified Successfully.');
}

public function resendOtp($id)
{
    $vendor = Vendor::find($id);

    if (!$vendor) {

        return back()->with('error', 'Vendor not found.');

    }

    $otp = rand(100000, 999999);

    $vendor->otp = $otp;

    $vendor->save();

    Mail::raw(
        "Your New OTP is: " . $otp,
        function ($message) use ($vendor) {

            $message->to($vendor->email)
                ->subject('Resend OTP');

        }
    );

    return back()->with('success', 'OTP Resent Successfully.');
}

public function login()
{
    $vendorTypes = VendorType::where('status', 1)->get();

    return view('auth.vendor_login', compact('vendorTypes'));
}





// public function loginSubmit(Request $request)
// {
//     $request->validate([

//         'email'           => 'required|email',

//         'password'        => 'required',

//         'vendor_type_id'  => 'required',

//     ]);


//     // =========================================
//     // CHECK VENDOR EXISTS
//     // =========================================

//     $vendor = Vendor::where('email', $request->email)
//         ->where('vendor_type_id', $request->vendor_type_id)
//         ->first();


//     if (!$vendor) {

//         return back()
//             ->withInput()
//             ->with('error', 'Vendor account not found.');
//     }


//     // =========================================
//     // OTP VERIFY CHECK
//     // =========================================

//     if ($vendor->email_verify == 0) {

//         return redirect()
//             ->route('vendor.otp.page', $vendor->id)
//             ->with('error', 'Please verify OTP first.');
//     }


//     // =========================================
//     // ACCOUNT STATUS CHECK
//     // =========================================

//     if ($vendor->status == 0) {

//         return back()
//             ->withInput()
//             ->with('error', 'Your vendor account is under approval.');
//     }


//     // =========================================
//     // PASSWORD CHECK
//     // =========================================

//     if (!Hash::check($request->password, $vendor->password)) {

//         return back()
//             ->withInput()
//             ->with('error', 'Invalid password.');
//     }


//     // =========================================
//     // LOGIN VENDOR
//     // =========================================

//     Auth::guard('vendor')->login($vendor);

//     $request->session()->regenerate();


//     // =========================================
//     // REDIRECT
//     // =========================================

//     return redirect()
//         ->route('vendor.index')
//         ->with('success', 'Vendor Login Successful.');
// }
public function loginSubmit(Request $request)
{
    $request->validate([

        'email'    => 'required|email',

        'password' => 'required',

    ]);


    // =========================================
    // CHECK VENDOR
    // =========================================

    $vendor = Vendor::where('email', $request->email)
        ->first();

    if (!$vendor) {

        return back()
            ->withInput()
            ->with('error', 'Vendor account not found.');
    }


    // =========================================
    // OTP VERIFY
    // =========================================

    if ($vendor->email_verify == 0) {

        return redirect()
            ->route('vendor.otp.page', $vendor->id)
            ->with('error', 'Please verify OTP first.');
    }


    // =========================================
    // STATUS CHECK
    // =========================================

    if ($vendor->status == 0) {

        return back()
            ->withInput()
            ->with('error', 'Your account is under approval.');
    }


    // =========================================
    // PASSWORD CHECK
    // =========================================

    if (!Hash::check($request->password, $vendor->password)) {

        return back()
            ->withInput()
            ->with('error', 'Invalid password.');
    }


    // =========================================
    // LOGIN
    // =========================================

    Auth::guard('vendor')->login($vendor);

    $request->session()->regenerate();


    // =========================================
    // SESSION
    // =========================================

    session([

        'vendor_id' => $vendor->id

    ]);


    // =========================================
    // REDIRECT COMMON DASHBOARD
    // =========================================

    return redirect()
          ->route('manufacturer.dashboard')
        ->with('success', 'Vendor Login Successful.');
}
public function forgotPassword()
{
    $vendorTypes = VendorType::where('status', 1)->get();

    return view(
        'auth.vendor_forgot_password',
        compact('vendorTypes')
    );
}

public function sendForgotOtp(Request $request)
{
    $request->validate([

        // 'vendor_type_id' => 'required',
        'email'          => 'required|email',

    ]);

    $vendor = Vendor::where('email', $request->email)
        // ->where('vendor_type_id', $request->vendor_type_id)
        ->first();

    if (!$vendor) {

        return back()->with('error',
            'Vendor account not found for selected vendor type.'
        );

    }

    // GENERATE OTP
    $otp = rand(100000, 999999);

    // SAVE OTP
    $vendor->otp = $otp;

    $vendor->save();

    // SAVE SESSION
    // session([

    //     'forgot_vendor_id'   => $vendor->id,
    //     'forgot_vendor_type' => $vendor->vendor_type_id,

    // ]);

    // SEND MAIL
    Mail::raw(
        "Your Password Reset OTP is: ".$otp,

        function ($message) use ($vendor) {

            $message->to($vendor->email)
                ->subject('Vendor Password Reset OTP');

        }
    );

    return redirect()
        ->route('vendor.reset.password')
        ->with('success', 'OTP sent successfully.');
}


public function resetPasswordPage()
{
    return view('auth.vendor_reset_password');
}

public function resetPasswordSubmit(Request $request)
{
    $request->validate([

        'otp'                   => 'required|digits:6',

        'password'              => 'required|min:6|confirmed',

    ]);

    $vendor = Vendor::where('id', session('forgot_vendor_id'))
        ->where('vendor_type_id', session('forgot_vendor_type'))
        ->first();

    if (!$vendor) {

        return back()->with('error', 'Vendor not found.');

    }

    // CHECK OTP
    if ($vendor->otp != $request->otp) {

        return back()->with('error', 'Invalid OTP.');

    }

    // UPDATE PASSWORD
    $vendor->password = Hash::make($request->password);

    // CLEAR OTP
    $vendor->otp = null;

    $vendor->save();

    // CLEAR SESSION
    session()->forget([

        'forgot_vendor_id',
        'forgot_vendor_type'

    ]);

    return redirect()
        ->route('vendor.login')
        ->with('success', 'Password reset successful.');
}




}
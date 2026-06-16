<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    // REGISTER PAGE
    public function register()
    {
        return view('auth.register');
    }

    // REGISTER STORE
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'state' => 'required',
            'city' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $otp = rand(1111, 9999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'user_type' => 'user',
            'status' => 0,
            'mail_otp' => $otp,
        ]);

        Mail::raw("Your OTP is: " . $otp, function ($message) use ($user) {

            $message->to($user->email)
                ->subject('Email Verification OTP');
        });

        return redirect()->route('otp.verify.form', $user->id)
            ->with('success', 'OTP sent to your email');
    }

    public function otpVerifyForm($id)
    {
        $user = User::findOrFail($id);

        return view('auth.otp_verify', compact('user'));
    }

    public function otpVerify(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'otp' => 'required'
        ]);

        $user = User::find($request->user_id);

        if (!$user) {

            return back()->with('error', 'User not found');
        }

        // Check OTP
        if ($user->mail_otp != $request->otp) {

            return back()->with('error', 'Invalid OTP');
        }



        // Verified
        $user->update([
            'status' => 1,
            'otp' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account Verified Successfully');
    }

    // LOGIN PAGE
    public function login()
    {
        return view('auth.login');
    }

    // LOGIN CHECK
    // public function loginCheck(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return back()->with('error', 'Email not found');
    //     }

    //     if (empty($user->email_verified_at)) {

    //         return redirect()->route('otp.verify.form', $user->id)
    //                 ->with('error', 'Please verify your email first');
    //     }

    //     if ($user->status == 0) {

    //         return back()->with('error', 'Your account is not active. Please contact admin.');
    //     }

    //     if(Auth::attempt([
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'user_type' => 'user',
    //         'status' => 1
    //     ]))

    //     {
    //         $request->session()->regenerate();

    //         return redirect()->route('home')
    //             ->with('success', 'Login Successfully');


    //     }

    //     return back()->with('error', 'Invalid Credentials');
    // }
   public function loginCheck(Request $request)
{
    $request->validate([

        'email'    => 'required|email',

        'password' => 'required'

    ]);


    // =========================================
    // CHECK USER EXISTS
    // =========================================

    $user = User::where('email', $request->email)->first();

    if (!$user) {

        return back()
            ->withInput()
            ->with('error', 'Email not found');
    }


    // =========================================
    // EMAIL VERIFY CHECK
    // =========================================

    // if (empty($user->email_verified_at)) {

    //     // GENERATE NEW OTP
    //     $otp = rand(1000, 9999);    

    //     // UPDATE OTP
    //     $user->otp = $otp;

    //     $user->otp_expired_at = now()->addMinutes(10);

    //     $user->save();


    //     // SEND OTP MAIL
    //     Mail::raw(
    //         "Your Login OTP is: " . $otp,
    //         function ($message) use ($user) {

    //             $message->to($user->email)
    //                 ->subject('Email Verification OTP');
    //         }
    //     );


    //     return redirect()
    //         ->route('otp.verify.form', $user->id)
    //         ->with('error', 'Please verify your email first. OTP sent successfully.');
    // }


    // =========================================
    // STATUS CHECK
    // =========================================

    if ($user->status == 0) {

        return back()
            ->withInput()
            ->with('error', 'Your account is not active. Please contact admin.');
    }


    // =========================================
    // LOGIN CHECK
    // =========================================

    if (Auth::attempt([

        'email'    => $request->email,

        'password' => $request->password,

        'status'   => 1

    ])) {

        $request->session()->regenerate();


        // =========================================
        // CHECK USER IS VENDOR OR NOT
        // =========================================

        $isVendor = Vendor::where('user_id', $user->id)
            ->where('email_verify', 1)
            ->exists();


        // =========================================
        // STORE SESSION
        // =========================================

        session([

            'is_vendor' => $isVendor

        ]);


        // =========================================
        // UPDATE USER TYPE
        // =========================================

        if ($isVendor && $user->user_type == 'user') {

            $user->user_type = 'both';

            $user->save();
        }


        return redirect()
            ->route('home')
            ->with('success', 'Login Successfully');
    }


    return back()
        ->withInput()
        ->with('error', 'Invalid Credentials');
}

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordSend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(10)
        ]);

        Mail::raw("Your Password Reset OTP is: " . $otp, function ($message) use ($user) {

            $message->to($user->email)
                ->subject('Forgot Password OTP');
        });

        return redirect()->route('reset.password', $user->id)
            ->with('success', 'OTP sent to your email');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        return view('auth.reset-password', compact('user'));
    }

    public function verifyResetOtp(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $user = User::findOrFail($id);

        if ($user->otp != $request->otp) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {

            return response()->json([
                'status' => false,
                'message' => 'OTP Expired'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP Verified Successfully'
        ]);
    }

    public function resetPasswordUpdate(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);

        if ($user->otp != $request->otp) {

            return back()->with('error', 'Invalid OTP');
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {

            return back()->with('error', 'OTP Expired');
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expired_at' => null
        ]);

        return redirect()->route('login')
            ->with('success', 'Password Reset Successfully');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

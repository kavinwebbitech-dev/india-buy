<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Vendor;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // if (!Auth::guard('vendor')->check()) {

        //     return redirect()->route('vendor.login');
        // }

        // return $next($request);
        // Vendor guard login
        if (Auth::guard('vendor')->check()) {
            return $next($request);
        }

        // Normal user login
        if (Auth::check()) {

            $user = Auth::user();

            // vendors table check
            $vendor = Vendor::where('email', $user->email)->first();

            if ($vendor) {

                // auto login into vendor guard
                Auth::guard('vendor')->login($vendor);

                return $next($request);
            }
        }

        return redirect()->route('vendor.login');
    }
}
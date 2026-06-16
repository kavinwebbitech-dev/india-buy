<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManufacturerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::guard('vendor')->check() &&
            Auth::guard('vendor')->user()->vendor_type_id == 1
        ) {

            return $next($request);

        }

        return redirect()->route('vendor.login');
    }
}
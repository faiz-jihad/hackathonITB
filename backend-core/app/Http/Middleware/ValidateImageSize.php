<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateImageSize
{
    public function handle(Request $request, Closure $next)
    {
        // Add custom size validation logic if needed
        return $next($request);
    }
}

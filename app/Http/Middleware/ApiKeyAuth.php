<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiKeyAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Read from header "X-API-Key"
        $apiKey = $request->header('X-API-Key');

        if (! $apiKey) {
            return response()->json([
                'message' => 'API key is missing.',
            ], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (! $user) {
            return response()->json([
                'message' => 'Invalid API key.',
            ], 401);
        }

        // Set the authenticated user for this request
        auth()->setUser($user);

        return $next($request);
    }
}

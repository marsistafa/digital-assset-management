<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class AuthenticateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('Authorization');
   
        if (!$apiKey) {
            return response()->json(['error' => 'API key is missing.'], 401);
        }

        $user = ApiKey::where('key', $apiKey)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid API key.'], 401);
        }

        // Attach the user to the request
        $request->user = $user->user_id;

        return $next($request);
    }
}

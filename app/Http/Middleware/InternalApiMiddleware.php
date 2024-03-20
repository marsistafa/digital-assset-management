<?php
 
 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class InternalApiMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($this->isInternalRequest($request)) {
           
            // If it's an internal request, set the internal API key
            $request->headers->set('Authorization', Config::get('app.api_key'));
            // $request->headers->set('Access-Control-Allow-Origin', '*');
        } else {
            // If it's an external request, check the internal API key
            $internalApiKey = $request->header('Authorization');
            if (!$this->isValidInternalApiKey($internalApiKey)) {
                return response()->json(['error' => 'Unauthorized external access'], 401);
            }
        }
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        
        return $response;
    }

    private function isInternalRequest($request)
    {
        //todo implement secure logic
        $allowedIPs = ['192.168.1.144','127.0.0.1', '192.168.1.150','192.168.1.0' ]; // Add your internal IP addresses
        $clientIP = $request->ip();
        return true;
        // return in_array($clientIP, $allowedIPs);
    }

    private function isValidInternalApiKey($internalApiKey)
    {
        // Check if the provided internal API key matches the configured key.
        return $internalApiKey === Config::get('app.api_key');
    }
}
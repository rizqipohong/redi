<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InternalApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->getClientIps() as $ip) {
            if (! $this->isValidIp($ip)) {
                return response()->json(['error'=>'Unauthorized', 'ip'=>$ip], 401);            
            }
        }
        
        if ($request->token !== env('MULTISTORE_TOKEN')) {
            return response()->json(['error'=>'Unauthorized.'], 401);            
        }

        return $next($request);
    }

    protected function isValidIp($ip)
    {
        return in_array($ip, ['::1','127.0.0.1']);
    }
}

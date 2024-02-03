<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class CookieToHeaderToken 
{
    public function handle(Request $request, Closure $next)
    {     
          //dump('This will be printed to the console');

        $cookie_name = "authUserToken";
        $token = $request->cookie($cookie_name);
       // dump("This will be printed to the console  $token");

        if (!$request->bearerToken()) {
            if ($request->hasCookie($cookie_name)) {
                $token = $request->cookie($cookie_name);
             //   dump('This will be printed to the console');

                $request->headers->add([
                    'Authorization' => 'Bearer ' . $token
                ]);
            }
        }
        
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
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
        // $domains = ["http://localhost:8100/"];

         //if(isset($request->server()['HTTP_ORIGIN'])){
        //   $origin = $request->server()['HTTP_ORIGIN'];

        //   if(in_array($origin,$domains)){
            //header("Access-Control-Allow-Origin: *");
            //header("Access-Control-Allow-Methods: GET, OPTIONS");
           // header("Access-Control-Allow-Headers: Origin,Content-type,Authorization");
        //   }

        // }

        return $next($request);
    }
}

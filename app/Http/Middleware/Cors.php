<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // return $next($request)
    //     // ->header('Access-Control-Allow-Origin', 'https://loyalite.ct8.pl')
    //     // ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
    //     // ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');
    //     // $response = $next($request);

    //     // $response->header("Access-Control-Allow-Origin","*");
    //     // $response->header("Access-Control-Allow-Credentials","true");
    //     // $response->header("Access-Control-Max-Age","600");    // cache for 10 minutes

    //     // $response->header("Access-Control-Allow-Methods","POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

    //     // $response->header("Access-Control-Allow-Headers", "Content-Type, Accept, Authorization, X-Requested-With, Application");

    //     // return $response;
    // }
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*');

    }
}

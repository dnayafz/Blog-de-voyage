<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('access_token')
        ])->post(env('AUTH_API_URL').'auth/check');
        if (!empty($response['message']) && $response['message'] == 'Unauthenticated') {
            return redirect()->route('AdminDashboard');
        }else{
            if (!empty($response['status']) && $response['status'] == true){
                return $next($request);
            }else{
                return redirect()->route('AdminDashboard');
            }
        }
    }
}

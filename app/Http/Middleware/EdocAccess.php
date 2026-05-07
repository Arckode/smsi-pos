<?php

namespace App\Http\Middleware;

use App\Models\Edocs\Edoc;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EdocAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $method = $request->method();

        if (in_array($method, ['GET', 'PUT', 'DELETE'])) {
            $edocId = Route::current()->parameter('edoc');

            if ($edocId) {
                try {
                    $edoc = Edoc::findOrFail($edocId);

                    if (auth()->user()->id === $edoc->user_id) {
                        return $next($request);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => "You Don't Have Permission"
                        ], 403);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => $e->getMessage()
                    ], 500);
                }
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErrorHandlingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Exception $exception) {
            // Logujemy wyjątek, aby móc go przeanalizować
            Log::error($exception);

            // Przekierowujemy użytkownika z komunikatem o błędzie
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}

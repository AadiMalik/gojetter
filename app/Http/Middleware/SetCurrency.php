<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;
use Illuminate\Http\Request;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currency = $request->header('X-Currency') ?? $request->query('currency');

        if ($currency && Currency::where('code', $currency)->where('is_deleted', false)->exists()) {
            session(['currency' => $currency]);
        } else {
            session(['currency' => Currency::where('is_default', true)->where('is_deleted', false)->value('code')]);
        }

        return $next($request);
    }
}

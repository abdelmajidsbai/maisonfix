<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $today = now()->toDateString();

        // Vérifie si ce visiteur a déjà été compté aujourd'hui
        if (!session()->has('visited_' . $today)) {
    Visitor::updateOrCreate(
        ['visited_date' => $today],
        ['count' => \DB::raw('count + 1')]
    );

    session(['visited_' . $today => true]);
}

        return $next($request);
    }
}

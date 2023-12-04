<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheckCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(session()->has("LoggedCompany"))) {
            return redirect(route("companies.loginForm"))->with("fail", "Login first of all");
        }

        // Passing down users data for the template
        $id = session("LoggedCompany");
        $request->company = Company::where("id", "=", $id)->first();
        
        return $next($request);
    }
}

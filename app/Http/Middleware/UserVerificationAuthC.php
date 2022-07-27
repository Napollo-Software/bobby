<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserVerificationAuthC
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
        $account_status = User::where('email', '=', $request->email)->value('account_status');
        //dd($account_status);
        if ($account_status == 'Not Approved') {
            return redirect('/')->with('fail', 'Your account is not verified!');
        }
        return $next($request);
    }
}

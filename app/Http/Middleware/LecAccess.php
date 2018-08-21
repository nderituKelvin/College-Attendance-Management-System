<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class LecAccess{
    public function handle($request, Closure $next){
        $user = Auth::user();
        if($user->usertype != 'lec'){
            Auth::logout();
            return redirect()->route('loginPage')->with([
                'title' => 'Access denied',
                'message' => "",
                "status" => "error"
            ]);
        }
        return $next($request);
    }
}

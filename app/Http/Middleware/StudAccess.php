<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudAccess{
    public function handle($request, Closure $next){
        $user = Auth::user();
        if($user->usertype != 'stud'){
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

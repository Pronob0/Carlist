<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Generalsetting;

class TwoStep
{

    public function handle(Request $request, Closure $next)
    {
        $two_fa = Generalsetting::value('two_fa');
        if($two_fa){
            $user = auth()->user();
            if($user->two_fa == 1){
                if($user->verified == 0){
                    $response = [
                        'status' => false,
                        'message' => 'Two Factor Authentication is enabled for your account. Please verify your account first.',
                        'data' => [],
                        'error' => []
                    ];
    
                    return response()->json($response);
                }
            }
            return $next($request);
        }
        return $next($request);
    }

    protected $except = [
        
       
        
    ];
}

<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckTokenClient
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
        if(isset($request->token)){
            if(!empty($request->token)){
                $get = User::where('token_client','=',$request->token)->exists();
                if($get){
                    return $next($request);
                }else{
                    return abort(401);
                }
            }else{
                return abort(401);
            }
        }else{
            return abort(401);
        }
    }
}

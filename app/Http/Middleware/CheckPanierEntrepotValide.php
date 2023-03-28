<?php

namespace App\Http\Middleware;

use App\Models\PanierEdi;
use Closure;
use Illuminate\Http\Request;

class CheckPanierEntrepotValide
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
        if($request->session()->has('panier_commercial')){
            if(isset($request->session()->get('panier_commercial')->id_panier_edi)){
                $panier = PanierEdi::where('id_panier_edi','=',$request->session()->get('panier_commercial')->id_panier_edi)->first();
                if(!$panier->is_validate){
                    return $next($request);
                }else{
                    if($request->session()->has('typeVente')){
                        if($request->session()->get('typeVente') == 2){
                            return redirect('/dropshipping/cart');
                        }else{
                            return redirect('/cart');
                        }
                    }else{
                        return redirect('/');
                    }
                }
            }else{
                return redirect('/');
            }  
        }else{
            if($request->session()->has('typeVente')){
                if($request->session()->get('typeVente') == 2){
                    return redirect('/dropshipping/cart');
                }else{
                    return redirect('/cart');
                }
            }else{
                return redirect('/');
            }
        }
    }
}

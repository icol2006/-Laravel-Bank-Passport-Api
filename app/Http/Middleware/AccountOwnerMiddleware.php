<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;

class AccountOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $account_id=  $request->route()->parameter('account');
        $account_id=$account_id==null?0:$account_id;

        if($account_id!=0)
        {
            $user_id=auth()->user()->id;
            $res= Account::where('id',$account_id)
            ->where('user_id',$user_id)
            ->get();

            if($res->count()==0)
            {
                return response()->json('Unauthorized');
            }
          
        }
        return $next($request);
    }
}

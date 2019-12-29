<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Api\ApiMessages;
use Illuminate\Support\Facades\Crypt;

class CheckWritingToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{   
            
            $email = explode(";", Crypt::decrypt($request->bearerToken('Authorization')))[0];
            $user = User::where('email', $email)->get()[0];

            if ($user->writing_token != $request->bearerToken('Authorization')) {

                return response()->json([
                    'data' => "Token invalido, acesso a escrita de dados não autorizada."
                ], 401);
            }

            return $next($request);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }
}

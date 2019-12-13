<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Para autenticación de APP
    public function signup(Request $request){
        
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }

    public function login(Request $request){        
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        // exit($request);
        // return response()->json(['message' => 'Successfully user Log!'], 201);
        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        
        $user = $request->user();
        $tokenResult = $user->createToken('mEqpyaFFThYgDiVXRHDKmHeemlyqlOan0ti0LzgH');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
}

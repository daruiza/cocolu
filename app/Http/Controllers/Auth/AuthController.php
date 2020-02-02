<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;

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
        // return response()->json(['message' => $request->all()], 201);
        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales no autorizadas'], 401);
        }
        
        $user = $request->user();
        $tokenResult = $user->createToken('41h1bXt0YXmbRAsdGBQuSfThIRd1YNneEI0IcSNs');
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
            'user'  => $request->user()
        ]);
    }    

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['message' => 
            'Successfully logged out']);
    }

    public function user(Request $request){
        // return response()->json(['message' => 'User'], 201);
        return response()->json($request->user());
    }
}

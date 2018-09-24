<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $user = (new User)->create([
        'name' => $request->name,
        'email' => $request->email,
        'pass' => bcrypt($request->pass),
      ]);

      $token = (new User)->login($request); //request no tiene el pass hasheado

      return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'pass']);

      if (!$token = (new User)->login($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }
  
      return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }

    //-----------------------------------------------------------------------------------


}

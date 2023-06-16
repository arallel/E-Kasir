<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;   

class AuthUserApi extends Controller
{
    public function Login(Request $request)
    {
      $request->validate([
         'email' => 'required|email',
         'password' => 'required',
      ]);
      $user = User::where('email', $request->email)->first();
      if ($user && Hash::check($request->password, $user->password)) {
        $user->update(['status'=>'online']);
         $token = $user->createToken('Kasirku-Token');
         return response()->json([
             'token' => $token->plainTextToken,
             'User' => $user
         ]);
      }
      return response()->json(['error' => 'Email Atau Password Salah'], 401);
    }
    public function Logout(Request $request)
    {
       $user = Auth::guard('sanctum')->user();
       $user->update([
        'status'=>'offline'
       ]);
       $user->tokens()->delete();
       return response()->json([
         'message' => 'Berhasil Logout',
       ],200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
   public function login(Request $request): JsonResponse
   {
       $request->validate([
           'email' => 'required|string|email',
           'password' => 'required|string'
       ]);

       $user = User::where('email', $request->email)->first();

       if(!$user || !Hash::check($request->password, $user->password)) {
           return response()->json(['message' => 'Email ou senha incorretos'], Response::HTTP_UNAUTHORIZED);
       }

       $token = $user->createToken('api-token')->plainTextToken;

       return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer',
        ], Response::HTTP_OK);
   }
   public function logout(Request $request): JsonResponse
   {
       $request->user()->currentAccessToken()->delete();

       return response()->json(['message' => 'Deslogado com sucesso'], Response::HTTP_OK);
   }

   public function me(Request $request): JsonResponse
   {
       $user = $request->user();

       if(!$user) {
           return response()->json(['message' => 'Úsuario não autenticado'],Response::HTTP_UNAUTHORIZED);
       }

       return response()->json($request->user());
   }
}

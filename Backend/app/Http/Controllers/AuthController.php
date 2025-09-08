<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginAuthRequest;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ){}

    public function login(LoginAuthRequest $request)
    {
        $user = Attendant::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $token = $user->createToken('attendant-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function register(RegisterAuthRequest $request)
    {
        $this->authService->store($request->validated());
    } 

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!'
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}

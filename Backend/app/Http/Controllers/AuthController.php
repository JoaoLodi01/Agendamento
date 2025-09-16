<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ){}

    public function index(int $issuer_id)
    {
        $users = $this->authService->index($issuer_id);

        return response()->json([
            'Dados' => $users,
        ]);
    }

    public function login(LoginAuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

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
        $user = $this->authService->store($request->validated());

        $token = $user->createToken('attendant-token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'token' => $token,
            'user' => $user,
        ], 201);
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

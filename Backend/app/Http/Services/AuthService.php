<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\AuthRepository;
use Carbon\Carbon;
use illuminate\Support\Str;

class AuthService
{
    public function __construct(
        protected AuthRepository $authRepository
    ){}

    public function index(int $issuer_id)
    {
        return $users = $this->authRepository->index($issuer_id);
    }

    public function store(array $data)
    {
        return $user = $this->authRepository->store($data);
    }

    public function show(int $user_id)
    {
        return $user = $this->authRepository->show($user_id);
    }

    public function update(int $user_id, array $data)
    {
        return $user = $this->authRepository->update($user_id, $data);
    }

    public function delete(int $user_id)
    {
        return $user = $this->authRepository->delete($user_id);
    }

    public function sendEmail(string $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user){
            return;
        }

        $token = Str::random(60);

        $this->authRepository->createPasswordResetToken(
            $user->email,
            $token,
            Carbon::now()->addMinutes(30)
        );

        Mail::to($user->email)->send(
            new PasswordResetMail($token)
        );
    }

}
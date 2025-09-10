<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\AuthRepository;

class AuthService
{
    public function __construct(
        protected AuthRepository $authRepository
    ){}

    public function index(int $issuer_id)
    {
        $all = $this->authRepository->index($issuer_id);
    }

    public function store(array $data)
    {
        $user = $this->authRepository->store($data);

        return $user;
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destory()
    {

    }

}
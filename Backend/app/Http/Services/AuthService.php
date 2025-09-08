<?php

namespace App\Services\AuthService;

use App\Repositories\AuthRepository;

class AuthService
{
    public function __construct(
        protected AuthRepository $authRepository
    ){}

    public function index(){}

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
<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\user;
use App\Http\Repositories\Interfaces\GeneralRepositoryInterface;

class AuthRepository implements GeneralRepositoryInterface
{
    public function index()
    {

    }

    public function store(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function show()
    {

    }
    
    public function update(){

    }
    
    public function destroy()
    {

    }
}
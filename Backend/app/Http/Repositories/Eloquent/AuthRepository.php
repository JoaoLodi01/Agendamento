<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\user;
use App\Models\Issuer;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\Interfaces\GeneralRepositoryInterface;

class AuthRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::where('id', $issuer_id)->first();
        $users = User::where('issuer_id', $issuer->user_code)->get();
    }

    public function store(array $data)
    {
        $issuer = Issuer::firstOrCreate(
            [ 'cnpj' => $data['cnpj'] ?? null, 'cpf' => $data['cpf'] ?? null ],
            [
                'company_name' => $data['companyName'] ?? $data['fullName'],
                'uf' => $data['uf'] ?? null,
                'municipality' => $data['municipality'] ?? null,
                'address' => $data['address'] ?? null,
                'number' => $data['number'] ?? null,
                'district' => $data['district'] ?? null,
                'complement' => $data['complement'] ?? null,
            ]
        );

        $isFirstUser = $issuer->users()->count() === 0;

        $user = User::create([
            'full_name' => $data['fullName'],
            'email' => $data['email'],
            'phone' => $data['whatsapp'],
            'password' => Hash::make($data['password']),
            'issuer_code' => $issuer->id,
            'role' => $isFirstUser ? 'owner' : 'user'                
        ]);

        if ($isFirstUser) {
            $issuer->user_code = $user->id;
            $issuer->save();
        }

        return $user;
    }

    public function show(int $id)
    {
        $user = User::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return User::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return User::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
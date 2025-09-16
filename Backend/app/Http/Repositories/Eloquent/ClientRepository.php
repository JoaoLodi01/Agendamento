<?php

namespace App\Http\Repositories\Eloquent;

use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Issuer;

class ClientRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $clients = Client::where('issuer_code', $issuer->id)->get();

        return $clients;
    }

    public function store(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::warning($issuer);

        $client = Client::create([
            'full_name' => $data['full_name'],
            'cpf' => $data['cpf'] ?? null,
            'cnpj' => $data['cnpj'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'date_birth' => $data['date_birth'] ?? null,
            'sex' => $data['sex'] ?? null,
            'cep' => $data['cep'] ?? null,
            'uf'  => $data['uf'] ?? null,
            'municipality' => $data['municipality'] ?? null,
            'address'  => $data['address'] ?? null,
            'number' => $data['number'] ?? null,
            'district' => $data['district'] ?? null,
            'complement' => $data['complement'] ?? null,
            'photo' => $data['photo'] ?? null,
            'issuer_code' => $issuer->id,
            'active' => $data['active'] ?? true,
        ]);

        return $client;
    }

    public function show(int $id)
    {
        return Client::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Client::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Client::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
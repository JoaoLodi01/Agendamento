<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\Issuer;
use App\Models\Comission;
use Illuminate\Support\Facades\Log;

class ComissionRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $comissions = Comission::where('issuer_code', $issuer->id)->get();

        return $comissions;
    }

    public function store(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::warning($issuer->id);

        $comission = Comission::create([

        ]);
    }

    public function show(int $id)
    {
        return Comission::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Comission::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Comission::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
<?php

namespace App\Http\Repositories\Eloquent;

use Illuminate\Support\Facades\Log;
use App\Models\Service;
use App\Models\Issuer;

class ServicesRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $services = Service::where('issuer_code', $issuer->id)->get();

        return $services;
    }

    public function store(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::warning($issuer->id);

        $service = Service::create([
            'service' => $data['service'],
            'duration' => $data['duration'],
            'price' => $data['price'],
            'categories_id' => $data['categories_id'],
            'description' => $data['description'],
            'home_service' => $data['home_service'],
            'check_availability' => $data['check_availability'],
            'issuer_code' => $issuer->id,
        ]);
    }

    public function show(int $id)
    {
        return Service::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Service::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Service::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
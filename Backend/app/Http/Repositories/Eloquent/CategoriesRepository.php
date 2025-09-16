<?php

namespace App\Http\Repositories\Eloquent;

use Illuminate\Support\Facades\Log;
use App\Models\Issuer;
use App\Models\Categorie;

class CategoriesRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $categories = Categorie::where('issuer_code', $issuer->id)->get();

        return $categories;
    }

    public function store(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::warning($issuer->id);

        $categorie = Categorie::create([

        ]);
    }

    public function show(int $id)
    {
        return Categorie::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Categorie::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Categorie::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
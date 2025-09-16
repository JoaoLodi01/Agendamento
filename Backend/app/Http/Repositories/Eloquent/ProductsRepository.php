<?php

namespace App\Http\Repositories\Eloquent;

use Illuminate\Support\Facades\Log;
use App\Models\Issuer;
use App\Models\Product;

class ProductsRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $products = Product::where('issuer_code', $issuer->id)->get();

        return $products;
    }

    public function store(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::warning($issuer->id);

        $products = Product::create([

        ]);
    }

    public function show(int $id)
    {
        return Product::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Product::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Product::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}
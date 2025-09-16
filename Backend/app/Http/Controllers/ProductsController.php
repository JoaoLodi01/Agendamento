<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProductsService;
use App\Htpp\Requests\ProdutcsRequest;

class ProductsController extends Controller
{
    public function __construct (
        protected ProductsService $productsService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        $products = $this->productsService->index($issuer_id);

        return response()->json([
            'Dados' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutcsRequest $request, int $issuer_id)
    {
        return $this->productsService->store($request->validated(), $issuer_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutcsRequest $request, int $issuer_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

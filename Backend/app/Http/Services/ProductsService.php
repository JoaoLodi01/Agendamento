<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\ProductsRepository;

class ProductsService
{
    public function __construct (
        protected ProductsRepository $productsRepository
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        return $this->productsRepository->index($issuer_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Array $data, int $issuer_id)
    {
        return $this->productsRepository->store($data, $issuer_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Array $data, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}

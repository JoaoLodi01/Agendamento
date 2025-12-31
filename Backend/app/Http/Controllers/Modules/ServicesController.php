<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServicesRequest;
use App\Http\Services\ServicesService;

class ServicesController extends Controller
{
    public function __construct (
        protected ServicesService $servicesService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        $services = $this->servicesService->index($issuer_id);

        return response()->json([
            'Dados' => $services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicesRequest $request, int $issuer_id)
    {
        return $this->servicesService->store($request->validated(), $issuer_id);
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
    public function update(Request $request, string $id)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Http\Services\ClientService;


class ClientController extends Controller
{   
    public function __construct (
        protected ClientService $clientService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        $clients = $this->clientService->index($issuer_id);

        return response()->json([
            'Dados' => $clients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request, int $issuer_id)
    {
        return $this->clientService->store($request->validated(), $issuer_id);
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
    public function update(ClientRequest $request, string $id)
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

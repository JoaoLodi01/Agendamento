<?php

namespace App\Http\Controllers;

use App\Http\Services\AgendaService;
use App\Http\Requests\AgendaRequest;


class AgendaController extends Controller
{
    public function __construct(
        protected AgendaService $agendaService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        $agenda = $this->agendaService->index($issuer_id);

        return response()->json([
            'Dados' => $agenda,
        ]);
    }

    public function hours(int $issuer_id)
    {
        return $hours = $this->agendaService->hours($issuer_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeClient(AgendaRequest $request, int $issuer_id)
    {
        return $this->agendaService->storeClient($request->validated(), $issuer_id);
    }

    public function storeManual(AgendaRequest $request, int $issuer_id)
    {
        return $this->agendaService->storeManual($request->validated(), $issuer_id);
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
    public function update(AgendaRequest $request, string $id)
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

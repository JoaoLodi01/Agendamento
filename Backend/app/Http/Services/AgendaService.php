<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\AgendaRepository;

class AgendaService
{
    public function __construct (
        protected AgendaRepository $agendaRepository
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        return $this->agendaRepository->index($issuer_id);
    }

    public function hours(int $issuer_id)
    {
        return $this->agendaRepository->hours($issuer_id);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeClient(Array $data, int $issuer_id)
    {
        return $this->agendaRepository->storeClient($data, $issuer_id);
    }
    
    public function storeManual(Array $data, int $issuer_id)
    {
        return $this->agendaRepository->storeManual($data, $issuer_id);
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

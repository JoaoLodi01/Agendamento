<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ComissionRequest;
use App\Http\Services\ComissionService;

class ComissionController extends Controller
{
    public function __construct (
        protected ComissionService $comissionService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(int $issuer_id)
    {
        $comissions = $this->comissionService->index($issuer_id);

        return response()->json([
            'Dados' => $comissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComissionRequest $request)
    {
        //
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
    public function update(ComissionRequest $request, int $id)
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

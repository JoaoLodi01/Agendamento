<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\ComissionRepository;

class ComissionService
{
    public function __construct(
        protected ComissionRepository $comissionRepository
    ){}

    public function index(int $issuer_id)
    {
        return $this->comissionRepository->index($issuer_id);
    }

    public function store(array $data, int $issuer_id)
    {
        return $this->comissionRepository->store($data, $issuer_id);
    }

    public function show(int $id)
    {
    }

    public function update(Array $data, int $id)
    {

    }

    public function destory(int $id)
    {

    }
}
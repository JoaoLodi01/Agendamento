<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\ServicesRepository;

class ServicesService
{
    public function __construct(
        protected ServicesRepository $serviceRepository
    ){}

    public function index(int $issuer_id)
    {
        return $this->serviceRepository->index($issuer_id);
    }

    public function store(array $data, int $issuer_id)
    {
        return $this->serviceRepository->store($data, $issuer_id);
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
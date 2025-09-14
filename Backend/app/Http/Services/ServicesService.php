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
        return $all = $this->serviceRepository->index($issuer_id);
    }

    public function store(array $data, int $issuer_id)
    {
        return $service = $this->serviceRepository->store($data, $issuer_id);
    }

    public function show()
    {
    }

    public function update()
    {

    }

    public function destory()
    {

    }
}
<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\ClientRepository;

class ClientService
{
    public function __construct(
        protected ClientRepository $clientRepository
    ){}

    public function index(int $issuer_id)
    {
        return $this->clientRepository->index($issuer_id);
    }

    public function store(array $data, int $issuer_id)
    {
        return $this->clientRepository->store($data, $issuer_id);
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
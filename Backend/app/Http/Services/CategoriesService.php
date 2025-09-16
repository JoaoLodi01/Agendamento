<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\CategoriesRepository;

class CategoriesService
{
    public function __construct(
        protected CategoriesRepository $categoriesRepository
    ){}

    public function index(int $issuer_id)
    {
        return $this->categoriesRepository->index($issuer_id);
    }

    public function store(array $data, int $issuer_id)
    {
        return $this->categoriesRepository->store($data, $issuer_id);
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
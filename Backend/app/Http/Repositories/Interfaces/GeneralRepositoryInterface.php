<?php

namespace App\Http\Repositories\Interfaces;

interface GeneralRepositoryInterface
{
    public function index();
    public function store();
    public function show();
    public function update();
    public function destroy();
}
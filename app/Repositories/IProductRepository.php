<?php

namespace App\Repositories;

interface IProductRepository
{
    public function all($sortBy = null, $filters = []);
    public function create(array $data);
    public function find($id);
}
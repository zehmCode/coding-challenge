<?php

namespace App\Repositories;

interface IProductRepository
{
    public function all(string $sortBy = null,array $filters = []): \Illuminate\Support\Collection;
    public function create(array $data): \App\Models\Product;
    public function find(int $id): \App\Models\Product;
}
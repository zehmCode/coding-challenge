<?php

namespace App\Repositories;

interface ICategoryRepository
{
    public function all(array $filters = []): \Illuminate\Support\Collection;
    public function create(array $data): \App\Models\Category;
    public function find(int $id): \App\Models\Category;
    public function exists(int $id): bool;
}

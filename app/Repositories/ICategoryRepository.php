<?php

namespace App\Repositories;

interface ICategoryRepository
{
    public function all($filters = []);
    public function create(array $data);
    public function find($id);
}

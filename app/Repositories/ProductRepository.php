<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all(string $sortBy = null,array $filters = []): \Illuminate\Support\Collection
    {
        $query = Product::query();

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if ($sortBy) {
            $query->orderBy('price', $sortBy);
        }

        return $query->get();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function find($id): Product
    {
        return Product::findOrFail($id);
    }
}
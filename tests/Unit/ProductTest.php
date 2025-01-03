<?php

namespace Tests\Unit;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    protected $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = app(ProductRepository::class);
    }

    public function test_creating_product()
    {
        $data = [
            'name' => 'Name Test',
            'description' => 'Test description',
            'price' => 120.00,
            'category_id' => null,
        ];

        $product = $this->productRepository->create($data);

        $this->assertDatabaseHas('products', $data);
    }
}

<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use App\Repositories\IProductRepository;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    protected IProductRepository $productRepository;
    protected ProductService $productService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {description} {price} {category_id?} {--image=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a new product in the database';

    public function __construct(IProductRepository $productRepository, ProductService $productService)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->productService->validateAndPrepareData([
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
            'category_id' => $this->argument('category_id'),
        ], $this->option('image') ? request()->file('image') : null);

        $product = $this->productRepository->create($data);

        $this->info("Product: '{$product->name}' created successfully!");
    }
}

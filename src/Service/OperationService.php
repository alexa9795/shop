<?php

namespace App\Service;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;

class OperationService
{
    /** @var CategoryRepository */
    private $categoryRepository;
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function listCategoriesWithActiveProducts(): array
    {
        $items = $this->categoryRepository->findCategoriesWithActiveProducts();

        return $items ?? [];
    }

    public function listProductsForCategoryAndPrice(string $category, int $price): array
    {
        $items = $this->productRepository->findProductsForCategoryAndPrice($category, $price);
dump($items);die;
        return $items ?? [];
    }
}

<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Price;
use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

class ProductService
{
    /** @var ManagerRegistry */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function importProductsFromXml(string $filePath)
    {
        /** @var EntityManager $entityManager */
        $entityManager =$this->doctrine->getManager();

        $xmldata = simplexml_load_file($filePath) or die("Failed to load");

        $items = $xmldata->children()[0]->children()->children();

        foreach ($items as $item) {
            if ($item->action == 'import') {
                $productEntity = (new Product())
                    ->setNumber((int)$item->orderNumber)
                    ->setType((string)$item->type)
                    ->setName((string)$item->name)
                    ->setDescription("(string)$item->description")
                    ->setActive((string)$item->status);

                $entityManager->persist($productEntity);
            }
        }

        $entityManager->flush();
    }

    public function populateProductCategoryTable(string $filePath)
    {
        $xmldata = simplexml_load_file($filePath) or die("Failed to load");

        $items = $xmldata->children()[0]->children()->children();

        foreach ($items as $item) {
            $productCategoryEntity = (new ProductCategory())
                ->setProductNumber((int)$item->orderNumber);
            foreach ($item->categoryRelations->children() as $categoryRelation) {
                $productCategoryEntity->setOrderId((string)$categoryRelation->sortOrderCategory)
                    ->setCategoryId((int)$categoryRelation->categoryId)
                    ->seVisible((bool)$categoryRelation->visible);
            }

            $this->doctrine->getManager()->persist($productCategoryEntity);
        }
    }

    public function populatePriceTable(string $filePath)
    {
        $xmldata = simplexml_load_file($filePath) or die("Failed to load");

        $items = $xmldata->children()[0]->children()->children();

        foreach ($items as $item) {
            $price = (new Price())
                ->setProductNumber((int)$item->orderNumber)
                ->setGrossPrice((int)$item->price->grossPrice)
                ->setPriceNet((int)$item->price->priceNet)
                ->setAmount((int)$item->price->amount);

            $this->doctrine->getManager()->persist($price);
        }
    }
}

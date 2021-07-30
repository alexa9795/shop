<?php

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

class CategoryService
{
    /** @var ManagerRegistry */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param string $filePath
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function importCategoriesFromXml(string $filePath)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();

        $xmldata = simplexml_load_file($filePath) or die("Failed to load");

        $categories = $xmldata->children()[0]->children()->children();

        foreach ($categories as $category) {
            if ($category->action == 'import') {
                $categoryEntity = (new Category())
                    ->setId((int)$category->id)
                    ->setParentId((int)$category->parentId)
                    ->setName((string)$category->categoryName)
                    ->setImage((string)$category->image)
                    ->setOrder((string)$category->sortNumber);

                $entityManager->persist($categoryEntity);
            }
        }

        $entityManager->flush();
    }
}

<?php


namespace App\Repository;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CategoryRepository
 * @package App\Repository
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findCategoriesWithActiveProducts(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.name AS categoryName, p.name as productName, p.number as productNumber')
            ->innerJoin(ProductCategory::class, 'pc', Join::WITH, 'pc.categoryId = c.id')
            ->innerJoin(Product::class, 'p', Join::WITH, 'pc.productNumber = p.number')
            ->andWhere('p.active = :val')
            ->setParameter('val', 1)
            ->orderBy('c.name', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

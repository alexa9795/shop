<?php


namespace App\Repository;

use App\Entity\Category;
use App\Entity\Price;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductRepository
 * @package App\Repository
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findProductsForCategoryAndPrice(string $category, int $price): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.name as productName, pr.grossPrice as grossPrice, pr.priceNet as priceNet')
            ->innerJoin(ProductCategory::class, 'pc', Join::WITH, 'pc.productNumber = p.number')
            ->innerJoin(Category::class, 'c', Join::WITH, 'pc.categoryId = c.id')
            ->innerJoin(Price::class, 'pr', Join::WITH, 'p.number = pr.productNumber')
            ->andWhere('pc.visible = :val')
            ->setParameter('val', 1)
            ->andWhere('c.name LIKE :val')
            ->setParameter('val', $category)
            ->andWhere('pr.grossPrice > :val')
            ->setParameter('val', $price)
            ->getQuery()
            ->getResult();
    }
}

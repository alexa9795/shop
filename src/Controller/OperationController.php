<?php


namespace App\Controller;


use App\Service\OperationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperationController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(OperationService $operationService): Response
    {
        try {
            $categoriesWithActiveProducts = $operationService->listCategoriesWithActiveProducts();

            $category = 'Dinghy und Jolle';
            $price = 200;
            $productsForCategoryAndPrice = $operationService->listProductsForCategoryAndPrice($category, $price);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $this->render('operation.html.twig', [
            'categoriesWithActiveProducts' => $categoriesWithActiveProducts,
            'productsForCategoryAndPrice' => $productsForCategoryAndPrice,
        ]);
    }
}
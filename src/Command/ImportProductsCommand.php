<?php

namespace App\Command;

use App\Service\ProductService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProductsCommand extends Command
{
    /** @var ProductService */
    private $productService;

    public function __construct(ProductService $productService, string $name = null)
    {
        $this->productService = $productService;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('import-products')
            ->setDescription('Import all items which have node <action> with value import from import_product.xml');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = 'public/import_product.xml';

        try {
            $this->productService->importProductsFromXml($filePath);
            $output->writeln([
                'Products inserted into db;'
            ]);

            $this->productService->populateProductCategoryTable($filePath);
            $output->writeln([
                'Product-category relations inserted into db'
            ]);

            $this->productService->populatePriceTable($filePath);
            $output->writeln([
                'Prices inserted into db'
            ]);
        } catch (\Throwable $e) {
            $output->writeln([
                $e->getMessage()
            ]);

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
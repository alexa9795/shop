<?php

namespace App\Command;

use App\Service\CategoryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCategoriesCommand extends Command
{
    /** @var CategoryService */
    private $categoryService;

    public function __construct(CategoryService $categoryService, string $name = null)
    {
        $this->categoryService = $categoryService;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('import-categories')
            ->setDescription('Import all items which have node <action> with value import from import_category.xml');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = 'public/import_category.xml';

        try {
            $this->categoryService->importCategoriesFromXml($filePath);

            $output->writeln(['Categories inserted into db']);
        } catch (\Throwable $e) {
            $output->writeln([
                $e->getMessage()
            ]);

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
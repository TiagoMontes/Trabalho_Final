<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        
    }

    public function register($category): Category
    {
        $categoryExist = $this->categoryRepository->findBy(["categoryName" => $category->getCategoryName()]);
        if ($categoryExist == null) { //
            $this->categoryRepository->save($category, true);
        }
        return $category;
    }

    public function update($category): Category
    {
        $this->categoryRepository->save($category, true);

        return $category;
    }
}

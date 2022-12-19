<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        
    }

    public function register(array $form): Category
    {
        $category = new Category();
        $category->setCategoryName($form['category_name']);

        $this->categoryRepository->save($category, true);

        return $category;
    }

    public function update($category): Category
    {
        $category->setCategoryName();

        return $category;
    }
}

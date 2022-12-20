<?php

namespace App\Controller;

use App\Form\Type\CategoryType;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryService $categoryService, private CategoryRepository $categoryRepository)
    {
        
    }

    #[Route('/category', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $data['categories'] = $categoryRepository->findAll();
        $data['title'] = 'Gerenciar Categorias';

        return $this->render('category/index.html.twig', $data);
    }

    #[Route('/category/new', name: 'category_new')]
    public function categoryAdd(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->register($form->getData());

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/form.html.twig', [
            'category_form' => $form,
            'title' => 'Adicionar Categoria',
        ]);
    }

    #[Route('/category/update/{id}', name: 'category_update')]
    public function categoryUpdate(int $id, Request $request): Response
    {
        $category = $this->categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->update($category);

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/form.html.twig', [
            'category_form' => $form,
            'title' => 'Editar Categoria',
        ]);
    }

    #[Route('/category/delete/{id}', name: 'category_delete')]
    public function categoryDelete(int $id): Response
    {
        $categoryId = $this->categoryRepository->find($id);

        $this->categoryRepository->remove($categoryId, true);

        return $this->redirectToRoute('category_index');
    }    
}

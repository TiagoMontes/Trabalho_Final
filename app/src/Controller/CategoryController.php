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

    #[Route('/categoria', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $data['categories'] = $categoryRepository->findAll();
        $data['title'] = 'Gerenciar Categorias';

        return $this->render('category/index.html.twig', $data);
    }

    #[Route('/categoria/adicionar', name: 'category_add')]
    public function addCategory(Request $request): Response
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

    // #[Route('/categoria/editar/{id}', name: 'category_edit')]
    // public function editCategory($id, Request $request): Response
    // {
    //     $categoryId = $request->request->get('id');
    //     $category = $this->categoryRepository->find($categoryId);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->categoryService->update($category);
    //     }

    //     return 

    // }

    #[Route('/categoria/delete/{id}', name: 'category_delete')]
    public function deleteCategory(int $id): Response
    {
        $categoryId = $this->categoryRepository->find($id);

        $this->categoryRepository->remove($categoryId, true);

        return $this->redirectToRoute('category_index');
    }    
}

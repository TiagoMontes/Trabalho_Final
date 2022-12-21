<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\Type\CategoryType;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    public function __construct(private CategoryService $categoryService, private CategoryRepository $categoryRepository)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $data['categories'] = $this->categoryRepository->findAll();
        $data['title'] = 'Gerenciar Categorias';

        return $this->render('category/index.html.twig', $data);
    }

    #[Route('/new', name: 'new')]
    public function categoryAdd(Request $request): Response
    {
        $category = new Category;

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->register($category);

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/form.html.twig', [
            'category_form' => $form,
            'title' => 'Adicionar Categoria',
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
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

    #[Route('/delete/{id}', name: 'delete')]
    public function categoryDelete(int $id): Response
    {
        $categoryId = $this->categoryRepository->find($id);

        $this->categoryRepository->remove($categoryId, true);

        return $this->redirectToRoute('category_index');
    }    
}

<?php

namespace App\Controller;

use App\Entity\Director;
use App\Form\Type\DirectorType;
use App\Repository\DirectorRepository;
use App\Service\DirectorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/director', name: 'director_')]
class DirectorController extends AbstractController
{
    public function __construct(private DirectorRepository $directorRepository, private DirectorService $directorService)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(DirectorRepository $directorRepository)
    {
        $data['title'] = 'Gerenciar Diretores';
        $data['directors'] = $directorRepository->findAll();

        return $this->render('director/index.html.twig', $data);
    }

    #[Route('/add', name: 'add')]
    public function addDirector(Request $request): Response
    {
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->directorService->register($director);
            return $this->redirectToRoute('director_index');
        }

        return $this->render('director/form.html.twig',[
            'director_form' => $form,
            'title' => 'Adicionar Diretor'
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteDirector(int $id): Response
    {
        $director = $this->directorRepository->find($id);

        $this->directorRepository->remove($director, true);

        return $this->redirectToRoute('director_index');
    }

    #[Route('/update/{id}', name: 'update')]
    public function updateDirector(int $id, Request $request): Response
    {
        $director = $this->directorRepository->find($id);

        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->directorService->update($director);

            return $this->redirectToRoute('director_index');
        }

        return $this->render('director/form.html.twig', [
            'director_form' => $form,
            'title' => 'Editar Diretor'
        ]);
    }
}

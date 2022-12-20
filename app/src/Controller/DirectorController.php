<?php

namespace App\Controller;

use App\Form\Type\DirectorType;
use App\Repository\DirectorRepository;
use App\Service\DirectorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectorController extends AbstractController
{
    public function __construct(private DirectorRepository $directorRepository, private DirectorService $directorService)
    {
        
    }

    #[Route('/director', name: 'director_index')]
    public function index(DirectorRepository $directorRepository)
    {
        $data['title'] = 'Gerenciar Diretores';
        $data['directors'] = $directorRepository->findAll();

        return $this->render('director/index.html.twig', $data);
    }

    #[Route('/director/add', name: 'director_add')]
    public function addDirector(Request $request): Response
    {
        $form = $this->createForm(DirectorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->directorService->register($form->getData());
            return $this->redirect('/director');
        }

        return $this->render('director/form.html.twig',[
            'director_form' => $form,
        ]);
    }

    #[Route('/director/delete/{id}', name: 'director_delete')]
    public function deleteDirector(int $id): Response
    {
        $director = $this->directorRepository->find($id);

        $this->movieRepository->remove($director, true);

        return $this->redirectToRoute('director_index');
    }

    #[Route('/director/update/{id}', name: 'director_update')]
    public function updateDirector(int $id, Request $request): Response
    {
        $director = $this->directorRepository->find($id);

        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieService->update($director);

            return $this->redirectToRoute('director_index');
        }

        return $this->render('director/form.html.twig', [
            'movie_form' => $form,
        ]);
    }
}

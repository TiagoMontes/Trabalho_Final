<?php

namespace App\Controller;

use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService, private MovieRepository $movieRepository)
    {
        
    }

    #[Route('/movie', name: 'movie_index')]
    public function index(MovieRepository $movieRepository)
    {
        $data['title'] = 'Gerenciar Filmes';
        $data['movies'] = $movieRepository->findAll();

        return $this->render('movie/index.html.twig', $data);
    }

    #[Route('/movie/add', name: 'movie_add')]
    public function newMovie(Request $request): Response
    {
        $form = $this->createForm(MovieType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieService->register($form->getData());
            return $this->redirectToRoute('movie_index');
        }

        return $this->render('movie/form.html.twig',[
            'movie_form' => $form,
            'title' => 'Adicionar Filme'
        ]);
    }

    #[Route('/movie/delete/{id}', name: 'movie_delete')]
    public function deleteMovie(int $id): Response
    {
        $movieId = $this->movieRepository->find($id);

        $this->movieRepository->remove($movieId, true);

        return $this->redirectToRoute('movie_index');
    }

    #[Route('/movie/update/{id}', name: 'movie_update')]
    public function editMovie($id, Request $request): Response
    {
        $movie = $this->movieRepository->find($id);

        $form = $this->createForm(MovieType::class, $movie); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieService->update($movie); 

            return $this->redirectToRoute('movie_index');
        }

        return $this->render('movie/form.html.twig', [
            'movie_form' => $form,
            'title' => 'Editar Filme'
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'movie_')]
class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService, private MovieRepository $movieRepository)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(MovieRepository $movieRepository)
    {
        $data['title'] = 'Gerenciar Filmes';
        $data['movies'] = $movieRepository->findAll();

        return $this->render('movie/index.html.twig', $data);
    }

    #[Route('/add', name: 'add')]
    public function newMovie(Request $request): Response
    {

        $movie = new Movie;
        $form = $this->createForm(MovieType::class, $movie);
        $requestData =$request->request->all();
        
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $dateForm = DateTime::createFromFormat('d/m/Y', $requestData['movie']['release_date']);
            $this->movieService->register($movie);
            return $this->redirectToRoute('movie_index');
        }

        return $this->render('movie/form.html.twig',[
            'movie_form' => $form,
            'title' => 'Adicionar Filme'
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteMovie(int $id): Response
    {
        $movieId = $this->movieRepository->find($id);

        $this->movieRepository->remove($movieId, true);

        return $this->redirectToRoute('movie_index');
    }

    #[Route('/update/{id}', name: 'update')]
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

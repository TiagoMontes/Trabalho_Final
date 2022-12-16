<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService, private MovieRepository $movieRepository)
    { 
        
    }

    #[Route('/movie', name: 'movie', methods: ['GET', 'POST'])]
    public function newMovie(Request $request)
    {
        $form = $this->createForm(MovieType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieService->create($form->getData());

            $this->addFlash(
                'success',
                "Filme cadastrado com sucesso"
            );
        }
        
        $moviesList = $this->movieRepository->findAll();

        return $this->render('index.html.twig',  [
            'form' => $form,
            'movies' => $moviesList
        ]);        
    }

    /*
    *   Delete route still in progress
    */
    // #[Route('/movie/{slug}', name: 'delete', methods: ['GET', 'POST'])]
    // public function deleteMovie($slug, Request $request): Response
    // {
    //     $movieId = ($request->get('id'));
    //     $movie = $this->movieRepository->findById($slug);

    //     $this->movieRepository->remove($movie, true);

    
    //     return $this->render('index.html.twig', compact('slug'));
    
    // }

    //#[Route('/movie/list', name: 'list', methods: ['GET'])]
    //public function show(ManagerRegistry $doctrine, int $id): Response
    //{

        //$movie = $doctrine->getRepository(Movie::class)->find($id);

        //if (!$movie) {
        //    throw $this->createNotFoundException(
        //        'Nenhum filme com o id' .$id
        //    );
        //}

        //return new Response('O incrível filme: ' .$movie->getName());
    //}
}

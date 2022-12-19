<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\SubscribedService;

class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService, private MovieRepository $movieRepository)
    {
        
    }

    #[Route('/filme', name: 'movie_index')]
    public function index(MovieRepository $movieRepository)
    {
        $data['movies'] = $movieRepository->findAll();
        $data['title'] = 'Gerenciar Filmes';

        return $this->render('movie/index.html.twig', $data);
    }

    #[Route('/filme/adicionar', name: 'movie_add')]
    public function add(Request $request): Response
    {

        $form = $this->createForm(MovieType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movieService->register($form->getData());
        }

        $movieList = $this->movieRepository->findAll();

        return $this->render('movie/form.html.twig',[
            'movie_form' => $form,
            'movies' => $movieList
        ]);
    }
}

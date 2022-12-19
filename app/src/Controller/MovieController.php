<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/filme', name: 'movie_index')]
    public function index(MovieRepository $movieRepository)
    {
        $data['movies'] = $movieRepository->findAll();
        $data['title'] = 'Gerenciar Filmes';

        return $this->render('movie/index.html.twig', $data);
    }

    #[Route('/filme/adicionar', name: 'movie_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = '';
        $movie = new Movie();

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($movie);
            $entityManager->flush();
            $message = 'Filme cadastrado';
        }

        $data['title'] = 'Adicionar novo filme';
        $data['form'] = $form;
        $data['message'] = $message;

        return $this->render('movie/form.html.twig', $data);
    }
}

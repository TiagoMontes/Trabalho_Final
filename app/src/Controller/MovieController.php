<?php

namespace App\Controller;

use App\Form\Type\MovieType;
use App\Service\MovieService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService)
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
        
        return $this->render('index.html.twig',  [
            'form' => $form
        ]);
    }
}

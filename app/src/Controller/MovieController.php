<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends AbstractController
{
    public function __construct(private MovieService $movieService, private MovieRepository $movieRepository, EntityManagerInterface $entityManager)
    { 
        
    }

    #[Route('/movie', name: 'movie', methods: ['GET', 'POST'])]
    public function newMovie(Request $request)
    {
        $form = $this->createForm(MovieType::class);
        $form->handleRequest($request);
        dd($form);
        
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

    // #[Route('/movie/{id}', name: 'search_movie')]
    // public function search(ManagerRegistry $doctrine, int $id): Response
    // {
    //     $movie = $doctrine->getRepository(Movie::class)->find($id);

    //     if (!$movie) {
    //         throw $this->createNotFoundException(
    //             'Filme com id: ' . $id . ' não econtrado.'
    //         );
    //     }

    //     return new Response('Filme ' .$movie->getName());
    // }

    #[Route('/movie/edit', name: 'movie_edit')]
    public function update(Request $request, ManagerRegistry $doctrine) 
    {
        $movieName = $request->request->get('movie');
        $movieId = $request->request->get('id');
        // dd($movieId, $movieName);
        $movie = $doctrine->getRepository(Movie::class)->find($movieId);

        $movie->setName($movieName);
        $this->movieRepository->save($movie, true);

        return $this->redirect('/movie');
    }

    // #[Route('/movie/edit/{id}/{new_name}', name: 'movie_edit')]
    // public function update(ManagerRegistry $doctrine, int $id, string $new_name): Response
    // {
    //     $entityManager = $doctrine->getManager();
    //     $movie = $entityManager->getRepository(Movie::class)->find($id);

    //     if (!$movie) {
    //         throw $this->createNotFoundException(
    //             'Nenhum filme com id ' . $id . ' encontrado'
    //         );
    //     }

    //     $movie->setName($new_name);
    //     $entityManager->flush();

    //     return $this->redirectToRoute('movie', [
    //         'id' => $movie->getId()
    //     ]);
    // }

    #[Route('/movie/delete/{id}', name: 'delete_movie')]
    public function delete(ManagerRegistry $doctrine, int $id, EntityManagerInterface $entityManager): Response
    {
        $movie = $doctrine->getRepository(Movie::class)->find($id);

        if (!$movie) {
            throw $this->createNotFoundException(
                'Filme com id: ' . $id . ' não econtrado.'
            );
        }

        $entityManager->remove($movie);
        $entityManager->flush();

        return new Response('Filme deletado: ' . $movie->getName());
    }
}

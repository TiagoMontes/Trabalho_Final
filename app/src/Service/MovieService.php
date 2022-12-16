<?php

namespace App\Service;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\MovieRepository;

class MovieService 
{
    public function __construct(private MovieRepository $movieRepository)
    {

    }

    public function create(array $form): Movie
    {
        $movie = new Movie();
        // $genre = new Genre();

        $movie->setName($form['name']);
        // $movie->setGenre($genre->getGenre());

        $this->movieRepository->save($movie, true);

        return $movie;
    }
}

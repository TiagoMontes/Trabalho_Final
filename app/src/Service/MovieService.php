<?php

namespace App\Service;

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
        $movie->setName($form['name']);

        $this->movieRepository->save($movie, true);

        return $movie;
    }
}

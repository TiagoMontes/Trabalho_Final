<?php

namespace App\Service;

use App\Repository\MovieRepository;
use App\Entity\Movie;

class MovieService
{
    public function __construct(private MovieRepository $movieRepository){

    }

    public function register($movie): Movie
    {
        $this->movieRepository->save($movie, true);

        return $movie;
    }

    public function update($movie): Movie
    {
        $this->movieRepository->save($movie, true);

        return $movie;
    }
}

<?php

namespace App\Service;

use App\Repository\MovieRepository;
use App\Entity\Movie;

class MovieService
{
    public function __construct(private MovieRepository $movieRepository){

    }

    public function register(array $form): Movie
    {

        $movie = new Movie;
        $movie->setTitle($form['title']);
        $movie->setDuration($form['duration']);
        $movie->setDescription($form['description']);
        $movie->setReleaseDate($form['release_date']);
        $movie->setCategory($form['category']);

        $this->movieRepository->save($movie, true);

        return $movie;
    }
}
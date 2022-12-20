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
        $movie->setDirector($form['director']);

        $this->movieRepository->save($movie, true);

        return $movie;
    }

    public function update($movie): Movie
    {
        $movie->setTitle($movie->getTitle());
        $movie->setDuration($movie->getDuration());
        $movie->setDescription($movie->getDescription());
        $movie->setReleaseDate($movie->getReleaseDate());
        $movie->setCategory($movie->getCategory());
        $movie->setDirector($movie->getDirector());

        $this->movieRepository->save($movie, true);

        return $movie;
    }
}

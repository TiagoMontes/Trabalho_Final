<?php

namespace App\Service;

use App\Entity\Director;
use App\Repository\DirectorRepository;

class DirectorService
{
    public function __construct(private DirectorRepository $directorRepository)
    {
        
    }

    public function register(array $form): Director
    {
        $director = new Director;
        $director->setFirstName($form['first_name']);
        $director->setLastName($form['last_name']);
        $director->setAge($form['age']);
        $director->setOscars($form['oscars']);

        $this->directorRepository->save($director, true);

        return $director;
    }

    public function update($director): Director
    {
        $director->setFirstName($director->getFirstName());
        $director->setLastName($director->getLastName());
        $director->setAge($director->getAge());
        $director->setOscars($director->getOscars());

        $this->directorRepository->save($director, true);

        return $director;
    }
}

<?php

namespace App\Service;

use App\Entity\Director;
use App\Repository\DirectorRepository;

class DirectorService
{
    public function __construct(private DirectorRepository $directorRepository)
    {
        
    }

    public function register($director): Director
    {
        // ESTA CONDICIONAL SÓ É VIÁVEL CASO EXISTA APENAS UM CAMPO NAME
        // $directorExist = $this->directorRepository->findBy(["first_name" => $director->getFirstName()]);
        // if ($directorExist == null) { 
        // }
            
        $this->directorRepository->save($director, true);
        return $director;
    }

    public function update($director): Director
    {
        $this->directorRepository->save($director, true);

        return $director;
    }
}

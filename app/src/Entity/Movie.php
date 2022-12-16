<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    //#[ORM\Column(length: 255)]
    //private ?string $description = null;

    //#[ORM\Column]
    //private int $duration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    //public function getDescription(): ?string
    //{
    //    return $this->description;
    //}

    //public function setDescription(string $description): self
    //{
    //    $this->description = $description;
//
    //    return $this;
   // }

    //public function getDuration(): ?int
    //{
    //    return $this->duration;
    //}

   // public function setDuration(string $duration): self
    //{
    //    $this->duration = $duration;

    //    return $this;
    //}
}

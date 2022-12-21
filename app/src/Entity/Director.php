<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
class Director
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'O Nome deve conter pelo {{ limit }} caracteres',
        maxMessage: 'O Nome do Produto deve contar no máximo {{ limit }} caracteres',
    )]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'O Sobrenome deve conter pelo {{ limit }} caracteres',
        maxMessage: 'O Sobrenome deve contar no máximo {{ limit }} caracteres',
    )]
    private ?string $last_name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'O valor deve ser positivo')]
    private ?int $age = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'O valor deve ser positivo')]
    private ?int $oscars = null;

    #[ORM\OneToMany(mappedBy: 'director', targetEntity: Movie::class)]
    private Collection $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getOscars(): ?int
    {
        return $this->oscars;
    }

    public function setOscars(int $oscars): self
    {
        $this->oscars = $oscars;

        return $this;
    }

    public function __toString()
    {
        return $this->first_name;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setDirector($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getDirector() === $this) {
                $movie->setDirector(null);
            }
        }

        return $this;
    }
}

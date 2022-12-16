<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genderType = null;

    #[ORM\OneToMany(mappedBy: 'gender', targetEntity: Subscriber::class)]
    private Collection $subscriber;

    public function __construct()
    {
        $this->gender = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenderType(): ?string
    {
        return $this->genderType;
    }

    public function setGenderType(string $genderType): self
    {
        $this->genderType = $genderType;

        return $this;
    }

    /**
     * @return Collection<int, Subscriber>
     */
    public function getSubscriber(): Collection
    {
        return $this->subscriber;
    }

    public function addSubscriber(Subscriber $subscriber): self
    {
        if (!$this->subscriber->contains($subscriber)) {
            $this->subscriber->add($subscriber);
            $subscriber->setGender($this);
        }

        return $this;
    }

    public function removeSubscriber(Subscriber $subscriber): self
    {
        if ($this->subscriber->removeElement($subscriber)) {
            // set the owning side to null (unless already changed)
            if ($subscriber->getGender() === $this) {
                $subscriber->setGender(null);
            }
        }

        return $this;
    }

}

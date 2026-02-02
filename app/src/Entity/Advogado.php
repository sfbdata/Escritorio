<?php

namespace App\Entity;

use App\Repository\AdvogadoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvogadoRepository::class)]
class Advogado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $numeroOAB = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOAB(): ?string
    {
        return $this->numeroOAB;
    }

    public function setNumeroOAB(string $numeroOAB): static
    {
        $this->numeroOAB = $numeroOAB;

        return $this;
    }
}

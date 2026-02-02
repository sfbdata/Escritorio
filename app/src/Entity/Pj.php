<?php

namespace App\Entity;

use App\Repository\PjRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PjRepository::class)]
class Pj
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $Cnpj = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnpj(): ?string
    {
        return $this->Cnpj;
    }

    public function setCnpj(?string $Cnpj): static
    {
        $this->Cnpj = $Cnpj;

        return $this;
    }
}

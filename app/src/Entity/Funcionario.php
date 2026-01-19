<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FuncionarioRepository::class)]
class Funcionario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 100)]
    private ?string $cargo = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $telefone = null;

    /**
     * @var Collection<int, Processo>
     */
    #[ORM\ManyToMany(targetEntity: Processo::class, mappedBy: 'responsavel')]
    private Collection $processos;

    public function __construct()
    {
        $this->processos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): static
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): static
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return Collection<int, Processo>
     */
    public function getProcessos(): Collection
    {
        return $this->processos;
    }

    public function addProcesso(Processo $processo): static
    {
        if (!$this->processos->contains($processo)) {
            $this->processos->add($processo);
            $processo->addResponsavel($this);
        }

        return $this;
    }

    public function removeProcesso(Processo $processo): static
    {
        if ($this->processos->removeElement($processo)) {
            $processo->removeResponsavel($this);
        }

        return $this;
    }
}

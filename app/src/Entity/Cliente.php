<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $telefone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $endereco = null;

    /**
     * @var Collection<int, Processo>
     */
    #[ORM\ManyToMany(targetEntity: Processo::class, mappedBy: 'cliente')]
    private Collection $processos;

    /**
     * @var Collection<int, Documento>
     */
    #[ORM\ManyToMany(targetEntity: Documento::class, mappedBy: 'clientes')]
    private Collection $documentos;

    public function __construct()
    {
        $this->processos = new ArrayCollection();
        $this->documentos = new ArrayCollection();
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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): static
    {
        $this->endereco = $endereco;

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
            $processo->addCliente($this);
        }

        return $this;
    }

    public function removeProcesso(Processo $processo): static
    {
        if ($this->processos->removeElement($processo)) {
            $processo->removeCliente($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Documento>
     */
    public function getDocumentos(): Collection
    {
        return $this->documentos;
    }

    public function addDocumento(Documento $documento): static
    {
        if (!$this->documentos->contains($documento)) {
            $this->documentos->add($documento);
            $documento->addCliente($this);
        }

        return $this;
    }

    public function removeDocumento(Documento $documento): static
    {
        if ($this->documentos->removeElement($documento)) {
            $documento->removeCliente($this);
        }

        return $this;
    }
}

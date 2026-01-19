<?php

namespace App\Entity;

use App\Repository\ProcessoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcessoRepository::class)]
class Processo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $numero = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    /**
     * @var Collection<int, Cliente>
     */
    #[ORM\ManyToMany(targetEntity: Cliente::class, inversedBy: 'processos')]
    private Collection $cliente;

    /**
     * @var Collection<int, Funcionario>
     */
    #[ORM\ManyToMany(targetEntity: Funcionario::class, inversedBy: 'processos')]
    private Collection $responsavel;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $data = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $proximoPrazo = null;

    /**
     * @var Collection<int, Documento>
     */
    #[ORM\OneToMany(targetEntity: Documento::class, mappedBy: 'processo')]
    private Collection $documentos;

    public function __construct()
    {
        $this->cliente = new ArrayCollection();
        $this->responsavel = new ArrayCollection();
        $this->documentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getCliente(): Collection
    {
        return $this->cliente;
    }

    public function addCliente(Cliente $cliente): static
    {
        if (!$this->cliente->contains($cliente)) {
            $this->cliente->add($cliente);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): static
    {
        $this->cliente->removeElement($cliente);

        return $this;
    }

    /**
     * @return Collection<int, Funcionario>
     */
    public function getResponsavel(): Collection
    {
        return $this->responsavel;
    }

    public function addResponsavel(Funcionario $responsavel): static
    {
        if (!$this->responsavel->contains($responsavel)) {
            $this->responsavel->add($responsavel);
        }

        return $this;
    }

    public function removeResponsavel(Funcionario $responsavel): static
    {
        $this->responsavel->removeElement($responsavel);

        return $this;
    }

    public function getData(): ?\DateTime
    {
        return $this->data;
    }

    public function setData(?\DateTime $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getProximoPrazo(): ?\DateTime
    {
        return $this->proximoPrazo;
    }

    public function setProximoPrazo(?\DateTime $proximoPrazo): static
    {
        $this->proximoPrazo = $proximoPrazo;

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
            $documento->setProcesso($this);
        }

        return $this;
    }

    public function removeDocumento(Documento $documento): static
    {
        if ($this->documentos->removeElement($documento)) {
            // set the owning side to null (unless already changed)
            if ($documento->getProcesso() === $this) {
                $documento->setProcesso(null);
            }
        }

        return $this;
    }
}

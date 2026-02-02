<?php

namespace App\Entity;

use App\Repository\DocumentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User; // importa a entidade User

#[ORM\Entity(repositoryClass: DocumentoRepository::class)]
class Documento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $caminho = null;

    #[ORM\ManyToOne(inversedBy: 'documentos')]
    private ?Processo $processo = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'documentos')]
    private Collection $users;

    #[ORM\Column]
    private ?\DateTimeImmutable $criadoEm = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificadoEm = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getcaminho(): ?string
    {
        return $this->caminho
;
    }

    public function setcaminho(string $caminho): static
    {
        $this->caminho
 = $caminho
;

        return $this;
    }

    public function getProcesso(): ?Processo
    {
        return $this->processo;
    }

    public function setProcesso(?Processo $processo): static
    {
        $this->processo = $processo;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getCriadoEm(): ?\DateTimeImmutable
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(\DateTimeImmutable $criadoEm): static
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }

    public function getModificadoEm(): ?\DateTimeImmutable
    {
        return $this->modificadoEm;
    }

    public function setModificadoEm(\DateTimeImmutable $modificadoEm): static
    {
        $this->modificadoEm = $modificadoEm;

        return $this;
    }
}

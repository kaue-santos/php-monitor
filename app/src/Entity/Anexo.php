<?php

namespace App\Entity;

use App\Repository\AnexoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnexoRepository::class)]
class Anexo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $criadoEm = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne]
    private ?Comentario $id_comentario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCriadoEm(): ?\DateTimeInterface
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(\DateTimeInterface $criadoEm): self
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdComentario(): ?Comentario
    {
        return $this->id_comentario;
    }

    public function setIdComentario(?Comentario $id_comentario): self
    {
        $this->id_comentario = $id_comentario;

        return $this;
    }
}

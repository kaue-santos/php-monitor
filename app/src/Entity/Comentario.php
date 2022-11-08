<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
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
    private ?string $tipoOperacao = null;

    #[ORM\ManyToOne]
    private ?Evento $id_evento = null;

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

    public function getTipoOperacao(): ?string
    {
        return $this->tipoOperacao;
    }

    public function setTipoOperacao(string $tipoOperacao): self
    {
        $this->tipoOperacao = $tipoOperacao;

        return $this;
    }

    public function getIdEvento(): ?Evento
    {
        return $this->id_evento;
    }

    public function setIdEvento(?Evento $id_evento): self
    {
        $this->id_evento = $id_evento;

        return $this;
    }
}

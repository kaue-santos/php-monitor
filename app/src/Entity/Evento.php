<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dados = null;

    #[ORM\Column(length: 255)]
    private ?string $situacao = null;

    #[ORM\Column]
    private ?int $reincidencia = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoEvento = null;

    #[ORM\Column]
    private ?bool $ignorar = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $criadoEm = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $atualizadoEm = null;

    #[ORM\Column(length: 255)]
    private ?string $chave = null;

    #[ORM\ManyToOne]
    private ?Ocorrencia $id_ocorrencia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDados(): ?string
    {
        return $this->dados;
    }

    public function setDados(string $dados): self
    {
        $this->dados = $dados;

        return $this;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    public function getReincidencia(): ?int
    {
        return $this->reincidencia;
    }

    public function setReincidencia(int $reincidencia): self
    {
        $this->reincidencia = $reincidencia;

        return $this;
    }

    public function getTipoEvento(): ?string
    {
        return $this->tipoEvento;
    }

    public function setTipoEvento(string $tipoEvento): self
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    public function isIgnorar(): ?bool
    {
        return $this->ignorar;
    }

    public function setIgnorar(bool $ignorar): self
    {
        $this->ignorar = $ignorar;

        return $this;
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

    public function getAtualizadoEm(): ?\DateTimeInterface
    {
        return $this->atualizadoEm;
    }

    public function setAtualizadoEm(\DateTimeInterface $atualizadoEm): self
    {
        $this->atualizadoEm = $atualizadoEm;

        return $this;
    }

    public function getChave(): ?string
    {
        return $this->chave;
    }

    public function setChave(string $chave): self
    {
        $this->chave = $chave;

        return $this;
    }

    public function getIdOcorrencia(): ?Ocorrencia
    {
        return $this->id_ocorrencia;
    }

    public function setIdOcorrencia(?Ocorrencia $id_ocorrencia): self
    {
        $this->id_ocorrencia = $id_ocorrencia;

        return $this;
    }
}

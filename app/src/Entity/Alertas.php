<?php

namespace App\Entity;

use App\Repository\AlertasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlertasRepository::class)]
class Alertas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $cor = null;

    #[ORM\Column]
    private ?int $diasInicio = null;

    #[ORM\Column]
    private ?int $diasFim = null;

    #[ORM\ManyToOne]
    private ?Area $id_area = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Ativo = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCor(): ?string
    {
        return $this->cor;
    }

    public function setCor(string $cor): self
    {
        $this->cor = $cor;

        return $this;
    }

    public function getDiasInicio(): ?int
    {
        return $this->diasInicio;
    }

    public function setDiasInicio(int $diasInicio): self
    {
        $this->diasInicio = $diasInicio;

        return $this;
    }

    public function getDiasFim(): ?int
    {
        return $this->diasFim;
    }

    public function setDiasFim(int $diasFim): self
    {
        $this->diasFim = $diasFim;

        return $this;
    }

    public function getIdArea(): ?Area
    {
        return $this->id_area;
    }

    public function setIdArea(?Area $id_area): self
    {
        $this->id_area = $id_area;

        return $this;
    }

    public function isAtivo(): ?bool
    {
        return $this->Ativo;
    }

    public function setAtivo(?bool $Ativo): self
    {
        $this->Ativo = $Ativo;

        return $this;
    }
}

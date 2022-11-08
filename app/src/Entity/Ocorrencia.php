<?php

namespace App\Entity;

use App\Repository\OcorrenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OcorrenciaRepository::class)]
class Ocorrencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(length: 255)]
    private ?string $script = null;

    #[ORM\Column(length: 255)]
    private ?string $colunaChave = null;

    #[ORM\Column(length: 255)]
    private ?string $colunas = null;

    #[ORM\Column]
    private ?bool $ativo = null;

    #[ORM\Column(length: 255)]
    private ?string $tipoOcorrencia = null;

    #[ORM\Column]
    private ?int $qtdDiasParaAtraso = null;

    #[ORM\Column]
    private ?int $qtdDiasParaAlertaAtraso = null;

    #[ORM\ManyToOne]
    private ?Categoria $id_categoria = null;

    #[ORM\ManyToOne]
    private ?Area $id_area = null;

    #[ORM\ManyToMany(targetEntity: Alertas::class)]
    private Collection $alertas;

    public function __construct()
    {
        $this->alertas = new ArrayCollection();
    }

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getScript(): ?string
    {
        return $this->script;
    }

    public function setScript(string $script): self
    {
        $this->script = $script;

        return $this;
    }

    public function getColunaChave(): ?string
    {
        return $this->colunaChave;
    }

    public function setColunaChave(string $colunaChave): self
    {
        $this->colunaChave = $colunaChave;

        return $this;
    }

    public function getColunas(): ?string
    {
        return $this->colunas;
    }

    public function setColunas(string $colunas): self
    {
        $this->colunas = $colunas;

        return $this;
    }

    public function isAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function getTipoOcorrencia(): ?string
    {
        return $this->tipoOcorrencia;
    }

    public function setTipoOcorrencia(string $tipoOcorrencia): self
    {
        $this->tipoOcorrencia = $tipoOcorrencia;

        return $this;
    }

    public function getQtdDiasParaAtraso(): ?int
    {
        return $this->qtdDiasParaAtraso;
    }

    public function setQtdDiasParaAtraso(int $qtdDiasParaAtraso): self
    {
        $this->qtdDiasParaAtraso = $qtdDiasParaAtraso;

        return $this;
    }

    public function getQtdDiasParaAlertaAtraso(): ?int
    {
        return $this->qtdDiasParaAlertaAtraso;
    }

    public function setQtdDiasParaAlertaAtraso(int $qtdDiasParaAlertaAtraso): self
    {
        $this->qtdDiasParaAlertaAtraso = $qtdDiasParaAlertaAtraso;

        return $this;
    }

    public function getIdCategoria(): ?Categoria
    {
        return $this->id_categoria;
    }

    public function setIdCategoria(?Categoria $id_categoria): self
    {
        $this->id_categoria = $id_categoria;

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

    /**
     * @return Collection<int, Alertas>
     */
    public function getAlertas(): Collection
    {
        return $this->alertas;
    }

    public function addAlerta(Alertas $alerta): self
    { 
        if (!$this->alertas->contains($alerta)) {
            $this->alertas->add($alerta);
        }

        return $this;
    }

    public function removeAlerta(Alertas $alerta): self
    {
        $this->alertas->removeElement($alerta);

        return $this;
    }
}

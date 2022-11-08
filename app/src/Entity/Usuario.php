<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $ativo = null;

    #[ORM\Column]
    private ?int $acessos = null;

    #[ORM\Column]
    private ?int $qtdAcessos = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ultimoLogin = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $roles = [];

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

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getAcessos(): ?int
    {
        return $this->acessos;
    }

    public function setAcessos(int $acessos): self
    {
        $this->acessos = $acessos;

        return $this;
    }

    public function getQtdAcessos(): ?int
    {
        return $this->qtdAcessos;
    }

    public function setQtdAcessos(int $qtdAcessos): self
    {
        $this->qtdAcessos = $qtdAcessos;

        return $this;
    }

    public function getUltimoLogin(): ?\DateTimeInterface
    {
        return $this->ultimoLogin;
    }

    public function setUltimoLogin(\DateTimeInterface $ultimoLogin): self
    {
        $this->ultimoLogin = $ultimoLogin;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}

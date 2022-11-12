<?php

namespace App\Service;

use App\Entity\Usuario;
use App\Entity\Area;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class UsuarioService
{
    /** @var EntityManager */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function json($usuarios)
    {
        $array = [];

        foreach ($usuarios as $usuario) {

            $array []= [
                "id" => $usuario->getId(),
                "nome" => $usuario->getNome(),
                "userName" => $usuario->getUserName(),
                "email" => $usuario->getEmail(), 
                "ativo" => $usuario->isAtivo(),
                "acessos" => $usuario->getAcessos(),
                "ultimoLogin" => $usuario->getUltimoLogin(),
                "roles" => $usuario->getRoles()
            ];
        }
        return $array;
    }

    public function listUsuario()
    {
        $usuarios = $this->em->getRepository(Usuario::class)->findAll();
        
        $json = $this->json($usuarios);

        return $json;
    }

    public function validateUsuario($data)
    {
        $msg = null;

        if ($data['nome'] == null || empty($data['nome'])) {
            $msg .= "Nome não informado!";
        }

        if ($data['userName'] == null || empty($data['userName'])) {
            $msg .= "Use Name não informado!";
        }

        if ($data['email'] == null || empty($data['email'])) {
            $msg .= "Email não informado!";
        }

        if ($data['roles'] == null || empty($data['roles'])) {
            $msg .= "Roles não informado";
        }

        // if ($data['area'] == null || empty($data['area']) || $data['area'] == 0) {
        //     $msg .= "Area fim não informado";
        // } else {
        //     /** @var Area $area */
        //     $area = $this->em->getRepository(Area::class)->find($data['area']);
        //     if (!$area) {
        //         $msg .= "Area não encontrada!";
        //     }
        // }

        if ($msg != null){
            throw new \Exception($msg);
        }
    }

    public function newUsuario($data)
    {
        $usuario = new Usuario;

        //$area = $this->em->getRepository(Area::class)->find($data['area']);

        $usuario->setNome($data['nome']);
        $usuario->setUserName($data['userName']);
        $usuario->setEmail($data['email']);
        $usuario->setAtivo(true);
        $usuario->setAcessos(1);
        $usuario->setQtdAcessos(1);
        $usuario->setUltimoLogin(new DateTime('NOW'));
        $usuario->setRoles($data['roles']);

        $this->em->persist($usuario);
        $this->em->flush();

        $array = [
            "id" => $usuario->getId(),
                "nome" => $usuario->getNome(),
                "userName" => $usuario->getUserName(),
                "email" => $usuario->getEmail(), 
                "ativo" => $usuario->isAtivo(),
                "acessos" => $usuario->getAcessos(),
                "ultimoLogin" => $usuario->getUltimoLogin(),
                "roles" => $usuario->getRoles()
        ];

        return $array;
    }

    public function editUsuario($data, $id)
    {
        $usuario = $this->em->getRepository(Usuario::class)->find($id);

        $usuario->setNome($data['nome']);
        $usuario->setUserName($data['userName']);
        $usuario->setEmail($data['email']);
        $usuario->setAtivo($data['ativo']);
        $usuario->setRoles($data['roles']);

        $this->em->persist($usuario);
        $this->em->flush();

        $array = [
            "id" => $usuario->getId(),
                "nome" => $usuario->getNome(),
                "userName" => $usuario->getUserName(),
                "email" => $usuario->getEmail(), 
                "ativo" => $usuario->isAtivo(),
                "acessos" => $usuario->getAcessos(),
                "ultimoLogin" => $usuario->getUltimoLogin(),
                "roles" => $usuario->getRoles()
        ];

        return $array;
    }

    public function deleteUsuario($id)
    {
        //Precisa verifficar se não area viculada
        $usuario = $this->em->getRepository(Usuario::class)->find($id);

        $this->em->remove($usuario);
        $this->em->flush();

        return "ok";
    }
}
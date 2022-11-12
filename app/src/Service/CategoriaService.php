<?php

namespace App\Service;

use App\Entity\Categoria;
use App\Entity\Area;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CategoriaService
{
    /** @var EntityManager */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function json($categorias)
    {
        $array = [];

        foreach ($categorias as $categorias) {

            $array []= [
                "id" => $categorias->getId(),
                "nome" => $categorias->getNome(),
                "ativo" => $categorias->isAtivo(),
                "areaId"  => $categorias->getIdArea()->getId()
            ];
        }
        return $array;
    }

    public function listCategoria()
    {
        $categorias = $this->em->getRepository(Categoria::class)->findAll();
        
        $json = $this->json($categorias);

        return $json;
    }

    public function validateCategoria($data)
    {
        $msg = null;

        if ($data['nome'] == null || empty($data['nome'])) {
            $msg .= "Nome não informado!";
        }

        if ($data['area'] == null || empty($data['area']) || $data['area'] == 0) {
            $msg .= "Area fim não informado";
        } else {
            /** @var Area $area */
            $area = $this->em->getRepository(Area::class)->find($data['area']);
            if (!$area) {
                $msg .= "Area não encontrada!";
            }
        }

        if ($msg != null){
            throw new \Exception($msg);
        }
    }

    public function newCategoria($data)
    {
        $categorias = new Categoria;

        $area = $this->em->getRepository(Area::class)->find($data['area']);

        $categorias->setNome($data['nome']);
        $categorias->setAtivo(true);
        $categorias->setIdArea($area);

        $this->em->persist($categorias);
        $this->em->flush();

        $array = [
            "id" => $categorias->getId(),
            "nome" => $categorias->getNome(),
            "ativo" => $categorias->isAtivo(),
            "areaId"  => $categorias->getIdArea()->getId()
        ];

        return $array;
    }

    public function editCategoria($data, $id)
    {
        $categorias = $this->em->getRepository(Categoria::class)->find($id);

        $categorias->setNome($data['nome']);
        $categorias->isAtivo(true);

        $this->em->persist($categorias);
        $this->em->flush();

        $array = [
            "id" => $categorias->getId(),
            "nome" => $categorias->getNome(),
            "ativo" => $categorias->isAtivo(),
            "areaId"  => $categorias->getIdArea()->getId()
        ];

        return $array;
    }

    public function deleteCategoria($id)
    {
        //Precisa verifficar se não area viculada
        $categorias = $this->em->getRepository(Categoria::class)->find($id);

        $this->em->remove($categorias);
        $this->em->flush();

        return "ok";
    }
}
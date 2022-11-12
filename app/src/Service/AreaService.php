<?php

namespace App\Service;

use App\Entity\Area;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class AreaService
{
    /** @var EntityManager */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function json($areas)
    {
        $array = [];

        foreach ($areas as $area) {

            $array []= [
                "id" => $area->getId(),
                "nome" => $area->getNome(),
                "ativo" => $area->isAtivo()
            ];
        }
        return $array;
    }

    public function listArea()
    {
        $areas = $this->em->getRepository(Area::class)->findAll();
        
        $json = $this->json($areas);

        return $json;
    }

    public function validateArea($data)
    {
        $msg = null;

        if ($data['nome'] == null || empty($data['nome'])) {
            $msg .= "Nome não informado!";
        }

        if ($msg != null){
            throw new \Exception($msg);
        }
    }

    public function newArea($data)
    {
        $area = new Area;

        $area->setNome($data['nome']);
        $area->isAtivo(true);

        $this->em->persist($area);
        $this->em->flush();

        $array = [
            "id" => $area->getId(),
            "nome" => $area->getNome(),
            "ativo" => $area->isAtivo()
        ];

        return $array;
    }

    public function editArea($data, $id)
    {
        $area = $this->em->getRepository(Area::class)->find($id);

        $area->setNome($data['nome']);
        $area->setAtivo($data['ativo']);

        $this->em->persist($area);
        $this->em->flush();

        $array = [
            "id" => $area->getId(),
            "nome" => $area->getNome(),
            "ativo" => $area->isAtivo()
        ];

        return $array;
    }

    public function deleteArea($id)
    {
        $area = $this->em->getRepository(Area::class)->find($id);

        $this->em->remove($area);
        $this->em->flush();

        return "ok";
    }
}
<?php

namespace App\Service;

use App\Entity\Alertas;
use App\Entity\Area;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class AlertasService
{
    /** @var EntityManager */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function json($alertas)
    {
        $array = [];

        foreach ($alertas as $alerta) {

            $array []= [
                "id" => $alerta->getId(),
                "nome" => $alerta->getNome(),
                "cor" => $alerta->getCor(),
                "diasInicio" => $alerta->getDiasInicio(), 
                "diasFim" => $alerta->getDiasFim(),
                "ativo" => $alerta->isAtivo(),
                "areaId"  => $alerta->getIdArea()->getId()

            ];
        }
        return $array;
    }

    public function listAlertas()
    {
        $alertas = $this->em->getRepository(Alertas::class)->findAll();
        
        $json = $this->json($alertas);

        return $json;
    }

    public function validateAlertas($data)
    {
        $msg = null;

        if ($data['nome'] == null || empty($data['nome'])) {
            $msg .= "Nome não informado!";
        }

        if ($data['cor'] == null || empty($data['cor'])) {
            $msg .= "Cor não informada!";
        }

        if ($data['diasInicio'] == null || empty($data['diasInicio'])) {
            $msg .= "Dias para inicio não informado!";
        }

        if ($data['diasFim'] == null || empty($data['diasFim'])) {
            $msg .= "Dias para fim não informado";
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

    public function newAlertas($data)
    {
        $alerta = new Alertas;

        $area = $this->em->getRepository(Area::class)->find($data['area']);

        $alerta->setNome($data['nome']);
        $alerta->setCor($data['cor']);
        $alerta->setDiasInicio($data['diasInicio']);
        $alerta->setDiasFim($data['diasFim']);
        $alerta->setAtivo(true);
        $alerta->setIdArea($area);

        $this->em->persist($alerta);
        $this->em->flush();

        $array = [
            "id" => $alerta->getId(),
            "nome" => $alerta->getNome(),
            "cor" => $alerta->getCor(),
            "diasInicio" => $alerta->getDiasInicio(), 
            "diasFim" => $alerta->getDiasFim(),
            "ativo" => $alerta->isAtivo(),
            "areaId"  => $alerta->getIdArea()->getId()
        ];

        return $array;
    }

    public function editAlertas($data, $id)
    {
        $alerta = $this->em->getRepository(Alertas::class)->find($id);

        $alerta->setNome($data['nome']);
        $alerta->setCor($data['cor']);
        $alerta->setDiasInicio($data['diasInicio']);
        $alerta->setDiasFim($data['nome']);
        $alerta->isAtivo(true);

        $this->em->persist($alerta);
        $this->em->flush();

        $array = [
            "id" => $alerta->getId(),
            "nome" => $alerta->getNome(),
            "cor" => $alerta->getCor(),
            "diasInicio" => $alerta->getDiasInicio(), 
            "diasFim" => $alerta->getDiasFim(),
            "ativo" => $alerta->isAtivo(),
            "areaId"  => $alerta->getIdArea()->getId()
        ];

        return $array;
    }

    public function deleteAlertas($id)
    {
        //Precisa verifficar se não area viculada
        $alerta = $this->em->getRepository(Alertas::class)->find($id);

        $this->em->remove($alerta);
        $this->em->flush();

        return "ok";
    }
}
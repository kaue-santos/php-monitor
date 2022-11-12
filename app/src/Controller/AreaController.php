<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaType;
use App\Repository\AreaRepository;
use App\Service\AreaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/area')]
class AreaController extends AbstractController
{
    /** @var AreaService */
    private $svr;

    public function __construct(AreaService $svr)
    {
        $this->svr = $svr;
    }

    #[Route('/', name: 'app_area_index', methods: ['GET'])]
    public function index(AreaRepository $areaRepository)
    {
        $area = $this->svr->listArea();
       
        return $this->json($area); 
    }

    #[Route('/new', name: 'app_area_new', methods: ['POST'])]
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->svr->validateArea($data);

        $area = $this->svr->newArea($data);

        return $this->json($area);
        
    }

    #[Route('/{id}', name: 'app_area_show', methods: ['GET'])]
    public function show(Area $area): Response
    {
        return $this->render('area/show.html.twig', [
            'area' => $area,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_area_edit', methods: ['PUT'])]
    public function edit(Request $request, $id): Response
    {
        //Só deveria ser possivel inativar uma Area sem ocorrências vinculadas
        $data = json_decode($request->getContent(), true);

        $this->svr->validateArea($data);

        $area = $this->svr->editArea($data, $id);

        return $this->json($area);
    }

    #[Route('/{id}', name: 'app_area_delete', methods: ['DELETE'])]
    public function delete($id): Response
    {
        //Deppois tenho que ver uma area não esta vinculada a algo para apagar
        $area = $this->svr->deleteArea($id);

        return $this->json($area);
    }
}

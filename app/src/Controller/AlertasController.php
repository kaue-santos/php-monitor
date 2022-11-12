<?php

namespace App\Controller;

use App\Entity\Alertas;
use App\Form\AlertasType;
use App\Repository\AlertasRepository;
use App\Service\AlertasService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/alertas')]
class AlertasController extends AbstractController
{
    /** @var AlertasService */
    private $svr;

    public function __construct(AlertasService $svr)
    {
        $this->svr = $svr;
    }

    #[Route('/', name: 'app_alertas_index', methods: ['GET'])]
    public function index(AlertasRepository $alertasRepository)
    {
        $alertas = $this->svr->listAlertas();
       
        return $this->json($alertas); 
    }

    #[Route('/new', name: 'app_alertas_new', methods: ['POST'])]
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->svr->validateAlertas($data);

        $alertas = $this->svr->newAlertas($data);

        return $this->json($alertas);
        
    }

    #[Route('/{id}', name: 'app_alertas_show', methods: ['GET'])]
    public function show(Alertas $alertas): Response
    {
        return $this->render('alertas/show.html.twig', [
            'alertas' => $alertas,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_alertas_edit', methods: ['PUT'])]
    public function edit(Request $request, $id): Response
    {
        //Só deveria ser possivel inativar uma Alertas sem ocorrências vinculadas
        $data = json_decode($request->getContent(), true);

        $this->svr->validateAlertas($data);

        $alertas = $this->svr->editAlertas($data, $id);

        return $this->json($alertas);
    }

    #[Route('/{id}', name: 'app_alertas_delete', methods: ['DELETE'])]
    public function delete($id): Response
    {
        //Deppois tenho que ver uma alertas não esta vinculada a algo para apagar
        $alertas = $this->svr->deleteAlertas($id);

        return $this->json($alertas);
    }
}

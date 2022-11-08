<?php

namespace App\Controller;

use App\Entity\Ocorrencia;
use App\Form\OcorrenciaType;
use App\Repository\OcorrenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/ocorrencia')]
class OcorrenciaController extends AbstractController
{
    #[Route('/', name: 'app_ocorrencia_index', methods: ['GET'])]
    public function index(OcorrenciaRepository $ocorrenciaRepository): Response
    {
        return $this->render('ocorrencia/index.html.twig', [
            'ocorrencias' => $ocorrenciaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ocorrencia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OcorrenciaRepository $ocorrenciaRepository): Response
    {
        $ocorrencium = new Ocorrencia();
        $form = $this->createForm(OcorrenciaType::class, $ocorrencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ocorrenciaRepository->save($ocorrencium, true);

            return $this->redirectToRoute('app_ocorrencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ocorrencia/new.html.twig', [
            'ocorrencium' => $ocorrencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ocorrencia_show', methods: ['GET'])]
    public function show(Ocorrencia $ocorrencium): Response
    {
        return $this->render('ocorrencia/show.html.twig', [
            'ocorrencium' => $ocorrencium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ocorrencia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ocorrencia $ocorrencium, OcorrenciaRepository $ocorrenciaRepository): Response
    {
        $form = $this->createForm(OcorrenciaType::class, $ocorrencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ocorrenciaRepository->save($ocorrencium, true);

            return $this->redirectToRoute('app_ocorrencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ocorrencia/edit.html.twig', [
            'ocorrencium' => $ocorrencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ocorrencia_delete', methods: ['POST'])]
    public function delete(Request $request, Ocorrencia $ocorrencium, OcorrenciaRepository $ocorrenciaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ocorrencium->getId(), $request->request->get('_token'))) {
            $ocorrenciaRepository->remove($ocorrencium, true);
        }

        return $this->redirectToRoute('app_ocorrencia_index', [], Response::HTTP_SEE_OTHER);
    }
}

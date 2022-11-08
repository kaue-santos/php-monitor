<?php

namespace App\Controller;

use App\Entity\Conexao;
use App\Form\ConexaoType;
use App\Repository\ConexaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/conexao')]
class ConexaoController extends AbstractController
{
    #[Route('/', name: 'app_conexao_index', methods: ['GET'])]
    public function index(ConexaoRepository $conexaoRepository): Response
    {
        return $this->render('conexao/index.html.twig', [
            'conexaos' => $conexaoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conexao_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConexaoRepository $conexaoRepository): Response
    {
        $conexao = new Conexao();
        $form = $this->createForm(ConexaoType::class, $conexao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conexaoRepository->save($conexao, true);

            return $this->redirectToRoute('app_conexao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conexao/new.html.twig', [
            'conexao' => $conexao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conexao_show', methods: ['GET'])]
    public function show(Conexao $conexao): Response
    {
        return $this->render('conexao/show.html.twig', [
            'conexao' => $conexao,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conexao_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conexao $conexao, ConexaoRepository $conexaoRepository): Response
    {
        $form = $this->createForm(ConexaoType::class, $conexao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conexaoRepository->save($conexao, true);

            return $this->redirectToRoute('app_conexao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conexao/edit.html.twig', [
            'conexao' => $conexao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conexao_delete', methods: ['POST'])]
    public function delete(Request $request, Conexao $conexao, ConexaoRepository $conexaoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conexao->getId(), $request->request->get('_token'))) {
            $conexaoRepository->remove($conexao, true);
        }

        return $this->redirectToRoute('app_conexao_index', [], Response::HTTP_SEE_OTHER);
    }
}

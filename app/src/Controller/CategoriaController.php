<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use App\Service\CategoriaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/categoria')]
class CategoriaController extends AbstractController
{
    /** @var CategoriaService */
    private $svr;

    public function __construct(CategoriaService $svr)
    {
        $this->svr = $svr;
    }

    #[Route('/', name: 'app_categoria_index', methods: ['GET'])]
    public function index(CategoriaRepository $categoriaRepository)
    {
        $categoria = $this->svr->listCategoria();
       
        return $this->json($categoria); 
    }

    #[Route('/new', name: 'app_categoria_new', methods: ['POST'])]
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->svr->validateCategoria($data);

        $categoria = $this->svr->newCategoria($data);

        return $this->json($categoria);
        
    }

    #[Route('/{id}', name: 'app_categoria_show', methods: ['GET'])]
    public function show(Categoria $categoria): Response
    {
        return $this->render('categoria/show.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_categoria_edit', methods: ['PUT'])]
    public function edit(Request $request, $id): Response
    {
        //Só deveria ser possivel inativar uma Categoria sem ocorrências vinculadas
        $data = json_decode($request->getContent(), true);

        $this->svr->validateCategoria($data);

        $categoria = $this->svr->editCategoria($data, $id);

        return $this->json($categoria);
    }

    #[Route('/{id}', name: 'app_categoria_delete', methods: ['DELETE'])]
    public function delete($id): Response
    {
        //Deppois tenho que ver uma categoria não esta vinculada a algo para apagar
        $categoria = $this->svr->deleteCategoria($id);

        return $this->json($categoria);
    }
}

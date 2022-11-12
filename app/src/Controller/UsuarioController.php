<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use App\Service\UsuarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monitor/usuario')]
class UsuarioController extends AbstractController
{
    /** @var UsuarioService */
    private $svr;

    public function __construct(UsuarioService $svr)
    {
        $this->svr = $svr;
    }

    #[Route('/', name: 'app_usuario_index', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository)
    {
        $usuario = $this->svr->listUsuario();
       
        return $this->json($usuario); 
    }

    #[Route('/new', name: 'app_usuario_new', methods: ['POST'])]
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $this->svr->validateUsuario($data);

        $usuario = $this->svr->newUsuario($data);

        return $this->json($usuario);
        
    }

    #[Route('/{id}', name: 'app_usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_usuario_edit', methods: ['PUT'])]
    public function edit(Request $request, $id): Response
    {
        //Só deveria ser possivel inativar uma Usuario sem ocorrências vinculadas
        $data = json_decode($request->getContent(), true);

        $this->svr->validateUsuario($data);

        $usuario = $this->svr->editUsuario($data, $id);

        return $this->json($usuario);
    }

    #[Route('/{id}', name: 'app_usuario_delete', methods: ['DELETE'])]
    public function delete($id): Response
    {
        //Deppois tenho que ver uma usuario não esta vinculada a algo para apagar
        $usuario = $this->svr->deleteUsuario($id);

        return $this->json($usuario);
    }
}

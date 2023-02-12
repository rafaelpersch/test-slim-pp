<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repository\TarefaRepository;
use Slim\Views\Twig;

class TarefaController {
    private TarefaRepository $tarefaRepository;

    function __construct() {
        $db = \App\Tools\ConnectionDatabase::getInstance();
        $this->tarefaRepository = new TarefaRepository($db);
    }    

    public function index(Request $request, Response $response, $args) {   
        $view = Twig::fromRequest($request);

        $tarefas = $this->tarefaRepository->selectAll();

        return $view->render($response, 'index.html', [
            'tarefas' => $tarefas
        ]);
    }

    public function delete(Request $request, Response $response, $args) {   
        $response->getBody()->write("delete!");
        return $response;
    }    

    public function save(Request $request, Response $response, $args) {   
        $response->getBody()->write("save!");
        return $response;
    }  
}
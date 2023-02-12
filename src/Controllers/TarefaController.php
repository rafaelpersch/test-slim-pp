<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repository\TarefaRepository;
use App\Models\Tarefa;
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

    public function register(Request $request, Response $response, $args) {   
        $view = Twig::fromRequest($request);
        return $view->render($response, 'form.html');
    }

    public function delete(Request $request, Response $response, $args) {   
        $this->tarefaRepository->delete(intval($args['id']));
        return $response->withHeader('Location', '/tarefa/index')->withStatus(302);
    }    

    public function save(Request $request, Response $response, $args) {   
        $parsedBody = $request->getParsedBody();

        $tarefa = new Tarefa();
        $tarefa->id = intval($parsedBody['id']);
        $tarefa->descricao = $parsedBody['descricao'];
        $tarefa->observacao =  $parsedBody['observacao'];

        if ($tarefa->id > 0){
            $this->tarefaRepository->update($tarefa);
        }else{
            $this->tarefaRepository->insert($tarefa);
        }

        return $response->withHeader('Location', '/tarefa/index')->withStatus(302);
    }  
}
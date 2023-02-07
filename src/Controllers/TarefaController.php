<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repository\TarefaRepository;

class TarefaController {
    private TarefaRepository $tarefaRepository;

    function __construct() {
        $this->tarefaRepository = new TarefaRepository(\App\Tools\ConnectionDatabase::getInstance());
    }    

    public function index(Request $request, Response $response, $args) {   
        $response->getBody()->write(json_encode($this->tarefaRepository->selectAll()));
        return $response;
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
<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

class TarefaController {
    public function teste(Request $request, Response $response, $args) {   
        var_dump($args);
        $response->getBody()->write("Hello world TEste teste!");
        return $response;
    }

    public function get(Request $request, Response $response, $args) {   
        var_dump($args['id']);
        $response->getBody()->write("Hello world TEste get!");
        return $response;
    }    
}
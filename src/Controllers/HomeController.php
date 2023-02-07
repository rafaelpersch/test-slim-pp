<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController {

    function __construct() {
    }   

    public function index(Request $request, Response $response, $args) {   
        $response->getBody()->write("index!");
        return $response;
    }

    public function login(Request $request, Response $response, $args) {   
        $response->getBody()->write("login!");
        return $response;
    }    

    public function logoff(Request $request, Response $response, $args) {   
        $response->getBody()->write("logoff!");
        return $response;
    }    
}
<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config.php';

// Create App   
$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../Templates');

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/tarefa/index', '\App\Controllers\TarefaController:index');
$app->get('/tarefa/register', '\App\Controllers\TarefaController:register');
$app->get('/tarefa/delete/{id}', '\App\Controllers\TarefaController:delete');
$app->post('/tarefa/save', '\App\Controllers\TarefaController:save');

$app->run();
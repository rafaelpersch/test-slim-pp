<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {

    /*$tarefa = new \App\Models\Tarefa();
    $tarefa->id = 10;
    $tarefa->descricao = 'nome';
    $tarefa->observacao = 'obs de boas';*/

    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/teste', function (Request $request, Response $response, $args) {
    //$tarefa = new App\Models\Tarefa();
    //$ddd = new App\Repository\TarefaRepository();
    $db = \App\Tools\ConnectionDatabase::getInstance();

    /*$repo = new \App\Repository\TarefaRepository($db);

	$tarefa = new App\Models\Tarefa();
	$tarefa->id = 9;
	$tarefa->descricao = '1231331';
	$tarefa->observacao = 'OBSSSSzzzzzzzzzzzzzzzzzzzzzzzzzzSSSSSSSSSS';
	$repo->update($tarefa);

	$repo->delete(9);

	var_dump($repo->selectAll());*/

    $response->getBody()->write('WEEEEEEEEEEEEEEEE');

    return $response;
});

$app->run();
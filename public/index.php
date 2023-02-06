<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/teste', function (Request $request, Response $response, $args) {
    $db = \App\Tools\ConnectionDatabase::getInstance();

    /*$repo = new \App\Repository\TarefaRepository($db);

	$tarefa = new App\Models\Tarefa();
	$tarefa->id = 9;
	$tarefa->descricao = '1231331';
	$tarefa->observacao = 'OBSSSSzzzzzzzzzzzzzzzzzzzzzzzzzzSSSSSSSSSS';
	$repo->insert($tarefa);

	var_dump($repo->selectAll());*/

    $repoUser = new \App\Repository\UsuarioRepository($db);

    var_dump($repoUser->auth("teste@teste.com", "haha"));

    var_dump($repoUser->auth("admin@admin.com", base64_encode("admin@admin.com"."&"."@dm1n")));

    $response->getBody()->write('WEEEEEEEEEEEEEEEE');

    return $response;
});

$app->get('/tarefa', '\App\Controllers\TarefaController:teste');
$app->get('/tarefa/get/{id}', '\App\Controllers\TarefaController:get');

$app->run();
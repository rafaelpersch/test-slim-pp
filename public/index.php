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

    $repo = new \App\Repository\TarefaRepository($db);

    $response->getBody()->write(var_dump($repo->teste()));

    return $response;
});

$app->run();

/*
	function buscarPorGrauDeRisco($cdrequerimento, $base){
		$sql = "SELECT c.cdcarga, v.nmvariavelentrada
				FROM ".$base.".w3i_pc_cer_requerimentoocupacaocnae AS oc
				INNER JOIN ".$base.".w3i_pc_cer_ocupacaocnae AS c ON (c.cdocupacao=oc.cdocupacao)
				INNER JOIN ".$base.".w3i_pc_pci_variavelentrada AS v ON (v.cdvariavelentrada=c.cdcarga)				
				WHERE oc.cdrequerimento = :cdrequerimento 
				ORDER BY c.cdcarga DESC ";

	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":cdrequerimento", $cdrequerimento);
	    $stmt->execute();

	    if($stmt->rowCount() > 0){
	    	$row  = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$model = new W3iPcCerRequerimentoOcupacaoCnaeModel();
			$model->cdcarga = $row['cdcarga'];
			$model->nmvariavelentrada = $row['nmvariavelentrada'];

			return $model;
	    }

		return null;
	}

	function inserir(W3iPcCerRequerimentoOcupacaoCnaeModel $model){
		$sql = "INSERT INTO w3i_pc_cer_requerimentoocupacaocnae 
                    (cdrequerimento, cdocupacao) 
                VALUES 
                    (:cdrequerimento, :cdocupacao);";

	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(':cdrequerimento', $model->cdrequerimento);
        $stmt->bindValue(':cdocupacao', $model->cdocupacao);
	    $stmt->execute();	
	}

*/    
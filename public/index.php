<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_USER", "root");
define("DB_SENHA", "root@123");

require __DIR__ . '/../vendor/autoload.php';

class ConnectionDB {
   
    public static $instance;
   
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_SENHA, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }
}

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/teste', function (Request $request, Response $response, $args) {

    $db = ConnectionDB::getInstance();

    $sql = "SELECT id, name, age FROM table_teste";

    $stmt = $db->prepare($sql);
    //$stmt->bindValue(":cdrequerimento", $cdrequerimento);
    $stmt->execute();

    $lista = array();

    if($stmt->rowCount() > 0){
        $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $model = array();
            array_push($model, $row['id']);
            array_push($model, $row['name']);
            array_push($model, $row['age']);

            array_push($lista, $model);
        }			
    }

    $response->getBody()->write(var_dump($lista));

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
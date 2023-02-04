<?php

declare(strict_types=1);

namespace App\Repository;

use \PDO;

class TarefaRepository {
    private PDO $db;

    function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function teste() : array{
        $sql = "SELECT id, name, age FROM table_teste";

        $stmt = $this->db->prepare($sql);
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

        return $lista;
    }
}
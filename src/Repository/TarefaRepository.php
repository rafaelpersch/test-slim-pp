<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Models\Tarefa;

class TarefaRepository {
    private PDO $db;

    function __construct(PDO $db) {
        $this->db = $db;
    }

    public function insert(Tarefa $tarefa) : Tarefa{
		$sql = "INSERT INTO tarefas 
                    (descricao, observacao) 
                VALUES 
                    (:descricao, :observacao);";

	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(':descricao', $tarefa->descricao);
        $stmt->bindValue(':observacao', $tarefa->observacao);
	    $stmt->execute();
        $tarefa->id = intval($this->db->lastInsertId());
        return $tarefa;
    }

    public function update(Tarefa $tarefa) : Tarefa{
		$sql = "UPDATE tarefas SET descricao = :descricao , observacao = :observacao WHERE id = :id ";

	    $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $tarefa->id);
	    $stmt->bindValue(':descricao', $tarefa->descricao);
        $stmt->bindValue(':observacao', $tarefa->observacao);
	    $stmt->execute();
        return $tarefa;
    }

    public function delete(int $id) : void{
		$sql = "DELETE FROM tarefas WHERE id = :id ";

	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(':id', $id);
	    $stmt->execute();
    }

    public function select(int $id) : ?Tarefa {
        $sql = "SELECT id, descricao, observacao FROM tarefas WHERE id = :id ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $model = new Tarefa();
                $model->id = intval($row['id']);
                $model->descricao = $row['descricao'];
                $model->observacao = $row['observacao'];

                return $model;
            }			
        }

        return null;
    }

    public function selectAll() : array {
        $lista = array();

        $sql = "SELECT id, descricao, observacao FROM tarefas";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $model = new Tarefa();
                $model->id = intval($row['id']);
                $model->descricao = $row['descricao'];
                $model->observacao = $row['observacao'];

                array_push($lista, $model);
            }			
        }

        return $lista;
    }
}
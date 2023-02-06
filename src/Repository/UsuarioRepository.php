<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Models\Usuario;

class UsuarioRepository {
    private PDO $db;

    function __construct(PDO $db) {
        $this->db = $db;
    }

    public function auth(string $email, string $senha) : ?Usuario {
        $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $model = new Usuario();
                $model->id = intval($row['id']);
                $model->nome = $row['nome'];
                $model->email = $row['email'];
                $model->senha = '';

                return $model;
            }			
        }

        return null;
    }
}
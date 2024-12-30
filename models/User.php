<?php

class User {

    private $pdo;

    public function __construct(Database $driver) {
        $this->pdo = $driver->getPdo();
    }

    public function create($nome, $email, $senha) {
        $sql = $this->pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
        $sql->execute([$nome, $email, $senha]);
    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);

        if($sql->rowCount() > 0) {
            $data = $sql->fetch( PDO::FETCH_ASSOC );
            return $data;
        } else {
            return false;
        }
    }

    public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$id]);

        if($sql->rowCount() > 0) {
            $data = $sql->fetch( PDO::FETCH_ASSOC );
            return $data;
        } else {
            return false;
        }
    }
}
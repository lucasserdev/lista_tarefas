<?php

class Tarefa {

    private $id;
    private $corpo;
    private $status;
    private $user_id;
    private $pdo;

    public function __construct(Database $driver) {
        $this->pdo = $driver->getPdo();
    }

    public function create($corpo, $userId) {
        $sql = $this->pdo->prepare("INSERT INTO tarefas (corpo, user_id) VALUES (?, ?)");
        $sql->execute([$corpo, $userId]);
    }

    public function findByUserId($userId) {
        $sql = $this->pdo->prepare("SELECT * FROM tarefas WHERE user_id = ?");
        $sql->execute([$userId]);

        if($sql->rowCount() > 0 ) {
            $data = $sql->fetchAll( PDO::FETCH_ASSOC );
            return $data;
        } else {
            return false;
        }
    }

    public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM tarefas WHERE id = ?");
        $sql->execute([$id]);

        if($sql->rowCount() > 0) {
           $data = $sql->fetch( PDO::FETCH_ASSOC );
           return $data;
        } else {
            return false;
        }
    }

    public function getStatus($id) {
        $sql = $this->pdo->prepare("SELECT * FROM tarefas WHERE id = ?");
        $sql->execute([$id]);

        if($sql->rowCount() > 0) {
            $data = $sql->fetch( PDO::FETCH_ASSOC );
            return $data;
        } else {
            return false;
        }
    }

    public function editStatus($status, $id) {
        $sql = $this->pdo->prepare("UPDATE tarefas set status = ? WHERE id = ?");
        $sql->execute([$status, $id]);
    }

    public function edit($corpo, $id) {
        $sql = $this->pdo->prepare("UPDATE tarefas SET corpo = ? WHERE id = ?");
        $sql->execute([$corpo, $id]);
    }

    public function del($id) {
        $sql = $this->pdo->prepare("DELETE FROM tarefas WHERE id = ?");
        $sql->execute([$id]);
    }
}
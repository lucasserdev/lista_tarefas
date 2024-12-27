<?php

class Database {
    
    private $db_name = 'lista_tarefa';
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = '';
    private $dsn;
    private $pdo;

    public function __construct() {
        $this->dsn = "mysql:dbname={$this->db_name};host={$this->db_host}";
        
        try {
            $this->pdo = new PDO($this->dsn, $this->db_user, $this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Erro ao tentar se conectar ao banco de dados: ') . $e->getMessage();
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}

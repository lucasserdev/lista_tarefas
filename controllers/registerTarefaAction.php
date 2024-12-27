<?php
session_start();
require '../config/Database.php';
require '../models/Tarefa.php';

$db = new Database();
$tarefa = new Tarefa($db);

$corpo = filter_input(INPUT_POST, 'body');
$userId = filter_input(INPUT_POST, 'id');

if($corpo && $userId) {
    $tarefa->create($corpo, $userId);
    header("Location: ../public/index.php");
    exit;

} else {
    $_SESSION['tarefaError'] = 'Preencha todos os campos!';
    header("Location: ../public/index.php");
    exit;
}
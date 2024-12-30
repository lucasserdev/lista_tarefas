<?php
session_start();
require_once '../config/Database.php';
require_once '../models/Tarefa.php';


$db = new Database();
$tarefa = new Tarefa($db);

$id = filter_input(INPUT_GET, 'id');
$corpo = filter_input(INPUT_POST, 'edit_corpo');

if($id && $corpo) {
    $tarefa->edit($corpo, $id);
    header("Location: ../public/index.php");
    exit;
}
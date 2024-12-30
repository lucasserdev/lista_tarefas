<?php
require_once '../config/Database.php';
require_once '../models/Tarefa.php';

$db = new Database();
$tarefa = new Tarefa($db);
$info = false;

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $info = $tarefa->getStatus($id);
    
    $status = $info['status'];
    $newStatus = null;
    
    if($status === 'pendente') {
        $newStatus = 'concluido';
    } else {
        $newStatus = 'pendente';
    }

    $tarefa->editStatus($newStatus, $id);

    header("Location: ../public/index.php");
    exit;
}
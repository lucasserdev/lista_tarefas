<?php

require '../config/Database.php';
require '../models/Tarefa.php';

$id = filter_input(INPUT_GET, 'id');

$db = new Database();
$tarefa = new Tarefa($db);

$tarefa->del($id);

header("Location: ../public/index.php");
exit;
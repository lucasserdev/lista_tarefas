<?php
session_start();
require '../config/Database.php';
require '../models/User.php';

$db = new Database();
$user = new User($db);

$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'pass');

$verifica = '';

if($email && $senha) {

    $verifica = $user->findByEmail($email);
    
    if(password_verify($senha, $verifica['senha']) && $email === $verifica['email']) {
        $_SESSION['userId'] = $verifica['id'];
        header("Location: ../public/index.php");
        exit;
    } else {
        $_SESSION['error'] = 'Dados incorretos';
        header("Location: ../views/auth/login.php");
    }
} else {
    $_SESSION['error_login'] = 'Preencha os campos';
    header("Location: ../views/auth/login.php");
    exit;
}

<?php
session_start();
require_once '../config/Database.php';
require_once '../models/User.php';

$db = new Database();
$user = new User($db);


$nome = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'pass');
$confirmSenha = filter_input(INPUT_POST, 'confirm');
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$verificarEmail = false;

if($confirmSenha !== $senha) {
    $_SESSION['error_senha'] = 'Digite a senha corretamente!';
    header("Location: ../views/auth/register.php");
    exit;
} else {
    if($nome && $email && $senha && $confirmSenha) {

        $verificarEmail = $user->findByEmail($email);
        if($verificarEmail === false) {
            $user->create($nome, $email, $senhaHash);
            $_SESSION['success'] = 'Cadastro criado com sucesso!';
            header("Location: ../views/auth/login.php");
            exit;
        } else {
            $_SESSION['ja_existe'] = 'Esse email já existe';
            header("Location: ../views/auth/register.php");
            exit;
        }
        
    } else {
        $_SESSION['error_register'] = 'Preencha todos os campos';
        header("Location: ../views/auth/register.php");
        exit;
    }
}


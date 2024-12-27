<?php
session_start();
require '../includes/header.php';

$success = '';
if(!empty($_SESSION['success'])) {
    $success = $_SESSION['success'];
    $_SESSION['success'] = '';
}

$error = '';
if(!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $_SESSION['error'] = '';
}

$error_login = '';
if(!empty($_SESSION['error_login'])) {
    $error = $_SESSION['error_login'];
    $_SESSION['error_login'] = '';
}
?>

<h2>Página de login</h2>


<div class="container-register">
    <form action="../../controllers/loginAction.php" method="post">
        <?php if($success): ?>
            <p><?= $success; ?></p>
        <?php elseif($error): ?>
            <p><?= $error; ?></p>
        <?php elseif($error_login): ?>
            <p><?= $error_login; ?></p>
        <?php endif; ?>
        <label for="">
            Email: <br>
            <input type="text" name="email" id=""> <br> <br>
        </label>
    
        <label for="">
            Senha: <br>
            <input type="password" name="pass" id=""> <br> <br>
        </label>

        <a href="register.php">Cadastre-se</a>
    
        <input type="submit" value="Entrar">
    </form>
</div>

<?php require '../includes/footer.php'; ?>
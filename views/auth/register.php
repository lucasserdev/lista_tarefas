<?php
session_start();
require '../includes/header.php';

$error_senha = '';
if(!empty($_SESSION['error_senha'])) {
    $error_senha = $_SESSION['error_senha'];
    $_SESSION['error_senha'] = '';
}

$error_register = '';
if(!empty($_SESSION['error_register'])) {
    $error_register = $_SESSION['error_register'];
    $_SESSION['error_register'] = '';
}

$ja_existe = '';
if(!empty($_SESSION['ja_existe'])) {
    $ja_existe = $_SESSION['ja_existe'];
    $_SESSION['ja_existe'] = '';
}

?>


<h2>Página de registro</h2>
<a href="login.php">Aréa de login</a>

<div class="container-register">
    <form action="../../controllers/registerAction.php" method="post">
        <?php if($error_senha): ?>
            <p><?= $error_senha; ?></p>
        <?php elseif($error_register): ?>
            <p><?= $error_register; ?></p>
        <?php elseif($ja_existe): ?>
            <p><?= $ja_existe; ?></p>
        <?php endif; ?>
        <label for="">
            Nome: <br>
            <input type="text" name="name" id=""> <br> <br>
        </label>
    
        <label for="">
            Email: <br>
            <input type="email" name="email" id=""> <br> <br>
        </label>
    
        <label for="">
            Senha: <br>
            <input type="password" name="pass" id=""> <br> <br>
        </label>
    
        <label for="">
            Confirmar senha: <br>
            <input type="password" name="confirm" id=""> <br> <br>
        </label>
    
        <input type="submit" value="Cadastrar">
    </form>
</div>



<?php require '../includes/footer.php'; ?>
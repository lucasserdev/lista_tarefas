<?php
session_start();
require '../config/Database.php';
require '../models/User.php';
require '../models/Tarefa.php';

if(empty($_SESSION['userId'])) {
    header("Location: ../views/auth/login.php");
    exit;
} else {
    $userId = $_SESSION['userId'];
}

$tarefaError = '';

if(!empty($_SESSION['tarefaError'])) {
    $tarefaError = $_SESSION['tarefaError'];
    $_SESSION['tarefaError'] = '';
}

$db = new Database();
$user = new User($db);
$tarefa = new Tarefa($db);

$getUser = $user->findById($userId);
$getTarefa = $tarefa->findByUserId($userId);

?>

<?php require '../views/includes/header.php'; ?>

<h3>Seja bem vindo <?= $getUser['nome']; ?></h3>

<a href="../controllers/exit.php">Sair</a>

<form action="../controllers/registerTarefaAction.php" method="post">

    <p><?= $tarefaError; ?></p>

    <input type="hidden" name="id" value="<?= $userId; ?>">

    <label for="">
        Adicionar tarefa <br>
        <textarea name="body" id=""></textarea> <br> <br>
    </label>

    <input type="submit" value="Adicionar">

</form>

<h2>Suas tarefas</h2>

<?php if($getTarefa): ?>
    <?php foreach($getTarefa as $atv): ?>
        <div class="posts" style="padding: 10px; box-shadow: 1px 1px 1px 1px black; margin-bottom: 5px">
            <span><?= $atv['status']; ?></span>
            <span><?= $atv['corpo']; ?></span>
            <span>
                <a href="../controllers/editTarefaAction.php?id=<?= $atv['id']; ?>">[ editar ]</a>
                <a href="../controllers/delTarefaAction.php?id=<?= $atv['id']; ?>" onclick="return confirm('Deseja exluir?'); ">[ excluir ]</a>
            </span>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Usuario sem tarefas, cadastre a sua primeira!</p>
<?php endif; ?>


<?php require '../views/includes/footer.php'; ?>
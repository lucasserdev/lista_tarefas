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

$teste = $user->findById($userId);

$getUser = $user->findById($userId);
$getTarefa = $tarefa->findByUserId($userId);

?>

<?php require '../views/includes/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">
<script src="assets/js/script.js" defer async></script>
<script src="https://kit.fontawesome.com/468f44bb2c.js" crossorigin="anonymous"></script>

<h3>Seja bem vindo <?= trim(ucfirst($getUser['nome'])); ?></h3>


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
        <div class="posts" style="display: flex; justify-content: space-between; padding: 10px; box-shadow: 1px 1px 1px 1px black; margin-bottom: 5px;">
            <span>
                <?php if($atv['status'] === 'pendente'): ?>
                    <a href="../controllers/statusAction.php?id=<?= $atv['id']; ?>">
                        <i style="cursor: pointer;" class="fa-regular fa-square"></i>
                    </a>
                <?php elseif($atv['status'] === 'concluido'): ?>
                    <a href="../controllers/statusAction.php?id=<?= $atv['id']; ?>">
                        <i style="cursor: pointer;" class="fa-solid fa-square-check"></i>
                    </a>
                <?php endif; ?>
            </span>
            <span style="display: flex;">
                <span id="corpo_<?= $atv['id']; ?>"><?= $atv['corpo']; ?></span>
                <form class="inputCorpo" action="../controllers/editTarefaAction.php?id=<?= $atv['id']; ?>" method="post" id="inputCorpo_<?= $atv['id']; ?>">
                    <input style="outline: 0; border: none; border-bottom: 1px solid black; padding: 5px;" type="text" name="edit_corpo" value="<?= $atv['corpo']; ?>">

                    <input type="submit" value="Enviar">
                </form>
            </span>
            <span>
                <a href="#" data-id="<?= $atv['id']; ?>" class="edit" style="margin-right: 5px;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="../controllers/delTarefaAction.php?id=<?= $atv['id']; ?>" onclick="return confirm('Deseja exluir?'); ">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </span>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Usuario sem tarefas, cadastre a sua primeira!</p>
<?php endif; ?>


<?php require '../views/includes/footer.php'; ?>
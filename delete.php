<?php
require 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = (int)$_GET['id'];

/* Opcional: confirmar antes de excluir */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Usuário confirmou a exclusão
    $stmt = $mysqli->prepare("DELETE FROM pessoas WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
    exit;
}

/* Busca o registro apenas para exibir o nome (confirmação) */
$stmt = $mysqli->prepare("SELECT nome FROM pessoas WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($nome);
if (!$stmt->fetch()) {
    $stmt->close();
    header('Location: index.php');
    exit;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Pessoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Excluir Pessoa</h1>

<p>Tem certeza que deseja excluir a pessoa <strong><?= htmlspecialchars($nome); ?></strong> (ID <?= $id; ?>)?</p>

<form method="post" action="">
    <button type="submit" class="btn btn-danger">Sim, excluir</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
</body>
</html>
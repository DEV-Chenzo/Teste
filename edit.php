<?php
require 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = (int)$_GET['id'];

$erro = '';
$nome = $email = $telefone = '';

// Busca o registro para preencher o formulário
$stmt = $mysqli->prepare("SELECT nome, email, telefone FROM pessoas WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($nome, $email, $telefone);
if (!$stmt->fetch()) {
    // Não encontrou
    $stmt->close();
    header('Location: index.php');
    exit;
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os novos valores
    $nome     = trim($_POST['nome']);
    $email    = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    // Validação
    if (empty($nome) || empty($email)) {
        $erro = 'Nome e e‑mail são obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E‑mail inválido.';
    } else {
        // Atualiza
        $stmt = $mysqli->prepare("UPDATE pessoas SET nome = ?, email = ?, telefone = ? WHERE id = ?");
        $stmt->bind_param('sssi', $nome, $email, $telefone, $id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            $erro = 'Erro ao atualizar: ' . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Editar Pessoa (ID <?= $id; ?>)</h1>

<?php if ($erro): ?>
    <p class="error"><?= htmlspecialchars($erro); ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Nome:<br>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome); ?>" required>
    </label><br><br>

    <label>E‑mail:<br>
        <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
    </label><br><br>

    <label>Telefone:<br>
        <input type="text" name="telefone" value="<?= htmlspecialchars($telefone); ?>">
    </label><br><br>

    <button type="submit" class="btn">Salvar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
</body>
</html>
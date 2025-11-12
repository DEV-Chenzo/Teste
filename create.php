<?php
require 'config.php';

$erro = '';
$nome = $email = $telefone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e sanitiza os dados
    $nome     = trim($_POST['nome']);
    $email    = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    // Validação simples
    if (empty($nome) || empty($email)) {
        $erro = 'Nome e e‑mail são obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E‑mail inválido.';
    } else {
        // Insere usando prepared statement
        $stmt = $mysqli->prepare("INSERT INTO pessoas (nome, email, telefone) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nome, $email, $telefone);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            $erro = 'Erro ao salvar: ' . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Pessoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Nova Pessoa</h1>

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
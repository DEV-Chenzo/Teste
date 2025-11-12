<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    if ($nome && $email) {
        $stmt = $pdo->prepare("INSERT INTO users (nome, email) VALUES (?, ?)");
        if ($stmt->execute([$nome, $email])) {
            header("Location: index.php");
            exit;
        } else {
            $erro = "Erro ao salvar o usuário.";
        }
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Usuário</h1>

    <?php if (!empty($erro)): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <button type="submit">Salvar</button>
    </form>

    <br>
    <a href="index.php">⬅️ Voltar</a>
</body>
</html>

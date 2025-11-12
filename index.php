<?php
include 'db.php';
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Simples com PDO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>
    <a href="create.php" class="botao">➕ Novo Usuário</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['nome']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="update.php?id=<?= $user['id'] ?>">✏️ Editar</a> |
                <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">🗑️ Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

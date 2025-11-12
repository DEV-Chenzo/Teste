<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Simples em PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>
    <a href="create.php">➕ Adicionar Usuário</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="update.php?id=<?= $row['id'] ?>">✏️ Editar</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">🗑️ Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

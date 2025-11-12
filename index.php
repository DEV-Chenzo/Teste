<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD PHP – Lista de Pessoas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Lista de Pessoas</h1>

<p><a href="create.php" class="btn">+ Nova Pessoa</a></p>

<?php
/* Busca todos os registros */
$sql = "SELECT * FROM pessoas ORDER BY id DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0): ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E‑mail</th>
            <th>Telefone</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['nome']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['telefone']); ?></td>
                <td><?= $row['criado_em']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn">Editar</a>
                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger"
                       onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum registro encontrado.</p>
<?php endif; ?>

</body>
</html>
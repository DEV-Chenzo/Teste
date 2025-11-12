<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $conn->query("UPDATE users SET nome='$nome', email='$email' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $user['nome'] ?>" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>
        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="index.php">⬅️ Voltar</a>
</body>
</html>

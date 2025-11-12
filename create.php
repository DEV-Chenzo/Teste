<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO users (nome, email) VALUES ('$nome', '$email')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Usuário</h1>
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

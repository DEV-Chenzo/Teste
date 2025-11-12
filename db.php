<?php
$host = 'sql208.infinityfree.com';
$dbname = 'if0_40402164';
$username = 'hnoVA64NVi7f';
$password = 'crud_project';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
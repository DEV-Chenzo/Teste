<?php
/* config.php – informações de conexão ao MySQL */

$host     = ' sql208.infinityfree.com ';      // ou IP do servidor de BD
$user     = 'if0_40402164';           // usuário do MySQL
$password = 'hnoVA64NVi7f';               // senha do usuário
$dbName   = 'crud_project';      // nome da base criada acima

/* Cria a conexão usando mysqli */
$mysqli = new mysqli($host, $user, $password, $dbName);

/* Verifica se ocorreu erro na conexão */
if ($mysqli->connect_error) {
    die('Falha na conexão: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

/* Define o charset para evitar problemas de acentuação */
$mysqli->set_charset('utf8mb4');
?>
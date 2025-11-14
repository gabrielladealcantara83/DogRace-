<?php
$servername = "localhost"; 
$username = "root"; // ou o seu usuário
$password = "root"; // sua senha, se houver
$database = "dograce"; // nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>

<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar_password'];

    if ($password !== $confirmar) {
        session_start();
        $_SESSION['message'] = "As senhas não coincidem!";
        $_SESSION['message_type'] = "danger";
        header("Location: registro.php");
        exit();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $hash);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['message'] = "Cadastro realizado com sucesso! Faça login.";
        $_SESSION['message_type'] = "primary";
        header("Location: login.php");
        exit();
    } else {
        session_start();
        $_SESSION['message'] = "Erro ao cadastrar: " . $conn->error;
        $_SESSION['message_type'] = "danger";
        header("Location: registro.php");
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>

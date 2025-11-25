<?php
require_once 'conexao.php'; // arquivo que tem a variável $conn

// --- DEBUG opcional: pra garantir que está conectando ---
if (!$conn) {
    die("❌ Erro de conexão com o banco: " . mysqli_connect_error());
} else {
}

// --- Verifica se veio via POST ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // --- Captura os dados enviados pelo formulário ---
    $nome = $_POST['nome'] ?? '';
    $cachorro_id = isset($_POST['cachorro_id']) ? (int) $_POST['cachorro_id'] : 0;
    session_start();
$usuario_id = $_SESSION['id'] ?? 0;
    $data_adocao = $_POST['data_adocao'] ?? date('Y-m-d');
    $status = $_POST['status'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    $numero_id = $_POST['numero_id'] ?? '';
    


    // --- DEBUG: Mostra os dados recebidos ---

    // --- Prepara o INSERT ---
    $sql = "INSERT INTO adocoes
            (nome, cachorro_id, usuario_id, data_adocao, status, observacoes, numero_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ Erro ao preparar SQL: " . $conn->error);
    }

$stmt->bind_param(
    "siissss",
    $nome,
    $cachorro_id,
    $usuario_id,
    $data_adocao,
    $status,
    $observacoes,
    $numero_id
);
    // --- Executa o INSERT ---
    if ($stmt->execute()) {
        echo "Adoção feita! Entraremos em contato com você logo logo.";
    } else {
        echo "<h3 style='color:red;'>❌ Erro ao adotar: " . $stmt->error . "</h3>";
    }

    $stmt->close();
} else {
    echo "⚠️ Acesso inválido — use o formulário.";
}

$conn->close();

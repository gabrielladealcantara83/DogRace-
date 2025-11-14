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
    $nome_dono = $_POST['nome_dono'] ?? '';
    $equipe = $_POST['equipe'] ?? '';
    $email = $_POST['email'] ?? '';
    $nome_cachorro = $_POST['nome_cachorro'] ?? '';
    $raca = $_POST['raca'] ?? '';
    $idade = $_POST['idade'] ?? '';
    $categoria = $_POST['categoria_inscricao'] ?? '';
    $experiencia = $_POST['experiencia'] ?? '';
    $comportamento = $_POST['comportamento'] ?? '';
    $data_inscricao = $_POST['data_inscricao'] ?? date('Y-m-d');

    // --- DEBUG: Mostra os dados recebidos ---

    // --- Prepara o INSERT ---
    $sql = "INSERT INTO inscricoes_corrida 
            (nome_dono, equipe, email, nome_cachorro, raca, idade, categoria, experiencia, comportamento, data_inscricao)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ Erro ao preparar SQL: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssisssss",
        $nome_dono,
        $equipe,
        $email,
        $nome_cachorro,
        $raca,
        $idade,
        $categoria,
        $experiencia,
        $comportamento,
        $data_inscricao
    );

    // --- Executa o INSERT ---
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>✅ Inscrição salva com sucesso!";
    } else {
        echo "<h3 style='color:red;'>❌ Erro ao salvar: " . $stmt->error . "</h3>";
    }

    $stmt->close();
} else {
    echo "⚠️ Acesso inválido — use o formulário.";
}

$conn->close();

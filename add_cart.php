<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
// Pega o ID do produto via GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Se o ID for válido
if ($id > 0) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Se o produto já estiver no carrinho, aumenta a quantidade
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// ⚠️ Retorna o número total de itens para atualizar o contador
echo array_sum($_SESSION['cart']);

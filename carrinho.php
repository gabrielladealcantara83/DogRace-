<?php
session_start();
require_once 'conexao.php'; // já tem a conexão ativa ($conn)

// Verifica login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// --- REMOVER ITEM ---
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("location: carrinho.php");
    exit;
}

// --- ATUALIZAR QUANTIDADE ---
if (isset($_POST['update'])) {
    foreach ($_POST['qtd'] as $id => $qtd) {
        if ($qtd > 0) {
            $_SESSION['cart'][$id] = intval($qtd);
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("location: carrinho.php");
    exit;
}

// --- BUSCAR PRODUTOS DO CARRINHO ---
$produtos = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";
    $res = $conn->query($sql);

    if ($res && $res->num_rows > 0) {
        while ($p = $res->fetch_assoc()) {
            $id = $p['id'];
            $p['qtd'] = $_SESSION['cart'][$id];
            $p['subtotal'] = $p['qtd'] * $p['preco'];
            $produtos[] = $p;
            $total += $p['subtotal'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>DogRace - Carrinho</title>
    <style>
        /* SEU CSS ORIGINAL (mantido 100%) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #F8F8F8;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 24px;
    font-weight: bold;
    color: #D32F2F;
        }

        .logo span {
            color: #D2691E;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        nav ul li a:hover {
            color: #D32F2F;
        }

        .cart-count {
            background: #D32F2F;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
            margin-left: 5px;
        }

        .cart-title {
            text-align: center;
            margin: 40px 0;
            color: #D32F2F;
        }

        .cart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .cart-items {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .item img {
            width: 100px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info {
            flex: 1;
            margin-left: 15px;
        }

        .info h3 {
            margin-bottom: 5px;
        }

        .info p {
            margin: 5px 0;
        }

        .subtotal {
            font-weight: bold;
            color: #D32F2F;
        }

        .order-summary {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .summary-title {
            font-size: 18px;
            margin-bottom: 20px;
            color: #D32F2F;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
        }

        .checkout-btn {
            background: #D32F2F;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .checkout-btn:hover {
            background: #B71C1C;
        }
 footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }
        }
                .preview-nav {
            display: flex;
            justify-content: space-around;
            background: white;
            border-radius: 5px;
            margin-bottom: 10px;
        }
         .page-preview {
            width: 500%;
            max-width: 1850px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .browser-bar {
            background: #e0e0e0;
            padding: 10px;
            display: flex;
            align-items: center;
        }
          .browser-dots {
            display: flex;
            gap: 5px;
        }

        .browser-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .dot-red {
            background: #9C0707;
        }

        .dot-yellow {
            background: #D69854;
        }

        .dot-blue {
            background: #1E95B3;
        }

        .browser-url {
            flex: 1;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .page-content {
           padding: 5px;
    height: 100%;
    width: 1;
    overflow-y: auto;
        }

        .preview-title {
              text-align: center;
    margin-bottom: 20px;
    color: #D32F2F;

        }
                nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        nav ul li a:hover {
            color: #D32F2F;
        }
    </style>
</head>

<body>
     <div class="page-preview">
        <div class="browser-bar">
            <div class="browser-dots">
                <div class="browser-dot dot-red"></div>
                <div class="browser-dot dot-yellow"></div>
                <div class="browser-dot dot-blue"></div>
            </div>
            <div class="browser-url">petrace.com</div>
        </div>
            <div class="logo">Dog<span>Race</span></div>
            <div class="page-content"> 
            <h1 class="preview-title">Seu Carrinho de Compras</h1>
        <nav class="preview-nav">
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="carros.php">Carros</a></li>
                    <li><a href="roupas.php">Roupas</a></li>
                    <li><a href="adoção.php">Adoção</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registro.php">Registrar</a></li>
                    <li><a href="carrinho.php">🛒 <span class="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></span></a></li>
                </ul>
            </nav>
        </div>
        </nav>

        <form method="post">
            <div class="cart-container">
                <div class="cart-items">
                    <?php if (empty($produtos)): ?>
                        <p>Seu carrinho está vazio. <a href="index.php" style="color:#D32F2F;">Compre agora!</a></p>
                    <?php else: ?>
                        <?php foreach ($produtos as $item): ?>
                            <div class="item">
                                <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="Imagem do produto">
                                <div class="info">
                                    <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                                    <p>Preço: R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                                    <p>
                                        Quantidade:
                                        <input type="number" name="qtd[<?php echo $item['id']; ?>]" value="<?php echo $item['qtd']; ?>" min="1">
                                        <a href="?remove=<?php echo $item['id']; ?>" style="color:#D32F2F;">Remover</a>
                                    </p>
                                </div>
                                <div class="subtotal">R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($produtos)): ?>
                <div class="order-summary">
                    <h2 class="summary-title">Resumo do Pedido</h2>
                    <div class="summary-row">
                        <span>Subtotal (<?php echo array_sum(array_column($produtos, 'qtd')); ?> itens):</span>
                        <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Frete:</span>
                        <span>Grátis</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span>R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
                    </div>
                    <button class="checkout-btn" type="submit" name="update">Comprar</button>
                    <div style="text-align: center; margin-top: 15px;">
                             <a href="index.php" style="color: #D32F2F; text-decoration: none;">Continuar Comprando</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </form> 
    </div>

    <footer style="text-align:center; margin-top:40px;">
        <p>© 2023 PetRace - Todos os direitos reservados</p>
    </footer>
</body>
</html>

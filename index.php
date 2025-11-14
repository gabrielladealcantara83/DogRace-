<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetRace - Página Inicial</title>
    <style>
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

        .page-preview {
            width: 100%;
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

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #D32F2F;
            text-align: center;
            padding: 10px 0;
        }

        .logo span {
            color: #D2691E;
        }

        .preview-title {
            text-align: center;
            margin-bottom: 20px;
            color: #D32F2F;
        }

        .page-content {
            padding: 5px;
            overflow-y: auto;
        }

        /* === MENU CENTRALIZADO E RESPONSIVO === */
        .nav-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            position: relative;
        }

        .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            color: #333;
            position: absolute;
            left: 20px;
            top: 10px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            transition: all 0.3s ease;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: 0.2s;
        }

        nav ul li a:hover {
            color: #D32F2F;
        }

        .active-nav {
            background: #D32F2F;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
        }

        .cart-count {
            background: #D32F2F;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
        }

        /* === MENU RESPONSIVO (MOBILE) === */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-preview ul {
                display: none;
                flex-direction: column;
                background-color: white;
                position: absolute;
                top: 55px;
                left: 0;
                right: 0;
                padding: 10px 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                z-index: 100;
            }

            .nav-preview ul.active {
                display: flex;
            }

            .nav-preview ul li {
                margin: 10px 0;
                text-align: center;
            }
        }

        .hero-preview {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), #D32F2F;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .preview-section {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #D32F2F;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .product-preview {
            background: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .add-to-cart {
            background: #D32F2F;
            color: white;
            border: none;
            padding: 3px 10px;
            border-radius: 10px;
            cursor: pointer;
            width: 25%;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
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

        <nav class="nav-preview">
            <span class="menu-toggle" onclick="toggleMenu()">☰</span>
            <ul id="menu-list">
                <li><a class="active-nav" href="index.php">Início</a></li>
                <li><a href="carros.php">Carros</a></li>
                <li><a href="roupas.php">Roupas</a></li>
                <li><a href="adoção.php">Adoção</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="registro.php">Registrar</a></li>
                <li>
                    <a href="carrinho.php">
                        🛒
                        <span class="cart-count" id="cart-count">
                            <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="page-content">
            <h2 class="preview-title">Página Inicial - DogRace</h2>

            <div class="hero-preview">
                <h3>Corridas de Cachorros com Estilo</h3>
                <p>Equipe seu melhor amigo para competições emocionantes!</p>
                <a href="inscrição.php" style="margin-top: 15px; padding: 8px 15px; background: white; color: #D32F2F; display: inline-block; border-radius: 4px;">Inscreva seu Cachorro</a>
            </div>

            <div class="preview-section">
                <div class="section-title">Carros em Destaque</div>
                <div class="product-grid">
                    <div class="product-preview">
                        <img src="carrocorrida.png" alt="Carro de Corrida">
                        <div>Carro Corrida</div>
                        <div>R$ 299,90</div>
                        <a href="carros.php" class="add-to-cart">Ver</a>
                    </div>
                    <div class="product-preview">
                        <img src="carroesportivo.png" alt="Carro Esportivo">
                        <div>Carro Esportivo</div>
                        <div>R$ 349,90</div>
                        <a href="carros.php" class="add-to-cart">Ver</a>
                    </div>
                </div>
            </div>

            <div class="preview-section">
                <div class="section-title">Roupas em Destaque</div>
                <div class="product-grid">
                    <div class="product-preview">
                        <img src="azulmacacao.png" alt="Macacão de Piloto Azul">
                        <div>Macacão de Piloto Azul</div>
                        <div>R$ 89,90</div>
                        <a href="roupas.php" class="add-to-cart">Ver</a>
                    </div>
                    <div class="product-preview">
                        <img src="capacetevermelho.png" alt="Capacete de Piloto Vermelho">
                        <div>Capacete Vermelho</div>
                        <div>R$ 59,90</div>
                        <a href="roupas.php" class="add-to-cart">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2023 PetRace - Todos os direitos reservados</p>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('menu-list').classList.toggle('active');
        }
    </script>
</body>
</html>

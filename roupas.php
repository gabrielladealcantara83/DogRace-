<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DogRace - Roupas</title>
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

        .page-content {
            padding: 5px;
            height: auto;
            overflow-y: auto;
        }

        .preview-title {
            text-align: center;
            margin-bottom: 20px;
            color: #D2691E;
            padding-left: 10px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .product-preview {
            background: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-top: 3px solid #D2691E;
        }

        .product-image {
            height: 200px;
            background: #fff;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-price {
            color: #D2691E;
            font-weight: bold;
            margin: 10px 0;
        }

        .add-to-cart {
            background: #D2691E;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .add-to-cart:hover {
            background: #b85a17;
        }

        .active-nav {
            background: #D2691E;
            color: white;
        }

        .preview-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            position: relative;
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
            padding: 6px 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            color: #D32F2F;
        }

        .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            color: #333;
        }

        :root {
            --off-white: #F8F8F8;
            --red: #D32F2F;
            --caramel: #D2691E;
            --blue: #87CEEB;
        }

        .cart-count {
            background: var(--red);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        /* === RESPONSIVIDADE === */
        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-image {
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 200px;
            }

            .page-content {
                padding: 10px;
            }

            .preview-nav {
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .menu-toggle {
                display: block;
            }

            nav ul {
                display: none;
                flex-direction: column;
                background: white;
                width: 100%;
                position: absolute;
                top: 55px;
                left: 0;
                padding: 15px 0;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            nav ul.show {
                display: flex;
            }

            nav ul li {
                margin: 10px 0;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .product-image {
                height: 160px;
            }

            .product-price {
                font-size: 14px;
            }

            .add-to-cart {
                font-size: 13px;
                padding: 7px 12px;
            }
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
            <div class="browser-url">petrace.com/roupas</div>
        </div>

        <div class="logo">Dog<span>Race</span></div>

        <div class="page-content">
            <h2 class="preview-title">Roupas de Corrida</h2>
            <nav class="preview-nav">
                <span class="menu-toggle" onclick="toggleMenu()">☰</span>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="carros.php">Carros</a></li>
                    <li><a class="active-nav" href="roupas.php">Roupas</a></li>
                    <li><a href="adoção.php">Adoção</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registro.php">Registrar</a></li>
                    <li>
                        <a href="carrinho.php">
                            🛒 <span class="cart-count" id="cart-count">
                                <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="product-grid">
                <div class="product-preview">
                    <div class="product-image">
                        <img src="roupinhadecachorro.png" alt="Macacão Vermelho">
                        <img src="roupinha_amarela.png" alt="Macacão Amarelo">
                        <img src="azulmacacao.png" alt="Macacão Azul">
                    </div>
                    <div>Macacão de Piloto</div>
                    <div class="product-price">R$ 89,90</div>
                    <a href="add_cart.php?id=41" class="add-to-cart">Adicionar Vermelho</a>
                    <a href="add_cart.php?id=42" class="add-to-cart">Adicionar Amarelo</a>
                    <a href="add_cart.php?id=43" class="add-to-cart">Adicionar Azul</a>
                </div>

                <div class="product-preview">
                    <div class="product-image">
                        <img src="capacetevermelho.png" alt="Capacete Vermelho">
                        <img src="capaceteamarelo.png" alt="Capacete Amarelo">
                        <img src="capaceteazul.png" alt="Capacete Azul">
                    </div>
                    <div>Capacetes de Corrida</div>
                    <div class="product-price">R$ 59,90</div>
                    <a href="add_cart.php?id=44" class="add-to-cart">Adicionar Vermelho</a>
                    <a href="add_cart.php?id=45" class="add-to-cart">Adicionar Amarelo</a>
                    <a href="add_cart.php?id=46" class="add-to-cart">Adicionar Azul</a>
                </div>

                <div class="product-preview">
                    <div class="product-image">
                        <img src="vermrlja.png" alt="Luvas Vermelhas">
                        <img src="amarelinha.png" alt="Luvas Amarelas">
                        <img src="luvinhavermelha.png" alt="Luvas Azul">
                    </div>
                    <div>Luvas de Corrida</div>
                    <div class="product-price">R$ 39,90</div>
                    <a href="add_cart.php?id=49" class="add-to-cart">Adicionar Vermelha</a>
                    <a href="add_cart.php?id=48" class="add-to-cart">Adicionar Amarela</a>
                    <a href="add_cart.php?id=47" class="add-to-cart">Adicionar Azul</a>
                </div>

                <div class="product-preview">
                    <div class="product-image">
                        <img src="jaquetavermelha.png" alt="Jaqueta Vermelha">
                        <img src="jaquetaamarela.png" alt="Jaqueta Amarela">
                        <img src="jaquetaazul.png" alt="Jaqueta Azul">
                    </div>
                    <div>Jaqueta de Corrida</div>
                    <div class="product-price">R$ 79,90</div>
                    <a href="add_cart.php?id=50" class="add-to-cart">Adicionar Vermelha</a>
                    <a href="add_cart.php?id=51" class="add-to-cart">Adicionar Amarela</a>
                    <a href="add_cart.php?id=52" class="add-to-cart">Adicionar Azul</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.querySelector('nav ul').classList.toggle('show');
        }

        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');

                fetch(url)
                    .then(response => response.text())
                    .then(total => {
                        document.getElementById('cart-count').innerText = total;
                    });
            });
        });
    </script>

    <footer>
        <p>© 2023 PetRace - Todos os direitos reservados</p>
    </footer>
</body>

</html>

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
  <title>DogRace - Carros</title>
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

    .dot-red { background: #9C0707; }
    .dot-yellow { background: #D69854; }
    .dot-blue { background: #1E95B3; }

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
      color: #D32F2F;
      padding-left: 10px;
    }

    /* ===== MENU ===== */
    .preview-nav {
      display: flex;
      justify-content: center; /* centraliza o menu */
      align-items: center;
      background: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
      position: relative;
      flex-wrap: wrap;
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

    nav ul {
      display: flex;
      list-style: none;
      flex-wrap: wrap;
      justify-content: center;
      transition: all 0.3s ease;
    }

    nav ul li {
      margin: 5px 10px;
    }

    nav ul li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
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

    .menu-toggle {
      display: none;
      font-size: 28px;
      cursor: pointer;
      color: #333;
      position: absolute;
      left: 20px;
      top: 10px;
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .preview-nav ul {
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

      .preview-nav ul.active {
        display: flex;
      }

      .preview-nav ul li {
        margin: 10px 0;
        text-align: center;
      }
    }

    /* === GRADE DE CARROS === */
    .car-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-bottom: 30px;
    }

    .car-preview {
      background: white;
      padding: 15px;
      border-radius: 5px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      border-top: 3px solid #D32F2F;
    }

    .car-image {
      height: 300px;
      background: #f5f5f5;
      border-radius: 5px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .car-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      display: block;
    }

    .car-name {
      color: #D32F2F;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .product-price {
      color: #D32F2F;
      font-weight: bold;
      margin: 10px 0;
    }

    .add-to-cart {
      background: #D32F2F;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 4px;
      cursor: pointer;
      display: inline-block;
      margin-top: 15px;
      transition: background 0.3s;
      position: relative;
      z-index: 1;
      font-weight: bold;
      text-decoration: none;
    }

    .add-to-cart:hover {
      background: #a32222;
    }

    .cart-count {
      background: #D32F2F;
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

    @media (max-width: 1024px) {
      .car-grid { grid-template-columns: repeat(2, 1fr); }
      .car-image { height: 250px; }
    }

    @media (max-width: 768px) {
      .car-grid { grid-template-columns: 1fr; }
      .car-image { height: 220px; }
      .car-preview { margin: 0 auto; max-width: 90%; }
      .page-content { padding: 10px; }
    }

    @media (max-width: 480px) {
      .car-image { height: 180px; }
      .car-name { font-size: 18px; }
      .add-to-cart { padding: 10px 20px; font-size: 14px; }
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
      <div class="browser-url">petrace.com/carros</div>
    </div>

    <div class="logo">Dog<span>Race</span></div>

    <nav class="preview-nav">
      <span class="menu-toggle" onclick="toggleMenu()">☰</span>
      <ul id="menu-list">
        <li><a href="index.php">Início</a></li>
        <li><a class="active-nav" href="carros.php">Carros</a></li>
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
      <h2 class="preview-title">Carros para Cachorros</h2>

      <div class="car-grid">
        <div class="car-preview">
          <div class="car-image"><img src="carrocorrida.png" alt="Carro de Corrida"></div>
          <div class="car-name">Carro de Corrida</div>
          <div class="product-price">R$ 299,90</div>
          <a href="add_cart.php?id=53" class="add-to-cart">Adicionar ao Carrinho</a>
        </div>

        <div class="car-preview">
          <div class="car-image"><img src="carroesportivo.png" alt="Carro Esportivo"></div>
          <div class="car-name">Carro Esportivo</div>
          <div class="product-price">R$ 349,90</div>
          <a href="add_cart.php?id=54" class="add-to-cart">Adicionar ao Carrinho</a>
        </div>

        <div class="car-preview">
          <div class="car-image"><img src="carrodeluxo.png" alt="Carro de Luxo"></div>
          <div class="car-name">Carro de Luxo</div>
          <div class="product-price">R$ 399,90</div>
          <a href="add_cart.php?id=55" class="add-to-cart">Adicionar ao Carrinho</a>
        </div>

        <div class="car-preview">
          <div class="car-image"><img src="carroclassico.png" alt="Carro Clássico"></div>
          <div class="car-name">Carro Clássico</div>
          <div class="product-price">R$ 279,90</div>
          <a href="add_cart.php?id=56" class="add-to-cart">Adicionar ao Carrinho</a>
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

    document.querySelectorAll('.add-to-cart').forEach(btn => {
      btn.addEventListener('click', function (event) {
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
</body>

</html>

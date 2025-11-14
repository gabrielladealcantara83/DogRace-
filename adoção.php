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
  <title>DogRace - Adoção</title>
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
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
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
      color: #87CEEB;
      padding-left: 10px;
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
      text-align: center;
      padding: 10px 0;
    }

    .logo span {
      color: #D2691E;
    }

    nav ul {
      display: flex;
      list-style: none;
      transition: all 0.3s ease;
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

    .active-nav {
      background: #87CEEB;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
    }

    /* === MENU DE TRÊS LINHAS IGUAL AO ROUPAS (À ESQUERDA) === */
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

    /* === RESTO IGUAL === */
    .dog-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-bottom: 30px;
    }

    .dog-preview {
      background: white;
      padding: 15px;
      border-radius: 5px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      border-top: 3px solid #87CEEB;
    }

    .dog-preview div {
      margin-bottom: 5px;
    }

    .dog-image {
      height: 300px;
      background: #f5f5f5;
      border-radius: 5px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .dog-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      display: block;
    }

    .dog-name {
      color: #87CEEB;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .adopt-btn {
      background: #87CEEB;
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
    }

    .adopt-btn:hover {
      background: #5db8dd;
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
      .dog-grid { grid-template-columns: repeat(2, 1fr); }
      .dog-image { height: 250px; }
    }

    @media (max-width: 768px) {
      .dog-grid { grid-template-columns: 1fr; }
      .dog-image { height: 220px; }
      .dog-preview { margin: 0 auto; max-width: 90%; }
      .page-content { padding: 10px; }
    }

    @media (max-width: 480px) {
      .dog-image { height: 180px; }
      .dog-name { font-size: 18px; }
      .adopt-btn { padding: 10px 20px; font-size: 14px; }
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
      <div class="browser-url">petrace.com/adocao</div>
    </div>

    <div class="logo">Dog<span>Race</span></div>

    <nav class="preview-nav">
      <span class="menu-toggle" onclick="toggleMenu()">☰</span>
      <ul id="menu-list">
        <li><a href="index.php">Início</a></li>
        <li><a href="carros.php">Carros</a></li>
        <li><a href="roupas.php">Roupas</a></li>
        <li><a class="active-nav" href="adoção.php">Adoção</a></li>
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
      <h2 class="preview-title">Cachorros para Adoção</h2>

      <div class="dog-grid">
        <div class="dog-preview">
          <div class="dog-image"><img src="rex.png" alt="Rex"></div>
          <div class="dog-name">Rex</div>
          <div>Idade: 2 anos</div>
          <div>Raça: Vira-lata</div>
          <a class="adopt-btn" href="adotar.php?opcao=rex">Quero Adotar</a>
        </div>

        <div class="dog-preview">
          <div class="dog-image"><img src="luna.png" alt="Luna"></div>
          <div class="dog-name">Luna</div>
          <div>Idade: 3 anos</div>
          <div>Raça: Labrador</div>
          <a class="adopt-btn" href="adotar.php?opcao=luna">Quero Adotar</a>
        </div>

        <div class="dog-preview">
          <div class="dog-image"><img src="max.png" alt="Max"></div>
          <div class="dog-name">Max</div>
          <div>Idade: 1 ano</div>
          <div>Raça: Poodle</div>
          <a class="adopt-btn" href="adotar.php?opcao=max">Quero Adotar</a>
        </div>

        <div class="dog-preview">
          <div class="dog-image"><img src="bela.png" alt="Bella"></div>
          <div class="dog-name">Bela</div>
          <div>Idade: 4 anos</div>
          <div>Raça: Golden Retriever</div>
          <a class="adopt-btn" href="adotar.php?opcao=bella">Quero Adotar</a>
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

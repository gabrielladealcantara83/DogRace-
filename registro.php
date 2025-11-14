<?php
// session_start();
// if (!isset($_SESSION['id'])) {
//     header("Location: registro.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PetRace - Registro</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f8f8f8;
      color: #333;
      padding: 20px;
    }

    :root {
      --off-white: #f8f8f8;
      --red: #d32f2f;
      --caramel: #d2691e;
      --blue: #87ceeb;
    }

    .page-preview {
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      height: auto;
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
      background: #9c0707;
    }

    .dot-yellow {
      background: #d69854;
    }

    .dot-blue {
      background: #1e95b3;
    }

    .browser-url {
      flex: 1;
      text-align: center;
      font-size: 14px;
      color: #555;
    }

    /* ===== MENU ===== */
    nav {
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px 20px;
      border-bottom: 1px solid #eee;
      position: relative;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: var(--red);
    }

    .logo span {
      color: var(--caramel);
    }

    .nav-links {
      display: flex;
      list-style: none;
    }

    .nav-links li {
      margin-left: 20px;
    }

    .nav-links a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .nav-links a:hover {
      color: var(--red);
    }

    .cart-count {
      background: var(--red);
      color: white;
      border-radius: 50%;
      padding: 2px 8px;
      font-size: 12px;
    }

    /* Botão hamburguer */
    .menu-btn {
      display: none;
      flex-direction: column;
      cursor: pointer;
      gap: 4px;
      position: absolute;
      right: 20px;
    }

    .menu-btn div {
      width: 25px;
      height: 3px;
      background: #333;
      border-radius: 2px;
    }

    /* Responsivo */
    @media (max-width: 768px) {
      .nav-links {
        display: none;
        flex-direction: column;
        width: 100%;
        background: white;
        position: absolute;
        top: 55px;
        left: 0;
        border-top: 1px solid #eee;
        text-align: center;
        z-index: 99;
      }

      .nav-links.active {
        display: flex;
      }

      .menu-btn {
        display: flex;
      }
    }

    /* ===== FORMULÁRIO ===== */
    .page-content {
      padding: 20px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .registro-container {
      width: 100%;
      max-width: 600px;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      text-align: center;
      color: var(--red);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    .registro-btn {
      background: var(--red);
      color: white;
      border: none;
      padding: 12px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
      font-size: 16px;
      margin-top: 10px;
    }

    .login-links {
      text-align: center;
      margin-top: 20px;
    }

    .login-links a {
      color: var(--red);
      text-decoration: none;
      margin: 0 10px;
      font-size: 14px;
    }

    footer {
      text-align: center;
      padding: 10px;
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
      <div class="browser-url">petrace.com/registro</div>
    </div>

    <!-- ===== MENU SUPERIOR ===== -->
    <nav>
      <div class="logo">Dog<span>Race</span></div>
      <div class="menu-btn" id="menu-btn">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <ul class="nav-links" id="nav-links">
        <li><a href="index.php">Início</a></li>
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

    <!-- ===== CONTEÚDO ===== -->
    <div id="register" class="page-content">
      <div class="registro-container">
        <h2 class="form-title">Criar Conta</h2>
        <form method="POST" action="registrar_usuarios.php">
          <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required />
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required />
          </div>
          <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password" required />
          </div>
          <div class="form-group">
            <label>Confirmar Senha:</label>
            <input type="password" name="confirmar_password" required />
          </div>
          <button type="submit" class="registro-btn">Cadastrar</button>
        </form>
        <div class="login-links">
          <a href="login.php">Já possuo login</a>
        </div>
      </div>
    </div>

    <footer>
      <p>© 2023 PetRace - Todos os direitos reservados</p>
    </footer>
  </div>

  <script>
    const menuBtn = document.getElementById("menu-btn");
    const navLinks = document.getElementById("nav-links");

    menuBtn.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });

    // Script simples do carrinho
    let carrinho = [];
    let total = 0;
    const botoes = document.querySelectorAll(".add-to-cart");

    botoes.forEach((botao) => {
      botao.addEventListener("click", function () {
        const produto = this.parentElement;
        const nome = produto.querySelector("div:nth-child(2)").textContent;
        const precoTexto = produto
          .querySelector(".product-price")
          .textContent.replace("R$", "")
          .replace(",", ".");
        const preco = parseFloat(precoTexto);

        carrinho.push({ nome, preco });
        total += preco;
        document.getElementById("cart-count").textContent = carrinho.length;
        alert(`${nome} adicionado ao carrinho!\nTotal: R$ ${total.toFixed(2)}`);
      });
    });
  </script>
</body>

</html>

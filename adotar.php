<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetRace - Adoção</title>
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

        .feedback-mensagem {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            border: 1px solid;
            max-width: 1000px;
            /* Adicionado para centralizar e limitar o tamanho */
            margin-left: auto;
            margin-right: auto;
        }

        .success {
            background-color: #e6ffe6;
            color: #38761d;
            border-color: #38761d;
        }

        .error {
            background-color: #ffe6e6;
            color: #cc0000;
            border-color: #cc0000;
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
            min-height: 70px;
        }

        .preview-title {
            text-align: center;
            margin-bottom: 20px;
            color: #D32F2F;
            border-left: 5px solid #D32F2F;
            padding-left: 10px;
        }

        .nav-preview {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .nav-item {
            padding: 5px 10px;
            border-radius: 3px;
            background: #f0f0f0;
            cursor: pointer;
        }

        .active-nav {
            background: #D32F2F;
            color: white;
        }

        /* 🔹 Formulário estilizado */
        .form-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid #f1f1f1;
        }

        .form-group {
            margin-bottom: 15px;
            flex: 1;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .submit-btn {
            background: linear-gradient(90deg, #D32F2F, #B71C1C);
            color: white;
            border: none;
            padding: 14px 40px;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: linear-gradient(90deg, #B71C1C, #8E0000);
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .preview-nav {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #D32F2F;
            /* Vermelho principal */
        }

        .logo span {
            color: #D2691E;
            /* Caramelo */
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

        .cart-count {
            background: var(--red);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
        }

        nav ul li a:hover {
            color: #D32F2F;
        }

                .preview-title {
            text-align: center;
            margin-bottom: 20px;
            color: #D32F2F;
            padding-left: 10px;
        }
        .form-adocao {
  display: none;
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
        <nav>
            <div class="logo">Dog<span>Race</span></div>
            <div class="page-content">

                <h2 class="preview-title">Adoção</h2>
                <nav class="nav-preview">
                    <ul>
                        <li><a href="index.php" onclick="showPage('index.php')">Início</a></li>
                        <li><a href="carros.php" onclick="showPage('carros.php')">Carros</a></li>
                        <li><a href="roupas.php" onclick="showPage('roupas.php')">Roupas</a></li>
                        <li><a href="adoção.php" onclick="showPage('adoção.php')">Adoção</a></li>
                        <li><a href="login.php" onclick="showPage('login.php')">Login</a></li>
                        <li><a href="registro.php" onclick="showPage('registro.php')">Registrar</a></li>
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
        </nav>
       
            <div id="rex" class="form-adocao">
              <div class="form-container">
          <form action="adotarsql.php" method="POST">

            <div class="form-group">
                <label for="nome_id">Seu nome</label>
                <input type="text" id="nome_id" name="nome_id" required placeholder="Ex: Gabriella Alcântara">
            </div>  
            <div class="form-group">
                <label for="cachorro_id">Rex</label>
                <div class="dog-image"><img src="rex.png" alt="Rex" style="height: 50px; width: 100px; "></div>
            <input type="hidden" name="cachorro_id" value="1">

            </div>
            <div class="form-group">
                <label for="usuario_id">E-mail</label>
                <input type="email" id="email" name="usuario_id" required placeholder="Ex: gabriella@email.com">
            </div>
 <div class="form-group">
                <label for="data_adocao">Data da adoção</label>
                <input type="date" id="data_adocao" name="data_adocao">
            </div>
            <div class="form-group">
                <label for="status">Possui algum outro animal? Se sim qual e quantos?</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="form-group">
                <label for="observacoes">Observação</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Alguma observação que deseja compartilhar."></textarea>
            </div>
            <div class="form-group">
                <label for="numero_id">Seu número</label>
                <input type="number" id="numero_id" name="numero_id">
            </div>
<button type="submit" class="submit-btn">Adotar!</button>
</div>
            </div>
</form>

 <div id="luna" class="form-adocao">
              <div class="form-container">
          <form action="adotarsql.php" method="POST">

            <div class="form-group">
                <label for="nome_id">Seu nome</label>
                <input type="text" id="nome_id" name="nome_id" required placeholder="Ex: Gabriella Alcântara">
            </div>  
            <div class="form-group">
                <label for="cachorro_id">Luna</label>
                <div class="dog-image"><img src="luna.png" alt="Luna" style="height: 50px; width: 100px; "></div>
           <input type="hidden" name="cachorro_id" value="2">
            </div>
            <div class="form-group">
                <label for="usuario_id">E-mail</label>
                <input type="email" id="usuario_id" name="usuario_id" required placeholder="Ex: gabriella@email.com">
            </div>
 <div class="form-group">
                <label for="data_adocao">Data da adoção</label>
                <input type="date" id="data_adocao" name="data_adocao">
            </div>
            <div class="form-group">
                <label for="status">Possui algum outro animal? Se sim qual e quantos?</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="form-group">
                <label for="observacoes">Observação</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Alguma observação que deseja compartilhar."></textarea>
            </div>
            <div class="form-group">
                <label for="numero_id">Seu número</label>
                <input type="number" id="numero_id" name="numero_id">
            </div>
<button type="submit" class="submit-btn">Adotar!</button>
</div>
            </div>
</form>
 <div id="max" class="form-adocao">
              <div class="form-container">
          <form action="adotarsql.php" method="POST">

            <div class="form-group">
                <label for="nome_id">Seu nome</label>
                <input type="text" id="nome_id" name="nome_id" required placeholder="Ex: Gabriella Alcântara">
            </div>  
            <div class="form-group">
                <label for="cachorro_id">Max</label>
                <div class="dog-image"><img src="max.png" alt="Rex" style="height: 50px; width: 100px; "></div>
            <input type="hidden" name="cachorro_id" value="3">
            </div>
            <div class="form-group">
                <label for="usuario_id">E-mail</label>
                <input type="email" id="usuario_id" name="usuario_id" required placeholder="Ex: gabriella@email.com">
            </div>
 <div class="form-group">
                <label for="data_adocao">Data da adoção</label>
                <input type="date" id="data_adocao" name="data_adocao">
            </div>
            <div class="form-group">
                <label for="status">Possui algum outro animal? Se sim qual e quantos?</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="form-group">
                <label for="observacoes">Observação</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Alguma observação que deseja compartilhar."></textarea>
            </div>
            <div class="form-group">
                <label for="numero_id">Seu número</label>
                <input type="number" id="numero_id" name="numero_id">
            </div>
<button type="submit" class="submit-btn">Adotar!</button>
</div>
            </div>
</form>
 <div id="bella" class="form-adocao">
              <div class="form-container">
          <form action="adotarsql.php" method="POST">

            <div class="form-group">
                <label for="nome_id">Seu nome</label>
                <input type="text" id="nome_id" name="nome_id" required placeholder="Ex: Gabriella Alcântara">
            </div>  
            <div class="form-group">
                <label for="cachorro_id">Bella</label>
                <div class="dog-image"><img src="bela.png" alt="Bella" style="height: 50px; width: 100px; "></div>
            <input type="hidden" name="cachorro_id" value="4">
            </div>
            <div class="form-group">
                <label for="usuario_id">E-mail</label>
                <input type="email" id="usuario_id" name="usuario_id" required placeholder="Ex: gabriella@email.com">
            </div>
 <div class="form-group">
                <label for="data_adocao">Data da adoção</label>
                <input type="date" id="data_adocao" name="data_adocao">
            </div>
            <div class="form-group">
                <label for="status">Possui algum outro animal? Se sim qual e quantos?</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="form-group">
                <label for="observacoes">Observação</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Alguma observação que deseja compartilhar."></textarea>
            </div>
            <div class="form-group">
                <label for="numero_id">Seu número</label>
                <input type="number" id="numero_id" name="numero_id">
            </div>
<button type="submit" class="submit-btn">Adotar!</button>
</div>
            </div>
</form>
    <footer>
        <p>© 2023 PetRace - Todos os direitos reservados</p>
    </footer>
<script>
  // Função para obter um parâmetro da URL
  function obterParametroUrl(nome) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nome);
  }

  // Quando a página estiver carregada...
  document.addEventListener('DOMContentLoaded', function() {
    // Esconde todos os formulários com a classe "form-adocao"
    const formularios = document.querySelectorAll('.form-adocao');
    formularios.forEach(form => {
      form.style.display = 'none';
    });

    // Pega o valor do parâmetro 'opcao' da URL
    const opcao = obterParametroUrl('opcao');

    // Se a opção existe, exibe o formulário correspondente
    if (opcao) {
      const formularioEspecifico = document.getElementById(opcao);
      if (formularioEspecifico) {
        formularioEspecifico.style.display = 'block';
      }
    }
  });
</script>
</body>

</html>
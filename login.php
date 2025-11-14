<?php
session_start();
require_once 'conexao.php'; // conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Consulta o usuário
    $usuario_id = $_SESSION['id'];
    $sql = "INSERT INTO inscricoes_corrida (usuario_id, nome_cachorro, raca_cachorro, idade_cachorro)
        VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $usuario_id, $nome, $raca, $idade);
    $stmt->execute();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica a senha (ajuste se não estiver usando password_hash)
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = "Senha incorreta!";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Usuário não encontrado!";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetRace - Login</title>
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
            max-width: 800px;
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

        /* ===== MENU ===== */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #D32F2F;
        }

        .logo span {
            color: #D2691E;
        }

        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
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

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 15px;
        }

        .menu-toggle div {
            width: 25px;
            height: 3px;
            background: #333;
            margin: 4px 0;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            nav ul {
                display: none;
                flex-direction: column;
                background: white;
                position: absolute;
                top: 50px;
                right: 10px;
                width: 180px;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            nav ul.show {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }
        }

        /* ===== Login ===== */
        .page-content {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #D32F2F;
        }

        .form-group { margin-bottom: 20px; }

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

        .login-btn {
            background: #D32F2F;
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
            color: #D32F2F;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        footer {
            text-align: center;
            margin-top: 30px;
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
            <div class="browser-url">petrace.com/login</div>
        </div>

        <nav>
            <div class="logo">Dog<span>Race</span></div>

            <div class="menu-toggle" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <ul id="menu">
                <li><a href="index.php">Início</a></li>
                <li><a href="carros.php">Carros</a></li>
                <li><a href="roupas.php">Roupas</a></li>
                <li><a href="adoção.php">Adoção</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="registro.php">Registrar</a></li>
                <li>
                    <a href="carrinho.php">🛒
                        <span class="cart-count" id="cart-count">
                            <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="page-content">
            <div class="login-container">
                <h2 class="login-title">Login</h2>
                <form method="POST" action="authenticate.php">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Sua senha" required>
                    </div>
                    <button type="submit" class="login-btn">Entrar</button>
                </form>
                <div class="login-links">
                    <a href="#">Esqueci minha senha</a>
                    <a href="registro.php">Cadastrar</a>
                </div>
            </div>
        </div>

        <footer>
            <p>© 2023 PetRace - Todos os direitos reservados</p>
        </footer>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("show");
        }
    </script>
</body>
</html>

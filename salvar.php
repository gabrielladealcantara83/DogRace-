<?php
session_start();
if (!isset($_SESSION['usuarios'])) {
   header("Location: login.php");
   exit();
}
 
require_once 'conexao.php';
 
try {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = isset($_POST['email']) ? $_POST['email'] : null;
        $description = isset($_POST['password']) ? $_POST['password']: null;
 
 
        if ($title) {
            $sql = "INSERT INTO usuarios (email,password) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
 
            if($stmt) {
                $stmt->bind_param("ss", $email, $password);
 
                if($stmt->execute()) {
                    session_start();
                    $_SESSION['message'] = "Login feito com sucesso!";
                    $_SESSION['message_type'] = 'success';
                    header("Location: index.php");
                    exit();
              } else {
                session_start();    
                $_SESSION['message'] = "Erro ao fazer login.";  
                $_SESSION['message_type'] = 'danger';
                throw new Exception("Erro ao fazer tarefa: " . $stmt->error);
              }
 
              $stmt->close();
               } else {
                throw new Exception("Erro ao fazer login: " . $conn->error);
               }
 
        } else {
            throw new Exception("Ocampo title é obrigatório!");
        }
    } else {
        throw new Exception("Método de requisição inválido!");
    }
} catch (Exception $e){
    echo "Erro: " . $e->getMessage();
} finally {
    $conn->close();
}
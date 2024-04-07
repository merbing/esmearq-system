<?php
session_start();
require_once("../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $senha = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["password"]));

    $verificar_usuario = "SELECT F.id,F.nome,F.email,F.telefone,F.papel_usuario,F.agencia,
                         P.id as papel_usuario,P.nome as papel, F.senha FROM funcionarios F 
                         inner join funcionarios_papel P
                         ON (F.papel_usuario = P.id) WHERE email = '$email' AND F.ativo=1";
    $result = $conn->query($verificar_usuario);
   
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
    
        if (password_verify($senha, $row["senha"])) {
            session_start();
            
            $_SESSION["funcionario_id"] = $row["id"];
            $_SESSION["nome_usuario"] = $row["nome"];
            $_SESSION["email_usuario"] = $row["email"];
            $_SESSION["telefone_usuario"] = $row["telefone"];
            $_SESSION["papel_usuario"] = $row["papel"];
            $_SESSION["papel_usuario_id"] = $row["papel_usuario"];
            $_SESSION["agencia_id"] = $row["agencia"];

            // Redirecionando para a área do cliente
            header("Location: ../../home/");
            exit();
        } else {
            // Senha incorreta
            $error_message = "A senha passada está incorrecta";
            header("Location: ../../login.php?&error_message=" . urlencode($error_message));
            exit;
        }
    } else {
        // Usuário não encontrado
        $error_message = "Nenhum usuário encontrado";
        header("Location: ../../login.php?&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


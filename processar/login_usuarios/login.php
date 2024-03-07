<?php
require_once("../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["password"];

    $verificar_usuario = "SELECT * FROM funcionarios WHERE email = '$email'";
    $result = $conn->query($verificar_usuario);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($senha, $row["palavrapasse"])) {
            session_start();

            $_SESSION["funcionario_id"] = $row["id"];
            $_SESSION["nome_usuario"] = $row["nome_funcionario"];
            $_SESSION["email_usuario"] = $row["email"];
            $_SESSION["telefone_usuario"] = $row["telefone"];
            $_SESSION["cargo_id"] = $row["cargo_id"];
            $_SESSION["agencia_id"] = $row["agencia_id"];

            // Redirecionando para a área do cliente
            header("Location: ../../pt/");
            exit();
        } else {
            // Senha incorreta
            $error_message = "A senha passada está incorrecta";
            header("Location: ../../login?&error_message=" . urlencode($error_message));
            exit;
        }
    } else {
        // Usuário não encontrado
        $error_message = "Nenhum usuário encontrado";
        header("Location: ../../login?&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login");
    exit();
}

$conn->close();
?>


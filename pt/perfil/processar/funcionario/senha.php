<?php
require_once("../../../../banco/config.php");

// Verifica se o formulário foi submetido via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $funcionario_id = $_POST["funcionario_id"];
    $senha_atual = $_POST["senha_atual"];
    $nova_senha = $_POST["nova_senha"];

    // Verifica se a senha atual inserida corresponde à senha atual do usuário
    $verificar_senha = "SELECT palavrapasse FROM funcionarios WHERE id = $funcionario_id";
    $result_senha = $conn->query($verificar_senha);

    if ($result_senha->num_rows > 0) {
        $row_senha = $result_senha->fetch_assoc();

        if (password_verify($senha_atual, $row_senha["palavrapasse"])) {
            // Senha atual está correta, podemos proceder com a atualização

            // Hash da nova senha
            $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

            // Atualiza a senha no banco de dados
            $atualizar_senha = "UPDATE funcionarios SET palavrapasse = '$senha_hash' WHERE id = $funcionario_id";

            if ($conn->query($atualizar_senha) === TRUE) {
                // Senha atualizada com sucesso
                header("Location: ../../index?status=sucesso");
                exit();
            } else {
                // Erro ao atualizar a senha
                header("Location: ../../index?mensagem=" . urlencode("Erro ao atualizar a senha"));
                exit();
            }
        } else {
            // Senha atual incorreta
            header("Location: ../../index?mensagem=" . urlencode("Senha atual incorreta"));
            exit();
        }
    } else {
        // Erro ao obter a senha atual do banco de dados
        header("Location: ../../index?mensagem=" . urlencode("Erro ao obter a senha atual"));
        exit();
    }
} else {
    // Redireciona se o formulário não foi submetido via POST
    header("Location: ../../index?mensagem=" . urlencode("Formulário não submetido via POST"));
    exit();
}

$conn->close();
?>

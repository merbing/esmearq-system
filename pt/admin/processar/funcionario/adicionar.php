<?php
// Inclua o arquivo de configuração do banco de dados
include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_funcionario = $_POST['nome_funcionario'];
    $cargo_id = $_POST['cargo_id'];
    $agencia_id = $_POST['agencia_id'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Verificar se o e-mail já existe na tabela
    $verifica_email = "SELECT id FROM funcionarios WHERE email = ?";
    $stmt_verifica = $conn->prepare($verifica_email);
    $stmt_verifica->bind_param("s", $email);
    $stmt_verifica->execute();
    $stmt_verifica->store_result();
    $num_rows = $stmt_verifica->num_rows;
    $stmt_verifica->close();

    if ($num_rows > 0) {
        // Redirecionar para a página de erro indicando que o e-mail já existe
        $error_message = "Erro ao adicionar novo funcionário. Este e-mail já está em uso";
        header("Location: ../../funcionarios_adicionar?error_message=" . urlencode($error_message));
        exit(); // Encerra a execução após o redirecionamento
    }

    // Gerar senha hash aleatória
    $senha_default = "mbuli123";
    $senha_hash = password_hash($senha_default, PASSWORD_DEFAULT);
    $senha_default = "SEM ACESSO";

    // Inserir os dados do funcionário no banco de dados
    $query = "INSERT INTO funcionarios (nome_funcionario, cargo_id, agencia_id, email, telefone, palavrapasse, senha_default) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siissss", $nome_funcionario, $cargo_id, $agencia_id, $email, $telefone, $senha_hash, $senha_default);

    $result = $stmt->execute();

    if ($result) {
        // Enviar e-mail ao funcionário com as informações de credenciais
        $subject = "Seus dados de acesso";
        $message = "Olá " . $nome_funcionario . ", você foi cadastrado no sistema com o e-mail " . $email . " e a senha " . $senha_default . ". Entre na plataforma para verificar as informações e atualizá-las conforme necessário.";
        mail($email, $subject, $message);

        // Redirecionar para a página de sucesso e passar o status na URL
        $success_message = "Funcionário adicionado com sucesso!";
        header("Location: ../../funcionarios_lista?success_message=" . urlencode($success_message));
        exit(); // Encerra a execução após o redirecionamento
    } else {
        // Redirecionar para a página de erro e passar o status na URL
        $error_message = "Erro ao adicionar novo funcionário. Tente novamente";
        header("Location: ../../funcionarios_adicionar?error_message=" . urlencode($error_message));
        exit(); // Encerra a execução após o redirecionamento
    }

    $stmt->close(); // Fechar a declaração preparada
} else {
    $error_message = "Requisição inválida";
    header("Location: ../../funcionarios_adicionar?error_message=" . urlencode($error_message));
    exit(); // Encerra a execução após o redirecionamento
}

$conn->close(); // Fechar a conexão com o banco de dados
?>

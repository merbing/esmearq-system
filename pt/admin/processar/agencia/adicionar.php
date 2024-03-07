<?php
include("../../../../banco/config.php");

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_agencia = $_POST['nome_agencia'];
    $endereco = $_POST['endereco'];
    $provincia = $_POST['provincia'];
    $telefone = $_POST['telefone'];

    // Inserir os dados da agência no banco de dados
    $query = "INSERT INTO agencias (nome_agencia, endereco, provincia, telefone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nome_agencia, $endereco, $provincia, $telefone);
    $result = $stmt->execute();

    if ($result) {
        // Redirecionar para a página de sucesso e passar o status na URL
        $sucess_message = "Agência adicionada com sucesso!";
        header("Location: ../../agencia_lista?success_message=" . urlencode($sucess_message));
        exit();    } else {
        // Redirecionar para a página de erro e passar o status na URL
        $error_message = "Ocorreu um erro ao inserir. Tente novamente!";
        header("Location: ../../agencia_adicionar?error_message=" . urlencode($error_message));
        exit();    }

    $stmt->close();
} else {
    // Se o formulário não foi enviado, redirecionar para a página de erro
    $error_message = "Requisição inválida";
    header("Location: ../../agencia_adicionar?error_message=" . urlencode($error_message));
    exit();}

?>

<?php
// Inclua o arquivo de configuração do banco de dados
include("../../../../banco/config.php");

// Verifique se o ID da agência foi enviado
if (isset($_POST['id_agencia'])) {
    // Obtenha os dados do formulário
    $id_agencia = $_POST['id_agencia'];
    $nome_agencia = $_POST['nome_agencia'];
    $endereco_agencia = $_POST['endereco'];
    $provincia_agencia = $_POST['provincia'];
    $telefone_agencia = $_POST['telefone'];

    // Consulta para atualizar a agência com base no ID
    $query = "UPDATE agencias SET nome_agencia = ?, endereco = ?, provincia = ?, telefone = ? WHERE id_agencia = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nome_agencia, $endereco_agencia, $provincia_agencia, $telefone_agencia, $id_agencia);

    // Execute a consulta
    if ($stmt->execute()) {
        // Redirecione para a página de sucesso ou outra página após a atualização
        $success_message = "Agência atualizada com sucesso!";
        header("Location: ../../agencia_lista?success_message=" . urlencode($success_message));
        exit();
    } else {
        // Em caso de erro na execução da consulta
        $error_message = "Ocorreu um erro ao atualizar. Tente novamente";
        header("Location: ../../agencia_lista?error_message=" . urlencode($error_message));
        exit();
    }

    // Feche a instrução preparada
    $stmt->close();
} else {
    // Se o ID da agência não foi enviado, redirecione para uma página de erro ou outra página apropriada
    $error_message = "Requisição inválida";
    header("Location: ../../agencia_lista?error_message=" . urlencode($error_message));
    exit();
}

?>

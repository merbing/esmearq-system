<?php
// Inclua o arquivo de configuração do banco de dados
include("../../../../banco/config.php");

// Verifique se o ID da agência foi enviado
if (isset($_POST['id_agencia'])) {
    // Obtenha o ID da agência do formulário
    $id_agencia = $_POST['id_agencia'];

    // Consulta para verificar dependências na tabela de funcionários
    $dependencias_query = "SELECT COUNT(*) AS total FROM funcionarios WHERE agencia_id=?";
    $stmt_dependencias = $conn->prepare($dependencias_query);
    $stmt_dependencias->bind_param("i", $id_agencia);
    $stmt_dependencias->execute();
    $result_dependencias = $stmt_dependencias->get_result();
    $row_dependencias = $result_dependencias->fetch_assoc();
    $total_dependencias = $row_dependencias['total'];

    // Se houver dependências, redirecione com uma mensagem de erro
    if ($total_dependencias > 0) {
        $error_message = "Esta agência possui funcionários associados e não pode ser removida.";
        header("Location: ../../agencia_lista?error_message=" . urlencode($error_message));
        exit();
    }

    // Consulta para excluir a agência com base no ID
    $query = "DELETE FROM agencias WHERE id_agencia = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_agencia);

    // Execute a consulta
    if ($stmt->execute()) {
        // Redirecione para a página de sucesso ou outra página após a remoção
        $success_message = "Agência eliminada com sucesso!";
        header("Location: ../../agencia_lista?success_message=" . urlencode($success_message));
        exit();
    } else {
        // Em caso de erro na execução da consulta
        $error_message = "Ocorreu um erro ao remover. Tente novamente";
        header("Location: ../../agencia_lista?error_message=" . urlencode($error_message));
        exit();
    }
} else {
    // Se o ID da agência não foi enviado, redirecione para uma página de erro ou outra página apropriada
    $error_message = "Requisição inválida";
    header("Location: ../../agencia_lista?error_message=" . urlencode($error_message));
    exit();
}
?>

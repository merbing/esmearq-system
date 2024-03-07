<?php

function verificarParametro($parametro) {
    return isset($_GET[$parametro]) && !empty($_GET[$parametro]);
}

if (!verificarParametro('conta_do_cliente')) {
    header("Location: cliente_info?status=erro_404");
    exit();
} else {
    $encrypted_user_id = $_GET['conta_do_cliente'];
    $cliente_id = base64_decode($encrypted_user_id);

    // Preparar a consulta SQL usando um prepared statement
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Verificar se houve erros ao preparar a consulta
    if (!$stmt) {
        die("Erro ao preparar a consulta SQL: " . $conn->error);
    }

    // Vincular o parâmetro ao statement
    $stmt->bind_param("i", $cliente_id);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->get_result();

    // Verificar se o cliente foi encontrado
    if ($result->num_rows === 0) {
        $error_message = "O cliente não foi encontrado.";
        header("Location: ../clientes/?&error_message=" . urlencode($error_message));
        exit;
    }
}
?>

<?php
include("../../../../banco/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Receber dados do formulário
    $user_id = $_POST["user_id"];
    $agencia_id = $_POST["agencia_id"];
    $nome = $_POST["nome"];
    $nif = $_POST["nif"];
    $data_de_nascimento = $_POST["data_de_nascimento"];
    $nacionalidade = $_POST["nacionalidade"];
    $estado_civil = $_POST["estado_civil"];
    $endereco = $_POST["Endereço"];
    $telefone = $_POST["Telefone"];
    $email = $_POST["uemail"];
    $funcionario_id = $_POST["funcionario_id"];
    $cliente_id = $_POST["cliente_id"];

    // 2. Atualizar dados do perfil do cliente
    $queryUpdateCliente = "UPDATE usuarios SET nome=?, nif=?, data_nascimento=?, nacionalidade=?, estado_civil=?, endereco=?, telefone=?, email=? WHERE id=?";
    $stmtUpdateCliente = $conn->prepare($queryUpdateCliente);
    $stmtUpdateCliente->bind_param("ssssssssi", $nome, $nif, $data_de_nascimento, $nacionalidade, $estado_civil, $endereco, $telefone, $email, $cliente_id);

    if ($stmtUpdateCliente->execute()) {
        $stmtUpdateCliente->close();

        // 3. Registrar na tabela de atividades
        $descricao_atividade = "Atualização de Conta de Cliente";
        $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado) VALUES (?, 'Completo', NOW(), ?, ?, ?)";
        $stmtInsertAtividade = $conn->prepare($queryInsertAtividade);
        $stmtInsertAtividade->bind_param("siii", $descricao_atividade, $funcionario_id, $agencia_id, $cliente_id);

        if ($stmtInsertAtividade->execute()) {
            $stmtInsertAtividade->close();

            // 4. Redirecionar para a página de sucesso
            $encrypted_user_id = base64_encode($cliente_id);
            $sucess_message = "Edição realizada com sucesso!";
            header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
        } else {
            // Tratamento de erro ao inserir atividade
            $stmtInsertAtividade->close();
            $erro_msg = "Erro ao registrar atividade. Por favor, tente novamente.";
            header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($erro_msg));
            exit();
        }
    } else {
        // Tratamento de erro ao atualizar dados do perfil do cliente
        $stmtUpdateCliente->close();
        $erro_msg = "Erro ao atualizar dados do perfil do cliente. Por favor, tente novamente.";
        header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($erro_msg));
        exit();
    }

    // Redirecionar para a página de erro
    header("Location: ../../../?erro=" . urlencode($erro_msg));
    exit();
}
?>

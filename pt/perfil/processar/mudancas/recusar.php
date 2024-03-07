<?php
require_once("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_solicitacao = $_POST["id_solicitacao"];
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];

    // Verificar se a solicitação já foi processada
    $sql_verificar_status = "SELECT status FROM solicitacoes_edicao WHERE id = '$id_solicitacao'";
    $resultado_verificar_status = $conn->query($sql_verificar_status);

    if ($resultado_verificar_status->num_rows > 0) {
        $row = $resultado_verificar_status->fetch_assoc();
        $status_atual = $row["status"];

        if ($status_atual == 'Aprovado' || $status_atual == 'Reprovado') {
            // Se já foi aprovado ou reprovado, exibir mensagem de erro
            $mensagem_erro = urlencode("Esta solicitação já foi processada anteriormente.");
            header("Location: ../../solicitacoes_detalhes?error_message=$mensagem_erro&solicitacao_selecionada=$id_solicitacao");
            exit();
        }
    }

    // 1. Atualizar o status da solicitação para 'Reprovado'
    $sql_atualizar_status = "UPDATE solicitacoes_edicao SET status = 'Reprovado', id_aprovador = $funcionario_id,  data_solicitacao = NOW() WHERE id = '$id_solicitacao'";
    if ($conn->query($sql_atualizar_status) !== TRUE) {
        // Tratar erro ao atualizar o status
        $mensagem_erro = urlencode("Erro ao atualizar o status da solicitação.");
        header("Location: ../../solicitacoes_detalhes?error_message=$mensagem_erro&solicitacao_selecionada=$id_solicitacao");
        exit();
    }

    // 2. Registrar a atividade da solicitação reprovada
    $descricao_atividade = "Solicitação Reprovada - ID: $id_solicitacao";
    $sql_inserir_atividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                              VALUES ('$descricao_atividade', 'Completo', NOW(), '$funcionario_id', '$agencia_id', '$id_solicitacao')";
    if ($conn->query($sql_inserir_atividade) !== TRUE) {
        // Tratar erro ao inserir atividade
        $mensagem_erro = urlencode("Erro ao registrar a atividade.");
        header("Location: ../../solicitacoes_detalhes?error_message=$mensagem_erro&solicitacao_selecionada=$id_solicitacao");
        exit();
    }

    // 3. Adicionar lógica de notificação aqui
    $notification_title = "Solicitação Reprovada";
    $notification_message = "Sua solicitação foi reprovada.";

    // Insira a notificação na tabela notificacoes_funcionarios
    $sql_insert_notification = "INSERT INTO notificacoes_funcionarios (titulo, mensagem, data_notificacao, lida, funcionario_id, agencia_id, objeto_id)
                                VALUES ('$notification_title', '$notification_message', NOW(), 0, '$funcionario_id', '$agencia_id', '$id_solicitacao')";

    if ($conn->query($sql_insert_notification) === TRUE) {
        // Redirecionar para a página com uma mensagem de sucesso
        $mensagem_sucesso = urlencode("Solicitação reprovada com sucesso.");
        header("Location: ../../solicitacoes_pedidos?success_message=$mensagem_sucesso&solicitacao_selecionada=$id_solicitacao");
        exit();
    } else {
        // Tratar erro ao inserir notificação
        $mensagem_erro = urlencode("Erro ao inserir notificação.");
        header("Location: ../../solicitacoes_detalhes?error_message=$mensagem_erro&solicitacao_selecionada=$id_solicitacao");
        exit();
    }
}

$conn->close();
?>

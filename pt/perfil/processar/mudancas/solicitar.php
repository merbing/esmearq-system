<?php
   require_once("../../../../banco/config.php");
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $agencia_id = $_POST["agencia_id"];
       $funcionario_id = $_POST["funcionario_id"];
       $tipo = $_POST["tipo"];
       $id_item = $_POST["id_item"];
       $motivo = $_POST["motivo"];
   
       // Inserir solicitação na tabela solicitacoes_edicao
       $sql_inserir_solicitacao = "INSERT INTO solicitacoes_edicao (tipo_solicitacao, id_item, id_solicitante, detalhes_solicitacao, data_solicitacao, data_limite_edicao, aprovado, status)
                                  VALUES ('$tipo', '$id_item', '$funcionario_id', '$motivo', NOW(), NOW(), NULL, 'Pendente')";
   
   if ($conn->query($sql_inserir_solicitacao) === TRUE) {
       // Registrar atividade em caso de sucesso
       $solicitacao_id = $conn->insert_id;
       $descricao_atividade = "Nova Solicitação - ID: $solicitacao_id";
       $sql_inserir_atividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                                 VALUES ('$descricao_atividade', 'Completo', NOW(), '$funcionario_id', '$agencia_id', '$solicitacao_id')";
   
       if ($conn->query($sql_inserir_atividade) === TRUE) {
           // Adicionar lógica de notificação aqui
           $notification_title = "Nova Solicitação";
           $notification_message = "Foi recebida uma nova solicitação.";
   
           // Insira a notificação na tabela notificacoes_funcionarios
           $sql_insert_notification = "INSERT INTO notificacoes_funcionarios (titulo, mensagem, data_notificacao, lida, funcionario_id, agencia_id, objeto_id)
                                       VALUES ('$notification_title', '$notification_message', NOW(), 0, '$funcionario_id', '$agencia_id', '$solicitacao_id')";
   
           if ($conn->query($sql_insert_notification) === TRUE) {
               $mensagem_sucesso = urlencode("Solicitação inserida com sucesso.");
               header("Location: ../../solicitacoes_minhas?success_message=$mensagem_sucesso");
               exit();
           } else {
               // Tratar erro ao inserir notificação
               $mensagem_erro = urlencode("Erro ao inserir notificação.");
               header("Location: ../../solicitacoes_solicitar?error_message=$mensagem_erro");
               exit();
           }
       } else {
           // Tratar erro ao inserir atividade
           $mensagem_erro = urlencode("Erro ao inserir atividade.");
           header("Location: ../../solicitacoes_solicitar?error_message=$mensagem_erro");
           exit();
       }
   }
    else {
           // Tratar erro ao inserir solicitação
           $mensagem_erro = urlencode("Erro ao inserir solicitação.");
           header("Location: ../../solicitacoes_solicitar?error_message=$mensagem_erro");
           exit();
       }
   }
   
   $conn->close();
   ?>
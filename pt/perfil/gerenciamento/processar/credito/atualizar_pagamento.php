
<?php
include("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];
    $data_pagamento = $_POST["data_pagamento"];
    $status_pagamento = $_POST["status_pagamento"];
    $pagamento_id = $_POST["pagamento_id"];
    $id_submissao = $_POST["id_submissao"];

    // Atualizando o status do pagamento na tabela pagamentos_credito
    $queryUpdatePagamento = "UPDATE pagamentos_credito SET status = ?, data_confirmacao = ?, funcionario_id = ? WHERE id_pagamento = ?";
    $stmtUpdatePagamento = $conn->prepare($queryUpdatePagamento);

    if ($stmtUpdatePagamento) {
        // Substituir os placeholders pelos valores reais
        $stmtUpdatePagamento->bind_param("ssii", $status_pagamento, $data_pagamento, $funcionario_id, $pagamento_id);

        // Executar a atualização
        $stmtUpdatePagamento->execute();

        // Verificar se a atualização foi bem-sucedida
        if ($stmtUpdatePagamento->affected_rows > 0) {
            // Registrando a atividade na tabela atividades
            $descricao_atividade = "Pagamento do cliente atualizado para: $status_pagamento";
            $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado) VALUES (?, 'Completo', ?, ?, ?, ?)";
            $stmtInsertAtividade = $conn->prepare($queryInsertAtividade);

            if ($stmtInsertAtividade) {
                // Substituir os placeholders pelos valores reais
                $stmtInsertAtividade->bind_param("sssii", $descricao_atividade, $data_pagamento, $funcionario_id, $agencia_id, $pagamento_id);

                // Executar a inserção da atividade
                $stmtInsertAtividade->execute();

                // Verificar se a inserção da atividade foi bem-sucedida
                if ($stmtInsertAtividade->affected_rows > 0) {
                    // Redirecionar após o sucesso
                    header("Location:../../pagamento_credito.php?status=sucesso&pagamento_selecionado=$pagamento_id&credito_selecionado=$id_submissao");
                } else {
                    echo "Erro ao registrar a atividade: " . $stmtInsertAtividade->error;
                }

                // Fechar a declaração preparada para a inserção da atividade
                $stmtInsertAtividade->close();
            } else {
                echo "Erro na preparação da declaração SQL para a atividade: " . $conn->error;
            }
        } else {
            echo "Erro ao atualizar o status do pagamento: " . $stmtUpdatePagamento->error;
        }

        // Fechar a declaração preparada para a atualização do pagamento
        $stmtUpdatePagamento->close();
    } else {
        echo "Erro na preparação da declaração SQL para a atualização do pagamento: " . $conn->error;
    }
} else {
    echo "Método inválido de requisição.";
}
?>

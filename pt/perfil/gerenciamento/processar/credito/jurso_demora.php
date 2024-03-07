<?php
include("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];
    $data_pagamento = $_POST["data_pagamento"];
    $id_submissao = $_POST["id_submissao"];
    $pagamento_id = $_POST["pagamento_id"];
    $montante_previsto = $_POST["montante_previsto"];

    // 1. Obter o ID do Produto associado à submissão de crédito
    $querySubmissao = "SELECT id_produto FROM submissao_credito WHERE id_submissao = $id_submissao";
    $resultSubmissao = $conn->query($querySubmissao);

    if ($resultSubmissao->num_rows > 0) {
        $rowSubmissao = $resultSubmissao->fetch_assoc();
        $id_produto = $rowSubmissao["id_produto"];

        // 2. Obter o valor do juros de demora associado ao produto
        $queryProduto = "SELECT juros_demora FROM produtos_microcredito WHERE id = $id_produto";
        $resultProduto = $conn->query($queryProduto);

        if ($resultProduto->num_rows > 0) {
            $rowProduto = $resultProduto->fetch_assoc();

            $juros_demora_bruto = $rowProduto["juros_demora"];
            $juros_demora_finado = $juros_demora_bruto / 100;
            $juros_demora = $montante_previsto * $juros_demora_finado;
            // 3. Adicionar atraso na tabela de atrasos
            $queryAtraso = "INSERT INTO atrasos_pagamento (id_pagamento, funcionario_id, status, data_atraso, montante_juros, id_submissao) VALUES (?, ?, 'Pendente', ?, ?, ?)";
            $stmtAtraso = $conn->prepare($queryAtraso);

            if ($stmtAtraso) {
                // Substituir os placeholders pelos valores reais
                $stmtAtraso->bind_param("iissi", $pagamento_id, $funcionario_id, $data_pagamento, $juros_demora, $id_submissao);

                // Executar a inserção do atraso
                $stmtAtraso->execute();

                // Verificar se a inserção foi bem-sucedida
                if ($stmtAtraso->affected_rows > 0) {
                    // 4. Registrar na tabela de atividades
                    $descricao_atividade = "Atraso adicionado para o pagamento ID: $pagamento_id";
                    $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado) VALUES (?, 'Completo', ?, ?, ?, ?)";
                    $stmtInsertAtividade = $conn->prepare($queryInsertAtividade);

                    if ($stmtInsertAtividade) {
                        // Substituir os placeholders pelos valores reais
                        $stmtInsertAtividade->bind_param("sssii", $descricao_atividade, $data_pagamento, $funcionario_id, $agencia_id, $pagamento_id);

                        // Executar a inserção da atividade
                        $stmtInsertAtividade->execute();

                        // Verificar se a inserção da atividade foi bem-sucedida
                        if ($stmtInsertAtividade->affected_rows > 0) {
                            echo "Atraso adicionado com sucesso e registrado na tabela de atividades.";
                        } else {
                            echo "Erro ao registrar atividade: " . $stmtInsertAtividade->error;
                        }

                        // Fechar a declaração preparada para a inserção da atividade
                        $stmtInsertAtividade->close();
                    } else {
                        echo "Erro na preparação da declaração SQL para a atividade: " . $conn->error;
                    }
                } else {
                    echo "Erro ao adicionar atraso: " . $stmtAtraso->error;
                }

                // Fechar a declaração preparada para a inserção do atraso
                $stmtAtraso->close();
            } else {
                echo "Erro na preparação da declaração SQL para o atraso: " . $conn->error;
            }
        } else {
            echo "Nenhum produto encontrado para o ID: $id_produto";
        }
    } else {
        echo "Nenhuma submissão encontrada para o ID: $id_submissao";
    }
} else {
    echo "Método inválido de requisição.";
}
?>

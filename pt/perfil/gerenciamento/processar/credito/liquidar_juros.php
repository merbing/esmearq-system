<?php
include("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $id_atraso = $_POST["id_atraso"];
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];
    $data_pagamento = $_POST["data_pagamento"];
    $id_submissao = $_POST["id_submissao"];
    $pagamento_id = $_POST["pagamento_id"];

    // Atualizando o status do montante na tabela de atrasos
    $queryUpdateAtraso = "UPDATE atrasos_pagamento SET status = 'Confirmado', funcionario_id = '$funcionario_id', data_atraso = '$data_pagamento' WHERE id_atraso = $id_atraso";
    $resultUpdateAtraso = $conn->query($queryUpdateAtraso);

    if ($resultUpdateAtraso) {
        // Registrando a atividade na tabela atividades
        $descricao_atividade = "Dívida liquidada para o pagamento com ID: $pagamento_id";
        $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado) VALUES ('$descricao_atividade', 'Completo', '$data_pagamento', $funcionario_id, $agencia_id, $pagamento_id)";
        $resultInsertAtividade = $conn->query($queryInsertAtividade);

        if ($resultInsertAtividade) {
            // Redirecionar após o sucesso
            header("Location:../../pagamento_credito.php?status=sucesso&pagamento_selecionado=$pagamento_id&credito_selecionado=$id_submissao");
        } else {
            echo "Erro ao registrar a atividade: " . $conn->error;
        }
    } else {
        echo "Erro ao atualizar o status da dívida: " . $conn->error;
    }
} else {
    echo "Método inválido de requisição.";
}
?>

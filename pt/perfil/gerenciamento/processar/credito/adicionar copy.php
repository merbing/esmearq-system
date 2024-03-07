<?php

include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST["cliente_id"];
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];
    $produto_id = $_POST["produto_id"];
    $valor_desejado = $_POST["valor_desejado"];
    $periodo_meses = $_POST["periodo_meses"];
    $finalidade_credito = $_POST["finalidade_credito"];
    $nome_pai = $_POST["nome_pai"];
    $nome_mae = $_POST["nome_mae"];
    $morada_bi = $_POST["morada_bi"];
    $localidade_bi = $_POST["localidade_bi"];
    $provincia_bi = $_POST["provincia_bi"];
    $despesas_mensais = $_POST["despesas_mensais"];
    $nome_conjuge = $_POST["nome_conjuge"];
    $telefone_conjuge = $_POST["telefone_conjuge"];
    $natureza_entidade_empregadora = $_POST["natureza_entidade_empregadora"];
    $setor_entidade_empregadora = $_POST["setor_entidade_empregadora"];
    $denominacao_entidade_empregadora = $_POST["denominacao_entidade_empregadora"];
    $departamento_cliente_empresa = $_POST["departamento_cliente_empresa"];
    $antiguidade_meses = $_POST["antiguidade_meses"];
    $cargo = $_POST["cargo"];
    $morada_entidade_empregadora = $_POST["morada_entidade_empregadora"];
    $morada_profissional = $_POST["morada_profissional"];
    $contacto_entidade_empregadora = $_POST["contacto_entidade_empregadora"];

    // 1. Inserir novo crédito na tabela submissao_credito
    $sql_inserir_credito = "INSERT INTO submissao_credito (id_cliente, id_agencia, id_funcionario, id_produto, valor_solicitado, prazo, finalidade, nome_pai, nome_mae, morada_bi, localidade_bi, provincia_bi, despesas_mensais, nome_conjuge, telefone_conjuge, natureza_entidade_empregadora, setor_entidade_empregadora, denominacao_entidade_empregadora, departamento_cliente_empresa, antiguidade_meses, cargo, morada_entidade_empregadora, morada_profissional, contacto_entidade_empregadora)
         VALUES ('$cliente_id', '$agencia_id', '$funcionario_id', '$produto_id', '$valor_desejado', '$periodo_meses', '$finalidade_credito', '$nome_pai', '$nome_mae', '$morada_bi', '$localidade_bi', '$provincia_bi', '$despesas_mensais', '$nome_conjuge', '$telefone_conjuge', '$natureza_entidade_empregadora', '$setor_entidade_empregadora', '$denominacao_entidade_empregadora', '$departamento_cliente_empresa', '$antiguidade_meses', '$cargo', '$morada_entidade_empregadora', '$morada_profissional', '$contacto_entidade_empregadora')";
    
    if ($conn->query($sql_inserir_credito) === TRUE) {
        // 2. Consultar o último crédito adicionado por este funcionário
        $sql_consulta_ultimo_credito = "SELECT id_submissao FROM submissao_credito WHERE id_funcionario = '$funcionario_id' ORDER BY id_submissao DESC LIMIT 1";
        $resultado_consulta = $conn->query($sql_consulta_ultimo_credito);

        if ($resultado_consulta->num_rows > 0) {
            $row = $resultado_consulta->fetch_assoc();
            $ultimo_credito_id = $row["id_submissao"];

            // 3. Determinar o status de aprovação ou reprovação
            $status_aprovacao = "Aprovado"; // ou "Reprovado", dependendo do seu cenário
            $observacoes = "Cliente É Legível";
            $nivel_aprovacao = $cargo_id; // Usar o cargo_id como nível de aprovação

            // 4. Encaminhar para aprovação de níveis superiores, se necessário
            if ($cargo_id == 0) {
                // Analista: Encaminhar para Supliervisor
                $status_aprovacao = "Aguardando Aprovação do Supervisor";
            } elseif ($cargo_id == 1) {
                // Supervisor: Encaminhar para Diretor
                $status_aprovacao = "Aguardando Aprovação do Diretor";
            }

            // 5. Inserir na tabela historico_creditos ou historico_creditos_reprovados
            if ($status_aprovacao == "Aprovado") {
                $sql_inserir_historico = "INSERT INTO historico_creditos (id_submissao, data_aprovacao, status_aprovacao, observacoes, nivel_aprovacao, responsavel_aprovacao, id_agencia)
                    VALUES ('$ultimo_credito_id', NOW(), '$status_aprovacao', '$observacoes', '$nivel_aprovacao', '$responsavel_aprovacao', '$agencia_id')";
            } else {
                $sql_inserir_historico = "INSERT INTO historico_creditos_reprovados (id_submissao, data_reprovacao, status_reprovacao, observacoes, nivel_reprovacao, responsavel_reprovacao, id_agencia)
                    VALUES ('$ultimo_credito_id', NOW(), '$status_aprovacao', '$observacoes', '$nivel_aprovacao', '$responsavel_aprovacao', '$agencia_id')";
            }

            if ($conn->query($sql_inserir_historico) === TRUE) {
                // 6. Inserir na tabela atividades
                $descricao_atividade = "Cadastro de Crédito";
                $data_inicio = date("Y-m-d H:i:s");

                $sql_insert_atividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                    VALUES ('$descricao_atividade', 'Completo', '$data_inicio', '$funcionario_id', '$agencia_id', '$ultimo_credito_id')";

                if ($conn->query($sql_insert_atividade) === TRUE) {
                    echo "Operações realizadas com sucesso!";
                } else {
                    echo "Erro ao inserir atividade: " . $conn->error;
                }
            } else {
                echo "Erro ao inserir histórico de crédito: " . $conn->error;
            }
        } else {
            echo "Erro ao consultar último crédito: " . $conn->error;
        }
    } else {
        echo "Erro ao inserir crédito: " . $conn->error;
    }

    $conn->close();
}
?>
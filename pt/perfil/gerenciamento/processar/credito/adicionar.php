<?php

include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST["cliente_id"];
    $funcionario_id = $_POST["funcionario_id"];
    $agencia_id = $_POST["agencia_id"];
    $produto_id = $_POST["produto_id"];
    $valor_desejado = $_POST["valor_solicitado"];
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
    $uagree = isset($_POST["uagree"]) ? 1 : 0;

    // Insert new credit into submissao_credito table
    $sql_insert_credit = "INSERT INTO
         submissao_credito (id_cliente, id_agencia, id_funcionario, id_produto, valor_solicitado, prazo, finalidade, nome_pai, nome_mae, morada_bi, localidade_bi, provincia_bi, despesas_mensais, nome_conjuge, telefone_conjuge, natureza_entidade_empregadora, setor_entidade_empregadora, denominacao_entidade_empregadora, departamento_cliente_empresa, antiguidade_meses, cargo, morada_entidade_empregadora, morada_profissional, contacto_entidade_empregadora)
         VALUES 
         ('$cliente_id', '$agencia_id', '$funcionario_id', '$produto_id', '$valor_desejado', '$periodo_meses', '$finalidade_credito', '$nome_pai', '$nome_mae', '$morada_bi', '$localidade_bi', '$provincia_bi', '$despesas_mensais', '$nome_conjuge', '$telefone_conjuge', '$natureza_entidade_empregadora', '$setor_entidade_empregadora', '$denominacao_entidade_empregadora', '$departamento_cliente_empresa', '$antiguidade_meses', '$cargo', '$morada_entidade_empregadora', '$morada_profissional', '$contacto_entidade_empregadora')";

    if ($conn->query($sql_insert_credit) === TRUE) {
        // Get the last credit added by this employee
        $sql_last_credit = "SELECT id_submissao FROM submissao_credito WHERE id_funcionario = '$funcionario_id' ORDER BY id_submissao DESC LIMIT 1";
        $result_last_credit = $conn->query($sql_last_credit);

        if ($result_last_credit->num_rows > 0) {
            $row = $result_last_credit->fetch_assoc();
            $last_credit_id = $row["id_submissao"];

            // Insert complete activity into atividades table
            $complete_activity_description = "Cadastro de Crédito";
            $complete_activity_start_date = date("Y-m-d H:i:s");

            $sql_insert_complete_activity = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                VALUES ('$complete_activity_description', 'Completo', '$complete_activity_start_date', '$funcionario_id', '$agencia_id', '$last_credit_id')";

            if ($conn->query($sql_insert_complete_activity) === TRUE) {
                // Insert incomplete activity into atividades table
                $incomplete_activity_description = "Status de Solicitação de Crédito";
                $incomplete_activity_start_date = date("Y-m-d H:i:s");

                $sql_insert_incomplete_activity = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                    VALUES ('$incomplete_activity_description', 'Incompleto', '$incomplete_activity_start_date', '$funcionario_id', '$agencia_id', '$last_credit_id')";

                if ($conn->query($sql_insert_incomplete_activity) === TRUE) {
                    header("location: ../../status_credito?credito_selecionado=$last_credit_id");
                    #echo "Operações realizadas com sucesso!";
                } else {
                    echo "Erro ao inserir atividade incompleta: " . $conn->error;
                }
            } else {
                echo "Erro ao inserir atividade completa: " . $conn->error;
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
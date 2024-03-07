<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $credito_id = $_POST["credito_id"];
    $cargo_id = $_POST["cargo_id"];
    $agencia_id = $_POST["agencia_id"];
    $funcionario_id = $_POST["funcionario_id"];

include("../../../../banco/config.php");

// Function to update status in submission_credito table
function updateSubmissionCreditoStatus($credito_id, $status) {
    global $conn;

    $sql = "UPDATE submissao_credito SET status = '$status' WHERE id_submissao = $credito_id";

    if ($conn->query($sql) !== TRUE) {
        return "Error updating status in submissao_credito: " . $conn->error;
    }

    return true;
}

// Function to log approval action in atividades table
function logApprovalAction($credito_id, $agencia_id, $funcionario_id) {
    global $conn;

    $descricao_atividade = "Aprovação de Crédito";
    $data_inicio = date("Y-m-d H:i:s");

    $sql = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
            VALUES ('$descricao_atividade', 'Completo', '$data_inicio', '$funcionario_id', '$agencia_id', '$credito_id')";

    if ($conn->query($sql) !== TRUE) {
        return "Error inserting approval action in atividades: " . $conn->error;
    }

    return true;
}

// Function to record final approval in historico_aprovacao table
function recordFinalApproval($credito_id, $status, $agencia_id, $funcionario_id) {
    global $conn;

    // Verificar se já existe um registro de aprovação final na tabela de aprovação
    $sql_check = "SELECT * FROM historico_aprovacao WHERE id_submissao = '$credito_id' AND nivel_aprovacao = 'Aprovação Final'";
    $result_check = $conn->query($sql_check);

    if ($result_check && $result_check->num_rows > 0) {
        return "Aprovação final já registrada anteriormente.";
    }

    // Inserir na tabela de histórico de aprovação
    $sql = "INSERT INTO historico_aprovacao (id_submissao, data_aprovacao, status_aprovacao, nivel_aprovacao, responsavel_aprovacao, id_agencia)
            VALUES ('$credito_id', NOW(), '$status', 'Aprovação Final', '$funcionario_id', '$agencia_id')";

    if ($conn->query($sql) !== TRUE) {
        return "Error recording final approval in historico_aprovacao: " . $conn->error;
    }

    return true;
}

// Function to get status based on cargo_id
function getStatusByCargoId($cargo_id) {
    if ($cargo_id == 1) {
        return "Aprovado Por Supervisor";
    } elseif ($cargo_id == 2 || $cargo_id == 3) {
        return "Aprovado Por Diretor";
    } elseif ($cargo_id == 0) {
        return "Aprovado Por Analista";
    } else {
        return "Status Indefinido";
    }
}

function getCargoIdByStatus($status) {
    switch ($status) {
        case "Aprovado Por Analista":
            return 0;
        case "Reprovado Por Analista":
            return 0;
        case "Aprovado Por Supervisor":
            return 1;
        case "Reprovado Por Supervisor":
            return 1;
        case "Aprovado Por Diretor":
            return 2;
        case "Reprovado Por Diretor":
            return 2;
        // Add more cases for other statuses if needed
        default:
            return -1; // Indicate an unknown status
    }
}


// Function to check if submission_credito is already approved by a superior
function isAlreadyApprovedBySuperior($conn, $credito_id, $cargo_id) {
    if (!$credito_id) {
        echo "Erro: ID do crédito não foi selecionado.";
        exit;
    }

    // Get the status from the database
    $sql = "SELECT status FROM submissao_credito WHERE id_submissao = $credito_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $database_status = $row['status'];

        // Define the numeric cargo_id based on the status
        $cargo_anterior = getCargoIdByStatus($database_status);

        // Check if the logged-in user is a superior
        return ($cargo_id < $cargo_anterior);
    } else {
        echo "Erro ao obter o status do banco de dados.";
        exit;
    }
}

// Example of how to use the function
if (isAlreadyApprovedBySuperior($conn, $credito_id, $cargo_id)) {
    header("Location: ../../status_credito?credito_selecionado=$credito_id&status=nao_possivel_atualizar_superior");
    exit;
}



// Function to handle credit approval
function approveCredit($credito_id, $cargo_id, $agencia_id, $funcionario_id) {
    global $conn;


    // 1. Update status in submission_credito based on cargo_id
    $status = getStatusByCargoId($cargo_id);
    if (!updateSubmissionCreditoStatus($credito_id, $status)) {
        header("Location: ../../status_credito?credito_selecionado=$credito_id&status=erro_atualizacao");
        exit;
    }

    // 2. Log approval action in activities table
    if (!logApprovalAction($credito_id, $cargo_id, $agencia_id, $funcionario_id)) {
        header("Location: ../../status_credito?status=erro_log_approval");
        exit;
    }

    // 3. Check if it's a final approval (cargo_id 2 or 3)
    if ($cargo_id == 2 || $cargo_id == 3) {
        // 4. Record final approval in historico_aprovacao table
        $final_approval_result = recordFinalApproval($credito_id, $status, $agencia_id, $funcionario_id);
        if ($final_approval_result !== true) {
            header("Location: ../../status_credito?credito_selecionado=$credito_id&status=" . $final_approval_result);
            exit;
        }
    }

    header("Location: ../../status_credito?credito_selecionado=$credito_id&status=aprovacao_completa");
    exit;
}


    approveCredit($credito_id, $cargo_id, $agencia_id, $funcionario_id);
} else {
    header("Location: ../../status_credito?credito_selecionado=$credito_id&status=metodo_invalido");
    exit;
}
?>

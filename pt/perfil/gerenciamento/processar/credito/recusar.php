<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $credito_id = $_POST["credito_id"];
    $cargo_id = $_POST["cargo_id"];
    $agencia_id = $_POST["agencia_id"];
    $funcionario_id = $_POST["funcionario_id"];
    $motivo_recuso = isset($_POST["motivo_recuso"]) ? $_POST["motivo_recuso"] : "";

    include("../../../../banco/config.php");

    // Function to update status in submission_credito table
    function updateSubmissionCreditoStatus($credito_id, $status, $motivo_recuso = "")
    {
        global $conn;

        if ($status === "Reprovado Por Analista" && empty($motivo_recuso)) {
            handleError("motivo_recuso_vazio");
        }

        // Update status and motivo_recuso if rejecting
        $update_fields = "";
        if ($motivo_recuso !== "") {
            $update_fields = ", motivo_recuso = '$motivo_recuso'";
        }

        $sql = "UPDATE submissao_credito SET status = '$status' $update_fields WHERE id_submissao = $credito_id";

        if ($conn->query($sql) !== TRUE) {
            handleError("erro_atualizacao");
        }

        return true;
    }

    // Function to log credit action in atividades table
    function logCreditAction($credito_id, $cargo_id, $agencia_id, $funcionario_id, $action)
    {
        global $conn;

        $descricao_atividade = ($action == "aprovacao") ? "Aprovação de Crédito" : "Reprovação de Crédito";
        $data_inicio = date("Y-m-d H:i:s");

        $sql = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
            VALUES ('$descricao_atividade', 'Completo', '$data_inicio', '$funcionario_id', '$agencia_id', '$credito_id')";

        if ($conn->query($sql) !== TRUE) {
            handleError("erro_log_approval");
        }

        return true;
    }

    // Function to record final action in historico_aprovacao table
// Function to record final action in historico_aprovacao table
function recordFinalAction($credito_id, $status, $agencia_id, $funcionario_id, $action)
{
    global $conn;

    // Check if it's a final approval or rejection
    $nivel_aprovacao = ($action == "aprovacao") ? "Aprovação Final" : "Reprovação Final";

    // Check if a final action is already recorded
    $sql_check = "SELECT 1 FROM historico_aprovacao WHERE id_submissao = '$credito_id'";
    $result_check = $conn->query($sql_check);

    if ($result_check && $result_check->num_rows > 0) {
        handleError("{$action}_final_ja_registrada");
    }

    // Insert into the historico_aprovacao table
    $sql = "INSERT INTO historico_aprovacao (id_submissao, data_aprovacao, status_aprovacao, nivel_aprovacao, responsavel_aprovacao, id_agencia)
        VALUES ('$credito_id', NOW(), '$status', '$nivel_aprovacao', '$funcionario_id', '$agencia_id')";

    if ($conn->query($sql) !== TRUE) {
        handleError("erro_record_final_approval: " . $conn->error);
    }

    return true;
}


    // Function to get status based on cargo_id
    function getStatusByCargoId($cargo_id, $action)
    {
        if ($action == "aprovacao") {
            switch ($cargo_id) {
                case 1:
                    return "Aprovado Por Supervisor";
                case 2:
                case 3:
                    return "Aprovado Por Diretor";
                case 0:
                    return "Aprovado Por Analista";
                default:
                    return "Status Indefinido";
            }
        } elseif ($action == "reprovacao") {
            switch ($cargo_id) {
                case 1:
                    return "Reprovado Por Supervisor";
                case 2:
                case 3:
                    return "Reprovado Por Diretor";
                case 0:
                    return "Reprovado Por Analista";
                default:
                    return "Status Indefinido";
            }
        } else {
            return "Status Indefinido";
        }
    }

    // Function to handle errors
    function handleError($error)
    {
        global $credito_id;
        header("Location: ../../status_credito?credito_selecionado=$credito_id&status=$error");
        exit;
    }

    // Update status for approval
    $approval_status = getStatusByCargoId($cargo_id, "aprovacao");
    updateSubmissionCreditoStatus($credito_id, $approval_status);

    // Log approval action
    logCreditAction($credito_id, $cargo_id, $agencia_id, $funcionario_id, "aprovacao");

    // Update status for rejection
    $rejection_status = getStatusByCargoId($cargo_id, "reprovacao");
    updateSubmissionCreditoStatus($credito_id, $rejection_status, $motivo_recuso);

    // Record final action for rejection
    recordFinalAction($credito_id, $rejection_status, $agencia_id, $funcionario_id, "reprovacao");

    // Redirect after processing
    if (strpos($approval_status, "Aprovado") !== false) {
        header("Location: ../../status_credito?credito_selecionado=$credito_id&status=aprovacao_completa");
        exit;
    } elseif (strpos($rejection_status, "Reprovado") !== false) {
        header("Location: ../../status_credito?credito_selecionado=$credito_id&status=reprovacao_completa");
        exit;
    } else {
        handleError("status_indefinido");
    }

} else {
    global $credito_id;
    header("Location: ../../status_credito?credito_selecionado=$credito_id&status=metodo_invalido");
    exit;
}
?>

<?php
include("../../../../banco/config.php");

// 1. Receber dados da URL
$status = $_GET["status"];
$conta_do_cliente = base64_decode($_GET["conta_do_cliente"]);
$funcionario_id = $_GET["funcionario_id"];

// 2. Validar dados
if (!isset($status) || !isset($conta_do_cliente) || !isset($funcionario_id)) {
  header("Location: ../../../?erro=" . urlencode("Dados inválidos."));
  exit();
}

if ($status != "aprovar" && $status != "reprovar") {
  header("Location: ../../../?erro=" . urlencode("Status inválido."));
  exit();
}

// 3. Obter informações do cliente
$queryGetCliente = "SELECT * FROM usuarios WHERE id=?";
$stmtGetCliente = $conn->prepare($queryGetCliente);
$stmtGetCliente->bind_param("i", $conta_do_cliente);
$stmtGetCliente->execute();
$resultGetCliente = $stmtGetCliente->get_result();
$cliente = $resultGetCliente->fetch_assoc();
$stmtGetCliente->close();

if (!$cliente) {
  header("Location: ../../../?erro=" . urlencode("Cliente não encontrado."));
  exit();
}

// 4. Atualizar status de verificação
$verificado = ($status == "aprovar") ? 1 : 2;
$queryUpdateVerificado = "UPDATE usuarios_extra_info SET verificado=? WHERE usuario_id=?";
$stmtUpdateVerificado = $conn->prepare($queryUpdateVerificado);
$stmtUpdateVerificado->bind_param("ii", $verificado, $conta_do_cliente);

if ($stmtUpdateVerificado->execute()) {
  $stmtUpdateVerificado->close();

  // 5. Registrar na tabela de atividades
  $descricao_atividade = ($status == "aprovar") ? "Aprovação de Conta de Cliente" : "Reprovação de Conta de Cliente";
  $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado) VALUES (?, ?, NOW(), ?, ?, ?)";
  $stmtInsertAtividade = $conn->prepare($queryInsertAtividade);
  $stmtInsertAtividade->bind_param("ssiii", $descricao_atividade, $status, $funcionario_id, $cliente["agencia_id"], $conta_do_cliente);

  if ($stmtInsertAtividade->execute()) {
    $stmtInsertAtividade->close();
    $conta_do_cliente = base64_encode($conta_do_cliente);

    // 6. Redirecionar para a página de sucesso
    $sucess_message = ($status == "aprovar") ? "Conta aprovada com sucesso!" : "Conta reprovada com sucesso!";
    header("Location: ../../../dados_cliente?conta_do_cliente=$conta_do_cliente&success_message=" . urlencode($sucess_message));
    exit();
  } else {
    // Tratamento de erro ao registrar atividade
    $stmtInsertAtividade->close();
    $erro_msg = "Erro ao registrar atividade. Por favor, tente novamente.";
  }
} else {
  // Tratamento de erro ao atualizar status de verificação
  $stmtUpdateVerificado->close();
  $erro_msg = "Erro ao atualizar status de verificação. Por favor, tente novamente.";
}

// 7. Redirecionar para a página de erro
header("Location: ../../../?erro=" . urlencode($erro_msg));
exit();
?>

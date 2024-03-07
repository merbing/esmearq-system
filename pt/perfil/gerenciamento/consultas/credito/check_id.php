<?php

function verificarParametro($parametro) {
    return isset($_GET[$parametro]) && !empty($_GET[$parametro]);
}

if (!verificarParametro('credito_selecionado')) {
    header("Location: ../../?status=credito_nao_encontrado");
    exit();
}

$credito_id = $_GET['credito_selecionado'];


$sql = "SELECT status FROM submissao_credito WHERE id_submissao = $credito_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // Se não encontrar o crédito, redirecione com uma mensagem de status
    header("Location: ../../?status=credito_nao_encontrado");
    exit();
}


?>

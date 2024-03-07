<?php
include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produto'])) {
    // Obter o ID do produto a ser removido
    $produto_id = $_POST['id_produto'];

    // Verificar se existem dependências antes de excluir
    $dependencias_query = "SELECT COUNT(*) AS total FROM submissao_credito WHERE id_produto=?";
    $stmt_dependencias = $conn->prepare($dependencias_query);
    $stmt_dependencias->bind_param("i", $produto_id);
    $stmt_dependencias->execute();
    $result_dependencias = $stmt_dependencias->get_result();
    $row_dependencias = $result_dependencias->fetch_assoc();
    $total_dependencias = $row_dependencias['total'];

    if ($total_dependencias > 0) {
        // Se houver dependências, redirecione com uma mensagem de erro
        $error_message = "Este produto possui dependências e não pode ser removido.";
        header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
        exit();
    }

    // Se não houver dependências, proceda com a exclusão do produto
    $query = "DELETE FROM produtos_microcredito WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $produto_id);
    $result = $stmt->execute();

    if ($result) {
        // Redirecionar para a página de sucesso e passar o status na URL
        $success_message = "Produto removido com sucesso!";
        header("Location: ../../produtos_lista?success_message=" . urlencode($success_message));
        exit();
    } else {
        // Se houver algum erro durante a exclusão, redirecione com uma mensagem de erro
        $error_message = "Ocorreu um erro ao remover o produto.";
        header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
        exit();
    }

    $stmt->close();
} else {
    // Se o método de requisição não for POST ou o ID do produto não estiver definido, redirecione com uma mensagem de erro
    $error_message = "Requisição inválida";
    header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
    exit();
}

$conn->close();
?>

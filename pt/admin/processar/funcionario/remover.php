<?php
include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_funcionario'])) {
    // Obter o ID do funcionário a ser removido
    $funcionario_id = $_POST['id_funcionario'];

    // Remover o funcionário do banco de dados
    $query = "DELETE FROM funcionarios WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $funcionario_id);
    $result = $stmt->execute();

    if ($result) {
        // Redirecionar para a página de sucesso e passar o status na URL
        $success_message = "Funcionário removido com sucesso!";
        header("Location: ../../funcionarios_lista?success_message=" . urlencode($success_message));
        exit();
    } else {
        // Redirecionar para a página de erro e passar o status na URL
        $error_message = "Algum erro ocorreu ao remover. Tente novamente!";
        header("Location: ../../funcionarios_lista?error_message=" . urlencode($error_message));
        exit();
    }

    $stmt->close();
} else {
    // Se o método de requisição não for POST ou o ID do funcionário não estiver definido, redirecionar para a página apropriada
    $error_message = "Requisição inválida";
    header("Location: ../../funcionarios_adicionar?error_message=" . urlencode($error_message));
    exit();}

$conn->close();
?>

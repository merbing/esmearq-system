<?php
include("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $funcionario_id = $_POST['funcionario_id'];
    $nome_funcionario = $_POST['nome_funcionario'];
    $cargo_id = $_POST['cargo_id'];
    $agencia_id = $_POST['agencia_id'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Atualizar os dados do funcionário no banco de dados
    $query = "UPDATE funcionarios SET nome_funcionario=?, cargo_id=?, agencia_id=?, email=?, telefone=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiisi", $nome_funcionario, $cargo_id, $agencia_id, $email, $telefone, $funcionario_id);
    $result = $stmt->execute();

    if ($result) {
        // Redirecionar para a página de sucesso e passar o status na URL
        $sucess_message = "Funcionario atualizado com sucesso!";
        header("Location: ../../funcionarios_lista?success_message=" . urlencode($sucess_message));
        exit();
    } else {
        // Redirecionar para a página de erro e passar o status na URL
        $error_message = "Erro ao atualizar funcionário. Tente Novamente!";
        header("Location: ../../funcionarios_editar?funcionario_selecionado=$funcionario_id&error_message=" . urlencode($error_message));
        exit();    }

} else {
    // Se o método de requisição não for POST, redirecionar para a página apropriada
    $error_message = "Erro ao aceder a página. Requisição não aprovada!";
    header("Location: ../../funcionarios_lista?error_message=" . urlencode($error_message));
    exit();    }

?>

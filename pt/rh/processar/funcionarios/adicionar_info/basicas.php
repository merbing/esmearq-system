<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $name = $_POST["name"];
    $agency = $_POST["agency"];
    $department = $_POST["department"];
    $role_id = $_POST["role_id"];
    $salary = $_POST["salary"];
    $address = $_POST["address"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $password = password_hash("1234",1);
    $query = "INSERT INTO funcionarios (nome, email, senha, papel_usuario, agencia, endereco, telefone,salario,departamento)
            VALUES ('$name', '$email', '$password', '$role_id', '$agency', '$address','$phonenumber','$salary','$department');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Cadastrado realizado com sucesso!";
        $_SESSION["success"] = "Funcionario Cadastrado com sucesso!"; 
        header("Location: ../../../adicionar.php");
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_files?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


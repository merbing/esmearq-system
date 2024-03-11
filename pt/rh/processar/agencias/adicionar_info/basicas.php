<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $name = $_POST["name"];
    $nif = $_POST["nif"];
    $birthdate = $_POST["birthdate"];
    $nationality = $_POST["nationality"];
    if(isset($foreingh_nationality)){
        $foreingh_nationality = $_POST["foreingh_nationality"];    
    }
    $address = $_POST["address"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $state = $_POST["state"];
    if($nationality == "Outra")
    {
        $nationality = $foreingh_nationality;
    }
    $query = "INSERT INTO clientes (nome, nif, data_de_nascimento, nacionalidade, estado_civil, endereco, telefone,email)
            VALUES ('$name', '$nif', '$birthdate', '$nationality', '$state', '$address','$phonenumber','$email');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Cadastrado realizado com sucesso!";
        $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
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


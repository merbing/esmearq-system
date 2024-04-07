<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    
    try{
        $name = htmlspecialchars($_POST["name"]);
        $agency = htmlspecialchars($_POST["agency"]);
        $department = htmlspecialchars($_POST["department"]);
        $role_id = $_POST["role_id"];
        $salary = htmlspecialchars($_POST["salary"]);
        $address = htmlspecialchars($_POST["address"]);
        $phonenumber = htmlspecialchars($_POST["phonenumber"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = password_hash("1234",1);
    
         // verify email
         $query = "SELECT * FROM funcionarios WHERE email = '$email'";
         $stmt = $conn->prepare($query);
         $stmt->execute();
         $result = $stmt->get_result();
     
         $cliente = null;
         if ($result->num_rows > 0) {
             $error_message = "Ocorreu um erro. Este email já está em uso";
             header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
             exit;
         }
         
        $query = "INSERT INTO funcionarios (nome, email, senha, papel_usuario, agencia, endereco, telefone,salario,departamento)
                VALUES ('$name', '$email', '$password', '$role_id', '$agency', '$address','$phonenumber','$salary','$department');";
        $result = $conn->query($query);
        
        
        if ($result === TRUE) {
            $encrypted_user_id = base64_encode($cliente_id);
            $sucess_message = "Cadastrado realizado com sucesso!";
            // $_SESSION["success"] = "Funcionario Cadastrado com sucesso!"; 
            header("Location: ../../../adicionar.php?success_message=" . urlencode($sucess_message));
            // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
    
        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro.";
            header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        exit;
    }


} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


<?php
session_start();
require_once("../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = mysqli_real_escape_string($conn,$_POST["email"]);
    $new = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["new"]));
    $confirm = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["confirm"]));

    try{
        if($new != $confirm){
            $error_message = "Ocorreu um erro. As senhas devem ser iguais";
            header("Location: ../update_password.php?idm=".base64_encode($mail)."&error_message=" . urlencode($error_message));
            exit;
        }
    
        $senha = password_hash($new,1);
        $query = "UPDATE freelancers SET senha='$senha' WHERE email='$mail'";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $encrypted_user_id = base64_encode($cliente_id);
    
            $sucess_message = "Senha alterada!";
            header("Location: ../success.php?success_message=" . urlencode($sucess_message));
            exit();
    
        } else {
            $error_message = "Ocorreu um erro.";
            header("Location: ../update_password.php?idm=".base64_encode($mail)."&error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Não foi possível alterar. Tente novamente";
        header("Location: ../update_password.php?idm=".base64_encode($mail)."&error_message=" . urlencode($error_message));
        exit;
    }
    
    
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../login.php");
    exit();
}

$conn->close();
?>


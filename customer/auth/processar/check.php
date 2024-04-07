<?php
session_start();
require_once("../../../banco/config.php");

// require_once("../utils/Log.php");
require_once("../../utils/Mail.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    try{
        $user_code = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["code"]));
        $mail = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["idm"]));
        $id = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["id_code"]));

        $query = "SELECT * FROM check_codes WHERE id = '$id'";
        $result = $conn->query($query);
       
        
        if ($result->num_rows > 0) {

            $code = $result->fetch_assoc();
            if($code['code'] == $user_code){
                $query = "UPDATE check_codes SET used=1 WHERE id= '$id';";
                $result = $conn->query($query);

                // $error_message = "Código Inválido.";
                header("Location: ../update_password.php?idm=".base64_encode($mail));
                exit;

            }else{
                // Usuário não encontrado
            $error_message = "Código Inválido.";
            header("Location: ../check.php?chkcd=".base64_encode($id)."&idm=".base64_encode($mail)."&error_message=" . urlencode($error_message));
            exit;
            }
           
        } else {
            // Usuário não encontrado
            $error_message = "Código Inválido.";
            header("Location: ../check.php?chkcd=".base64_encode($id)."&idm=".base64_encode($mail)."error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Código Inválido.";
            header("Location: ../check.php?chkcd=".base64_encode($id)."&idm=".base64_encode($mail)."error_message=" . urlencode($error_message));
            exit;
    }

} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../login.php");
    exit();
}

$conn->close();
?>


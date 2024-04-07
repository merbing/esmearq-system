<?php
session_start();
require_once("../../../banco/config.php");
require_once("../../../libs/PHPMailer/src/PHPMailer.php");
require_once("../../../libs/PHPMailer/src/Exception.php");
require_once("../../../libs/PHPMailer/src/SMTP.php");

// require_once("../utils/Log.php");
require_once("../../utils/Mail.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    try{
        $email = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["email"]));

        $verificar_usuario = "SELECT * FROM funcionarios WHERE email = '$email' AND ativo=1";
        $result = $conn->query($verificar_usuario);
       
        
        if ($result->num_rows > 0) {
            $funcionario = $result->fetch_assoc();
            
            // Conta Encontrada
            echo $funcionario['nome']."<br/>";
            // echo rand(0,9);
            $code = "";
            for($i=1;$i<=6;$i++){
                $code.= strval(rand(0,9));
            }

            echo $code;
            $query = "INSERT INTO check_codes (email,code) VALUES ('$email', '$code');";
            $result = $conn->query($query);
            $id = $conn->insert_id;
            if ($result === TRUE) {
                
                try{
                    // Enviar um Email  (Log)
                    $message = $code."é o seu código para recuperar sua conta.";
                    $mail = new Mail($email,"CÓDIGO DE RECUPERAÇÃO",$message);
                    
                    if($mail->send()){

                        $success_message = "Código enviado com sucesso!";
                        header("Location: ../../check.php?chkcd=".base64_encode($id)."&idm=".base64_encode($email)."&success_message=". urlencode($success_message));
                        exit();

                    }else{
                        $error_message = "Não foi possível enviar o código. Tente outra vez ";
                        $query = "UPDATE check_codes SET used=1 WHERE id= '$id';";
                        $result = $conn->query($query);

                        header("Location: ../../forgot.php?error_message=".urlencode($error_message));
                        exit();
                    }
                } catch(\Exception $e)
                {
                    
                    $error_message = "Não foi possível enviar o código. Tente outra vez ";


                    header("Location: ../../forgot.php?error_message=".urlencode($error_message));
                    exit();
                }
                exit;
                header("Location: ../../check.php?&error_message=" . urlencode($error_message));            
            

            } else {
                $error_message = "Não foi possível enviar código.Tente outra vez";
                header("Location: ../../forgot.php?error_message=" . urlencode($error_message));
                exit;
            }
            
            
        
        } else {
            // Usuário não encontrado
            $error_message = "Conta não encontrada.";
            header("Location: ../../forgot.php?&error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Não foi possível enviar código.Tente outra vez";
        header("Location: ../../forgot.php?&error_message=" . urlencode($error_message));
        exit;
    }

} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


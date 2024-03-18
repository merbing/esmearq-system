<?php
session_start();
require_once("../../../../../banco/config.php");

require_once("../../../../../libs/PHPMailer/src/PHPMailer.php");
require_once("../../../../../libs/PHPMailer/src/Exception.php");
require_once("../../../../../libs/PHPMailer/src/SMTP.php");

require_once("../../../../utils/Log.php");
require_once("../../../../utils/Mail.php");

// exit();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $terminar = $_POST['terminar'];
    $state_id = $_POST['state_id'];
    $processo_id = $_POST['processo_id'];
    $cliente_email = $_POST['cliente_email'];
    // echo $_POST['terminar'];
    // exit();

    if( isset($_POST['terminar']) &&  $_POST['terminar']=='1'){
        $query = "UPDATE processos SET estado_processo_id='$state_id' WHERE id = $processo_id;";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $encrypted_user_id = base64_encode($client_id);
            $sucess_message = "Processo Terminado com sucesso!";
            
            try{
                // Registar a actividade (Log)
                $log = new Log("Terminando  um processo",("ID:".$processo_id),$conn);
                $log->save();
            } catch(\Exception $e)
            {
            
            }

            try{
                // Enviar um Email para notificar o cliente (Log)
                $mail = new Mail($cliente_email,"Processo Terminado","O Seu processo nº".$processo_id." foi Terminado com successo. Obrigado");
                
                if($mail->send()){
                    // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
                    header("Location: ../../../lista.php?success_message=". urlencode($sucess_message));
                    // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    exit();
                }else{
                    $warning_message = "Não foi possível notificar o cliente! #".$mail->error;
                    header("Location: ../../../lista.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                    // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    exit();
                }

                
            } catch(\Exception $e)
            {
                
                $warning_message = "Não foi possível notificar o cliente! #".$e->getMessage();
                header("Location: ../../../lista.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                exit();
            }



            // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
            header("Location: ../../../lista.php?success_message=". urlencode($sucess_message));
            // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
 
        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro.";
            header("Location: ../../../terminar.php?processo_id=".base64_encode($processo_id)."&error_message=" . urlencode($error_message));
            exit;
        }
    }else{
            // $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro. Dados não confirmados.";
            header("Location: ../../../terminar.php?processo_id=".base64_encode($processo_id)."&error_message=" . urlencode($error_message));
            exit;
    }

    
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


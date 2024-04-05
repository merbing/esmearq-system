<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");
require_once("../../libs/PHPMailer/src/PHPMailer.php");
require_once("../../libs/PHPMailer/src/Exception.php");
require_once("../../libs/PHPMailer/src/SMTP.php");

require_once("../utils/Log.php");
require_once("..//utils/Mail.php");

    //  // verificar se  o utilizador tem permissao para ver essa pagina
    //  if(!in_array("Ver Clientes",$permissoes) ){
    //     header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
     
    //  }
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    try{
        $viagem_id = base64_decode($_GET["viagem_id"]);
    
        $query = "SELECT C.nome as client_name, C.id as client_id,C.email,
        V.id, V.data_viagem, V.hora_viagem, V.realizado, V.destino FROM viagens V
        INNER JOIN clientes C on(C.id = V.id_cliente) WHERE V.id = '$viagem_id'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $viagem = null;
        if ($result->num_rows > 0) {
            $viagem = $result->fetch_assoc();
        }
        else{
            $viagem = null;
        }
    
        if($viagem) {
            try{
                // Enviar um Email para notificar o cliente (Log)
                $message = "A sua viagem para ".$viagem['destino']." está marcada para o dia 
                            ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado";
                $mail = new Mail($viagem['email'],"Sua Viagem se aproxima",$message);
                
                if($mail->send()){
                    // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
                    $success_message = "Notificação enviada com sucesso! #".$mail->error;
                    header("Location: lista_viagens.php?success_message=". urlencode($sucess_message));
                    // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    exit();
                }else{
                    $warning_message = "Não foi possível notificar o cliente! #".$mail->error;
                    header("Location: lista_viagens.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                    // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    exit();
                }

                
            } catch(\Exception $e)
            {
                
                $warning_message = "Não foi possível notificar o cliente! #".$e->getMessage();
                header("Location: lista_viagens.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                exit();
            }



        } else {
            $error_message = "Ocorreu um erro. Viagem não encontrada";
            header("Location: lista_viagens.php?error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente Novamente";
        header("Location: lista_viagens.php?error_message=" . urlencode($error_message));
        exit;
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['client_id']) && $_POST['client_id']!="")
    {
        try{
            
            $client_id = $_POST['client_id'];
            $query = "SELECT C.nome as client_name, C.id as client_id, C.email, COUNT(D.id) as qtd from clientes C 
            INNER JOIN clientes_documentos D ON (D.cliente_id = C.id)
            WHERE D.data_validade < CURRENT_DATE
            AND  C.id = $client_id 
            Group by C.nome,C.id,C.email; ";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $cliente = null;
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
            }
            
            if($cliente != null) {
                
                try{
                    // Enviar um Email para notificar o cliente (Log)
                    $message = "Saudações, Você tem ".$cliente['qtd']." documento(s) com a data de validade expirada. Por favor regularize a sua situação.";
                    $mail = new Mail($cliente['email'],"DOCUMENTO EXPIRADO",$message);
                    
                    if($mail->send())
                    {
                        $data = [
                            "status" => "success",
                            "message" => "Email enviado com sucesso"
                        ];
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($data);
                    }else{
                        $data = [
                            "status" => "error",
                            "message" => "Erro ao enviar email"
                        ];
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($data);
                    }
                    // if($mail->send()){
                    //     $success_message = "Notificação enviada com sucesso! #".$mail->error;
                    //     header("Location: ../../../lista_viagens.php?success_message=". urlencode($sucess_message));
                    //     // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    //     exit();
                    // }else{
                    //     $warning_message = "Não foi possível notificar o cliente! #".$mail->error;
                    //     header("Location: ../../../lista_viagens.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                    //     // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    //     exit();
                    // }
    
                    
                } catch(\Exception $e)
                {
                    $data = [
                        "status" => "error",
                        "message" => $e->getMessage()
                    ];
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($data);
                }

            }else{
                $data = [
                    "status" => "error",
                    "message" => "Cliente não encontrado"
                ];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }

            

        }catch(Exception $e)
        {
            $data = [
                "status" => "error",
                "message" => "Não foi possível notificar clientes",
                "details" => $e->getMessage()
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    }else{
        $data = [
            "status" => "error",
            "message" => "Não foi possível notificar clientes"
        ];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    
} 
else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


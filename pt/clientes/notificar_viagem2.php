<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");
require_once("../../libs/PHPMailer/src/PHPMailer.php");
require_once("../../libs/PHPMailer/src/Exception.php");
require_once("../../libs/PHPMailer/src/SMTP.php");

require_once("../utils/Log.php");
require_once("..//utils/Mail.php");

// $query = "SELECT C.nome as client_name, C.id as client_id,C.email,
// V.id, V.data_viagem, V.hora_viagem, V.realizado, V.destino, DATEDIFF(V.data_viagem,CURDATE()) as dias_faltando FROM viagens V
// INNER JOIN clientes C on(C.id = V.id_cliente) 
// WHERE DATEDIFF(V.data_viagem,CURDATE()) <=$days";



        try{
            
            // BUSCAR AS VIAGENS
            $query = "SELECT C.nome as client_name, C.id as client_id,C.email,
            V.id, V.data_viagem, V.hora_viagem, V.realizado, V.destino, DATEDIFF(V.data_viagem,CURDATE()) as dias_faltando FROM viagens V
            INNER JOIN clientes C on(C.id = V.id_cliente) 
            WHERE CURDATE() <= V.data_viagem  AND V.realizado = 0";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $viagens = [];
            if ($result->num_rows > 0) {
                while($viagem = $result->fetch_assoc()){
                    $viagens[] = $viagem;
                }
            }
            else{
                $viagens = [];
            }
            
            $total = count($viagens);
            $sent = 0;
            $errors = 0; 
            foreach($viagens as $viagem) {
                
                try{


                    // BUSCAR AS NOTIFICAÇÕES PARA ESSA VIAGEM
                    $id_viagem = $viagem['id'];
                    $query = "SELECT * FROM notificacoes_viagens WHERE id_viagem = '$id_viagem'";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $notificacao = null;
                    if ($result->num_rows > 0) {
                        // TEM REGISTRO
                        // Ja tem um registro de notificacao
                        $notificacao = $result->fetch_assoc();
                        // echo "- JA TEM REGISTRO - ";
                        $data_viagem = $viagem['data_viagem'];
                        $hoje = date("Y-m-d");
                        if($data_viagem == $hoje){
                            // data da viagem é hoje
                            // echo " - DATA DE VIAGEM É HOJE - ";

                            // verificar se ja foi notificado
                            if($notificacao['no_dia']==1){
                                // echo " - JÁ FOI NOTIFICADO HOJE - ";
                                // exit;

                            }else{
                                // echo " - AINDA NAO FOI NOTIFICADO HOJE - ";
                                // Enviar um Email para notificar o cliente (Log)
                                $message = "A ESMEARQ deseja que tenha uma BOA VIAGEM! Muito obrigado por preferir os nossos serviços.";
                                $mail = new Mail($viagem['email'],"CHEGOU O DIA",$message);
                                if($mail->send()){
                                    $sent++;
                                    // Actualizar o registro de notificacao
                                    $query_notify = "UPDATE notificacoes_viagens SET no_dia=1 WHERE id =".$notificacao['id'];
                                    $result = $conn->query($query_notify);

                                    // echo "Mensagem enviada";
                                    // $sent++;
                                    // exit;
                                }else{

                                }
                            }
                            
                        }else{
                            // echo " -- DATA NÃO É HOJE -- ";
                            $origin = date_create($hoje);
                            $target = date_create($data_viagem);
                            $interval = date_diff($origin, $target,true);
                            // var_dump($interval);
                            // echo " -- FALTAM ".$interval->days." DIAS --";
                            $dias_faltando = $interval->days;
                            if($interval->days <=7){
                                // ULTIMOS 7 DIAS
                                // echo " -- FALTAM MENOS DE 7 DIAS --";
                                if($hoje == $notificacao['ultimos_sete_dias']){
                                    // echo " -- HOJE JA FOI NOTIFICADO --";
                                    
                                }else{
                                    // echo " -- HOJE NAO FOI NOTIFICADO --";
                                    // Enviar um Email para notificar o cliente (Log)
                                    $message = "SUA VIAGEM SE APROXIMA. A sua viagem para ".$viagem['destino']." está marcada para o dia 
                                    ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado"; 
                                    $mail = new Mail($viagem['email'],"FALTAM ".$dias_faltando." DIAS",$message);
                                    if($mail->send()){
                                        $sent++;
                                        // Actualizar o registro de notificacao
                                        $query_notify = "UPDATE notificacoes_viagens SET ultimos_sete_dias='$hoje' WHERE id =".$notificacao['id'];
                                        $result = $conn->query($query_notify);

                                        // echo "Mensagem enviada";
                                        // $sent++;
                                        // exit;
                                    }else{

                                    }

                                }
                            }else{
                                // echo " -- FALTAM MAIS DE 7 DIAS --";
                                // echo " -- NOTIFICACAO A CADA 7 DIAS --";

                                if($notificacao['ultima_notificacao']==null){
                                    // echo "AINDA NAO FOI NOTIFICADO";

                                    $message = " A sua viagem para ".$viagem['destino']." está marcada para o dia 
                                    ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado"; 
                                    $mail = new Mail($viagem['email'],"SUA VIAGEM SE APROXIMA",$message);
                                    if($mail->send()){
                                        $sent++;
                                        // Actualizar o registro de notificacao
                                        $query_notify = "UPDATE notificacoes_viagens SET ultima_notificacao='$hoje' WHERE id =".$notificacao['id'];
                                        $result = $conn->query($query_notify);

                                        // echo "Mensagem enviada";
                                        // $sent++;
                                        // exit;
                                    }else{

                                    }
                                    
                                }else{
                                    // echo "-- JA FOI NOTIFICADO -- ";
                                    $ultima_notificacao = date_create($notificacao['ultima_notificacao']);
                                    $alvo = date_create($hoje);
                                    $intervalo = date_diff($ultima_notificacao, $alvo,true);
                                    if($intervalo->days >=7){
                                        // echo " -- JA PASSOU 7 DIAS DESDE A ULTIMA NOTIFICACAO";
                                        $message = " A sua viagem para ".$viagem['destino']." está marcada para o dia 
                                        ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado"; 
                                        $mail = new Mail($viagem['email'],"SUA VIAGEM SE APROXIMA",$message);
                                        if($mail->send()){
                                            $sent++;
                                            // Actualizar o registro de notificacao
                                            $query_notify = "UPDATE notificacoes_viagens SET ultima_notificacao='$hoje' WHERE id =".$notificacao['id'];
                                            $result = $conn->query($query_notify);

                                            // echo "Mensagem enviada";
                                            // $sent++;
                                            // exit;
                                        }else{

                                        }
                                    }else{
                                        // echo " -- AINDA NAO PASSOU 7 DIAS DESDE A ULTIMA NOTIFICACAO";
                                    }

                                }
                            }

                            // exit;
                        }

                    }
                    else{
                        // NAO TEM REGISTRO
                        // Não tem nenhum registro de notificacao para essa viagem
                        // Inserir um novo registro
                        // echo "NAO TEM REGISTRO";
                        // Verificar se a data de viagem é hoje
                        // echo "Viagem - ".$viagem['client_name'];
                        $data_viagem = $viagem['data_viagem'];
                        $hoje = date("Y-m-d");

                        if($data_viagem == $hoje){
                            // data da viagem é hoje
                            // echo "HOJE";

                            // Enviar um Email para notificar o cliente (Log)
                            $message = "A ESMEARQ deseja que tenha uma BOA VIAGEM! Muito obrigado por preferir os nossos serviços.";
                            $mail = new Mail($viagem['email'],"CHEGOU O DIA",$message);
                            if($mail->send()){
                                $sent++;
                                // Registar a notificacao
                                $query_notify = "INSERT INTO notificacoes_viagens(id_viagem,no_dia)
                                VALUES ($id_viagem,1);";
                                $result = $conn->query($query_notify);

                                // echo "Mensagem enviada";
                                // $sent++;
                                // exit;
                            }else{

                            }
                        }else{
                            // echo " -- DATA NÃO É HOJE -- ";
                            $origin = date_create($hoje);
                            $target = date_create($data_viagem);
                            $interval = date_diff($origin, $target,true);
                            // var_dump($interval);
                            // echo " -- FALTAM ".$interval->days." DIAS --";
                            $dias_faltando = $interval->days;
                            if($interval->days <=7){
                                // ULTIMOS 7 DIAS
                                // echo " -- FALTAM MENOS DE 7 DIAS --";
                                // echo " -- NAO FOI NOTIFICADO AINDA--";
                                    // Enviar um Email para notificar o cliente (Log)
                                    $message = "SUA VIAGEM SE APROXIMA. A sua viagem para ".$viagem['destino']." está marcada para o dia 
                                    ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado"; 
                                    $mail = new Mail($viagem['email'],"FALTAM ".$dias_faltando." DIAS",$message);
                                    if($mail->send()){
                                        $sent++;
                                        // registar a notificacao
                                        $query_notify = "INSERT INTO notificacoes_viagens (id_viagem,ultimos_sete_dias)
                                        values('$id_viagem','$hoje')";
                                        $result = $conn->query($query_notify);

                                        // echo "Mensagem enviada";
                                        // exit;
                                    }else{

                                    }

                            }else{
                                
                                // echo " -- FALTAM MAIS DE 7 DIAS --";
                                // echo " -- NOTIFICACAO A CADA 7 DIAS --";
                                // echo "AINDA NAO FOI NOTIFICADO";

                                    $message = " A sua viagem para ".$viagem['destino']." está marcada para o dia 
                                    ".$viagem['data_viagem']." as ".$viagem['hora_viagem'].". Obrigado"; 
                                    $mail = new Mail($viagem['email'],"SUA VIAGEM SE APROXIMA",$message);
                                    if($mail->send()){
                                        $sent++;
                                        // Actualizar o registro de notificacao
                                        $query_notify = "INSERT INTO notificacoes_viagens(id_viagem,ultima_notificacao) values ('$id_viagem','$hoje')";
                                        $result = $conn->query($query_notify);

                                        // echo "Mensagem enviada";
                                        // exit;
                                    }else{

                                    }
                            }

                            // exit;

                        }



                        

                    }
                    // exit;


                    
    
                    
                } catch(\Exception $e)
                {
                    $errors +=1;
                    continue;
                    // $warning_message = "Não foi possível notificar o cliente! #".$e->getMessage();
                    // header("Location: ../../../lista_viagens.php?warning_message=".urlencode($warning_message)."&success_message=". urlencode($sucess_message));
                    // // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                    // exit();
                }
            }

            // echo "<br/><br/>".$sent." NOTIFICACOES ENVIADAS.";
            // exit; 

            $data = [
                "status" => "success",
                "message" => "Clientes notificados com sucesso",
                "total_sent" => $sent
            ];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);



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

$conn->close();

?>


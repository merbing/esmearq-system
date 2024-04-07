<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $client_id = htmlspecialchars($_POST["id_client"]);
    $conta_id = htmlspecialchars($_POST["id_conta"]);
    $service_id = htmlspecialchars($_POST["id_service"]);
    $nome_empresa = htmlspecialchars($_POST["nome_empresa"]);
    $email_empresa = htmlspecialchars($_POST["email_empresa"]);
    $telefone_empresa = htmlspecialchars($_POST["telefone_empresa"]);
    $endereco_empresa = htmlspecialchars($_POST["endereco_empresa"]);
    $desconto = htmlspecialchars($_POST["desconto"]);
    $valor = htmlspecialchars($_POST["valor"]);
    $id_pago = $_POST["id_pago"];
    $id_fatura = $_POST['id_fatura'];
    
    //cliente_id, servico_id, bancaria_info_id, nome_empresa, email, telefone, endereco, desconto, pago
    $query = "UPDATE faturas SET cliente_id='$client_id',servico_id='$service_id',bancaria_info_id='$conta_id',
    nome_empresa='$nome_empresa',email='$email_empresa',telefone='$telefone_empresa',endereco='$endereco_empresa',
    desconto='$desconto',pago='$id_pago'
    WHERE id = $id_fatura;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        // $encrypted_user_id = base64_encode($client_id);
        $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Fatura Actualizada com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Actualizando  uma fatura",("Fatura=".$id_fatura."-Cliente=".$client_id."-pago=".$id_pago."-FUNCIONARIO:".$encrypted_user_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        if($id_pago == "1")
        {
            
            try{
                
            // Se a fatura foi paga, emitir a comissão do freelancer, caso tenha sido adicionado por um freelancer 
                
            // buscar os dados do cliente para obter o ID do Freelancer
                $query = "SELECT C.nome, C.id_freelancer, F.comissao_percentagem FROM clientes C
                LEFT JOIN freelancers F ON (F.id = C.id_freelancer) 
                WHERE C.id = '$client_id';";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
    
                $cliente = null;
                if($result->num_rows > 0) {
                        $cliente = $result->fetch_assoc();
                }
                else{
                    $cliente = null;
                }
 
                if($cliente){
                    
                    if($cliente['id_freelancer']!=null){
                        
                       
                        // buscar os dados do servico para obter o Preco e a comissao para o freelancer
                        $query = "SELECT * FROM servicos WHERE id = $service_id";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
    
                        $servico = null;
                        if($result->num_rows > 0) {
                                    $servico = $result->fetch_assoc();
                        }
                        else{
                                $servico = null;
                        }  

                        if($servico)
                        {
                            
                            $percentagem_do_freelancer = $cliente['comissao_percentagem'];
                            $total_a_pagar = ($servico['custo'] - ($servico['custo']*($desconto/100)));
                            $comissao = ($total_a_pagar* ($percentagem_do_freelancer/100)) ;
                             // adicionar a comissao do freelancer
                             
                            $query = "INSERT INTO freelancers_comissoes (id_freelancer,id_fatura,comissao,pago)
                            VALUES ('".$cliente['id_freelancer']."','".$id_fatura."','$comissao',0);";
                            $result = $conn->query($query);


                            if ($result === TRUE) {

                                try{
                                    // Registar a actividade (Log)
                                    $log = new Log("Commisao de Freelancer emitida",('Client:'.$client_id."-Fatura:".$id_fatura."-Freelancer:".$cliente['id_freelancer']),$conn);
                                    $log->save();
                                } catch(\Exception $e)
                                {
                                    $warning_message = "Não foi possível emitir comissao para freelancer! #".$e->getMessage();
                                }

                            }else{
                                $warning_message = "Não foi possível emitir comissao para freelancer! ";
                            }
                        }else{
                            $warning_message = "Não foi possível emitir comissao para freelancer! Serviço não encontrado";
                        }


                       

                    }else{
                        
                    }
                }else{
                    
                }
            }catch(\Exception $e){
                $warning_message = "Não foi possível emitir comissao para freelancer! #".$e->getMessage();
            }
        }else{
        }
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        if($warning_message){
            header("Location: ../../../editar_fatura.php?fatura_id=".base64_encode($id_fatura)."&success_message=". urlencode($sucess_message)."&warning_message=". urlencode($warning_message) );
            // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
        }else{
            header("Location: ../../../editar_fatura.php?fatura_id=".base64_encode($id_fatura)."&success_message=". urlencode($sucess_message) );
            // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
        }
        
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_fatura.php?fatura_id=".base64_encode($id_fatura)."&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e)
    {   
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro. Tenta novamente mais tarde";
        header("Location: ../../../editar_fatura.php?fatura_id=".base64_encode($id_fatura)."&error_message=" . urlencode($error_message));
        exit;

    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


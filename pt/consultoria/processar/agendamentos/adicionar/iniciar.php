<?php
session_start();
require_once("../../../../../banco/config.php");
include("../../../consultas/estados/buscar_iniciado.php");
require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    // $razoes = $_POST["razoes"];
    $motivo = $_POST["motivo"];
    $motivo_especifico = $_POST["especificar_motivo_input"];
    if($motivo == "outro"){
        $motivo = $motivo_especifico;
    }
    $esteve_embaixada = $_POST["esteve_embaixada"];
    $visto_concedido_select = $_POST["visto_concedido_select"];
    $razoes_nao_aprovado_input = $_POST["razoes_nao_aprovado_input"];
    $ano_nao_aprovado_input = $_POST["ano_nao_aprovado_input"] != ''?$_POST["ano_nao_aprovado_input"]:0;
    $quantidade_nao_aprovado_input = $_POST["quantidade_nao_aprovado_input"]!= ''?$_POST["quantidade_nao_aprovado_input"]: 0;
    $vinheta = $_POST["vinheta"];
    $ano_aprovacao_visto_input = $_POST["ano_aprovacao_visto_input"] != ''? $_POST["ano_aprovacao_visto_input"]:0;
    $solicitacao_visto = $_POST["solicitacao_visto"];
    $data_vencimento = $_POST["data_vencimento"];
    $qtd_familia = $_POST["qtd_familia"]!= ''?$_POST["qtd_familia"]:0;
    $responsabilidade_despesas = $_POST["responsabilidade_despesas"];
    $nome_outra_pessoa = $_POST["nome_outra_pessoa"];
    $numero_outra_pessoa = $_POST["numero_outra_pessoa"];
    $endereco_outra_pessoa = $_POST["endereco_outra_pessoa"];
    $emprego_outra_pessoa = $_POST["emprego_outra_pessoa"];
    $trabalho = $_POST["trabalho"];
    $extracto_conta = $_POST["extracto_conta"];
    $mensagem_notas = $_POST["mensagem_notas"];
    $utente_legivel = $_POST["utente_legivel"];
    $recomendacao = $_POST["recomendacao"];
    $agendamento_id = $_POST["agendamento_id"];
   
    $query = "INSERT INTO consultoriadetalhes(agendamento_consulta_id,
            motivo_viagem,esteve_embaixada,visto_concedido,vezes_nao_aprovado,ano_visto,
            ano_vinheta_visto,motivo_reprovacao,tipo_visto,quantidade_filhos,pessoa_responsavel,
            custos_viagens,nome_responsavel,telefone_responsavel,pais_responsavel,endereco_responsavel,
            trabalhando,nome_empresa,funcao,extrato,utente_legivel,recomendacao,data_vencimento_visto) 
            VALUES ('$agendamento_id','$motivo','$esteve_embaixada','$visto_concedido_select',$quantidade_nao_aprovado_input,$ano_nao_aprovado_input,$ano_aprovacao_visto_input,
            '$razoes_nao_aprovado_input','$solicitacao_visto',$qtd_familia,'$responsabilidade_despesas','','$nome_outra_pessoa','$numero_outra_pessoa','',
            '$endereco_outra_pessoa','$trabalho','$emprego_outra_pessoa','',$extracto_conta,$utente_legivel,'$recomendacao','$data_vencimento');";
    // $query = "INSERT INTO consultoriadetalhes(agendamento_consulta_id,razoes_viagem,
    //         motivo_viagem,esteve_embaixada,visto_concedido,vezes_nao_aprovado,ano_visto,
    //         ano_vinheta_visto,motivo_reprovacao,tipo_visto,quantidade_filhos) 
    //         VALUES ('$agendamento_id','$razoes','$motivo','$esteve_embaixada','$visto_concedido_select',$quantidade_nao_aprovado_input,$ano_nao_aprovado_input,$ano_aprovacao_visto_input,
    //         '$razoes_nao_aprovado_input','$solicitacao_visto',$qtd_familia);";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {

        // Actualizar o estado do agendamento
        if($state)
        {
            $query = "UPDATE consultasagendamento SET id_estado=".$state['id']."
                WHERE id=".$agendamento_id;
    
            $result = $conn->query($query);   
        }
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Agendamento Iniciado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Iniciando um agendamento",('Agendamento:'.$agendamento_id."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../../lista.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../iniciando.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


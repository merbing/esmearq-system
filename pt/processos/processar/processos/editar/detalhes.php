<?php
session_start();
require_once("../../../../../banco/config.php");
include("../../../consultas/estados/buscar_iniciado.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $razoes = $_POST["razoes"];
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
    $detalhes_id = $_POST['detalhes_id'];
   
    $query = "UPDATE consultoriadetalhes SET razoes_viagem='$razoes',
            motivo_viagem='$motivo',esteve_embaixada='$esteve_embaixada',visto_concedido='$visto_concedido_select',
            vezes_nao_aprovado=$quantidade_nao_aprovado_input,ano_visto=$ano_nao_aprovado_input,
            ano_vinheta_visto=$ano_aprovacao_visto_input,motivo_reprovacao='$razoes_nao_aprovado_input',
            tipo_visto='$solicitacao_visto',quantidade_filhos=$qtd_familia,pessoa_responsavel='$responsabilidade_despesas',
            custos_viagens='',nome_responsavel='$nome_outra_pessoa',telefone_responsavel='$numero_outra_pessoa',pais_responsavel='',
            endereco_responsavel='$endereco_outra_pessoa',
            trabalhando='$trabalho',nome_empresa='$emprego_outra_pessoa',funcao='',extrato=$extracto_conta,
            utente_legivel=$utente_legivel,recomendacao='$recomendacao'
            WHERE id=$detalhes_id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {

        
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Agendamento Actualizado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../details.php?agendamento_id=".base64_encode($agendamento_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../details.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>


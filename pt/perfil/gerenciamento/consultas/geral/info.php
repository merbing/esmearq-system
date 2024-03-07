
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $credito_id = $_GET["credito_selecionado"];

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

$credito_id = $_GET["credito_selecionado"] ?? "";
$id_parcela_pagamento = $_GET["pagamento_selecionado"] ?? "";
$id_atraso_selecionado = $_GET["atraso_selecionado"] ?? "";


$queryCredito = "SELECT * FROM submissao_credito WHERE id_submissao = $credito_id";
$resultCredito = $conn->query($queryCredito);

if ($resultCredito->num_rows > 0) {
    $row = $resultCredito->fetch_assoc();
        $id_submissao = $row['id_submissao'];
        
        $id_cliente = $row['id_cliente'];
        $id_produto = $row['id_produto'];
        $data_submissao = $row['data_submissao'];
        $valor_solicitado = $row['valor_solicitado']; $valor_solicitado_formatado = number_format($valor_solicitado, 2, '.', ',');
        $prazo_credito = $row['prazo'];
        $finalidade = $row['finalidade'];
        $nome_pai = $row['nome_pai'];
        $nome_mae = $row['nome_mae'];
        $morada_bi = $row['morada_bi'];
        $localidade_bi = $row['localidade_bi'];
        $provincia_bi = $row['provincia_bi'];
        $despesas_mensais = $row['despesas_mensais'];
        $nome_conjuge = $row['nome_conjuge'];
        $telefone_conjuge = $row['telefone_conjuge'];
        $natureza_entidade_empregadora = $row['natureza_entidade_empregadora'];
        $setor_entidade_empregadora = $row['setor_entidade_empregadora'];
        $denominacao_entidade_empregadora = $row['denominacao_entidade_empregadora'];
        $departamento_cliente_empresa = $row['departamento_cliente_empresa'];
        $antiguidade_meses = $row['antiguidade_meses'];
        $cargo = $row['cargo'];
        $morada_entidade_empregadora = $row['morada_entidade_empregadora'];
        $morada_profissional = $row['morada_profissional'];
        $contacto_entidade_empregadora = $row['contacto_entidade_empregadora'];
        $id_agencia = $row['id_agencia'];
        $id_funcionario = $row['id_funcionario'];
        $status = $row['status'];
        $statussb = $row['status'];
        $motivo_recuso = $row['motivo_recuso'];

        #$cliente_id = base64_decode($encrypted_user_id);

        $id_cliente_encript = base64_encode($id_cliente );

}
}
$queryUsuario = "SELECT * FROM usuarios WHERE id = $id_cliente";
$resultUsuario = $conn->query($queryUsuario);

if ($resultUsuario->num_rows > 0) {
    while ($row = $resultUsuario->fetch_assoc()) {
        $nome_cliente = $row['nome'];
        $email_cliente = $row['email'];
        $telefone_cliente = $row['telefone'];
        $data_nascimento_cliente = $row['data_nascimento'];
        $estado_civil_cliente = $row['estado_civil'];
        $nacionalidade_cliente = $row['nacionalidade'];
        $nif_cliente = $row['nif'];
        $endereco_cliente = $row['endereco'];
        


    }
}

$queryExtraInfoUsuario = "SELECT * FROM usuarios_extra_info WHERE usuario_id = $id_cliente";
$resultExtraInfoUsuario = $conn->query($queryExtraInfoUsuario);

if ($resultExtraInfoUsuario->num_rows > 0) {
    while ($row = $resultExtraInfoUsuario->fetch_assoc()) {
        $banco_desembolso_cliente = $row['nome_banco'];
        $conta_desembolso_cliente  = $row['numero_de_conta'];
        $iban_desembolso_cliente = $row['iban'];
        $renda_mensal =  $row['renda_mensal'];

    }
}


// Consulta para obter informações gerais
$queryInfoGerais = "SELECT * FROM funcionarios WHERE id = $id_funcionario";

$resultInfoGerais = $conn->query($queryInfoGerais);

if ($resultInfoGerais->num_rows > 0) {
    while ($row = $resultInfoGerais->fetch_assoc()) {
        $nomeOficial = $row['nome_funcionario'];
    }
}
// Consulta para obter informações do produto de crédito
$queryProdutoInfo = "SELECT * from produtos_microcredito WHERE id = $id_produto";
$resultProdutoInfo = $conn->query($queryProdutoInfo);

if ($resultProdutoInfo->num_rows > 0) {
    while ($row = $resultProdutoInfo->fetch_assoc()) {
        $nomeProduto = $row['nome_produto'];
        $taxaJuro = $row['juros'];
        $creditoIVA = $row['IVA'];
        $juros_demora = $row['juros_demora'];

    }
}

// Consulta para obter informações do produto de crédito
$queryAgenciaInfo = "SELECT * FROM agencias WHERE id_agencia = $id_agencia";

$resultAgenciaInfo = $conn->query($queryAgenciaInfo);

if ($resultAgenciaInfo->num_rows > 0) {
    while ($row = $resultAgenciaInfo->fetch_assoc()) {
        $nomeAgencia = $row['nome_agencia'];
    }
}


$queryHistoricoAprovacao = "SELECT * FROM historico_aprovacao WHERE id_submissao = $id_submissao";
$resultHistoricoAprovacao = $conn->query($queryHistoricoAprovacao);

if ($resultHistoricoAprovacao->num_rows > 0) {
    while ($row = $resultHistoricoAprovacao->fetch_assoc()) {
        $id_historico = $row['id_historico'];
        $nivel_aprovacao  = $row['nivel_aprovacao'];
    }
}

// Consulta para obter informações sobre entrega de crédito
$queryEntregaCredito = "SELECT * FROM historico_entrega_credito WHERE id_submissao = $id_submissao";
$resultEntregaCredito = $conn->query($queryEntregaCredito);

// Consulta para obter informações sobre pagamentos de crédito
$queryPagamentosCredito = "SELECT * FROM pagamentos_credito WHERE id_submissao = $id_submissao";
$resultPagamentosCredito = $conn->query($queryPagamentosCredito);

// Consulta para obter informações sobre atrasos de pagamento
$queryAtrasosPagamento = "SELECT * FROM atrasos_pagamento WHERE id_submissao = $id_submissao";
$resultAtrasosPagamento = $conn->query($queryAtrasosPagamento);


#$conn->close();
?>

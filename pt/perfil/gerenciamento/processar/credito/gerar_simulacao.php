
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $credito_id = $_GET["credito_selecionado"];

    // Verifica se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

$credito_id = $_GET ["credito_selecionado"];

$queryCredito = "SELECT * FROM submissao_credito WHERE id_submissao = $credito_id";
$resultCredito = $conn->query($queryCredito);

if ($resultCredito->num_rows > 0) {
    while ($row = $resultCredito->fetch_assoc()) {
        $id_submissao = $row['id_submissao'];
        $id_cliente = $row['id_cliente'];
        $id_produto = $row['id_produto'];
        $data_submissao = $row['data_submissao'];
        $valor_solicitado = $row['valor_solicitado'];
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
        $motivo_recuso = $row['motivo_recuso'];

        if(empty($status))
        {
            $status = 'Pendente';
        }
    }
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
$queryInfoGerais = "SELECT agencias.nome_agencia, funcionarios.nome_funcionario, produtos_microcredito.nome_produto, produtos_microcredito.juros, produtos_microcredito.IVA
FROM submissao_credito
JOIN agencias ON submissao_credito.id_agencia = agencias.id_agencia
JOIN funcionarios ON submissao_credito.id_funcionario = funcionarios.id
JOIN produtos_microcredito ON submissao_credito.id_produto = produtos_microcredito.id
WHERE submissao_credito.id_submissao = $id_submissao";

$resultInfoGerais = $conn->query($queryInfoGerais);

if ($resultInfoGerais->num_rows > 0) {
    while ($row = $resultInfoGerais->fetch_assoc()) {
        $nomeAgencia = $row['nome_agencia'];
        $nomeOficial = $row['nome_funcionario'];
        $nomeProduto = $row['nome_produto'];
        $taxaJuro = $row['juros'];
        $creditoIVA = $row['IVA'];
    }
}

$data_atual = date('y/m/d');

            function simularCredito($valor_solicitado, $taxaJuro, $prazo_credito)
            {
                // Inicialização de variáveis
                
                $tabelaAmortizacao = [];
                $dataAtual = strtotime(date('d-m-Y'));
                $valorTotal = $valor_solicitado;
            
                // Cálculos
                $taxaJurosMensal = $taxaJuro / 100;
                $jurosMensal = $valor_solicitado * $taxaJurosMensal;
                $prestacaoFixa = ($valor_solicitado + $jurosMensal) / $prazo_credito;
                
            
                // Gerar tabela de amortização
                for ($i = 1; $i <= $prazo_credito; $i++) {
                    $dataPagamento = date('d/m/Y', strtotime("+$i months", $dataAtual));
            
                    // Adicionar entrada à tabela de amortização
                    $tabelaAmortizacao[] = [
                        'Prestação' => $i,
                        'Data de Pagamento' => $dataPagamento,
                        'Capital' => number_format($valor_solicitado / $prazo_credito, 2),
                        'Juros' => number_format($jurosMensal, 2),
                        'Prestação Mensal' => number_format($prestacaoFixa + $jurosMensal, 2),
                    ];
            
                    $valorTotal += $prestacaoFixa;
                }
            
                return ['tabelaAmortizacao' => $tabelaAmortizacao, 'valorTotal' => $valorTotal];
            }
            
            
            $resultadoSimulacao = simularCredito($valor_solicitado, $taxaJuro, $prazo_credito);
            $tabelaAmortizacao = $resultadoSimulacao['tabelaAmortizacao'];
            $valorTotal = $resultadoSimulacao['valorTotal'];


$conn->close();
?>

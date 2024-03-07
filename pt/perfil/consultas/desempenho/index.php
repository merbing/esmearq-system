

<?php

// Função para executar consultas e retornar resultados
function executarConsulta($conn, $query, $mensagem)
{
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $resultado = $row[$mensagem];
    
    return $resultado;
}


// Definir datas
$data_inicio = '2024-01-01';
$data_fim = '2024-12-31';

// Armazenar os resultados em variáveis
$soma_total = executarConsulta($conn, "SELECT SUM(valor_solicitado) AS soma_total FROM submissao_credito WHERE data_submissao >= '$data_inicio' AND data_submissao <= '$data_fim'", 'soma_total');
$soma_aprovada = executarConsulta($conn, "SELECT SUM(sc.valor_solicitado) AS soma_aprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE ha.status_aprovacao = 'Aprovado Por Diretor' AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'soma_aprovada');
$soma_aprovada_count = executarConsulta($conn, "SELECT COUNT(sc.valor_solicitado) AS soma_aprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE ha.status_aprovacao = 'Aprovado Por Diretor' AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'soma_aprovada');
$soma_reprovada = executarConsulta($conn, "SELECT SUM(sc.valor_solicitado) AS soma_reprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE (ha.status_aprovacao = 'Reprovado Por Diretor' OR ha.status_aprovacao = 'Reprovado Por Analista') AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'soma_reprovada');
$soma_reprovada_count = executarConsulta($conn, "SELECT COUNT(sc.valor_solicitado) AS soma_reprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE (ha.status_aprovacao = 'Reprovado Por Diretor' OR ha.status_aprovacao = 'Reprovado Por Analista') AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'soma_reprovada');

$media_aprovada = executarConsulta($conn, "SELECT AVG(sc.valor_solicitado) AS media_aprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE ha.status_aprovacao = 'Aprovado Por Diretor' AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'media_aprovada');
$media_reprovada = executarConsulta($conn, "SELECT AVG(sc.valor_solicitado) AS media_reprovada FROM submissao_credito sc JOIN historico_aprovacao ha ON sc.id_submissao = ha.id_submissao WHERE (ha.status_aprovacao = 'Reprovado Por Diretor' OR ha.status_aprovacao = 'Reprovado Por Analista') AND ha.data_aprovacao >= '$data_inicio' AND ha.data_aprovacao <= '$data_fim'", 'media_reprovada');
$soma_entregue = executarConsulta($conn, "SELECT SUM(hec.montante_entregue) AS soma_entregue FROM historico_entrega_credito hec WHERE hec.data_entrega >= '$data_inicio' AND hec.data_entrega <= '$data_fim'", 'soma_entregue');
$soma_pago = executarConsulta($conn, "SELECT SUM(montante_previsto) AS soma_pago FROM pagamentos_credito WHERE data_confirmacao >= '$data_inicio' AND data_confirmacao <= '$data_fim' AND status = 'Confirmado'", 'soma_pago');
$media_montantes_previstos_nao_aprovados_pendentes = executarConsulta($conn, "SELECT AVG(montante_previsto) AS media_montantes FROM pagamentos_credito WHERE (status = 'Pendente' OR status = 'Atrasado') AND data_prevista >= '$data_inicio' AND data_prevista <= '$data_fim'", 'media_montantes');
$parcelas_pendentes_Contagem = executarConsulta($conn, "SELECT COUNT(*) AS parcelas_pendentes FROM pagamentos_credito WHERE status = 'Pendente' AND data_prevista >= '$data_inicio' AND data_prevista <= '$data_fim'", 'parcelas_pendentes');
$media_pagamentos = executarConsulta($conn, "SELECT AVG(montante_previsto) AS media_pagamentos FROM pagamentos_credito WHERE data_prevista >= '$data_inicio' AND data_prevista <= '$data_fim'", 'media_pagamentos');
$parcelas_pendentes_nao_paga_contagem = executarConsulta($conn, "SELECT COUNT(*) AS parcelas_pendentes_nao_pagas FROM pagamentos_credito WHERE (status = 'Pendente' OR status = 'Não Pago') AND data_prevista >= '$data_inicio' AND data_prevista <= '$data_fim'", 'parcelas_pendentes_nao_pagas');
$soma_total_pendentes = executarConsulta($conn, "SELECT SUM(montante_previsto) AS soma_total_pendentes FROM pagamentos_credito WHERE (status = 'Pendente' OR status = 'Não Pago') AND data_prevista >= '$data_inicio' AND data_prevista <= '$data_fim'", 'soma_total_pendentes');
$soma_total_juros = executarConsulta($conn, "SELECT SUM(montante_juros) AS soma_total_juros FROM atrasos_pagamento WHERE data_atraso >= '$data_inicio' AND data_atraso <= '$data_fim'", 'soma_total_juros');
$total_atrasos = executarConsulta($conn, "SELECT COUNT(*) AS total_atrasos FROM atrasos_pagamento WHERE data_atraso >= '$data_inicio' AND data_atraso <= '$data_fim'", 'total_atrasos');
$media_juros_atrasos = executarConsulta($conn, "SELECT AVG(montante_juros) AS media_juros FROM atrasos_pagamento WHERE data_atraso >= '$data_inicio' AND data_atraso <= '$data_fim'", 'media_juros');

// Função para executar consulta de pagamentos por dia
function consultarPagamentosPorDia($conn, $dataInicio, $dataFim)
{
    $query = "SELECT 
                data_prevista,
                montante_previsto,
                IFNULL(montante_confirmado, 0) AS montante_confirmado
              FROM 
                pagamentos_credito
              WHERE 
                data_prevista BETWEEN '$dataInicio' AND '$dataFim'
                OR data_confirmacao BETWEEN '$dataInicio' AND '$dataFim'
              ORDER BY 
                data_prevista";

    $result = $conn->query($query);
    
    $pagamentos = array();

    while ($row = $result->fetch_assoc()) {
        $pagamentos[] = array(
            'data_prevista' => $row['data_prevista'],
            'montante_previsto' => $row['montante_previsto'],
            'montante_confirmado' => $row['montante_confirmado']
        );
    }

    return $pagamentos;
}


// Utilização da nova função
$pagamentosPorDia = consultarPagamentosPorDia($conn, $data_inicio, $data_fim);

// Crie arrays para as datas, montantes previstos e montantes confirmados
$datas = array();
$montantesPrevistos = array();
$montantesConfirmados = array();

foreach ($pagamentosPorDia as $pagamento) {
    $datas[] = $pagamento['data_prevista'];
    $montantesPrevistos[] = $pagamento['montante_previsto'];
    $montantesConfirmados[] = $pagamento['montante_confirmado'];
}


// Consulta para contar submissões de crédito por agência
$queryContagemPorAgencia = "
    SELECT 
        a.nome_agencia,
        COUNT(sc.id_submissao) AS total_submissoes
    FROM 
        submissao_credito sc
    JOIN 
        agencias a ON sc.id_agencia = a.id_agencia
    WHERE 
        sc.data_submissao BETWEEN '$data_inicio' AND '$data_fim'
    GROUP BY 
        sc.id_agencia
    ORDER BY 
        total_submissoes DESC;
";

// Executar a consulta no banco de dados
$resultadoContagemPorAgencia = $conn->query($queryContagemPorAgencia);

// Verificar se houve resultados
if ($resultadoContagemPorAgencia->num_rows > 0) {
    // Array para armazenar os dados do gráfico
    $dadosGrafico = array();

    // Loop através dos resultados e armazenar os dados no array
    while ($row = $resultadoContagemPorAgencia->fetch_assoc()) {
        $nomesAgencias[] = $row['nome_agencia'];
        $totalSubmissoes[] = $row['total_submissoes'];
    }

    // Converta os arrays para formatos de string JSON
    $nomesAgenciasJSON = json_encode($nomesAgencias);
    $totalSubmissoesJSON = json_encode($totalSubmissoes);

    // Agora, você pode usar $nomesAgenciasJSON e $totalSubmissoesJSON no script do Chart.js
} else {
    // Não houve resultados
   # echo "Nenhuma submissão de crédito encontrada no período especificado.";
}
    
// Termino a consulta de agencias e submissão de créditos

// Consulta para contar submissões de crédito por produto
$queryContagemPorProduto = "
    SELECT 
        p.nome_produto,
        COUNT(sc.id_submissao) AS total_submissoes
    FROM 
        submissao_credito sc
    JOIN 
        produtos_microcredito p ON sc.id_produto = p.id
    WHERE 
        sc.data_submissao BETWEEN '$data_inicio' AND '$data_fim'
    GROUP BY 
        sc.id_produto
    ORDER BY 
        total_submissoes DESC;
";

// Executar a consulta no banco de dados
$resultadoContagemPorProduto = $conn->query($queryContagemPorProduto);

// Verificar se houve resultados
if ($resultadoContagemPorProduto->num_rows > 0) {
    // Array para armazenar os dados do gráfico
    $dadosGraficoProduto = array();

    // Loop através dos resultados e armazenar os dados no array
    while ($row = $resultadoContagemPorProduto->fetch_assoc()) {
        $nomesProdutos[] = $row['nome_produto'];
        $totalSubmissoesProduto[] = $row['total_submissoes'];
    }

    // Converta os arrays para formatos de string JSON
    $nomesProdutosJSON = json_encode($nomesProdutos);
    $totalSubmissoesProdutoJSON = json_encode($totalSubmissoesProduto);

    // Agora, você pode usar $nomesProdutosJSON e $totalSubmissoesProdutoJSON no script do Chart.js
} else {
    // Não houve resultados
  #  echo "Nenhuma submissão de crédito encontrada no período especificado.";
}

// Créditos

// Consulta para contar pagamentos associados a cada agência
$queryPagamentosPorAgencia = "
SELECT
    a.nome_agencia,
    COUNT(pc.id_pagamento) AS total_pagamentos,
    SUM(CASE WHEN pc.status = 'Confirmado' AND pc.data_prevista <= NOW() THEN 1 ELSE 0 END) AS pagamentos_confirmados
FROM
    pagamentos_credito pc
JOIN
    submissao_credito sc ON pc.id_submissao = sc.id_submissao
JOIN
    agencias a ON sc.id_agencia = a.id_agencia
WHERE
    pc.data_prevista <= NOW()  -- Apenas pagamentos com datas previstas no passado
GROUP BY
    sc.id_agencia;

";

// Executar a consulta no banco de dados
$resultadoPagamentosPorAgencia = $conn->query($queryPagamentosPorAgencia);

// Verificar se houve resultados
if ($resultadoPagamentosPorAgencia->num_rows > 0) {
    // Array para armazenar os dados do desempenho
    $dadosDesempenho = array();

    // Loop através dos resultados e armazenar os dados no array
    while ($row = $resultadoPagamentosPorAgencia->fetch_assoc()) {
        $porcentagemConfirmados = ($row['pagamentos_confirmados'] / $row['total_pagamentos']) * 100;

        $dadosDesempenho[] = array(
            'nome_agencia' => $row['nome_agencia'],
            'porcentagem_confirmados' => $porcentagemConfirmados
        );
    }

    // Agora, você pode usar $dadosDesempenho para exibir em gráficos ou outras análises
} else {
    // Não houve resultados
    echo "Nenhum pagamento encontrado.";
}


// Consulta para contar pagamentos associados a cada funcionário
$querySubmissoesPorFuncionario = "
SELECT
    f.nome_funcionario,
    COUNT(sc.id_submissao) AS total_submissoes
FROM
    submissao_credito sc
JOIN
    funcionarios f ON sc.id_funcionario = f.id
GROUP BY
    sc.id_funcionario
ORDER BY
    total_submissoes DESC
LIMIT 5;";

// Executar a consulta no banco de dados
$resultadoSubmissoesPorFuncionario = $conn->query($querySubmissoesPorFuncionario);

// Verificar se houve resultados
if ($resultadoSubmissoesPorFuncionario->num_rows > 0) {
    // Array para armazenar os dados do desempenho do funcionário
    $dadosDesempenhoFuncionario = array();

    // Loop através dos resultados e armazenar os dados no array
    while ($row = $resultadoSubmissoesPorFuncionario->fetch_assoc()) {
        $dadosDesempenhoFuncionario[] = array(
            'nome_funcionario' => $row['nome_funcionario'],
            'total_submissoes' => $row['total_submissoes']
        );
    }

    // Agora, você pode usar $dadosDesempenhoFuncionario para exibir em gráficos ou outras análises
} else {
    // Não houve resultados
    echo "Nenhuma submissão de crédito encontrada para os funcionários.";
}


$meta_soma_total = 5000000;

// Consulta 5: Número de Atrasos Agrupados por Status
$query5 = "SELECT status, COUNT(*) AS total_por_status FROM atrasos_pagamento GROUP BY status";
$result5 = $conn->query($query5);
$status_por_total = array();
while ($row5 = $result5->fetch_assoc()) {
    $status_por_total[$row5['status']] = $row5['total_por_status'];
}

// Consulta 6: Atrasos Associados a Submissões de Crédito
$query6 = "SELECT ap.*, sc.id_submissao, sc.valor_solicitado FROM atrasos_pagamento ap JOIN pagamentos_credito pc ON ap.id_pagamento = pc.id_pagamento JOIN submissao_credito sc ON pc.id_submissao = sc.id_submissao";
$result6 = $conn->query($query6);
$atrasos_associados = array();
while ($row6 = $result6->fetch_assoc()) {
    $atrasos_associados[] = array(
        'id_atraso' => $row6['id_atraso'],
        'id_submissao' => $row6['id_submissao'],
        'valor_solicitado' => $row6['valor_solicitado']
    );
}

?>

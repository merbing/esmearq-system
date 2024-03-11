<?php

// Consulta para contar créditos aprovados
$creditosAprovadosQuery = "
    SELECT COUNT(*) AS totalAprovados
    FROM funcionarios ";

// Executar a consulta
$creditosAprovadosResult = $conn->query($creditosAprovadosQuery);

// // Obter o resultado
 $creditosAprovadosRow = $creditosAprovadosResult->fetch_assoc();
// $totalAprovados = $creditosAprovadosRow['totalAprovados'];
$totalAprovados = 0;

// // Consulta para contar créditos reprovados
// $creditosReprovadosQuery = "
//     SELECT COUNT(*) AS totalReprovados
//     FROM submissao_credito
//     WHERE status LIKE '%Reprovado%' AND DATE(data_submissao) = CURDATE();
// ";

// // Executar a consulta
// $creditosReprovadosResult = $conn->query($creditosReprovadosQuery);

// // Obter o resultado
// $creditosReprovadosRow = $creditosReprovadosResult->fetch_assoc();
// $totalReprovados = $creditosReprovadosRow['totalReprovados'];


// $creditoTotalRow  = $creditosReprovadosRow + $creditosAprovadosRow;

// Consulta para obter os pagamentos pendentes da agência do funcionário com o nome do cliente
$PagamentosPendentesQuery = "
    SELECT
        pc.id_pagamento,
        pc.id_submissao,
        pc.parcela,
        pc.status,
        pc.data_prevista,
        pc.montante_previsto,
        sc.id_funcionario,
        sc.id_agencia,
        uc.nome AS nome_cliente
    FROM
        pagamentos_credito pc
    JOIN
        submissao_credito sc ON pc.id_submissao = sc.id_submissao
    JOIN
        usuarios uc ON sc.id_cliente = uc.id
    WHERE
        pc.data_prevista < NOW() AND
        (pc.status = 'Atrasado' OR pc.status = 'Pendente')
    ORDER BY
        pc.data_prevista DESC
    LIMIT
        10;
";

// // Executar a consulta
// $PagamentosPendentesResult = $conn->query($PagamentosPendentesQuery);

// // Consulta para contar créditos entregues
// $creditosEntreguesQuery = "
//     SELECT COUNT(*) AS totalEntregues
//     FROM historico_entrega_credito
//     WHERE data_entrega >= CURDATE() AND data_entrega < DATE_ADD(CURDATE(), INTERVAL 1 DAY);
// ";

// Executar a consulta
// $creditosEntreguesResult = $conn->query($creditosEntreguesQuery);

// // Obter o resultado
// $creditosEntreguesRow = $creditosEntreguesResult->fetch_assoc();
// $totalEntregues = $creditosEntreguesRow['totalEntregues'];
$totalEntregues = 0;
// // Consulta para contar registros de usuários
// $registrosUsuariosQuery = "
//     SELECT COUNT(*) AS totalRegistrosUsuarios
//     FROM atividades
//     WHERE 
//         status = 'Completo' AND
//         descricao = 'Cadastro de Cliente' AND
//         data_inicio = CURDATE();
// ";

// // Executar a consulta
// $registrosUsuariosResult = $conn->query($registrosUsuariosQuery);

// // Obter o resultado
// $registrosUsuariosRow = $registrosUsuariosResult->fetch_assoc();
//  $totalRegistrosUsuarios = $registrosUsuariosRow['totalRegistrosUsuarios'];
 $totalRegistrosUsuarios = 2;


// // Consulta Para obter os créditos pendentes disponíveis
// $CreditosPerfilUsuarioquery = "
//     SELECT
//         sc.id_submissao,
//         sc.data_submissao,
//         pm.nome_produto AS nome_credito,
//         CONCAT(LEFT(uc.nome, 1), LEFT(REVERSE(SUBSTRING_INDEX(REVERSE(uc.nome), ' ', 1)), 1)) AS nome_cliente_abreviado,
//         sc.status,
//         uf.nome_funcionario AS nome_funcionario
//     FROM
//         submissao_credito sc
//     JOIN
//         produtos_microcredito pm ON sc.id_produto = pm.id
//     JOIN
//         usuarios uc ON sc.id_cliente = uc.id
//     JOIN
//         funcionarios uf ON sc.id_funcionario = uf.id
//     WHERE
//         (sc.status LIKE '%Por Analista%' OR sc.status LIKE '%Por Supervisor%' OR sc.status = 'Pendente')
//     ORDER BY
//         sc.data_submissao DESC
//     LIMIT
//         10;
// ";


//     // Executar a consulta
//     $CreditosPerfilUsuarioresult = $conn->query($CreditosPerfilUsuarioquery);

// // Consulta Para obter os créditos aprovados da disponíveis
// $CreditosAprovadosAgenciaquery = "
//     SELECT
//         sc.id_submissao,
//         sc.data_submissao,
//         pm.nome_produto AS nome_credito,
//         uc.nome AS nome_cliente,
//         CONCAT(LEFT(uc.nome, 1), LEFT(REVERSE(SUBSTRING_INDEX(REVERSE(uc.nome), ' ', 1)), 1)) AS nome_cliente_abreviado,
//         sc.status,
//         uf.nome_funcionario AS nome_funcionario
//     FROM
//         submissao_credito sc
//     JOIN
//         produtos_microcredito pm ON sc.id_produto = pm.id
//     JOIN
//         usuarios uc ON sc.id_cliente = uc.id
//     JOIN
//         funcionarios uf ON sc.id_funcionario = uf.id
//     WHERE
//         sc.status  = 'Aprovado Por Diretor'
//     ORDER BY
//         sc.data_submissao DESC
//     LIMIT
//         10;
// ";


//     // Executar a consulta
//     $CreditosAprovadosAgenciaresult = $conn->query($CreditosAprovadosAgenciaquery);

    
// // Consulta Para obter As Maiores Agências Pela Inscrição de Crédito
// $AgenciasInscritosDiaQuery = "
// SELECT
//     ag.id_agencia,
//     ag.nome_agencia,
//     COUNT(*) AS totalCadastros
// FROM
//     atividades a
// JOIN
//     agencias ag ON a.agencia_id = ag.id_agencia
// WHERE
//     a.descricao = 'Cadastro de Cliente'
//     AND a.status = 'Completo'
//     AND a.data_inicio >= NOW() - INTERVAL 24 HOUR
// GROUP BY
//     ag.id_agencia
// ORDER BY
//     ag.id_agencia;


// ";

// // Executar a consulta
// $AgenciasInscritosDiaResult = $conn->query($AgenciasInscritosDiaQuery);

// // Variáveis para cálculos
// $SomaTotalRegistrosAgenciasDiaria = 0;

// // Defina a data limite como o presente ou 7 dias à frente
// $dataLimite = date('Y-m-d H:i:s', strtotime('+7 days'));

// // Consulta para obter a soma dos montantes previstos
// $somaMontantePrevistosQuery = "
//     SELECT SUM(montante_previsto) AS somaMontantePrevistos
//     FROM pagamentos_credito
//     WHERE data_prevista <= NOW() AND data_prevista <= '$dataLimite';
// ";

// // Executar a consulta
// $somaMontantePrevistosResult = $conn->query($somaMontantePrevistosQuery);

// // Obter o resultado
// $somaMontantePrevistosRow = $somaMontantePrevistosResult->fetch_assoc();

// // Definir um valor padrão se a variável estiver vazia (nula)
// $somaMontantePrevistos = !empty($somaMontantePrevistosRow['somaMontantePrevistos']) ? $somaMontantePrevistosRow['somaMontantePrevistos'] : 0;

// // Consulta para obter a soma dos montantes confirmados
// $somaMontanteConfirmadosQuery = "
//     SELECT SUM(montante_previsto) AS somaMontanteConfirmados
//     FROM pagamentos_credito
//     WHERE status = 'Confirmado' AND data_prevista <= NOW() AND data_prevista <= '$dataLimite';
// ";



// // Executar a consulta
// $somaMontanteConfirmadosResult = $conn->query($somaMontanteConfirmadosQuery);

// // Obter o resultado
// $somaMontanteConfirmadosRow = $somaMontanteConfirmadosResult->fetch_assoc();

// // Definir um valor padrão se a variável estiver vazia (nula)
// $somaMontanteConfirmados = !empty($somaMontanteConfirmadosRow['somaMontanteConfirmados']) ? $somaMontanteConfirmadosRow['somaMontanteConfirmados'] : 0;
$somaMontanteConfirmados = 14;
// // Consulta para obter a soma dos montantes atrasados ou pendentes
// $somaMontanteAtrasadoPendenteQuery = "
//     SELECT SUM(montante_previsto) AS somaMontanteAtrasadoPendente
//     FROM pagamentos_credito
//     WHERE (status = 'Atrasado' OR status = 'Pendente') AND data_prevista <= NOW() AND data_prevista <= '$dataLimite';
// ";

// // Executar a consulta
// $somaMontanteAtrasadoPendenteResult = $conn->query($somaMontanteAtrasadoPendenteQuery);

// // Obter o resultado
// $somaMontanteAtrasadoPendenteRow = $somaMontanteAtrasadoPendenteResult->fetch_assoc();

// // Definir um valor padrão se a variável estiver vazia (nula)
// $somaMontanteAtrasadoPendente = !empty($somaMontanteAtrasadoPendenteRow['somaMontanteAtrasadoPendente']) ? $somaMontanteAtrasadoPendenteRow['somaMontanteAtrasadoPendente'] : 0;
$somaMontanteAtrasadoPendente = 9;
// // Verificar se $somaMontantePrevistos é diferente de zero antes de calcular a porcentagem
// $percentualConfirmado = ($somaMontantePrevistos != 0) ? ($somaMontanteConfirmados / $somaMontantePrevistos) * 100 : 0;
$percentualNaoConfirmado = 100 - $percentualConfirmado;



?>

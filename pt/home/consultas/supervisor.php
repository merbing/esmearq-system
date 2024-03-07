<?php

// Consulta para contar créditos aprovados
$creditosAprovadosQuery = "
    SELECT COUNT(*) AS totalAprovados
    FROM submissao_credito
    WHERE status LIKE '%Aprovado Por%' AND data_submissao >= CURDATE() AND data_submissao < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND id_agencia = $agencia_id;
";

// Executar a consulta
$creditosAprovadosResult = $conn->query($creditosAprovadosQuery);

// Obter o resultado
$creditosAprovadosRow = $creditosAprovadosResult->fetch_assoc();
$totalAprovados = $creditosAprovadosRow['totalAprovados'];


// Consulta para contar créditos reprovados
$creditosReprovadosQuery = "
    SELECT COUNT(*) AS totalReprovados
    FROM submissao_credito
    WHERE status LIKE '%Reprovado%' AND DATE(data_submissao) = CURDATE() AND id_agencia = $agencia_id;
";

// Executar a consulta
$creditosReprovadosResult = $conn->query($creditosReprovadosQuery);

// Obter o resultado
$creditosReprovadosRow = $creditosReprovadosResult->fetch_assoc();
$totalReprovados = $creditosReprovadosRow['totalReprovados'];


$creditoTotalRow  = $creditosReprovadosRow + $creditosAprovadosRow;

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
        (pc.status = 'Atrasado' OR pc.status = 'Pendente') AND
        sc.id_agencia = $agencia_id
    ORDER BY
        pc.data_prevista DESC
    LIMIT
        10;
";

// Executar a consulta
$PagamentosPendentesResult = $conn->query($PagamentosPendentesQuery);

// Consulta para contar créditos entregues
$creditosEntreguesQuery = "
    SELECT COUNT(*) AS totalEntregues
    FROM historico_entrega_credito
    WHERE data_entrega >= CURDATE() AND data_entrega < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND funcionario_id = $user_id;
";

// Executar a consulta
$creditosEntreguesResult = $conn->query($creditosEntreguesQuery);

// Obter o resultado
$creditosEntreguesRow = $creditosEntreguesResult->fetch_assoc();
$totalEntregues = $creditosEntreguesRow['totalEntregues'];

// Consulta para contar registros de usuários
$registrosUsuariosQuery = "
    SELECT COUNT(*) AS totalRegistrosUsuarios
    FROM atividades
    WHERE 
        status = 'Completo' AND
        descricao = 'Cadastro de Cliente' AND
        data_inicio = CURDATE() AND
        agencia_id = $agencia_id;
";

// Executar a consulta
$registrosUsuariosResult = $conn->query($registrosUsuariosQuery);

// Obter o resultado
$registrosUsuariosRow = $registrosUsuariosResult->fetch_assoc();
$totalRegistrosUsuarios = $registrosUsuariosRow['totalRegistrosUsuarios'];



// Consulta Para obter os créditos pendentes da Agência Pelo S
$CreditosPerfilUsuarioquery = "
    SELECT
        sc.id_submissao,
        sc.data_submissao,
        pm.nome_produto AS nome_credito,
        CONCAT(LEFT(uc.nome, 1), LEFT(REVERSE(SUBSTRING_INDEX(REVERSE(uc.nome), ' ', 1)), 1)) AS nome_cliente_abreviado,
        sc.status,
        uf.nome_funcionario AS nome_funcionario
    FROM
        submissao_credito sc
    JOIN
        produtos_microcredito pm ON sc.id_produto = pm.id
    JOIN
        usuarios uc ON sc.id_cliente = uc.id
    JOIN
        funcionarios uf ON sc.id_funcionario = uf.id
    WHERE
        sc.id_agencia = $agencia_id AND (sc.status LIKE '%Por Analista%' OR sc.status = 'Pendente')
    ORDER BY
        sc.data_submissao DESC
    LIMIT
        10;
";


    // Executar a consulta
    $CreditosPerfilUsuarioresult = $conn->query($CreditosPerfilUsuarioquery);

// Consulta Para obter os créditos aprovados da Agência
$CreditosAprovadosAgenciaquery = "
    SELECT
        sc.id_submissao,
        sc.data_submissao,
        pm.nome_produto AS nome_credito,
        uc.nome AS nome_cliente,
        CONCAT(LEFT(uc.nome, 1), LEFT(REVERSE(SUBSTRING_INDEX(REVERSE(uc.nome), ' ', 1)), 1)) AS nome_cliente_abreviado,
        sc.status,
        uf.nome_funcionario AS nome_funcionario
    FROM
        submissao_credito sc
    JOIN
        produtos_microcredito pm ON sc.id_produto = pm.id
    JOIN
        usuarios uc ON sc.id_cliente = uc.id
    JOIN
        funcionarios uf ON sc.id_funcionario = uf.id
    WHERE
        sc.id_agencia = $agencia_id AND sc.status  = 'Aprovado Por Diretor'
    ORDER BY
        sc.data_submissao DESC
    LIMIT
        10;
";


    // Executar a consulta
    $CreditosAprovadosAgenciaresult = $conn->query($CreditosAprovadosAgenciaquery);

    // Defina a data limite como o presente ou 7 dias à frente
$dataLimite = date('Y-m-d H:i:s', strtotime('+7 days'));

// Consulta para obter a soma dos montantes previstos
$somaMontantePrevistosQuery = "
    SELECT SUM(pc.montante_previsto) AS somaMontantePrevistos
    FROM pagamentos_credito pc
    JOIN submissao_credito sc ON pc.id_submissao = sc.id_submissao
    WHERE pc.data_prevista <= NOW() 
        AND pc.data_prevista <= '$dataLimite'
        AND sc.id_agencia = $agencia_id;
";


// Executar a consulta
$somaMontantePrevistosResult = $conn->query($somaMontantePrevistosQuery);

// Obter o resultado
$somaMontantePrevistosRow = $somaMontantePrevistosResult->fetch_assoc();

// Definir um valor padrão se a variável estiver vazia (nula)
$somaMontantePrevistos = !empty($somaMontantePrevistosRow['somaMontantePrevistos']) ? $somaMontantePrevistosRow['somaMontantePrevistos'] : 0;

// Consulta para obter a soma dos montantes confirmados
$somaMontanteConfirmadosQuery = "
    SELECT SUM(pc.montante_previsto) AS somaMontanteConfirmados
    FROM pagamentos_credito pc
    JOIN submissao_credito sc ON pc.id_submissao = sc.id_submissao
    WHERE pc.status = 'Confirmado' 
        AND pc.data_prevista <= NOW() 
        AND pc.data_prevista <= '$dataLimite'
        AND sc.id_agencia = $agencia_id;
";



// Executar a consulta
$somaMontanteConfirmadosResult = $conn->query($somaMontanteConfirmadosQuery);

// Obter o resultado
$somaMontanteConfirmadosRow = $somaMontanteConfirmadosResult->fetch_assoc();

// Definir um valor padrão se a variável estiver vazia (nula)
$somaMontanteConfirmados = !empty($somaMontanteConfirmadosRow['somaMontanteConfirmados']) ? $somaMontanteConfirmadosRow['somaMontanteConfirmados'] : 0;

// Consulta para obter a soma dos montantes atrasados ou pendentes
$somaMontanteAtrasadoPendenteQuery = "
    SELECT SUM(pc.montante_previsto) AS somaMontanteAtrasadoPendente
    FROM pagamentos_credito pc
    JOIN submissao_credito sc ON pc.id_submissao = sc.id_submissao
    WHERE (pc.status = 'Atrasado' OR pc.status = 'Pendente') 
        AND pc.data_prevista <= NOW() 
        AND pc.data_prevista <= '$dataLimite'
        AND sc.id_agencia = $agencia_id;
";


// Executar a consulta
$somaMontanteAtrasadoPendenteResult = $conn->query($somaMontanteAtrasadoPendenteQuery);

// Obter o resultado
$somaMontanteAtrasadoPendenteRow = $somaMontanteAtrasadoPendenteResult->fetch_assoc();

// Definir um valor padrão se a variável estiver vazia (nula)
$somaMontanteAtrasadoPendente = !empty($somaMontanteAtrasadoPendenteRow['somaMontanteAtrasadoPendente']) ? $somaMontanteAtrasadoPendenteRow['somaMontanteAtrasadoPendente'] : 0;

// Verificar se $somaMontantePrevistos é diferente de zero antes de calcular a porcentagem
$percentualConfirmado = ($somaMontantePrevistos != 0) ? ($somaMontanteConfirmados / $somaMontantePrevistos) * 100 : 0;
$percentualNaoConfirmado = 100 - $percentualConfirmado;


?>

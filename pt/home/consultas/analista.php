<?php


// Consulta Para obter os créditos recentes do usuario
$CreditosPerfilUsuarioquery = "
    SELECT
        sc.id_submissao,
        sc.data_submissao,
        pm.nome_produto AS nome_credito,
        CONCAT(LEFT(uc.nome, 1), LEFT(REVERSE(SUBSTRING_INDEX(REVERSE(uc.nome), ' ', 1)), 1)) AS nome_cliente_abreviado,
        sc.status
    FROM
        submissao_credito sc
    JOIN
        produtos_microcredito pm ON sc.id_produto = pm.id
    JOIN
        usuarios uc ON sc.id_cliente = uc.id
    WHERE
        sc.id_funcionario = $user_id
    ORDER BY
        sc.data_submissao DESC
    LIMIT
        10;
";

    // Executar a consulta
    $CreditosPerfilUsuarioresult = $conn->query($CreditosPerfilUsuarioquery);

    // Consulta de Lista de Solicitacoes dos Clientes
    $SolicitacoesPerfilQuery = "SELECT * FROM solicitacoes_edicao WHERE id_solicitante = $user_id ORDER BY data_solicitacao DESC LIMIT 10";    
    // Executar Consulta de Lista Solicitacoes de Clientes
    $SolicitacoesPerfilresult = $conn ->query($SolicitacoesPerfilQuery);

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



?>

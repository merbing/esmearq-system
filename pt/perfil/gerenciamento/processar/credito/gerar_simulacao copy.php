<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $credito_id = $_POST["credito_id"];

    // Verifica se a conexão foi estabelecida corretamente
    if ($mysqli->connect_error) {
        die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
    }

$credito_id = $_POST ["credito_id"];

$queryCredito = "SELECT * FROM submissao_credito WHERE id = $credito_id";
$resultCredito = $mysqli->query($queryCredito);

if ($resultCredito->num_rows > 0) {
    while ($row = $resultCredito->fetch_assoc()) {
        $id_submissao = $row['id_submissao'];
        $id_cliente = $row['id_cliente'];
        $id_produto = $row['id_produto'];
        $data_submissao = $row['data_submissao'];
        $valor_solicitado = $row['valor_solicitado'];
        $prazo = $row['prazo'];
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
        
    }
}
}

// Consulta para obter informações gerais
$queryInfoGerais = "SELECT agencias.nome_agencia, funcionarios.nome_funcionario, produtos_microcredito.nome_produto, produtos_microcredito.juros
FROM submissao_credito
JOIN agencias ON submissao_credito.id_agencia = agencias.id_agencia
JOIN funcionarios ON submissao_credito.id_funcionario = funcionarios.id
JOIN produtos_microcredito ON submissao_credito.id_produto = produtos_microcredito.id
WHERE submissao_credito.id_submissao = $id_submissao";
$resultInfoGerais = $mysqli->query($queryInfoGerais);

if ($resultInfoGerais->num_rows > 0) {
    while ($row = $resultInfoGerais->fetch_assoc()) {
        $nomeAgencia = $row['nome_agencia'];
        $nomeOficial = $row['nome_funcionario'];
        $nomeProduto = $row['nome_produto'];
        $taxaJuro = $row['juros'];
    }
}

echo $nomeAgencia .' '. $nomeOficial .' '. $nomeProduto .' '. $taxaJuro .' '. $cargo .' '. $morada_entidade_empregadora .' '. $id_agencia .' '. $id_funcionario .' '. $status .' '.

$mysqli->close();
?>

<?php
    
    $processo_id = base64_decode($_GET['processo_id']);
    $query = "SELECT P.id, P.descricao,P.data_inicio,P.data_fim,C.nome as client_name,C.email as client_email,C.id as client_id, 
    E.nome_estado as state_name,E.id as state_id,S.nome as service_name,S.id as service_id,
    F.nome as funcionario_name,F.id as funcionario_id,P.funcionario_responsavel_id FROM processos P
    INNER JOIN clientes C ON (C.id = P.cliente_id)
    INNER JOIN processosestado E ON(E.id = P.estado_processo_id) 
    INNER JOIN servicos S ON(S.id = P.tipo_servico_id)
    INNER JOIN funcionarios F ON (F.id = P.funcionario_responsavel_id)
            WHERE P.id = '$processo_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $processo = null;
    if ($result->num_rows > 0) {
            $processo = $result->fetch_assoc();
        }
    else{
        $processo = null;
        }



//         $query = "SELECT * FROM consultoriadetalhes
//         WHERE agendamento_consulta_id = '$agendamento_id'";
// $stmt = $conn->prepare($query);
// $stmt->execute();
// $result = $stmt->get_result();

// $detalhes = null;
// if ($result->num_rows > 0) {
//         $detalhes = $result->fetch_assoc();
//     }
// else{
//         $detalhes = null;
//     }
    

    // else{
    //     $clientes = [];
    // }
?>
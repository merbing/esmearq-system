<?php
    if(isset($_GET['estado']) && $_GET['estado']=="andamento")
    {
        $query = "SELECT P.id, P.descricao,P.data_inicio,P.data_fim,C.nome as client_name,C.id as client_id, 
        E.nome_estado as state_name,E.id as state_id,S.nome as service_name,S.id as service_id,
        F.nome as funcionario_name FROM processos P
        INNER JOIN clientes C ON (C.id = P.cliente_id)
        INNER JOIN processosestado E ON(E.id = P.estado_processo_id) 
        INNER JOIN servicos S ON(S.id = P.tipo_servico_id)
        INNER JOIN funcionarios F ON (F.id = P.funcionario_responsavel_id)
        WHERE E.nome_estado LIKE '%andamento%'

        
        ";
    }else if(isset($_GET['estado']) && $_GET['estado']=="terminado") {
        $query = "SELECT P.id, P.descricao,P.data_inicio,P.data_fim,C.nome as client_name,C.id as client_id, 
            E.nome_estado as state_name,E.id as state_id,S.nome as service_name,S.id as service_id,
            F.nome as funcionario_name FROM processos P
            INNER JOIN clientes C ON (C.id = P.cliente_id)
            INNER JOIN processosestado E ON(E.id = P.estado_processo_id) 
            INNER JOIN servicos S ON(S.id = P.tipo_servico_id)
            INNER JOIN funcionarios F ON (F.id = P.funcionario_responsavel_id)
            WHERE E.nome_estado LIKE '%terminado%'
            ";
    }else if(isset($_GET['estado']) && $_GET['estado']=="atrasado") {
        $query = "SELECT P.id, P.descricao,P.data_inicio,P.data_fim,C.nome as client_name,C.id as client_id, 
            E.nome_estado as state_name,E.id as state_id,S.nome as service_name,S.id as service_id,
            F.nome as funcionario_name FROM processos P
            INNER JOIN clientes C ON (C.id = P.cliente_id)
            INNER JOIN processosestado E ON(E.id = P.estado_processo_id) 
            INNER JOIN servicos S ON(S.id = P.tipo_servico_id)
            INNER JOIN funcionarios F ON (F.id = P.funcionario_responsavel_id)
            WHERE P.data_fim < sysdate() AND E.nome_estado <> 'terminado'
            ";
    }else{
    $query = "SELECT P.id, P.descricao,P.data_inicio,P.data_fim,C.nome as client_name,C.id as client_id, 
            E.nome_estado as state_name,E.id as state_id,S.nome as service_name,S.id as service_id,
            F.nome as funcionario_name FROM processos P
            INNER JOIN clientes C ON (C.id = P.cliente_id)
            INNER JOIN processosestado E ON(E.id = P.estado_processo_id) 
            INNER JOIN servicos S ON(S.id = P.tipo_servico_id)
            INNER JOIN funcionarios F ON (F.id = P.funcionario_responsavel_id)
            WHERE C.id = '$user_id'
            
            ";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $processos = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($processo = $result->fetch_assoc()){
         $processos[] = $processo; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
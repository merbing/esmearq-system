<?php
    $query = "SELECT S.nome as service_name,SS.id,SS.created_at,SS.estado,C.nome as client_name
    FROM servicos_solicitados SS
    INNER JOIN servicos S ON (S.id = SS.id_servico)
    INNER JOIN clientes C ON (c.id = SS.id_cliente)";
    $servicos = [];
    try{
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
    
        if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
            while($servico = $result->fetch_assoc()){
            $servicos[] = $servico; 
            }
        }
    }catch(Exception $e)
    {
        $servicos = [];
    }
    
    // else{
    //     $clientes = [];
    // }
?>
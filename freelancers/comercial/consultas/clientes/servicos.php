<?php

    // $cliente_id = base64_decode($_GET['cliente_id']);
    $query = "SELECT C.nome as client_name, S.nome as service_name,SS.id,SS.created_at,SS.estado 
            FROM servicos_solicitados SS
            INNER JOIN servicos S ON (S.id = SS.id_servico)
            INNER JOIN clientes C ON(C.id = SS.id_cliente) 
            where C.id_freelancer='$user_id' order by id desc";


    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $servicos = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($servico = $result->fetch_assoc()){
         $servicos[] = $servico; 
        }
    }
    
?>
<?php

    // $cliente_id = base64_decode($_GET['cliente_id']);
    $query = "SELECT S.nome as service_name,SS.id,SS.created_at,SS.estado 
            FROM servicos_solicitados SS
            INNER JOIN servicos S ON (S.id = SS.id_servico) 
            where id_cliente='$user_id'";


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
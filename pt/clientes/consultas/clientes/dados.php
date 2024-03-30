<?php
    $query = "SELECT C.*, F.id as freelancer_id,F.nome as freelancer_nome FROM clientes C
    LEFT JOIN freelancers F ON (F.id = C.id_freelancer) 
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $clients = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($client = $result->fetch_assoc()){
         $clients[] = $client; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
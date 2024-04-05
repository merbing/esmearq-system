<?php


    $query = "SELECT * FROM clientes where id_freelancer=$user_id";


    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $clientes = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($cliente = $result->fetch_assoc()){
         $clientes[] = $cliente; 
        }
    }
    
?>
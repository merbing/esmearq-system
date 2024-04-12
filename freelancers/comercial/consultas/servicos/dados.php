<?php
    $query = "SELECT * FROM servicos";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $services = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($service = $result->fetch_assoc()){
         $services[] = $service; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
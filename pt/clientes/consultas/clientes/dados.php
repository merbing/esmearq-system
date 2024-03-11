<?php
    $query = "SELECT * FROM clientes ";
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
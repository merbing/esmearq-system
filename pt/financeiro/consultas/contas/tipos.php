<?php
    $query = "SELECT * FROM  bancostipocontas  ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $account_types = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($type = $result->fetch_assoc()){
         $account_types[] = $type; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
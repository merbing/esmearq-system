<?php
    $query = "SELECT * FROM agencias";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $agencies = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($agency = $result->fetch_assoc()){
         $agencies[] = $agency; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
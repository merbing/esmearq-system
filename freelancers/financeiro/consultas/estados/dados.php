<?php
    $query = "SELECT * FROM processosestado";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $states = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($state = $result->fetch_assoc()){
         $states[] = $state; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
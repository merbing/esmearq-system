<?php
    $query = "SELECT * FROM freelancers ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $freelancers = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($freelancer = $result->fetch_assoc()){
         $freelancers[] = $freelancer; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
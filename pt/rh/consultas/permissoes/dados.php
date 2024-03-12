<?php
    $query = "SELECT * FROM permissoessistema";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $permitions = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($permition = $result->fetch_assoc()){
         $permitions[] = $permition; 
        }
    }
    
?>
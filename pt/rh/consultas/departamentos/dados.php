<?php
    $query = "SELECT * FROM departamentos";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $departments = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($department = $result->fetch_assoc()){
         $departments[] = $department; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
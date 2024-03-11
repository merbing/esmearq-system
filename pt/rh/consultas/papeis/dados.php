<?php
    $query = "SELECT * FROM funcionarios_papel";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $roles = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($role = $result->fetch_assoc()){
         $roles[] = $role; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
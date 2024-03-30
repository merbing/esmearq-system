<?php
    $query = "SELECT * FROM requisitos";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $requisitos = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($requisito = $result->fetch_assoc()){
         $requisitos[] = $requisito; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
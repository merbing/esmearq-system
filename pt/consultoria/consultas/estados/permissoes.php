<?php

    $papel_id = base64_decode($_GET['papel_id']);
    
    $query = "SELECT * FROM funcionarios_papel WHERE id=".$papel_id.";";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Obtém os dados do cliente
        $papel = $result->fetch_assoc();

    }
    


    $query = "SELECT P.permissao, P.id FROM permissoesporcargo PP
    INNER JOIN funcionarios_papel PA ON (PP.cargo_id = PA.id)
    INNER JOIN permissoessistema P ON (PP.permissao_id = P.id)
    WHERE PP.cargo_id=".$papel_id;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $papel_permitions = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($permition = $result->fetch_assoc()){
         $papel_permitions[] = $permition; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
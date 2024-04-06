<?php
    $query = "SELECT C.*,T.tipo_conta as tipo FROM bancariasinformacoes C
            INNER JOIN bancostipocontas T ON(T.id = C.tipo_conta_id)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $accounts = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($account = $result->fetch_assoc()){
         $accounts[] = $account; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
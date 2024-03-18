<?php
    $query = "SELECT * FROM bancariasinformacoes";
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
<?php

    $account_id = base64_decode($_GET['account_id']);
    $query = "SELECT C.*,T.tipo_conta as tipo FROM bancariasinformacoes C
            INNER JOIN bancostipocontas T ON(T.id = C.tipo_conta_id)
            WHERE C.id='$account_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
         $bank_account = $result->fetch_assoc();
    }
    // else{
    //     $clientes = [];
    // }
?>
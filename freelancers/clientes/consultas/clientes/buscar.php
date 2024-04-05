<?php
    
    $cliente_id = base64_decode($_GET['cliente_id']);
    $query = "SELECT * FROM Clientes WHERE id ='$cliente_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cliente = null;
    if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
        }
    else{
        $cliente = null;
        }



    

    // else{
    //     $clientes = [];
    // }
?>
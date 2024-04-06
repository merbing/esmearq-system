<?php

    $agency_id = base64_decode($_GET['agency_id']);
    $query = "SELECT * FROM agencias WHERE id='$agency_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
         $agency = $result->fetch_assoc();
    }
    // else{
    //     $clientes = [];
    // }
?>
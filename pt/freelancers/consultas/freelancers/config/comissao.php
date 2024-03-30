<?php
    $query = "SELECT * FROM freelancers_config WHERE id = 1 limit 1 ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $config = null;
    if ($result->num_rows > 0) {
        $config = $result->fetch_assoc();
    }

    // else{
    //     $clientes = [];
    // }
?>
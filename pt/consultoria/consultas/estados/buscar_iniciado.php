<?php
    
    $agendamento_id = base64_decode($_GET['agendamento_id']);
    $query = "SELECT * FROM consultasestado
            WHERE nome = 'iniciado'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $state= null;
    if ($result->num_rows > 0) {
            $state = $result->fetch_assoc();
        }
    else{
        $state = null;
        }
    
    // else{
    //     $clientes = [];
    // }
?>
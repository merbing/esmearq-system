<?php
    
    $service_id = base64_decode($_GET['service_id']);
    $query = "SELECT * FROM servicos
            WHERE id = '$service_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $service = null;
    if ($result->num_rows > 0) {
            $service = $result->fetch_assoc();
        }
    else{
        $service = null;
        }



//         $query = "SELECT * FROM consultoriadetalhes
//         WHERE agendamento_consulta_id = '$agendamento_id'";
// $stmt = $conn->prepare($query);
// $stmt->execute();
// $result = $stmt->get_result();

// $detalhes = null;
// if ($result->num_rows > 0) {
//         $detalhes = $result->fetch_assoc();
//     }
// else{
//         $detalhes = null;
//     }
    

    // else{
    //     $clientes = [];
    // }
?>
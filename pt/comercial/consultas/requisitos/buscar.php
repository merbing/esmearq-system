<?php
    
    $requisito_id = base64_decode($_GET['requisito_id']);
    $query = "SELECT * FROM requisitos
            WHERE id = '$requisito_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $requisito = null;
    if ($result->num_rows > 0) {
            $requisito = $result->fetch_assoc();
        }
    else{
        $requisito = null;
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
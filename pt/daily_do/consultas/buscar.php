<?php
    
    $activity_id = base64_decode($_GET['atividade_id']);
    $query = "SELECT * FROM atividadesregistro WHERE id = '$activity_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $activity = null;
    if ($result->num_rows > 0) {
            $activity = $result->fetch_assoc();
        }
    else{
        $activity = null;
        }



//         $query = "SELECT * FROM clientes_documentos
//         WHERE cliente_id = '$cliente_id'";
// $stmt = $conn->prepare($query);
// $stmt->execute();
// $result = $stmt->get_result();

// $documentos = [];
// if ($result->num_rows > 0) {
//         while($documento = $result->fetch_assoc()){
//             $documentos[] = $documento;
//         }
//     }
    

    // else{
    //     $clientes = [];
    // }
?>
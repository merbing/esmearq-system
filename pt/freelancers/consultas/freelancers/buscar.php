<?php
    
    $freelancer_id = base64_decode($_GET['freelancer_id']);
    $query = "SELECT * FROM freelancers WHERE id = '$freelancer_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $freelancer = null;
    if ($result->num_rows > 0) {
            $freelancer = $result->fetch_assoc();
        }
    else{
        $freelancer = null;
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
<?php
    
    $cliente_id = base64_decode($_GET['cliente_id']);
    $query = "SELECT * FROM clientes WHERE id = '$cliente_id'";
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



        $query = "SELECT * FROM clientes_documentos
        WHERE cliente_id = '$cliente_id'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$documentos = [];
if ($result->num_rows > 0) {
        while($documento = $result->fetch_assoc()){
            $documentos[] = $documento;
        }
    }
    

    // else{
    //     $clientes = [];
    // }
?>
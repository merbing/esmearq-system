<?php
    
    $file_id = base64_decode($_GET['file_id']);
    $query = "SELECT * FROM clientes_documentos WHERE id = '$file_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $file = null;
    if ($result->num_rows > 0) {
            $file = $result->fetch_assoc();
        }
    else{
        $file = null;
        }


?>
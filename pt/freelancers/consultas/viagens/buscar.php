<?php
    
    $viagem_id = base64_decode($_GET['viagem_id']);
    $query = "SELECT C.nome as client_name, C.id as client_id,
    V.id, V.data_viagem, V.hora_viagem, V.realizado, V.destino FROM viagens V
    INNER JOIN clientes C on(C.id = V.id_cliente) WHERE V.id = '$viagem_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $viagem = null;
    if ($result->num_rows > 0) {
            $viagem = $result->fetch_assoc();
        }
    else{
        $viagem = null;
        }



      
?>
<?php
    
    $cliente_id = base64_decode($_GET['cliente_id']);
    $query = "SELECT C.nome as client_name, C.id as client_id,
    V.id, V.data_viagem, V.hora_viagem, V.realizado, V.destino FROM viagens V
    INNER JOIN clientes C on(C.id = V.id_cliente)
    WHERE  C.id = $cliente_id";
    $viagens = [];
    try{
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
    
        if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
            while($viagem = $result->fetch_assoc()){
            $viagens[] = $viagem; 
            }
        }
    }catch(Exception $e)
    {
        $viagens = [];
    }
    
    // else{
    //     $clientes = [];
    // }
?>
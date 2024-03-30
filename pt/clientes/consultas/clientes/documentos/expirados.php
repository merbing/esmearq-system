<?php
    $query = "SELECT DISTINCT C.id,C.nome,count(D.id) as qtd_documentos FROM clientes C
    INNER JOIN clientes_documentos D ON (D.cliente_id = C.id)
    WHERE D.data_validade < CURRENT_DATE
    GROUP BY C.id,C.nome
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $expirados = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($expirado = $result->fetch_assoc()){
         $expirados[] = $expirado; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
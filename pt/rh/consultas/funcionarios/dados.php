<?php
    $query = "SELECT F.nome,F.email,F.telefone,A.nome as agencia ,D.nome as departamento FROM funcionarios F
            INNER JOIN departamentos D ON (F.departamento = D.id)
            INNER JOIN agencias A ON (F.agencia = A.id) ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $employes = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($employe = $result->fetch_assoc()){
         $employes[] = $employe; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
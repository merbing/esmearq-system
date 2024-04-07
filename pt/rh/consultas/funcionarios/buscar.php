<?php
    $funcionario_id = base64_decode($_GET['funcionario_id']);
    $query = "SELECT F.id,F.nome,F.email,F.estado,F.telefone,F.ativo,F.endereco,F.salario,A.nome as agencia ,A.id as id_agencia,D.nome as departamento,D.id as id_departamento,P.nome as papel,P.id as id_papel
             FROM funcionarios F
            INNER JOIN departamentos D ON (F.departamento = D.id)
            INNER JOIN agencias A ON (F.agencia = A.id)
            inner join funcionarios_papel P ON (F.papel_usuario = P.id) 
            WHERE F.id = $funcionario_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $employe = null;
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        $employe = $result->fetch_assoc();
        
    }
    // else{
    //     $clientes = [];
    // }
?>
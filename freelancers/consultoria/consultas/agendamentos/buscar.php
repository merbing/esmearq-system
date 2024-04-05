<?php
    
    $agendamento_id = base64_decode($_GET['agendamento_id']);
    $query = "SELECT A.id, A.pais_destino,A.data_consulta,C.nome as client_name,C.id as client_id,
            E.nome as state_name,E.id as state_id,S.nome as service_name,S.id as service_id FROM consultasagendamento A
            INNER JOIN clientes C ON (C.id = A.id_cliente)
            INNER JOIN consultasestado E ON(E.id = A.id_estado) 
            INNER JOIN servicos S ON(S.id = A.servico_desejado)
            INNER JOIN freelancers F ON(F.id = C.id_freelancer)
            WHERE A.id = '$agendamento_id'
            AND F.id ='$user_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $consulta = null;
    if ($result->num_rows > 0) {
            $consulta = $result->fetch_assoc();
        }
    else{
        $consulta = null;
        }



        $query = "SELECT * FROM consultoriadetalhes
        WHERE agendamento_consulta_id = '$agendamento_id'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$detalhes = null;
if ($result->num_rows > 0) {
        $detalhes = $result->fetch_assoc();
    }
else{
        $detalhes = null;
    }
    

    // else{
    //     $clientes = [];
    // }
?>
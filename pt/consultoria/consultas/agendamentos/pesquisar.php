<?php
if(isset($_GET['termo']))
{
    $termo = $_GET['termo'];
    $query = "SELECT A.id, A.pais_destino,A.data_consulta,C.nome as client_name,E.nome as state_name,S.nome as service_name FROM consultasagendamento A
    INNER JOIN clientes C ON (C.id = A.id_cliente)
    INNER JOIN consultasestado E ON(E.id = A.id_estado) 
    INNER JOIN servicos S ON(S.id = A.servico_desejado)
    WHERE (C.nome LIKE '%$termo%' OR S.nome LIKE '%$termo%') ";
    if(isset($_GET['id_state']) && $_GET['id_state']!=null ){
        $query.= " AND E.id=".$_GET['id_state'];
    }

    // var_dump($query);exit;
}else{
    $query = "SELECT A.id, A.pais_destino,A.data_consulta,C.nome as client_name,E.nome as state_name,S.nome as service_name FROM consultasagendamento A
    INNER JOIN clientes C ON (C.id = A.id_cliente)
    INNER JOIN consultasestado E ON(E.id = A.id_estado) 
    INNER JOIN servicos S ON(S.id = A.servico_desejado)";

    if(isset($_GET['id_state']) && $_GET['id_state']!=null ){
        $query.= " WHERE E.id=".$_GET['id_state'];
    }
}
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $consultas = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($consulta = $result->fetch_assoc()){
         $consultas[] = $consulta; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
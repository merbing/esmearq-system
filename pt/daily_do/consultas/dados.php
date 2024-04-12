<?php
if(isset($_GET['estado']) && $_GET['estado']=="1")
{
    $query = "SELECT F.nome as funcionario,F.id as funcionario_id, A.atividade,A.id,
    A.data_inicio,A.data_fim,A.status,A.estado,A.state FROM atividadesregistro A
    INNER JOIN funcionarios F ON(F.id = A.funcionario_id) WHERE A.state=1 ";
}else if(isset($_GET['estado']) && $_GET['estado']=="3") {
    $query = "SELECT F.nome as funcionario,F.id as funcionario_id, A.atividade,A.id,
    A.data_inicio,A.data_fim,A.status,A.estado,A.state FROM atividadesregistro A
    INNER JOIN funcionarios F ON(F.id = A.funcionario_id) WHERE A.state=3 ";
}else{
    $query = "SELECT F.nome as funcionario,F.id as funcionario_id, A.atividade,A.id,
    A.data_inicio,A.data_fim,A.status,A.estado,A.state FROM atividadesregistro A
    INNER JOIN funcionarios F ON(F.id = A.funcionario_id) ";
}
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $activities = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($activity = $result->fetch_assoc()){
         $activities[] = $activity; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
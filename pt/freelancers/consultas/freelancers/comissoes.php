<?php
    
    $freelancer_id = base64_decode($_GET['freelancer_id']);
    $query = "SELECT C.nome as client_name, C.id as client_id,
    F.id as id_fatura, CO.comissao,CO.pago,CO.id,CO.id_freelancer FROM freelancers_comissoes CO
    INNER JOIN faturas F ON (F.id = CO.id_fatura)
    INNER JOIN clientes C on(C.id = F.cliente_id)
    WHERE  CO.id_freelancer = $freelancer_id";
    $comissoes = [];
    try{
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
    
        if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
            while($comissao = $result->fetch_assoc()){
            $comissoes[] = $comissao; 
            }
        }
    }catch(Exception $e)
    {
        $comissoes = [];
    }
    
    // else{
    //     $clientes = [];
    // }
?>
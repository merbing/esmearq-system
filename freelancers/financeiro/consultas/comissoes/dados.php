<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inicio = $_POST['data_inicio'];
        $fim = $_POST['data_fim'];
        $pago = $_POST['pago'];

        $query = "SELECT C.nome as client_name, C.id as client_id,
        F.id as id_fatura,CO.data, CO.comissao,CO.pago,CO.id,CO.id_freelancer FROM freelancers_comissoes CO
        INNER JOIN faturas F ON (F.id = CO.id_fatura)
        INNER JOIN clientes C on(C.id = F.cliente_id)
        WHERE  CO.id_freelancer = $user_id 
        AND (CO.data BETWEEN '$inicio' AND '$fim') AND CO.pago='$pago' ";
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
            var_dump($comissoes);
            exit;
        }

    }else{
    // $freelancer_id = base64_decode($_GET['freelancer_id']);
    $query = "SELECT C.nome as client_name, C.id as client_id,
    F.id as id_fatura, CO.comissao,CO.pago,CO.id,CO.id_freelancer FROM freelancers_comissoes CO
    INNER JOIN faturas F ON (F.id = CO.id_fatura)
    INNER JOIN clientes C on(C.id = F.cliente_id)
    WHERE  CO.id_freelancer = $user_id";
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
    }
?>
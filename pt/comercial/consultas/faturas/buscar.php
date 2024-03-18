<?php
    
    $fatura_id = base64_decode($_GET['fatura_id']);
    $query = "SELECT F.id, F.data_emissao,F.nome_empresa,F.email,F.telefone,F.endereco,F.desconto,F.pago,F.valor,
    C.nome as client_name,C.id as client_id,C.email as client_email,C.endereco as client_address, S.nome as service_name,S.id as service_id,
    B.nome_conta,B.banco,B.IBAN,B.numero_conta,B.saldo,B.tipo_conta_id  FROM faturas F
    INNER JOIN clientes C ON (C.id = F.cliente_id)
    INNER JOIN bancariasinformacoes B ON(B.id = F.bancaria_info_id) 
    INNER JOIN servicos S ON(S.id = F.servico_id)
            WHERE F.id = '$fatura_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $fatura = null;
    if ($result->num_rows > 0) {
            $fatura = $result->fetch_assoc();
        }
    else{
        $fatura = null;
        }



//         $query = "SELECT * FROM consultoriadetalhes
//         WHERE agendamento_consulta_id = '$agendamento_id'";
// $stmt = $conn->prepare($query);
// $stmt->execute();
// $result = $stmt->get_result();

// $detalhes = null;
// if ($result->num_rows > 0) {
//         $detalhes = $result->fetch_assoc();
//     }
// else{
//         $detalhes = null;
//     }
    

    // else{
    //     $clientes = [];
    // }
?>
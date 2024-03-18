<?php
if(isset($_GET['termo']))
{
    $termo = $_GET['termo'];
    $query = "SELECT F.id, F.data_emissao,F.nome_empresa,F.email,F.telefone,F.endereco,F.desconto,F.pago,F.valor,
    C.nome as client_name,C.id as client_id, S.nome as service_name,S.id as service_id,
    B.nome_conta,B.banco,B.IBAN,B.numero_conta,B.saldo,B.tipo_conta_id  FROM faturas F
    INNER JOIN clientes C ON (C.id = F.cliente_id)
    INNER JOIN bancariasinformacoes B ON(B.id = F.bancaria_info_id) 
    INNER JOIN servicos S ON(S.id = F.servico_id)
    WHERE F.id LIKE '%$termo%' OR C.nome LIKE '%$termo%' OR F.nome_empresa LIKE '%$termo%'";

}else{
    $query = "SELECT F.id, F.data_emissao,F.nome_empresa,F.email,F.telefone,F.endereco,F.desconto,F.pago,F.valor,
    C.nome as client_name,C.id as client_id, S.nome as service_name,S.id as service_id,
    B.nome_conta,B.banco,B.IBAN,B.numero_conta,B.saldo,B.tipo_conta_id  FROM faturas F
    INNER JOIN clientes C ON (C.id = F.cliente_id)
    INNER JOIN bancariasinformacoes B ON(B.id = F.bancaria_info_id) 
    INNER JOIN servicos S ON(S.id = F.servico_id)";
}
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $faturas = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($fatura = $result->fetch_assoc()){
         $faturas[] = $fatura; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
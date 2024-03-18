<?php
if(isset($_GET['termo']))
{
    $termo = $_GET['termo'];
    $query = "SELECT * FROM clientes
    WHERE nome LIKE '%$termo%' OR nif LIKE '%$termo%' ";

}else{
    $query = "SELECT * FROM clientes";
}
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $clients = [];
    if ($result->num_rows > 0) {
                             // Obtém os dados do cliente
        while($cliente = $result->fetch_assoc()){
         $clients[] = $cliente; 
        }
    }
    // else{
    //     $clientes = [];
    // }
?>
<?php 
if(session_id()=="")
{
    session_start();
}
include_once("../../config/base.php");
// include_once("../banco/config.php");

// Verificar se usuario autenticou-se
if(!isset($_SESSION["cliente_id"])){
    
    header("Location: ".BASE_URL."customer/auth/login.php?error_message=".urlencode("Tem de iniciar sessão primeiro"));
}


$user_id = $_SESSION['cliente_id'];
$user_name = $_SESSION["nome_usuario"];
$user_email = $_SESSION["email_usuario"];
$user_phone = $_SESSION["telefone_usuario"];

// // Buscando as permissoes do utilizador autenticado
// $papel_id = $_SESSION['papel_usuario_id'];

// $query = "SELECT P.permissao FROM permissoesporcargo PP
//     INNER JOIN funcionarios_papel PA ON (PP.cargo_id = PA.id)
//     INNER JOIN permissoessistema P ON (PP.permissao_id = P.id)
//     WHERE PP.cargo_id=".$papel_id;
//     $stmt = $conn->prepare($query);
//     $stmt->execute();
//     $result = $stmt->get_result();
    
//     $permissoes = [];
//     if ($result->num_rows > 0) {
//                              // Obtém os dados do cliente
//         while($permition = $result->fetch_assoc()){
//          $permissoes[] = $permition['permissao']; 
//         }
//     }
    
    // Verifica se tem permissao para ver esta página
    // if(in_array("adicionar funcionario",$permissoes)){
    //     echo "Tem Permissao";
    // }else{
    //     header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Tem de iniciar sessão primeiro"));
    // }
?>
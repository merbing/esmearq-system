<?php 
include("../env/auth_check.php");
if ($cargo_id == 0) {
   include("analista.php");
}
elseif ($cargo_id == 1) {
   include("supervisor.php");
}
elseif ($cargo_id == 2 || $cargo_id == 3 || $cargo_id == 4) {
   include("admin.php");
}
else {
   echo "Erro Cargo Desconhecido, Contecte Um Admin Para Colocar Um Cargo Válido";
}
?>

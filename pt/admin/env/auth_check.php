<?php

$cargo_id = isset($cargo_id) ? intval($cargo_id) : 0;


if ($cargo_id !== 3) {
    // Código a ser executado se $cargo_id não for igual a 3
   # echo "O funcionário não é o funcionário de ID 3.";
} else {
    // Código a ser executado se $cargo_id for igual a 3
    #echo "O funcionário é o funcionário de ID 3.";
}

?>

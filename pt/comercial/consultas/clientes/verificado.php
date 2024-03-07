<?php
    $Usuariosextraquery = "SELECT * FROM usuarios_extra_info WHERE usuario_id = ?";
    $stmt = $conn->prepare($Usuariosextraquery);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $Usuariosextraresult = $stmt->get_result();
                              
    if ($Usuariosextraresult->num_rows > 0) {
                             // Obtém os dados do cliente
        $Usuariosextrainfo = $Usuariosextraresult->fetch_assoc();
        $renda_mensal = $Usuariosextrainfo["renda_mensal"];
        $nome_banco = $Usuariosextrainfo["nome_banco"];
        $verificado = $Usuariosextrainfo["verificado"];
                              
        if($verificado == 1 || $verificado == 2 && !empty($renda_mensal) && !empty($nome_banco)){
            $verificado = TRUE;
        }
        else {
            $verificado = FALSE;
        }
    }
?>
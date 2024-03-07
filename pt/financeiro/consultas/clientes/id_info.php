<?php
   $sqlUsuarios = "SELECT * FROM usuarios WHERE id = $cliente_id";
   $resultUsuarios = $conn->query($sqlUsuarios);
   
   if ($resultUsuarios->num_rows > 0) {
       $dadosUsuarios = $resultUsuarios->fetch_assoc();
   
       $nome_cliente = (!empty($dadosUsuarios['nome'])) ? $dadosUsuarios['nome'] : null;
       $email_cliente = (!empty($dadosUsuarios['email'])) ? $dadosUsuarios['email'] : null;
       $telefone_cliente = (!empty($dadosUsuarios['telefone'])) ? $dadosUsuarios['telefone'] : null;
       $verificado_cliente = (!empty($dadosUsuarios['verificado'])) ? $dadosUsuarios['verificado'] : null;
       $data_nascimento_cliente = (!empty($dadosUsuarios['data_nascimento'])) ? $dadosUsuarios['data_nascimento'] : null;
       $nif_cliente = (!empty($dadosUsuarios['nif'])) ? $dadosUsuarios['nif'] : null;
       $endereco_cliente = (!empty($dadosUsuarios['endereco'])) ? $dadosUsuarios['endereco'] : null;
       $estado_civil_cliente = (!empty($dadosUsuarios['estado_civil'])) ? $dadosUsuarios['estado_civil'] : null;
       $nacionalidade_cliente_zero = (!empty($dadosUsuarios['nacionalidade'])) ? $dadosUsuarios['nacionalidade'] : null;
   
       if($nacionalidade_cliente_zero === 'Angola')
       {
           $nacionalidade_cliente = 'Angolana';
       }
       else {
           $nacionalidade_cliente =  $dadosUsuarios['nacionalidade'];
       }
   
   
   }
   
   $sqlAtividadesExtra = "SELECT * FROM usuarios_extra_info WHERE usuario_id = $cliente_id";
   $resultAtividadesExtra = $conn->query($sqlAtividadesExtra);
   
   if ($resultAtividadesExtra->num_rows > 0) {
       $dadosAtividadesExtra = $resultAtividadesExtra->fetch_assoc();
   
       $tempo_residencia_cliente = (!empty($dadosAtividadesExtra['tempo_residencia'])) ? $dadosAtividadesExtra['tempo_residencia'] : null;
       $historico_residencias_cliente_cliente = (!empty($dadosAtividadesExtra['historico_residencias'])) ? $dadosAtividadesExtra['historico_residencias'] : null;
       $emprego_cliente = (!empty($dadosAtividadesExtra['emprego'])) ? $dadosAtividadesExtra['emprego'] : null;
       $pontuacao_credito_cliente = (!empty($dadosAtividadesExtra['pontuacao_credito'])) ? $dadosAtividadesExtra['pontuacao_credito'] : null;
       $outras_fontes_renda_cliente = (!empty($dadosAtividadesExtra['outras_fontes_renda'])) ? $dadosAtividadesExtra['outras_fontes_renda'] : null;
       $nome_banco_cliente = (!empty($dadosAtividadesExtra['nome_banco'])) ? $dadosAtividadesExtra['nome_banco'] : null;
       $iban_cliente = (!empty($dadosAtividadesExtra['iban'])) ? $dadosAtividadesExtra['iban'] : null;
       $extrato_bancario_filename_cliente = (!empty($dadosAtividadesExtra['extrato_bancario_filename'])) ? $dadosAtividadesExtra['extrato_bancario_filename'] : null;
       $copia_bilhete_filename_cliente = (!empty($dadosAtividadesExtra['copia_bilhete_filename'])) ? $dadosAtividadesExtra['copia_bilhete_filename'] : null;
       $declaracao_servicos_filename_cliente = (!empty($dadosAtividadesExtra['declaracao_servicos_filename'])) ? $dadosAtividadesExtra['declaracao_servicos_filename'] : null;
       $numero_de_conta_cliente = (!empty($dadosAtividadesExtra['numero_de_conta'])) ? $dadosAtividadesExtra['numero_de_conta'] : null;
       $foto_passe_file_name_cliente = (!empty($dadosAtividadesExtra['foto_passe_file_name'])) ? $dadosAtividadesExtra['foto_passe_file_name'] : 'user.jpg';
       $renda_mensal_cliente = (!empty($dadosAtividadesExtra['renda_mensal'])) ? $dadosAtividadesExtra['renda_mensal'] : null;
       $iban_cliente = (!empty($dadosAtividadesExtra['iban'])) ? $dadosAtividadesExtra['iban'] : null;
   
       function formatarTempoResidencia($tempo) {
           if ($tempo < 12) {
               return $tempo . ' Meses';
           } elseif ($tempo == 12) {
               return '1 Ano';
           } else {
               $anos = floor($tempo / 12);
               $meses = $tempo % 12;
       
               $anosStr = ($anos > 1) ? $anos . ' Anos' : '1 Ano';
               $mesesStr = ($meses > 0) ? $meses . ($meses == 1 ? ' Mês' : ' Meses') : '';
       
               return $anosStr . (($anos > 0 && $meses > 0) ? ' e ' : '') . $mesesStr;
           }
       }
       
       
       // Formatação do tempo de residência
       if (!is_null($tempo_residencia_cliente)) {
           $tempo_residencia_formatado = formatarTempoResidencia($tempo_residencia_cliente);
       } else {
           $tempo_residencia_formatado = null;
       }
   
       // Formatação da renda mensal
       if (!is_null($renda_mensal_cliente)) {
            $renda_mensal_cliente_formatada = number_format($renda_mensal_cliente, 0, ',', '.');
       } else {
            $renda_mensal_cliente_formatada = null;
       }
   
       // Formatação do IBAN
   
       if (!is_null($iban_cliente)) {
           $iban_cliente_formatado = chunk_split($iban_cliente, 4, '.');
       } else {
           $iban_cliente_formatado = null;
       }
   
   }

   else{
    $tempo_residencia_cliente = null;
    $historico_residencias_cliente_cliente = null;
    $emprego_cliente = null;
    $pontuacao_credito_cliente = null;
    $outras_fontes_renda_cliente = null;
    $nome_banco_cliente = null;
    $iban_cliente = null;
    $extrato_bancario_filename_cliente = null;
    $copia_bilhete_filename_cliente = null;
    $declaracao_servicos_filename_cliente = null;
    $numero_de_conta_cliente = null;
    $foto_passe_file_name_cliente = 'user.jfif';
    $renda_mensal_cliente = null;
    $renda_mensal_cliente_formatada  = null;
    $tempo_residencia_formatado  = null;
    $iban_cliente_formatado = null;
   }
   
   ?>
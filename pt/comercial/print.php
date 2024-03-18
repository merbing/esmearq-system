<?php 
require_once ("../../libs/dompdf/autoload.inc.php");
require_once ("../utils/LoadPdf.php");

        if(!isset($_GET['fatura_id']))
        {
          $error_message = "Fatura não encontrada";
          header("Location: lista_faturas.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../../banco/config.php");
        include("consultas/faturas/buscar.php");
        include_once("../../config/auth.php");

        if(!$fatura)
        {
          $error_message = "Fatura não encontrada";
          header("Location: lista_faturas.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        // verificar se  o utilizador tem permissao para ver essa pagina
        if(!in_array("Ver Factura",$permissoes) ){
         header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
      
      }

    $total = ($fatura['valor'] - ($fatura['valor']*($fatura['desconto']/100)));
    $path = '../assets/img/logoa.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// <img src="<?php echo $base64" width="150" height="150"/>
      $html = "
        
<html lang='pt'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Factura de Cobrança</title>
<style>
   
</style>
</head>
<body style='font-family: Arial, Helvetica, sans-serif;padding: 0 50px ;'>
<div class='container' style='margin: auto;width: 100%;'>
    <div class='company-logo' style='text-align: center;'>
        <img src='".$base64."' alt='Logotipo da Empresa'>
    </div>
    <h3 style='text-align: center;'>Factura de Cobrança</h3>
    <div class='invoice-details'>
        <h4>Detalhes da Factura</h4>
        <p style='color: #666;font-size:0.8em'><strong>Número da Factura:</strong> ".$fatura['id']."</p>
        <p style='color: #666;font-size:0.8em'><strong>Data de Emissão:</strong> ".$fatura['data_emissao']."</p>
    </div>
    <div class='customer-info'>
        <div style='float: left;'>
            <h4>Informações do Cliente</h4>
            <p style='color: #666;font-size:0.8em'><strong>Nome:</strong> ".$fatura['client_name']."</p>
            <p style='color: #666;font-size:0.8em'><strong>Endereço:</strong> ".$fatura['client_address']."</p>
            <p style='color: #666;font-size:0.8em'><strong>Email:</strong> ".$fatura['client_email']."</p>
        </div>
        <div class='' style='float: right;'>
            <h4>Informações da Empresa</h4>
            <p style='color: #666;font-size:0.8em'><strong>Nome:</strong> ".$fatura['nome_empresa']."</p>
            <p style='color: #666;font-size:0.8em'><strong>Email:</strong> ".$fatura['email']."</p>
            <p style='color: #666;font-size:0.8em'><strong>Telefone:</strong> ".$fatura['telefone']."</p>
            <p style='color: #666;font-size:0.8em'><strong>Endereço:</strong> ".$fatura['endereco']."</p>

        </div>
        <div style='clear: both;'></div>
    </div>

    <table style='border-collapse: collapse;border: 1px solid #ddd;width: 100%;margin:auto;margin-top: 50px;font-family: Arial, Helvetica, sans-serif;'>
        <thead>
            <tr>
                <th style='border: 1px solid #ddd;padding: 12px;text-align: left;background-color: #f2f2f2;font-size:0.9em'>Serviço</th>
                <th style='border: 1px solid #ddd;padding: 12px;text-align: left;background-color: #f2f2f2;font-size:0.9em'>Preço Unitário</th>
                <th style='border: 1px solid #ddd;padding: 12px;text-align: left;background-color: #f2f2f2;font-size:0.9em'>Desconto (%)</th>
                <th style='border: 1px solid #ddd;padding: 12px;text-align: left;background-color: #f2f2f2;font-size:0.9em'>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style='border: 1px solid #ddd;padding: 12px;text-align: left;font-size:0.9em'> ".$fatura['service_name']."</td>
                <td style='border: 1px solid #ddd;padding: 12px;text-align: left;font-size:0.9em'>KZ ".$fatura['valor']."</td>
                <td style='border: 1px solid #ddd;padding: 12px;text-align: left;font-size:0.9em'> ".$fatura['desconto']."</td>
                <td style='border: 1px solid #ddd;padding: 12px;text-align: left;font-size:0.9em'>KZ ".$total."</td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <td colspan='3' style='border: 1px solid #ddd;padding: 12px;text-align: right;'><strong>Total a Pagar:</strong></td>
                <td style='border: 1px solid #ddd;padding: 12px;text-align: left;background-color: #f2f2f2;'>KZ ".$total."</td>
            </tr>
        </tfoot>
    </table>
    <div>
        <h4>Informações Bancárias</h4>
            
        <p style='color: #666;font-size:0.9em'><strong>Número da Conta:</strong> ".$fatura['numero_conta']."</p>
        <p style='color: #666;font-size:0.9em'><strong>Nome do Titular:</strong> ".$fatura['nome_conta']."</p>
        <p style='color: #666;font-size:0.9em'><strong>IBAN:</strong> ".$fatura['IBAN']."</p>
    </div>
    <!-- <div class='note' style='margin-top: 30px;text-align: center;'>
        <p>Este documento não serve como uma factura, nem confirma o pagamento do cliente.</p>
    </div> -->
    <div class='link' style='text-align: center;margin-top: 40px;'>
        <p style='color: #666;font-size:0.8em'>Visite nosso site para mais informações: www.esmearqviagens.ao</p>
    </div>
    
</div>
</body>
</html>

      
      
      ";

      $pdf = new LoadPdf();
      $pdf->load($html);
      $pdf->print();

      var_dump($fatura);
      exit();
    ?>
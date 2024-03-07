<?php
$copia_bilhete_path = "arquivos/{$copia_bilhete_filename_cliente}";
$extrato_bancario_path = "arquivos/{$extrato_bancario_filename_cliente}";
$declaracao_servicos_path = "arquivos/{$declaracao_servicos_filename_cliente}";
$historico_credito_path = "arquivos/{$historico_credito_filename_cliente}";

function downloadFile($filePath, $fileName) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    readfile($filePath);
}

?>
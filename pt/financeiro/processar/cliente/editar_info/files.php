<?php
include("../../../../banco/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $agencia_id = $_POST["agencia_id"];
    $cliente_id = $_POST["cliente_id"];

    // Lista de campos de arquivo e seus respectivos nomes na tabela
    $campos_arquivo = [
        "Extrato" => "extrato_bancario_filename",
        "Bilhete" => "copia_bilhete_filename",
        "Declaração" => "declaracao_servicos_filename",
        "Foto" => "foto_passe_file_name", // Novo campo para a foto
        // Adicione mais campos conforme necessário
    ];

    $erro_upload = false;

    foreach ($campos_arquivo as $campo_formulario => $campo_tabela) {
        if (isset($_FILES[$campo_formulario]) && $_FILES[$campo_formulario]["error"] == UPLOAD_ERR_OK) {
            $nome_arquivo = $_FILES[$campo_formulario]["name"];
            $caminho_destino = "../../../arquivos/";

            // Mova o arquivo para o diretório desejado
            if (!move_uploaded_file($_FILES[$campo_formulario]["tmp_name"], $caminho_destino . $nome_arquivo)) {
                $erro_upload = true;
                break; // Saia do loop se houver um erro de upload
            }

            // Atualize o banco de dados com o nome do arquivo
            $queryUpdateArquivo = "UPDATE usuarios_extra_info SET $campo_tabela = ? WHERE usuario_id = ?";
            $stmtUpdateArquivo = $conn->prepare($queryUpdateArquivo);
            $stmtUpdateArquivo->bind_param("si", $nome_arquivo, $cliente_id);
            $stmtUpdateArquivo->execute();
            $stmtUpdateArquivo->close();
        }
    }

    if ($erro_upload) {
        // Se houver um erro de upload, redirecione para a página principal com uma mensagem de erro
        $mensagem_erro = urlencode("Erro durante o upload dos arquivos. Por favor, tente novamente.");
        header("Location: ../../../?sucesso=$mensagem_erro");
        exit();
    }

    // Registrar atividade para a atualização de informações de arquivos
    $descricao_atividade = "Atualização de Documentos do Cliente";
    $queryInsertAtividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
        VALUES (?, 'Completo', NOW(), ?, ?, ?)";
    $stmtInsertAtividade = $conn->prepare($queryInsertAtividade);
    $stmtInsertAtividade->bind_param("siii", $descricao_atividade, $user_id, $agencia_id, $cliente_id);
    $stmtInsertAtividade->execute();
    $stmtInsertAtividade->close();

    // Redirecionar para a página de sucesso
    $encrypted_user_id = base64_encode($cliente_id);
    $sucess_message = "Edição realizada com sucesso!";
    header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
    exit();
}
?>

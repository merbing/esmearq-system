<?php

require_once("../../../../../banco/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $funcionario_id = $_POST["user_id"];
    $cliente_id = $_POST["client_id"];
    // $agencia_id = $_POST["agencia_id"];

    // var_dump($_FILES);
    // exit();
    // Lista de campos de arquivo e seus respectivos nomes na tabela
    $campos_arquivo = [
        "Extrato" => "extrato_bancario_filename",
        "Bilhete" => "copia_bilhete_filename",
        "Declaração" => "declaracao_servicos_filename",
        "Foto" => "foto_passe_file_name", // Novo campo para a foto
        // Adicione mais campos conforme necessário
    ];

    $doc_names = $_POST['doc_nome'];
    $datas = $_POST['data'];
    $doc_files_names = $_FILES['documento']['name'];
    $doc_files_tmp_names = $_FILES['documento']['tmp_name'];
    $doc_files_types = $_FILES['documento']['type'];
    // var_dump($_FILES);
    // exit();
    $extensions = [
        "application/pdf" => ".pdf",
        "image/png" => ".png",
        "image/jpg" => ".jpg",
        "image/jpeg" => ".jpeg",

        
    ];

    try{
        $inserted = 0;
    // var_dump($datas);
    // exit;
    foreach($doc_names as $index => $name)
    {
        // echo $index." -> ".$name." -> ".$doc_files_names[$index]." -> ".$doc_files_tmp_names[$index]."</br>";
        $nome_do_arquivo =  uniqid("file").date("dmYHis").$extensions[$doc_files_types[$index]];
        echo $nome_do_arquivo."</br>";
        $caminho_destino = "../../../arquivos/";
        
        if(isset($datas[$index]) && $datas[$index]!=""){
            $data_validade = $datas[$index];
            $query = "INSERT INTO clientes_documentos (cliente_id,nome_documento,nome_arquivo,data_validade)
                    VALUES ($cliente_id,'$name','$nome_do_arquivo','$data_validade')";
        }else{
            $data_validade = null;
            $query = "INSERT INTO clientes_documentos (cliente_id,nome_documento,nome_arquivo,data_validade)
                    VALUES ($cliente_id,'$name','$nome_do_arquivo',null)";
        }

        // var_dump($data_validade);
        // exit;
        // Mova o arquivo para o diretório desejado
        move_uploaded_file($doc_files_tmp_names[$index], $caminho_destino.$nome_do_arquivo);
        
        if($conn->query($query) === TRUE)
        {
            $inserted++;
        }

    
    }
    if ( $inserted == count($doc_files_names)) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Arquivos adicionados com sucesso!";
        header("Location: ../../../dados_cliente.php?cliente_id=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro ao adicionar arquivos.";
        header("Location: ../../../documentos.php?error_message=" . urlencode($error_message));
        exit;
    }
}
catch(\Exception $e)
{
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro ao adicionar arquivos.".$e->getMessage();
        header("Location: ../../../documentos.php?error_message=" . urlencode($error_message));
        exit;
}
    var_dump($doc_names);
    var_dump($doc_files_names);
    var_dump($doc_files_tmp_names);
    exit();

    foreach ($campos_arquivo as $campo_formulario => $campo_tabela) {
        if (isset($_FILES[$campo_formulario]) && $_FILES[$campo_formulario]["error"] == UPLOAD_ERR_OK) {
            $nome_arquivo = $_FILES[$campo_formulario]["name"];
            $caminho_destino = "../../../arquivos/";

            // Mova o arquivo para o diretório desejado
            move_uploaded_file($_FILES[$campo_formulario]["tmp_name"], $caminho_destino . $nome_arquivo);

            // Atualize o banco de dados com o nome do arquivo
            $sql_update_arquivo = "UPDATE usuarios_extra_info SET $campo_tabela = '$nome_arquivo' WHERE usuario_id = '$cliente_id'";

            if ($conn->query($sql_update_arquivo) !== TRUE) {
                // Tratar erro, se necessário
            }
        }
    }

    // Registrar atividade para a atualização de informações de arquivos
    $descricao_atividade = "Cadastro de Cliente";
    $data_inicio = date("Y-m-d");
    $sql_insert_atividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
        VALUES ('$descricao_atividade', 'Completo', '$data_inicio', '$funcionario_id', '$agencia_id', '$cliente_id')";

    if ($conn->query($sql_insert_atividade) === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Cadastrado realizado com sucesso!";
        header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_files?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
}
else {
    $error_message = "Oops! Parece que você acessou esta página de uma maneira incorreta. Por favor, utilize o formulário adequado para enviar suas informações.";
    header("Location: ../../../pesquisar_clientes?error_message=" . urlencode($error_message));
    exit;
}


?>

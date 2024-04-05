<?php
include("../../../../../banco/config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $agencia_id = $_POST["agencia_id"];
    $cliente_id = $_POST["cliente_id"];
    $data_validade = $_POST["data_validade"];
    $file_id = $_POST['file_id'];
    $nome_documento = $_POST['doc_nome'];
    $nome_arquivo = $_FILES['documento']['name'];
    $tmp_nome_arquivo = $_FILES['documento']['tmp_name'];
    $type_arquivo = $_FILES['documento']['type'];

    $extensions = [
        "application/pdf" => ".pdf",
        "image/png" => ".png",
        "image/jpg" => ".jpg",
        "image/jpeg" => ".jpeg",

        
    ];

    try{
        if($nome_arquivo){

        
        // echo $index." -> ".$name." -> ".$doc_files_names[$index]." -> ".$doc_files_tmp_names[$index]."</br>";
        $nome_do_arquivo =  uniqid("file").date("dmYHis").$extensions[$type_arquivo];
        echo $nome_do_arquivo."</br>";
        $caminho_destino = "../../../arquivos/";

        // Mova o arquivo para o diretório desejado
        move_uploaded_file($tmp_nome_arquivo, $caminho_destino.$nome_do_arquivo);
        if($data_validade!=""){
            $query = "UPDATE clientes_documentos SET nome_documento='$nome_documento',nome_arquivo='$nome_do_arquivo', data_validade='$data_validade'
                    WHERE id=$file_id";
        }else{
            $query = "UPDATE clientes_documentos SET nome_documento='$nome_documento',nome_arquivo='$nome_do_arquivo', data_validade=$data_validade
                    WHERE id=$file_id";
        }
        
        if($conn->query($query) === TRUE)
        {
            $encrypted_file_id = base64_encode($file_id);
            $sucess_message = "Arquivo alterado com sucesso!";
            header("Location: ../../../editar_arquivo.php?file_id=$encrypted_file_id&success_message=" . urlencode($sucess_message));
            exit();    
        }else{
            var_dump($nome_arquivo);
            exit();
            $encrypted_file_id = base64_encode($file_id);
            $error_message = "Ocorreu um erro ao alterar arquivos.";
            header("Location: ../../../editar_arquivo.php?file_id=$encrypted_file_id&error_message=" . urlencode($error_message));
            exit;
        }
        }else{
            if($data_validade!=""){
                $query = "UPDATE clientes_documentos SET nome_documento='$nome_documento', data_validade='$data_validade'
                    WHERE id=$file_id";
            }else{
                $query = "UPDATE clientes_documentos SET nome_documento='$nome_documento', data_validade=null
                    WHERE id=$file_id";
            }
            
        if($conn->query($query) === TRUE)
        {
            $encrypted_file_id = base64_encode($file_id);
            $sucess_message = "Arquivo alterado com sucesso!";
            header("Location: ../../../editar_arquivo.php?file_id=$encrypted_file_id&success_message=" . urlencode($sucess_message));
            exit();    
        }else{
            var_dump($nome_arquivo);
            exit();
            $encrypted_file_id = base64_encode($file_id);
            $error_message = "Ocorreu um erro ao alterar arquivos.";
            header("Location: ../../../editar_arquivo.php?file_id=$encrypted_file_id&error_message=" . urlencode($error_message));
            exit;
        }

        }

    
    }
catch(\Exception $e)
{
    
        $encrypted_file_id = base64_encode($file_id);
        $error_message = "Ocorreu um erro ao adicionar arquivos.";
        header("Location: ../../../editar_arquivo.php?file_id=$encrypted_file_id&error_message=" . urlencode($error_message));
        exit;
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

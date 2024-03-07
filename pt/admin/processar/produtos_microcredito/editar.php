<?php
// Inclua o arquivo de configuração do banco de dados
include("../../../../banco/config.php");

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $id_produto = $_POST['id_produto']; // Certifique-se de incluir o ID do produto no formulário

    $nome_produto = $conn->real_escape_string($_POST['nome_produto']);
    $moeda = $conn->real_escape_string($_POST['moeda']);
    $montante = intval($_POST['montante']);
    $prazo_minimo = isset($_POST['prazo_minimo']) ? intval($_POST['prazo_minimo']) : 'NULL';
    $prazo_limite = intval($_POST['prazo_limite']);
    $taxa_juro = isset($_POST['taxa_juro']) ? intval($_POST['taxa_juro']) : 'NULL';
    $juros = intval($_POST['juros']);
    $juros_demora = intval($_POST['juros_demora']);
    $IVA = intval($_POST['IVA']);
    $status = intval($_POST['status']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $taxa_esforco = floatval($_POST['taxa_esforco']);

    // Verifique se há uma nova imagem para upload
    if (!empty($_FILES['Foto']['name'])) {
        // Upload da nova imagem
        $uploadDir = "../../../uploads/capas_produtos/";  // Diretório de destino
        $uploadFile = $uploadDir . basename($_FILES['Foto']['name']);

        // Verifique se o upload foi bem-sucedido
        if ($_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
            $imagem_temp = $_FILES['Foto']['tmp_name'];
            $nome_imagem = $conn->real_escape_string($_FILES['Foto']['name']);

            // Mova a imagem para o diretório desejado
            if (move_uploaded_file($imagem_temp, $uploadFile)) {
                // Caminho da nova imagem para armazenar no banco de dados
                $caminho_imagem = "uploads/capas_produtos/" . $nome_imagem;

                // Atualize os dados na tabela incluindo o novo caminho da imagem
                echo $id_produto;
                $query = "UPDATE produtos_microcredito SET
                          nome_produto='$nome_produto', moeda='$moeda', montante=$montante, prazo_minimo=$prazo_minimo, prazo_limite=$prazo_limite, taxa_juro=$taxa_juro, juros=$juros, juros_demora=$juros_demora, IVA=$IVA, status=$status, descricao='$descricao', taxa_esforco=$taxa_esforco, caminho_imagem='$nome_imagem'
                          WHERE id = $id_produto";

                // Imprimir a consulta (para fins de depuração)
                echo "Consulta SQL: $query";
                

                // Execute a consulta
                if ($conn->query($query) === TRUE) {
                    // Redirecione para a página de sucesso ou outra página após a atualização
                    $sucess_message = "Produto atualizado com sucesso!";
                    header("Location: ../../produtos_lista?success_message=" . urlencode($sucess_message));
                    exit();
                } else {
                    // Em caso de erro na execução da consulta
                    $error_message = "Ocorreu um erro ao atualizar. Tente novamente!";
                    header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
                    exit();                }
            } else {
                // Em caso de falha no upload
                $error_message = "Ocorreu um erro ao atualizar imagem. Tente novamente!";
                header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
                exit();
            }
        } else {
            // Em caso de falha no upload
            $error_message = "Ocorreu um erro ao atualizar imagem. Tente novamente!";
            header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
            exit();
        }
    } else {
        // Se não houver uma nova imagem, atualize os dados excluindo a coluna caminho_imagem da atualização
        $query = "UPDATE produtos_microcredito SET
                  nome_produto='$nome_produto', moeda='$moeda', montante=$montante, prazo_minimo=$prazo_minimo, prazo_limite=$prazo_limite, taxa_juro=$taxa_juro, juros=$juros, juros_demora=$juros_demora, IVA=$IVA, status=$status, descricao='$descricao', taxa_esforco=$taxa_esforco
                  WHERE id=$id_produto";

        // Imprimir a consulta (para fins de depuração)
        echo "Consulta SQL: $query";

        // Execute a consulta
        if ($conn->query($query) === TRUE) {
            // Redirecione para a página de sucesso ou outra página após a atualização
            $sucess_message = "Produto atualizado com sucesso!";
            header("Location: ../../produtos_lista?success_message=" . urlencode($sucess_message));
            exit();
        } else {
            // Em caso de erro na execução da consulta
            $error_message = "Ocorreu um erro ao atualizar. Tente novamente!";
            header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
            exit();           }
    }
} else {
    // Se os dados do formulário não foram enviados corretamente, redirecione para uma página de erro
    $error_message = "Requisição inválida";
    header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
    exit();
}
?>

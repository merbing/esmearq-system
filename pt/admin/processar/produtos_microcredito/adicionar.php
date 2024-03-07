<?php
// Inclua o arquivo de configuração do banco de dados
include("../../../../banco/config.php");

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $nome_produto = $_POST['nome_produto'];
    $moeda = $_POST['moeda'];
    $montante = $_POST['montante'];
    $prazo_minimo = isset($_POST['prazo_minimo']) ? $_POST['prazo_minimo'] : null;
    $prazo_limite = $_POST['prazo_limite'];
    $taxa_juro = isset($_POST['taxa_juro']) ? $_POST['taxa_juro'] : null;
    $juros = $_POST['juros'];
    $juros_demora = $_POST['juros_demora'];
    $IVA = $_POST['IVA'];
    $status = $_POST['status'];
    $descricao = $_POST['descricao'];
    $taxa_esforco = $_POST['taxa_esforco'];

    // Upload da imagem
    $uploadDir = "../../../uploads/capas_produtos/";  // Diretório de destino
    $uploadFile = $uploadDir . basename($_FILES['Foto']['name']);

    // Verifique se o upload foi bem-sucedido
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
        $imagem_temp = $_FILES['Foto']['tmp_name'];
        $nome_imagem = $_FILES['Foto']['name'];

        // Mova a imagem para o diretório desejado
        if (move_uploaded_file($imagem_temp, $uploadFile)) {
            // Caminho da imagem para armazenar no banco de dados
            $caminho_imagem = "uploads/capas_produtos/" . $nome_imagem;

            // Consulta para inserir os dados na tabela
            $query = "INSERT INTO produtos_microcredito (nome_produto, moeda, montante, prazo_minimo, prazo_limite, taxa_juro, juros, juros_demora, IVA, status, requisitos_produto, descricao, taxa_esforco, caminho_imagem)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Ajuste do bind_param de acordo com os campos do seu banco de dados
            $stmt->bind_param("ssiiiiidiiisss", $nome_produto, $moeda, $montante, $prazo_minimo, $prazo_limite, $taxa_juro, $juros, $juros_demora, $IVA, $status, $caminho_imagem, $descricao, $taxa_esforco, $nome_imagem);

            // Execute a consulta
            if ($stmt->execute()) {
                // Redirecione para a página de sucesso ou outra página após a inserção

                $sucess_message = "Produto adicionado com sucesso!";
                header("Location: ../../produtos_lista?success_message=" . urlencode($sucess_message));
                exit();
            } else {
                // Em caso de erro na execução da consulta
                $error_message = "Ocorreu um erro ao inserir. Tente novamente!";
                header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
                exit();
            }

            // Feche a instrução preparada
        } else {
            // Em caso de falha no upload
            $error_message = "Ocorreu um erro ao carregar imagem. Tente novamente!";
            header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
            exit();
        }
    } else {
        // Em caso de falha no upload
        $error_message = "Ocorreu um erro ao carregar imagem. Tente novamente!";
        header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
        exit();
    }
} else {
    // Se os dados do formulário não foram enviados corretamente, redirecione para uma página de erro
    $error_message = "Requisição inválida";
    header("Location: ../../produtos_lista?error_message=" . urlencode($error_message));
    exit();
}
?>

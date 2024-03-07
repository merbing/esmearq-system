<?php
   include("../../../../../banco/config.php");
   
   // Verificar a conexão
   if ($conn->connect_error) {
       die("Erro na conexão com o banco de dados: " . $conn->connect_error);
   }
   
   // Verifica se o formulário foi enviado
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       try {
           // Recebe os dados do formulário
           $id_historico = $_POST["id_historico"];
           $id_submissao = $_POST["id_submissao"];
           $funcionario_id = $_POST["funcionario_id"];
           $data_credito = $_POST["data_credito"];
           $status = $_POST["status"];
           $prazo_credito = $_POST["prazo_credito"];
           $montante = $_POST["montante"];
           $taxaJuro = $_POST["taxa_juros"];
           $iva = $_POST["iva"];
           
   
           // Inicia uma transação
           $conn->autocommit(false);
   
           // Inserir na tabela historico_entrega_credito
           $sql_insert_entrega = "INSERT INTO historico_entrega_credito (id_historico, id_submissao, funcionario_id, data_entrega, montante_entregue, data_pagamento, status) 
                                  VALUES ('$id_historico', '$id_submissao', '$funcionario_id', NOW(), '$montante', DATE_ADD(NOW(), INTERVAL $prazo_credito MONTH), '$status')";
   
           // Executar a consulta
           $conn->query($sql_insert_entrega);
   
           // Obtém o último ID inserido
           $last_id = $conn->insert_id;
   
   
   
   // Cálculos
   $taxaJurosMensal = $taxaJuro / 100;
   
   // 1. Calcular os juros mensais
   $jurosMensal = $montante * $taxaJurosMensal;
   
   // 2. Calcular o IVA sobre o montante do crédito
   $ivaMontante1 = $montante * ($iva / 100);
   
   $ivaMontante = $ivaMontante1 / $prazo_credito;
   
   // 3. Calcular o Montante Mensal a ser devolvido pelo cliente
   $montanteMensalCliente = $montante / $prazo_credito;
   
   // 4. Somar o Juros Mensal ao Montante Mensal Cliente, considerando o IVA sobre o montante
   $totalMensal = $jurosMensal + $ivaMontante + $montanteMensalCliente;
   
   // Insere na tabela pagamentos_credito
   for ($i = 1; $i <= $prazo_credito; $i++) {
       $dataPrevista = date('Y-m-d', strtotime("+$i month"));
   
       $sql_insert_pagamento = "INSERT INTO pagamentos_credito (id_entrega_credito, id_submissao, funcionario_id, parcela, status, data_prevista, montante_previsto, data_confirmacao, montante_confirmado) 
                                VALUES ('$last_id', '$id_submissao', '$funcionario_id', '$i', 'Pendente', '$dataPrevista', '$totalMensal', NULL, NULL)";
   
       // Executar a consulta
       $conn->query($sql_insert_pagamento);
   }
   
   
   
           // Adição de Atividades para Registrar a Entrega de Créditos
           $descricao_atividade = "Entrega de Crédito";
           $status_atividade = "Completo";
   
           $sql_atividade = "INSERT INTO atividades (descricao, status, data_inicio, funcionario_id, agencia_id, id_alterado)
                             VALUES ('$descricao_atividade', '$status_atividade', NOW(), '$funcionario_id', NULL, '$last_id')";
   
           // Executar a consulta
           $conn->query($sql_atividade);
   
           // Commit da transação
           $conn->commit();
   
           // echo "Crédito entregue com sucesso! Pagamentos gerados e atividade registrada.";
   
            header("Location: ../../?credito_selecionado=$id_submissao");
           // exit;
       } catch (Exception $e) {
           // Em caso de erro, rollback da transação
           $conn->rollback();
           echo "Erro no processamento: " . $e->getMessage();
       } finally {
           // Reativar o modo de autocommit
           $conn->autocommit(true);
       }
   } else {
       // Se o formulário não foi enviado, redirecionar ou exibir mensagem de erro
       // header("Location: pagina_erro.php");
       // exit;
       echo "Erro: O formulário não foi enviado corretamente.";
   }
   
   // Fechar a conexão
   $conn->close();
   ?>
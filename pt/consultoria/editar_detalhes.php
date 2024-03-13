<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      if(!isset($_GET['agendamento_id']))
      {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
      }
      include("../views/include/head.php");
      include("../../banco/config.php");
      include("consultas/agendamentos/buscar.php");

      if(!$consulta)
      {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
      }

      ?> 
   </head>
   <body>
      <!-- begin app -->
      <div class="app">
         <!-- begin app-wrap -->
         <!-- begin app-header -->
         <?php include("../views/include/header.php");?>
         <?php include("../views/include/menu.php");?>
         <!-- end app-header -->
         <!-- begin app-main -->
         <!-- begin app-container -->
         <div class="app-container">
            <!-- begin app-main -->
            <div class="app-main" id="main">
               <!-- begin container-fluid -->
               <div class="container-fluid">
                  <!-- begin row -->
                  <div class="row">
                     <div class="col-12 mb-2">
                        <?php
                           // Verifica se há uma mensagem de erro
                           if (isset($_GET['error_message'])) {
                           ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>Erro:</strong> <?php echo urldecode($_GET['error_message']); ?>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <i class="ti ti-close"></i>
                           </button>
                        </div>
                        <?php
                           }
                           
                           // Verifica se há uma mensagem de sucesso
                           if (isset($_GET['success_message'])) {
                           ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>Sucesso:</strong> <?php echo urldecode($_GET['success_message']); ?>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <i class="ti ti-close"></i>
                           </button>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="row tabs-contant">
                                 <div class="col-xxl-6">
                                    <div class="card card-statistics">
                                       <div class="card-header">
                                          <div class="card-heading">
                                             <h4 class="card-title " style="font-weight: normal;">Editar detalhes do Agendamento de  <strong><?=$consulta['client_name']?></strong> para <strong><?=$consulta['service_name']?></strong> </h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <div class="tab-content">
                                                <div class="tab-pane fade active show py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                   <form action="processar/agendamentos/editar/detalhes.php" method="post" class="form-horizontal">
                                                      <!-- <input type="hidden" name="user_id" value="<?php echo $user_id ?>"> -->
                                                      <input type="hidden" name="agendamento_id" value="<?php echo $consulta['id'] ?>">
                                                      <input type="hidden" name="detalhes_id" value="<?=$detalhes['id']?>">
                                                      <!-- <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" /> -->
                                                      <!-- 1. Quais são as razões que o faz viajar? -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="razoes">Quais são as razões que o faz viajar?</label>
                                                         <div class="mb-2">
                                                            <textarea name="razoes" id="" cols="30" rows="3" class="form-control" required><?=$detalhes['razoes_viagem']?></textarea>
                                                         </div>
                                                      </div>
                                                      <!-- 2. Motivo da Viagem Por Opção -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="motivo">Motivo da Viagem Por Opção</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="motivo" id="motivo_viagem" required onchange="handleMotivoViagem()">
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Turismo" <?=($detalhes['motivo_viagem']=='Turismo')?'selected':''?> >Turismo</option>
                                                               <option value="Estudo" <?=($detalhes['motivo_viagem']=='Estudo')?'selected':''?>>Estudo</option>
                                                               <option value="Trabalho" <?=($detalhes['motivo_viagem']=='Trabalho')?'selected':''?>>Trabalho</option>
                                                               <option value="Transito" <?=($detalhes['motivo_viagem']=='Transito')?'selected':''?>>Transito</option>
                                                               <option value="Saúde" <?=($detalhes['motivo_viagem']=='Saúde')?'selected':''?>>Saúde</option>
                                                               <option value="outro">Outro</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- Campo de entrada para especificar o motivo da viagem se "Outro" for selecionado -->
                                                      <div class="form-group" id="especificar_motivo" style="display: none;">
                                                         <label class="control-label" for="especificar_motivo_input">Motivo</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="especificar_motivo_input" name="especificar_motivo_input" placeholder="Especificar o motivo" />
                                                         </div>
                                                      </div>
                                                      <!-- 3. Já alguma vez esteve na embaixada do país selecionado? -->
                                                      <div class="form-group" id="esteve_na_embaixada">
                                                         <label class="control-label" for="esteve_embaixada">Já alguma vez esteve na embaixada do país selecionado?</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="esteve_embaixada" id="esteve_embaixada" required onchange="handleEsteveEmbaixada()">
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Sim" <?=($detalhes['esteve_embaixada']=='Sim')?'selected':''?>>Sim</option>
                                                               <option value="Não" <?=($detalhes['esteve_embaixada']=='Não')?'selected':''?>>Não</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- 3.1 Se o campo for sim, questionar se o visto foi concedido, ou não -->
                                                      <div class="form-group" id="visto_concedido" style="display: none;">
                                                         <label class="control-label" for="visto_concedido_select">O visto foi concedido?</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="visto_concedido_select" id="visto_concedido_select" required onchange="handleVistoConcedido()">
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Sim" <?=($detalhes['visto_concedido']=='Sim')?'selected':''?>>Sim</option>
                                                               <option value="Não" <?=($detalhes['visto_concedido']=='Não')?'selected':''?>>Não</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- 3.2 Se dizer não, razões de não ter sido aprovado -->
                                                      <div class="form-group" id="razoes_nao_aprovado" style="display: none;">
                                                         <label class="control-label" for="razoes_nao_aprovado_input">Razões de não ter sido aprovado</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="razoes_nao_aprovado_input" 
                                                            name="razoes_nao_aprovado_input" value="<?=$detalhes['motivo_reprovacao']?>" placeholder="Digite as razões" />
                                                         </div>
                                                      </div>
                                                      <!-- 3.2.1 Em que ano em caso de reprovação de visto -->
                                                      <div class="form-group" id="ano_nao_aprovado" style="display: none;">
                                                         <label class="control-label" for="ano_nao_aprovado_input">Em que ano</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="ano_nao_aprovado_input" 
                                                            name="ano_nao_aprovado_input" placeholder="Digite o ano" value="<?=$detalhes['ano_visto']?>"  />
                                                         </div>
                                                      </div>
                                                      <!-- 3.2.2 Quantas Vezes (número) Em caso de não ter sido aprovado -->
                                                      <div class="form-group" id="quantidade_nao_aprovado" style="display: none;">
                                                         <label class="control-label" for="quantidade_nao_aprovado_input">Quantas Vezes</label>
                                                         <div class="mb-2">
                                                            <input type="number" class="form-control" id="quantidade_nao_aprovado_input" 
                                                            name="quantidade_nao_aprovado_input" placeholder="Digite a quantidade" value="<?=$detalhes['vezes_nao_aprovado']?>"  />
                                                         </div>
                                                      </div>
                                                      <!-- 3.3 Em caso de visto aprovado -->
                                                      <div class="form-group" id="ano_visto_aprovado" style="display: none;">
                                                         <label class="control-label" for="vinheta">Vinheta do visto</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="vinheta" name="vinheta" 
                                                            placeholder="Digite o ano da vinheta do visto" value="<?=$detalhes['ano_vinheta_visto']?>" />
                                                         </div>
                                                      </div>
                                                      <div class="form-group" id="ano_aprovacao_visto" style="display: none;">
                                                         <label class="control-label" for="ano_aprovacao_visto_input">Ano de aprovação do visto</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="ano_aprovacao_visto_input" 
                                                            name="ano_aprovacao_visto_input" value="<?=$detalhes['ano_vinheta_visto']?>" placeholder="Digite o ano de aprovação do visto" />
                                                         </div>
                                                      </div>
                                                      <!-- 4. Solicitação de Visto é singular, ou familiar -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="solicitacao_visto">Solicitação de Visto é singular, ou familiar?</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="solicitacao_visto" id="solicitacao_visto" required onchange="handleSolicitacaoVisto()">
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Singular" <?=($detalhes['tipo_visto']=='Singular')?'selected':''?>>Singular</option>
                                                               <option value="Familiar" <?=($detalhes['tipo_visto']=='Familiar')?'selected':''?>>Familiar</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- 4.1 Em caso de ser familiar -->
                                                      <div class="form-group" id="info_familiar" style="display: none;">
                                                         <label class="control-label" for="info_familiar_input">Informações sobre a família</label>
                                                         <div class="mb-2">
                                                            <input type="number" class="form-control" id="qtd_familia" name="qtd_familia" 
                                                            placeholder="Digite a quantidade de pessoas" value="<?=($detalhes['quantidade_filhos'])?>" />
                                                         </div>
                                                      </div>
                                                      <!-- 5. Despesas de Viagens e subsistências -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="responsabilidade_despesas">Quem se responsabilizará pelas despesas de viagens e subsistências?</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="responsabilidade_despesas" id="responsabilidade_despesas" required>
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Por Conta Própria" <?=($detalhes['pessoa_responsavel']=='Por Conta Própria')?'selected':''?>>Por Conta Própria</option>
                                                               <option value="Outrem" <?=($detalhes['pessoa_responsavel']=='Outrem')?'selected':''?>>Outrem</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- 5.1 Em caso de ser outra pessoa -->
                                                      <div class="form-group" id="info_outra_pessoa" style="display: none;">
                                                         <label class="control-label" for="info_outra_pessoa_input">Informações sobre a outra pessoa responsável</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="nome_outra_pessoa" name="nome_outra_pessoa" 
                                                            placeholder="Nome" value="<?=($detalhes['nome_responsavel'])?>" />
                                                            <input type="text" class="form-control" id="numero_outra_pessoa" name="numero_outra_pessoa" 
                                                            placeholder="Número de telefone" value="<?=($detalhes['telefone_responsavel'])?>" />
                                                            <input type="text" class="form-control" id="endereco_outra_pessoa" name="endereco_outra_pessoa" 
                                                            placeholder="Endereço" value="<?=($detalhes['endereco_responsavel'])?>" />
                                                            <input type="text" class="form-control" id="emprego_outra_pessoa" name="emprego_outra_pessoa" 
                                                            placeholder="Emprego"  value="<?=($detalhes['nome_empresa'])?>"/>
                                                         </div>
                                                      </div>
                                                      <!-- 6. Trabalha por conta própria/Empresa e função/Não trabalha -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="trabalho">Situação profissional</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="trabalho" id="trabalho" required>
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Por Conta Própria" <?=($detalhes['trabalhando']=='Por Conta Própria')?'selected':''?>>Por Conta Própria</option>
                                                               <option value="Empresa" <?=($detalhes['trabalhando']=='Empresa')?'selected':''?>>Empresa e função</option>
                                                               <option value="Não trabalha" <?=($detalhes['trabalhando']=='Não trabalha')?'selected':''?>>Não trabalha</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <!-- 7. Extracto dos últimos 3 meses de sua conta corrente ou salarial -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="extracto_conta">Pode nos passar o extrato dos últimos 3 meses de sua conta corrente ou salarial?</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="extracto_conta" id="">
                                                               <option value="1" <?=($detalhes['extrato']=='1')?'selected':''?>>Sim</option>
                                                               <option value="0" <?=($detalhes['extrato']=='0')?'selected':''?>>Não</option>
                                                            </select>
                                                            <!-- <input type="text" class="form-control" id="extracto_conta" name="extracto_conta" required /> -->
                                                         </div>
                                                      </div>
                                                      <!-- 8. Campo de Mensagem para passar as notas -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="mensagem_notas">Mensagem / Notas</label>
                                                         <div class="mb-2">
                                                            <textarea class="form-control" id="mensagem_notas" name="mensagem_notas" rows="4" placeholder="Digite suas notas ou mensagens"></textarea>
                                                         </div>
                                                      </div>
                                                      <!-- 9. Utente Legível/Não -->
                                                      <div class="form-group">
                                                         <label class="control-label">Utente Legível/Não</label>
                                                         <div class="mb-2">
                                                            <div class="form-check">
                                                               <input required class="form-check-input" type="radio" <?=($detalhes['utente_legivel']=='1')?'checked':''?>  name="utente_legivel" id="utente_legivel_sim" value="1">
                                                               <label class="form-check-label" for="utente_legivel_sim" >Sim</label>
                                                            </div>
                                                            <div class="form-check">
                                                               <input required class="form-check-input" type="radio" <?=($detalhes['utente_legivel']=='2')?'checked':''?> name="utente_legivel" id="utente_legivel_nao" value="2">
                                                               <label class="form-check-label" for="utente_legivel_nao" >Não</label>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!-- 10. Campo de Recomendação -->
                                                      <div class="form-group">
                                                         <label class="control-label" for="recomendacao">Recomendação</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="recomendacao" name="recomendacao" 
                                                            placeholder="Digite sua recomendação, se houver" value="<?=($detalhes['recomendacao'])?>" />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar dados</button>
                                                      </div>
                                                   </form>
                                                </div>
                                                <div class="tab-pane fade py-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                   <form enctype="multipart/form-data" action="processar/cliente/aditar_info/files.php" method="post" class="form-horizontal">
                                                      <input type="hidden" name="user_id" value="
                                                         <?php echo $user_id ?>">
                                                      <input type="hidden" name="agencia_id" value="
                                                         <?php echo $agencia_id ?>">
                                                      <input type="hidden" name="cliente_id" value="
                                                         <?php echo $cliente_id ?>">
                                                      <div class="col-md-12 mb-3">
                                                         <label for="Extrato">Foto do Cliente</label>
                                                         <input type="file" name="Foto" accept=".jpg, .jpeg, .png" class="custom-file-input" id="customFileFoto">
                                                         <label class="custom-file-label" for="customFileFoto">Foto do Cliente</label>
                                                      </div>
                                                      <div class="col-md-12 mb-3">
                                                         <label for="Extrato">Extrato Bancario</label>
                                                         <input type="file" name="Extrato" accept=".pdf, .jpg, .jpeg, .png" class="custom-file-input" id="customFileExtrato">
                                                         <label class="custom-file-label" for="customFileExtrato">Extrato Bancario</label>
                                                      </div>
                                                      <div class="col-md-12 mb-3">
                                                         <label for="Bilhete">Bilhete/Passaporte</label>
                                                         <input type="file" name="Bilhete" accept=".pdf, .jpg, .jpeg, .png" class="custom-file-input" id="customFileBilhete">
                                                         <label class="custom-file-label" for="customFileBilhete">Bilhete/Passaporte</label>
                                                      </div>
                                                      <div class="col-md-12 mb-3">
                                                         <label for="Declaração">Declaração de Serviços</label>
                                                         <input type="file" name="Declaração" accept=".pdf, .jpg, .jpeg, .png" class="custom-file-input" id="customFileDeclaracao">
                                                         <label class="custom-file-label" for="customFileDeclaracao">Declaração de Serviços</label>
                                                      </div>
                                                      <div class="form-group">
                                                         <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Atualizar</button>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
               </div>
               <!-- end container-fluid -->
            </div>
            <!-- end app-main -->
         </div>
         <!-- end app-container -->
         <!-- begin footer -->
      </div>
      <!-- end app-container -->
      </div>
      <!-- end app-wrap -->
      </div>
      <!-- end app -->
      <script>
         // Função para lidar com a seleção do motivo da viagem
         function handleMotivoViagem() {
             var motivoViagemSelect = document.getElementById("motivo_viagem");
             var especificarMotivoDiv = document.getElementById("especificar_motivo");
         
             // Se "Outro" for selecionado, exibir o campo de entrada, caso contrário, ocultá-lo
             if (motivoViagemSelect.value === "Outro") {
                 especificarMotivoDiv.style.display = "block";
             } else {
                 especificarMotivoDiv.style.display = "none";
             }
         }
         
         
      </script>
      <script>
         function handleEsteveEmbaixada() {
           const esteveEmbaixadaSelect = document.getElementById('esteve_embaixada');
           const vistoConcedidoDiv = document.getElementById('visto_concedido');
           const razoesNaoAprovadoDiv = document.getElementById('razoes_nao_aprovado');
           const anoNaoAprovadoDiv = document.getElementById('ano_nao_aprovado');
           const quantidadeNaoAprovadoDiv = document.getElementById('quantidade_nao_aprovado');
           const anoVistoAprovadoDiv = document.getElementById('ano_visto_aprovado');
           const anoAprovacaoVistoDiv = document.getElementById('ano_aprovacao_visto');
         
           const selectedValue = esteveEmbaixadaSelect.value;
         
           if (selectedValue === 'Sim') {
             vistoConcedidoDiv.style.display = 'block';
             razoesNaoAprovadoDiv.style.display = 'none';
             anoNaoAprovadoDiv.style.display = 'none';
             quantidadeNaoAprovadoDiv.style.display = 'none';
             anoVistoAprovadoDiv.style.display = 'none';
             anoAprovacaoVistoDiv.style.display = 'none';
           } else if (selectedValue === 'Não') {
             vistoConcedidoDiv.style.display = 'none';
             razoesNaoAprovadoDiv.style.display = 'block';
             anoNaoAprovadoDiv.style.display = 'block';
             quantidadeNaoAprovadoDiv.style.display = 'block';
             anoVistoAprovadoDiv.style.display = 'none';
             anoAprovacaoVistoDiv.style.display = 'none';
           } else {
             vistoConcedidoDiv.style.display = 'none';
             razoesNaoAprovadoDiv.style.display = 'none';
             anoNaoAprovadoDiv.style.display = 'none';
             quantidadeNaoAprovadoDiv.style.display = 'none';
             anoVistoAprovadoDiv.style.display = 'none';
             anoAprovacaoVistoDiv.style.display = 'none';
           }
         }
         
         function handleVistoConcedido() {
           const vistoConcedidoSelect = document.getElementById('visto_concedido_select');
           const anoVistoAprovadoDiv = document.getElementById('ano_visto_aprovado');
           const anoAprovacaoVistoDiv = document.getElementById('ano_aprovacao_visto');
         
           const selectedValue = vistoConcedidoSelect.value;
         
           if (selectedValue === 'Sim') {
             anoVistoAprovadoDiv.style.display = 'block';
             anoAprovacaoVistoDiv.style.display = 'block';
           } else if (selectedValue === 'Não') {
             anoVistoAprovadoDiv.style.display = 'none';
             anoAprovacaoVistoDiv.style.display = 'none';
             handleVistoNaoConcedido();
           }
         }
         
         function handleVistoNaoConcedido() {
           const razoesNaoAprovadoDiv = document.getElementById('razoes_nao_aprovado');
           const anoNaoAprovadoDiv = document.getElementById('ano_nao_aprovado');
           const quantidadeNaoAprovadoDiv = document.getElementById('quantidade_nao_aprovado');
         
           razoesNaoAprovadoDiv.style.display = 'block';
           anoNaoAprovadoDiv.style.display = 'block';
           quantidadeNaoAprovadoDiv.style.display = 'block';
         }
         
         // Chamar a função handleEsteveEmbaixada() no carregamento da página
         window.addEventListener('load', handleEsteveEmbaixada);
         
         
         function handleSolicitacaoVisto() {
           const solicitacaoVistoSelect = document.getElementById('solicitacao_visto');
           const infoFamiliarDiv = document.getElementById('info_familiar');
         
           const selectedValue = solicitacaoVistoSelect.value;
         
           if (selectedValue === 'Familiar') {
             infoFamiliarDiv.style.display = 'block';
           } else if (selectedValue === 'Singular') {
             infoFamiliarDiv.style.display = 'none';
           } else {
             infoFamiliarDiv.style.display = 'none';
           }
         }
         
         // Chamar a função handleSolicitacaoVisto() no carregamento da página
         window.addEventListener('load', handleSolicitacaoVisto);
         
         function handleResponsabilidadeDespesas() {
           const responsabilidadeDespesasSelect = document.getElementById('responsabilidade_despesas');
           const infoOutraPessoaDiv = document.getElementById('info_outra_pessoa');
         
           const selectedValue = responsabilidadeDespesasSelect.value;
         
           if (selectedValue === 'Outrem') {
             infoOutraPessoaDiv.style.display = 'block';
           } else if (selectedValue === 'Por Conta Própria') {
             infoOutraPessoaDiv.style.display = 'none';
           } else {
             infoOutraPessoaDiv.style.display = 'none';
           }
         }
         
         // Chamar a função handleResponsabilidadeDespesas() no carregamento da página
         window.addEventListener('load', handleResponsabilidadeDespesas);
         
      </script>
      <!-- custom app -->
      <script src="../assets/js/vendors.js"></script>
      <script src="../assets/js/app.js"></script>
   </body>
</html>
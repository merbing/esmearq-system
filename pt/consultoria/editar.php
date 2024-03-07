<!DOCTYPE html>
<html lang="pt">
   <head> <?php 
      include("../views/include/head.php");
      include("../banco/config.php");
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
                                             <h4 class="card-title">Alteração de Conta</h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                   <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pessoal e Contacto</a>
                                                </li>
                                                <li class="nav-item">
                                                   <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Anexos</a>
                                                </li>
                                             </ul>
                                             <div class="tab-content">
                                                <div class="tab-pane fade active show py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                   <form action="processar/cliente/adicionar_info/basicas.php" method="post" class="form-horizontal">
                                                      <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                                      <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                                      <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" />
                                                      <div class="form-group">
                                                         <label class="control-label" for="nome">Nome Completo*</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="nif">Número de identificação fiscal*</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="data_de_nascimento">Data de Nascimento*</label>
                                                         <div class="mb-2">
                                                            <input type="date" class="form-control" name="data_de_nascimento" placeholder="Data de Nascimento" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="nacionalidade">Nacionalidade*</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="nacionalidade" id="nacionalidade" required onchange="handleNacionalidade()">
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Angola">Angola</option>
                                                               <option value="Outra">Outra</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="form-group" id="outra_nacionalidade">
                                                         <label class="control-label" for="nacionalidade_input">Nome da Nacionalidade*</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="nacionalidade_input" name="nacionalidade_input" placeholder="Nome da Nacionalidade" disabled />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="estado_civil">Estado Civil*</label>
                                                         <div class="mb-2">
                                                            <select class="form-control" name="estado_civil" id="estado_civil" required>
                                                               <option selected disabled>Selecionar</option>
                                                               <option value="Solteiro">Solteiro</option>
                                                               <option value="Casado">Casado</option>
                                                               <option value="Divorciado">Divorciado</option>
                                                               <option value="Viúvo">Viúvo</option>
                                                               <option value="Separado">Separado</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="Endereço">Endereço residencial*</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="Endereço" name="Endereço" placeholder="Endereço" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="Telefone">Número de Telefone*</label>
                                                         <div class="mb-2">
                                                            <input type="text" class="form-control" id="Telefone" name="Telefone" placeholder="Telefone" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label" for="uemail">Email*</label>
                                                         <div class="mb-2">
                                                            <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Email" required />
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <div class="form-check">
                                                            <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                                            <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
                                                         </div>
                                                      </div>
                                                      <div class="form-group">
                                                         <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Iniciar Cadastro</button>
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
      <!-- custom app -->
      <script src="../assets/js/vendors.js"></script>
      <script src="../assets/js/app.js"></script>
   </body>
</html>
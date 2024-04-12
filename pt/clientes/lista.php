<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/clientes/dados.php");
         include("consultas/clientes/documentos/expirados.php");
         include_once("../config/auth.php");

         if(!in_array("Ver Clientes",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
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
                  <div class="row mb-0">
                     <div class="col-md-12 mb-1">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                           <div class="page-title mb-2 mb-sm-0">
                              <h1>Lista de Clientes</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Clientes
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Clientes</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        
                        <!-- end page title -->
                     </div>
                  </div>
                  <div class="mt-3 d-flex justify-content-between align-items-center">
                           <div class="">
                              <?php if(isset($expirados) && count($expirados) > 0): ?>
                                 <a role="button" data-toggle="modal" data-target="#ModalAll" class="btn btn-sm btn-dark text-light">Notificar Todos</a>
                                 <!-- MODAL Notify-->
                              <div class="modal" tabindex="-1" id="ModalAll">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Notificar Todos os Clientes</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <form action="notificar_viagem.php" method="post">
                                       <div class="modal-body">
                                             <p class="text-dark mb-3" id="text" style="font-size: 1.1em;">Deseja notificar todos os clientes com alguma documentação expirada?</p>
                                             <div id="form" class="row">
                                             
                                             </div>
                                             <div id="spinner" class=" mt-3 text-center">
                                                   <h4 class=" mb-3">Notificando. Por favor aguarde...</h4>
                                                   <img src="../assets/img/loading.gif" width="70px" height="70px" alt="">
                                             </div>
                                             <div id="sucesso" class=" mt-3 text-center">
                                                   <h4 class=" mb-3"> <span id="total_sent"></span> Clientes notificados com sucesso!</h4>
                                                   <img src="../assets/img/checked.png" width="70px" height="70px" alt="">
                                             </div>
                                             <div id="error" class=" mt-3 text-center">
                                                   <h4 class=" mb-3">Não foi possível notificar clientes!</h4>
                                                   <img src="../assets/img/remove.png" width="70px" height="70px" alt="">
                                             </div>
                                       </div>
                                       <div class="modal-footer" id="botoes">
                                       <a id="notificar" class="btn btn-info text-light">Notificar</a>   
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                       </div>
                                       </form>
                                    </div>
                                  </div>
                              </div>
                              <!-- END MODAL -->
                              <?php endif; ?>
                              <!-- <a href="#" class="btn btn-sm btn-primary ">Notificar</a> -->
                           </div>
                           <div class="">
                              <?php if(isset($expirados) && count($expirados) > 0): ?>
                              <div>
                                 <!-- <h5 class="text-danger dropdown-toggle"
                                 id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=count($expirados)?> Cliente(s) com documento expirado
                                 </h5> -->
                                 <h5 class="text-danger dropdown-toggle"
                                 
                                 type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                 <!-- <i class="fe fe-bell"></i> -->
                  <span class="notify mr-2">
                  <span class="blink"></span>    
                  <span class="dot"></span>
                  </span>  <?=count($expirados)?> Cliente(s) com documento expirado
                                 </h5>

                                 <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
        <h4 class=" modal-title">
         
                                    <?=count($expirados)?> Cliente(s) com documento expirado
                                 </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
        <?php foreach($expirados as $expirado): ?>
                                             <li class="dropdown-item py-3">
                                             <div class="d-flex justify-content-start align-items-center">
                                                <span class="mr-3"><?=$expirado['nome']?></span>
                                                <span class="text-danger"><?=$expirado['qtd_documentos']?></span>
                                                <a role="button" data-value="<?=$expirado['id']?>"  id="notify<?=$expirado['id']?>" class="btn btn-xs btn-info ml-2 notif text-light">Notificar</a>
                                                <span class="spinner_notify" id="spinner_notify<?=$expirado['id']?>">
                                                   <img src="../assets/img/loading2.gif" width="30px" height="30px" alt="">
                                                </span>
                                                <span class="error ml-3" id="error_notify<?=$expirado['id']?>">
                                                   <img src="../assets/img/remove.png" width="20px" height="20px" alt="">
                                                </span>
                                                <a href="#" class="btn btn-xs btn-dark ml-2 notificado" id="notificado_notify<?=$expirado['id']?>" class="btn btn-xs btn-dark ml-2">Notificado</a>
                                                
                                                <!-- <span class="spinner_notify" id="spinner_notify<?=$expirado['id']?>">
                                                <img src="../assets/img/checked.png" width="30px" height="30px" alt="">
                                                </span> -->
                                             </div>
                                             </li>
                                          <?php endforeach; ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                          <?php foreach($expirados as $expirado): ?>
                                             <!-- <li class="dropdown-item py-3">
                                             <div class="d-flex justify-content-end align-items-center">
                                                <span class="mr-3"><?=$expirado['nome']?></span>
                                                <span class="text-danger"><?=$expirado['qtd_documentos']?></span>
                                                <a role="button"   id="notify<?=$expirado['id']?>" class="btn btn-xs btn-info ml-2 notif text-light">Notificar</a>
                                                <span class="spinner_notify" id="spinner_notify<?=$expirado['id']?>">
                                                   <img src="../assets/img/loading.gif" width="30px" height="30px" alt="">
                                                </span>
                                                <a href="#" class="btn btn-xs btn-dark ml-2 notificado" id="notificado_notify<?=$expirado['id']?>" class="btn btn-xs btn-dark ml-2">Notificado</a>
                                                
                                                <span class="spinner_notify" id="spinner_notify<?=$expirado['id']?>">
                                                <img src="../assets/img/checked.png" width="30px" height="30px" alt="">
                                                </span>
                                             </div>
                                             </li> -->
                                          <?php endforeach; ?>
                                       
                                    
                                 </div>
                              </div>
                              <?php endif; ?>
                           </div>
                  </div>
                  <!-- end row -->
                  <div class="row mt-0">
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
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_clientes.php" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus clientes aqui..." class="form-control" type="search" name="termo" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div>
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Nome</th>
                                          <th>NIF</th>
                                          <!-- <th>Data de Nascimento</th> -->
                                          <th>Nacionalidade</th>
                                          <th>Telefone</th>
                                          <th>Freelancer</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       <?php 
                                          
                                       foreach($clients as $client): ?>
                                       <tr>
                                          <td><?php echo $client['nome'] ?></td>
                                          <td><?php echo $client['nif'] ?></td>
                                          <!-- <td><?php echo $client['data_de_nascimento'] ?></td> -->
                                          <td><?php echo $client['nacionalidade'] ?></td>
                                          <td><?php echo $client['telefone'] ?></td>
                                          <td>
                                             <?php if($client['freelancer_nome']): ?>
                                                <a href="../freelancers/comissoes.php?freelancer_id=<?=base64_encode($client['freelancer_id'])?>"><?php echo $client['freelancer_nome'] ?></a>
                                             <?php else: ?>
                                                <span>-----</span>
                                             <?php endif; ?>
                                             
                                          </td>
                                          <td>
                                             <a href="dados_cliente.php?cliente_id=<?=base64_encode($client['id']);?>" class="btn btn-sm btn-icon btn-success"><i class="dripicons dripicons-preview"></i></a>
                                             <a href="cliente_servicos.php?cliente_id=<?=base64_encode($client['id']);?>" class="btn btn-sm  btn-info">Serviços</a>
                                             <a href="editar.php?cliente_id=<?=base64_encode($client['id']);?>" class="btn btn-sm btn-info">Editar</a>
                                           
                                          </td>
                                       </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th>Número de Conta</th>
                                          <th>Nome</th>
                                          <th>Profissão</th>
                                          <th>Sálario</th>
                                          <th>Telefone</th>
                                          <th>Email</th>
                                          <th>Perfil</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
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
      <!-- plugins -->
      <script src="../assets/js/jquery-3.3.1.min.js"></script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
      <script>
         $(document).ready(function(){
            
            // 
            // NOTIFICAR DOCUMENTO EXPIRADO INDIVIDUALMENTE
            // 

            $(".notificado").hide();
            $(".error").hide();
            $(".spinner_notify").hide();

            $(".notif").click(function(){
               var id = $(this).attr("id");
               var id_client = $(this).attr("data-value");

               $("#spinner_"+id).show();
               $(this).hide();
               
               // console.log($("#spinner_"+id));
               // console.log("ID_CLIENT: "+id_client);

               $.ajax({
                  url: "<?=BASE_URL?>pt/clientes/notificar_documento.php",
                  method:"POST", 
                  dataType:"json",
                  data:{
                     client_id: id_client
                  },
                  success: function(result){
                     console.log(result);
                     if((result != undefined) && (result != null)  )
                     {
                        if( (result.status!= undefined) &&  (result.status!= null) )
                        {
                           if(result.status == "success")
                           {
                              $("#spinner_"+id).hide();
                              $("#notificado_"+id).show();
                              
                           }else{
                              $("#spinner_"+id).hide();
                              $("#error_"+id).show();
                           }
                        }
                     } 
                  },
                  error: function(xhr){
                     // console.log(xhr);
                     // alert("An error occured: " + xhr.status + " " + xhr.statusText);
                     $("#spinner_"+id).hide();
                     $("#error_"+id).show();
                  }
            });

            });

            // 
            // FIM DO NOTIFICAR DOCUMENTO EXPIRADO INDIVIDUALMENTE
            // 


            // 
            // NOTIFICAR DOCUMENTO EXPIRADO COLECTIVAMENTE
            // 

            $("#spinner").hide();
            $("#sucesso").hide();
            $("#error").hide();

            $("#notificar").click(function(){
               // alert();
               // exit();
               $("#form").hide();
               $("#botoes").hide();
               $("#text").hide();
               $("#sucesso").hide();
               $("#error").hide();
               $("#spinner").fadeIn();

               $.ajax({
                  url: "<?=BASE_URL?>pt/clientes/notificar_documento_all.php",
                  method:"POST", 
                  dataType:"json",
                  data:{
                     
                  },
                  success: function(result){
                     // console.log(result);
                     if((result != undefined) && (result != null)  )
                     {
                        if( (result.status!= undefined) &&  (result.status!= null) )
                        {
                           if(result.status == "success")
                           {
                              $("#spinner").hide();
                              $("#sucesso").fadeIn();
                              $("#total_sent").text(result.total_sent?result.total_sent:'')
                           }else{
                              $("#spinner").hide();
                              $("#sucesso").hide();
                              $("#error").fadeIn();
                           }
                        }
                     } 
                  },
                  error: function(xhr){
                     console.log(xhr);
                     $("#spinner").hide();
                     $("#sucesso").hide();
                     $("#error").fadeIn();
                  }
               });
            
            });



         });

      </script>

   </body>
</html>
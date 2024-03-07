<?php 
   include("../env/auth_check.php");
   include("env/auth_check.php");
   ?>
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
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
                     <div class="col-md-12 m-b-30">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                           <div class="page-title mb-2 mb-sm-0">
                              <h1>Lista de Agências</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Agências
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Agências</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <?php
                                 if ($cargo_id == 3 || $cargo_id == 4) {

                                    $termo_pesquisa = isset($_GET['termo_pesquisa']) ? $_GET['termo_pesquisa'] : '';
                                    $sql = "SELECT * FROM agencias WHERE id_agencia LIKE '%$termo_pesquisa%'
                                    OR nome_agencia LIKE '%$termo_pesquisa%'";
                                    $result = $conn->query($sql);
                                    ?>
                                 <form class="" action="agencia_pesquisar" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelas agências aqui..." class="form-control" type="search" name="termo_pesquisa" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div>
                                 </form>
                                 <?php
                                    if ($result->num_rows > 0) {
                                    ?>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>ID</th>
                                          <th>Nome</th>
                                          <th>Endereço</th>
                                          <th>Telefone</th>
                                          <th>Província</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          while ($row = $result->fetch_assoc()) {
                                          ?>
                                       <tr>
                                          <td><?php echo $row["id_agencia"]; ?></td>
                                          <td><?php echo $row["nome_agencia"]; ?></td>
                                          <td><?php echo $row["endereco"]; ?></td>
                                          <td><?php echo $row["telefone"]; ?></td>
                                          <td><?php echo $row["provincia"]; ?></td>
                                          <td><a href="agencia_editar?agencia_selecionado=<?php echo $row["id_agencia"]; ?>" class="zmdi zmdi-assignment">Ver Agência</a></td>
                                       </tr>
                                       <?php
                                          }
                                          ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th>ID</th>
                                          <th>Nome</th>
                                          <th>Endereço</th>
                                          <th>Telefone</th>
                                          <th>Província</th>
                                          <th>Ação</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                                 <?php
                                    } else {
                                        echo "Nenhum resultado encontrado.";
                                    }                                    }else {

                                       $error_message = "<p style='color:red'>Você não tem permissão suficiente para aceder esta página!</p>";
                                       echo $error_message;}
                                    
                                    // Fechar a conexão
                                    $conn->close();
                                    ?>
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
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>
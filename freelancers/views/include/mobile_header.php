<div class="responsive main-header collapse" id="navbarSupportedContent-4">
   <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark d-sm-none ">
      <div class="navbar-collapse">
         <div class="d-flex order-lg-2 ml-auto">
            <form class="navbar-form nav-item my-auto d-lg-none" role="search">
               <div class="input-group nav-item my-auto">
                  <input type="text" id="mobileSearchInput" class="form-control" placeholder="Pesquise aqui...">
                  <span class="input-group-btn">
                  <button type="reset" class="btn btn-default">
                  <i class="ti-close"></i>
                  </button>
                  <button type="submit" id="mobileSearchButton" class="btn btn-default nav-link">
                  <i class="ti-search"></i>
                  </button>
                  </span>
               </div>
            </form>
            <div class="d-md-flex">
               <div class="nav-item full-screen fullscreen-button">
                  <a class="new nav-link full-screen-link" href="#"><i class="ti-fullscreen"></i></span></a>
               </div>
            </div>
            <div class="dropdown main-profile-menu nav nav-item nav-link">
               <a class="profile-user" href="../"><img alt="" src="../assets/img/faces/user.jfif"></a>
               <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                  <div class="main-header-profile header-img">
                     <div class="main-img-user"><img alt="" src="../assets/img/faces/user.jfif"></div>
                     <h6><?php echo $cliente_nome?></h6>
                  </div>
                  <a class="dropdown-item" href="../perfil/conta"><i class="far fa-user"></i> Minha Conta</a>
                  <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Terminar Sessão</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
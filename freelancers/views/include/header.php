<?php include_once("../utils/helpers.php");?>
<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="app-sidebar__toggle mobile-toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icons" data-eva="menu-outline"></i></a>
							<a class="close-toggle" href="#"><i class="header-icons" data-eva="close-outline"></i></a>
						</div>
						<div class="main-header-center ml-3 d-sm-none d-md-none d-lg-block">
						    <input type="search" id="searchInput" class="form-control" placeholder="Pesquise aqui...">
							<button id="searchButton" class="btn"><i class="fas fa-search"></i></button>
						</div>
					</div>
					<div class="main-header-center">
						<div class="responsive-logo">
							<a href="../">
                                <img src="../assets/img/brand/logo.png" class="mobile-logo" alt="logo">
                                <img src="../assets/img/brand/logo.png" class="dark-mobile-logo" alt="logo">
                            </a>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<form class="navbar-form nav-item my-auto d-lg-none" role="search">
								<div class="input-group nav-item my-auto">
									<input type="text" class="form-control" placeholder="Search">
									<span class="input-group-btn">
										<button type="reset" class="btn btn-default">
											<i class="ti-close"></i>
										</button>
										<button type="submit" class="btn btn-default nav-link">
											<i class="ti-search"></i>
										</button>
									</span>
								</div>
							</form>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><i class="ti-fullscreen"></i></span></a>
							</div>
							<button class="navbar-toggler navresponsive-toggler d-sm-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
								aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon fe fe-more-vertical "></span>
							</button>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user" href="#"><img alt="" src="../assets/img/faces/user.jfif"></a>
								<div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
									<div class="main-header-profile header-img">
										<div class="main-img-user"><img alt="" src="../assets/img/faces/user.jfif"></div>
										<h5 class="text-info">Freelancer</h5>
										<h6><?php echo $user_name?reduce_fullname($user_name):"Utilizador" ?></h6>
									</div>
									<a class="dropdown-item" href="../perfil/conta.php"><i class="far fa-user"></i> Minha Conta</a>
									<a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Terminar Sessão</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>




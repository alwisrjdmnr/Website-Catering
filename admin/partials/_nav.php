    <header class="header" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        
        <div class="header__img">
            <img src="/assetsForSideBar/img/perfil.jpg" alt="">
        </div>
    </header>

    <div class="l-navbar bg-dark" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="index.php" class="nav__logo bg-dark">
                    <i class='bx bx-layer nav__logo-icon'></i>
                    <span class="nav__logo-name ">Catering Trio</span>
                </a>

                <div class="nav__list">
                    <a href="index.php" class="nav__link nav-home bg-dark">
                      <i class='bx bx-grid-alt nav__icon' ></i>
                      <span class="nav__name">Home</span>
                    </a>
                    <a href="index.php?page=orderManage" class="nav-orderManage nav__link bg-dark">
                      <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                      <span class="nav__name">Pesanan</span>
                    </a>
                    <a href="index.php?page=ongkirManage" class="nav__link nav-categoryManage bg-dark">
                      <i class='bx bx-dollar nav__icon' ></i>
                      <span class="nav__name">Data Ongkir</span>
                    </a>
                    <a href="index.php?page=categoryManage" class="nav__link nav-categoryManage bg-dark">
                      <i class='bx bx-folder nav__icon' ></i>
                      <span class="nav__name">Data Kategori</span>
                    </a>
                    <a href="index.php?page=menuManage" class="nav__link nav-menuManage bg-dark">
                      <i class='bx bx-message-square-detail nav__icon' ></i>
                      <span class="nav__name">Menu</span>
                    </a>
                    <a href="index.php?page=contactManage" class="nav__link nav-contactManage bg-dark">
                      <i class="fas fa-hands-helping"></i>
                      <span class="nav__name">Kontak</span>
                    </a>
                    <a href="index.php?page=userManage" class="nav__link nav-userManage bg-dark">
                      <i class='bx bx-user nav__icon' ></i>
                      <span class="nav__name">Users</span>
                    </a>
                    <a href="index.php?page=siteManage" class="nav__link nav-siteManage bg-dark">
                      <i class="fas fa-cogs"></i>
                      <span class="nav__name">Pengaturan</span>
                    </a>
                </div>
            </div>
            <a href="partials/_logout.php" class="nav__link bg-dark">
              <i class='bx bx-log-out nav__icon' ></i>
              <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>  
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
	  $('.nav-<?php echo $page; ?>').addClass('active')
</script>
   
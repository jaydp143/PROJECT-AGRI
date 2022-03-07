<nav class="main-header navbar navbar-collapse-md navbar-success navbar-dark">
    <div class="container">
      <a href="dashbooard.php">
        <img src="../dist/img/pang.png" alt="Pangasinan Logo"  width="50" height="50" class="d-inline-block" alt=""">
      </a>
      <a href="dashbooard.php" class="navbar-brand">
        <span class="brand-text font-weight-heavy h3">PROVINCIAL AGRICULTURE OFFICE</span>
        <br>
        <p class="h5">RICE CROP MONITORING SYSTEM</p>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">|</span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a href="dashboard.php" class="nav-link">HOME</a>
          </li>
          <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">MONITORING</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="planting_accomplishment_monitoring.php" class="dropdown-item">PLANTING</a></li>
              <li><a href="harvesting_accomplishment_monitoring.php" class="dropdown-item">HARVESTING</a></li>
              <li><a href="cropstages.php" class="dropdown-item">CROP STAGES</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">SYSTEM SET-UP</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="municipality.php" class="dropdown-item">MUNICIPALITY</a></li>
              <li><a href="seed.php" class="dropdown-item">SEEDS</a></li>
              <li><a href="seed_type.php" class="dropdown-item">SEED TYPE</a></li>
              <li><a href="ecosystem.php" class="dropdown-item">ECOSYSTEM</a></li>
              <li><a href="target.php" class="dropdown-item">TARGETS</a></li>
              
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">REPORT</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">PLANTING</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li><a href="view_planting_report.php" class="dropdown-item">PLANTING REPORT</a></li>
                  <li><a href="view_plantingByST_report.php" class="dropdown-item">PLANTING STATUS BY SEED TYPE</a></li>
                  <li><a href="view_plantingByEco_report.php" class="dropdown-item">PLANTING STATUS BY ECOSYSTEM</a></li>
                </ul>
              </li>
              <!-- End Level two -->
              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">HARVESTING</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li><a href="view_harvesting_report.php" class="dropdown-item">HARVESTING REPORT</a></li>
                  <li><a href="view_harvestingByST_report.php" class="dropdown-item">HARVESTING STATUS BY SEED TYPE</a></li>
                  <li><a href="view_harvestingByEco_report.php" class="dropdown-item">HARVESTING STATUS BY ECOSYSTEM</a></li>
                </ul>
              </li>
              <!-- End Level two -->
              
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="d-lg-inline text-gray-600">Welcome <?php echo " ".$_SESSION['username']."!"; ?></span>
          </a>
          
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editprofile">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile Settings
                    </a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Change_password" >
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Change Password
                    </a>
                    <div class="dropdown-divider"></div> -->
                    <a href="logout.php" class="dropdown-item" >
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>-->
      </ul>
    </div>
  </nav>
<nav class="main-header navbar navbar-expand navbar-success navbar-dark" style="background-color:#1B5E20;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><p class="fas fa-bars text-light"> RICE CROP MONITORING SYSTEM</p> </a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="d-lg-inline text-gray-600"><i class="fas fa-user-tie"></i> Welcome <?php echo " ".$_SESSION['username']."!"; ?></span>
          </a>
          
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editprofile">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile Settings
                    </a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Change_password" >
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <?php

                    if  ($_SESSION['userlevel']=='admin'){
                      echo'<a href="user.php" class="dropdown-item" >
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      ADMIN
                    </a>';
                    }
                    ?>
                    <a href="logout.php" class="dropdown-item" >
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
        </li>
    </ul>
  </nav>
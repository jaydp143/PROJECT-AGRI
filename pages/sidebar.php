<aside class="main-sidebar sidebar-dark-info elevation-4  "style="background-color:#33691E;">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link elevation-4 " style="background-color:#2E7D32;">
      <img src="../dist/img/pang.png" alt="Pangasinan Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PANGASINAN AGRI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo $db; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    DASHBOARD
                </p>
                </a>
            </li>
          
          
          <li class="nav-item <?php echo $monitoring_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $monitoring_nav_link; ?>">
              <i class="fas fa-desktop"></i>
              <p>
                CROP MONITORING
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="planting_monitoring.php" class="nav-link <?php echo $pl_monitoring; ?>">
                <i class="fas fa-angle-right"></i>
                  <p> PLANTING ACCOMP.</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_planting_accomplishment2.php" class="nav-link <?php echo $pl_monitoring; ?>">
                <i class="fas fa-angle-right"></i>
                  <p> DATA ENTRY.</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="harvest_monitoring.php" class="nav-link <?php echo $hr_monitoring; ?>">
                <i class="fas fa-angle-right"></i>
                  <p>HARVEST ACCOMP.</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crop_schedule.php" class="nav-link <?php echo $cr_sched; ?>">
                <i class="fas fa-angle-right"></i>
                  <p>CROP SCHEDULE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crop_stages.php" class="nav-link <?php echo $cr_stage; ?>">
                <i class="fas fa-angle-right"></i>
                  <p>CROP STAGES</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="damage_monitoring.php" class="nav-link <?php echo $dm_ass; ?>">
                <i class="fas fa-angle-right"></i>
                  <p>DAMAGE ASSESSTMENT</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item <?php echo $pl_monitoring_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $pl_monitoring_nav_link; ?>">
              <i class="fas fa-leaf"></i>
              <p>
                PLANTING
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="planting_monitoring.php" class="nav-link <?php echo $pl_monitoring; ?>">
                <i class="fas fa-leaf"></i>
                  <p> ACCOMPLISHMENT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_planting_accomplishment2.php" class="nav-link <?php echo $pl_monitoring_add; ?>">
                <i class="fas fa-leaf"></i>
                  <p> ADD ENTRY</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php echo $hr_monitoring_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $hr_monitoring_nav_link; ?>">
            <i class="fas fa-seedling"></i>
              <p>
                HARVESTING
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="harvest_monitoring.php" class="nav-link <?php echo $hr_monitoring; ?>">
                <i class="fas fa-seedling"></i>
                  <p>ACCOMPLISHMENT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_harvest_accomplishment2.php" class="nav-link <?php echo $hr_monitoring_add; ?>">
                <i class="fas fa-seedling"></i>
                  <p>ADD ENTRY</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="crop_schedule.php" class="nav-link <?php echo $cr_sched; ?>">
            <i class="far fa-calendar-alt"></i>
              <p>CROP SCHEDULE</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="crop_stages.php" class="nav-link <?php echo $cr_stage; ?>">
            <i class="fas fa-chart-line"></i>
              <p>CROP STAGES</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="damage_monitoring.php" class="nav-link <?php echo $dm_ass; ?>">
            <i class="fas fa-house-damage"></i>
              <p>DAMAGE ASSESSMENT</p>
            </a>
          </li>

          <li class="nav-item <?php echo $report_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $report_nav_link; ?>">
              <i class="fas fa-print"></i>
              <p>
                REPORT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="view_planting_report.php" class="nav-link <?php echo $pl_report; ?>">
                <i class="fas fa-print"></i>
                  <p>PLANTING REPORTS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view_harvesting_report.php" class="nav-link <?php echo $hr_report; ?>">
                <i class="fas fa-print"></i>
                  <p>HARVESTING REPORTS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php echo $set_up_nav_item; ?>">
            <a href="#" class="nav-link <?php echo $set_up_nav_link; ?>">
            <i class="fas fa-cog"></i>
              <p>
                SET-UP
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="municipality.php" class="nav-link <?php echo $mn_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>Municipality</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="seed.php" class="nav-link <?php echo $sd_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>Seeds</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="seed_type.php" class="nav-link <?php echo $sdt_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>Seed Types</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ecosystem.php" class="nav-link <?php echo $eco_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>Ecosystems</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="target.php" class="nav-link <?php echo $target_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>Targets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dat_setting.php" class="nav-link <?php echo $target_set_up; ?>">
                <i class="fas fa-cog"></i>
                  <p>DAT Setting</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li> -->
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
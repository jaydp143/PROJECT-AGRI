<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
   <img src="../images/logos6.png" width="30%">
  <div class="sidebar-brand-text mx-3">FMIS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item  <?php echo $dash; ?>">
  <a class="nav-link" href="dashboard.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>


<!-- Divider budget-->
<hr class="sidebar-divider">
    <!-- page Budget Management -->
    <div class="sidebar-heading" style="color: white">
      <h6><b>SYSTEM SET UP</b></h6> 
    </div>
    <li class="nav-item  <?php echo $of; ?>">
      <a class="nav-link" href="./offices.php">
        <i class="fa fa-th-list" aria-hidden="true"></i>
        <span>Offices/Hospitals</span></a>
    </li>  
    <li class="nav-item  <?php echo $ac; ?>">
      <a class="nav-link" href="./acc_category.php">
        <i class="fa fa-th-list" aria-hidden="true"></i>
        <span>Account Category</span></a>
    </li>

    <li class="nav-item <?php echo $act; ?>">
      <a class="nav-link" href="./account.php">
        <i class="fa fa-address-card" aria-hidden="true"></i>
        <span>Accounts</span></a>
    </li>
    <li class="nav-item <?php echo $repAct; ?>">
      <a class="nav-link" href="./receipt_account.php">
        <i class="fa fa-address-card" aria-hidden="true"></i>
        <span>Receipt Accounts</span></a>
    </li>

    <li class="nav-item <?php echo $bdg; ?>">
      <a class="nav-link" href="./budget.php">
        <i class="fa fa-calculator" aria-hidden="true"></i> 
        <span>Budget</span></a>
    </li>
    <li class="nav-item <?php echo $in; ?>">
      <a class="nav-link" href="./income.php">
        <i class="fa fa-calculator" aria-hidden="true"></i> 
        <span>Income</span></a>
    </li>

<hr class="sidebar-divider">
    <!-- page Budget Management -->
    <div class="sidebar-heading" style="color: white">

      <h6><b>TRANSACTION</b></h6> 
    </div>

    <li class="nav-item ">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
       <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Allotment</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Custom Allotment:</h6>
          <a class="collapse-item <?php echo $adAll; ?>" href="./advice_allotment.php">Advice of Allotment</a>
          <a class="collapse-item <?php echo $all; ?>" href="./allotment.php">Create Advice of Allotment</a>
        </div>
      </div>
    </li>

    <li class="nav-item <?php echo $ear; ?>">
      <a class="nav-link" href="./earmark.php">
        <i class="fa fa-clipboard" aria-hidden="true"></i>
        <span>Earmark</span></a>
    </li>

    <li class="nav-item <?php echo $real; ?>">
      <a class="nav-link" href="./realignment.php">
        <i class="fas fa-exchange-alt" aria-hidden="true"></i>
        <span>Realignment</span></a>
    </li>

    <li class="nav-item <?php echo $obl; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseObligation" aria-expanded="true" aria-controls="collapseObligation">
       <i class="fa fa-clipboard" aria-hidden="true"></i>
        <span>Obligation</span>
      </a>
      <div id="collapseObligation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Custom Obligation:</h6>
          <a class="collapse-item <?php echo $ob; ?>" href="./obligation.php">Preparation and review of <br>Obligation Request<br> and Status</a>
          <a class="collapse-item <?php echo $appOb; ?>" href="./approval_obligation.php">Approval of Obligation<br>Request</a>
          <a class="collapse-item <?php echo $canOb; ?>" href="./cancellation_obligation.php">Cancellation of Obligation<br>Request</a>
          <a class="collapse-item <?php echo $vOb; ?>" href="./view_obligation.php">View Obligations</a>
        </div>
      </div>
    </li>

<hr class="sidebar-divider">
    <!-- page Budget Management -->
    <div class="sidebar-heading" style="color: white">
      <h6><b>QUERY</b></h6> 
    </div>

    <li class="nav-item <?php echo $balApp; ?>">
      <a class="nav-link " href="./balances_appropriation_allotment.php">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Balances of Appropriation and Allotment</span></a>
    </li>

     <li class="nav-item <?php echo $relrev; ?>">
      <a class="nav-link" href="./realignment_reversion_summary.php">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Realignment / Reversion Summary</span></a>
    </li>

     <li class="nav-item <?php echo $brkOb; ?>">
      <a class="nav-link" href="./breakdown_obligation_allotment.php">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Breakdown of Obligation and Allotment and Status of Obligation</span></a>
    </li>

 <hr class="sidebar-divider">
     <!-- page Budget Management -->
    <div class="sidebar-heading" style="color: white">
      <h6><b>REPORTS</b></h6> 
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnnualBudget" aria-expanded="true" aria-controls="collapseAnnualBudget">
       <i class="fa fa-clipboard" aria-hidden="true"></i>
        <span>Annual Budget</span>
      </a>
      <div id="collapseAnnualBudget" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"></h6>
          <a class="collapse-item <?php echo $ar1; ?>" href="./annual_budget_office_view.php">OFFICES</a>
          <a class="collapse-item <?php echo $ar2; ?>" href="./annual_budget_hospital_view.php">HOSPITALS</a>
          <a class="collapse-item <?php echo $ar3; ?>" href="./annual_budget_non_office_view.php">NON-OFFICE</a>
          <a class="collapse-item <?php echo $ar4; ?>" href="./annual_budget_summary_view.php">SUMMARY OF <br>NEW APPROPRIATION</a>
        </div>
      </div>
    </li>
    <li class="nav-item <?php echo $inrep; ?>">
      <!-- <a class="nav-link" href="http://localhost:51220/Default.aspx" target="_blank"> -->
        <a class="nav-link" href="./income_report_view.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span>Receipts Program Report</span></a>
    </li>
    <li class="nav-item <?php echo $allrep; ?>">
      <!-- <a class="nav-link" href="http://localhost:51220/Default.aspx" target="_blank"> -->
        <a class="nav-link" href="./allotment_report_view.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span>Allotment Report</span></a>
    </li>
    <li class="nav-item <?php echo $adAllrep; ?>">
      <!-- <a class="nav-link" href="http://localhost:51220/Default.aspx" target="_blank"> -->
        <a class="nav-link" href="./advice_allotment_report_view.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span> Advice Allotment Report</span></a>
    </li>
    <li class="nav-item <?php echo $monObRep; ?>">
      <!-- <a class="nav-link" href="http://localhost:51220/Default.aspx" target="_blank"> -->
        <a class="nav-link" href="./monthly_obligation_view.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span> Monthly Obligation Report</span></a>
    </li>
    <li class="nav-item <?php echo $qObRep; ?>">
        <a class="nav-link" href="./quarterly_obligation_view.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span> Quarterly Obligation Report</span></a>
    </li>
    <li class="nav-item <?php echo $RelRevRep; ?>" >
        <a class="nav-link" href="./realignment_reversion_summary_report.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span>Realignment/ Reversion Summary Report</span></a>
    </li>
    <li class="nav-item <?php echo $obReqRep; ?>" >
        <a class="nav-link" href="./obligation_request_report.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span>Obligation Request Report</span></a>
    </li>
    <li class="nav-item <?php echo $dvr; ?>" >
        <a class="nav-link" href="./disbursement_voucher_report.php" >
        <i class="fa fa-file" aria-hidden="true"></i>
        <span>Disbursement Voucher Report</span></a>
    </li>



<!-- Divider budget-->
<hr class="sidebar-divider">
<!--       end -->

<!-- Pages manage users-->
 <div class="sidebar-heading">
      User Management
  </div>

 <li class="nav-item <?php echo $LUser; ?> ">
  <a class="nav-link" href="list_users.php">
    <i class="fa fa-user-circle"></i>
    <span>Manage Users</span></a>
  </li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
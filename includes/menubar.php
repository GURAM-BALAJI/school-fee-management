<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($admin['admin_photo'])) ? '../images/' . $admin['admin_photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['admin_name']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li><a href="../home/index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <?php
      if ($admin['payments_view']) { ?>
        <li class="header">PAYMENTS</li>
        <?php
        if ($admin['payments_view']) { ?>
          <li><a href="../payments/index.php"><i class="fa fa-money"></i> <span>Payments</span></a></li>
        <?php } ?>
      <?php } ?>
      <?php
      if ($admin['students_view'] || $admin['classes_and_fee_view']) { ?>
        <li class="header">MANAGE</li>
        <?php
        if ($admin['students_view']) { ?>
          <li><a href="../students/index.php"><i class="fa fa-users"></i> <span>Students</span></a></li>
        <?php } ?>

        <?php
        if ($admin['classes_and_fee_view']) { ?>
          <li><a href="../classes_and_fee/index.php"><i class="fa fa-signal"></i> <span>Class and Fee</span></a></li>
        <?php } ?>
      <?php } ?>
      <?php
      if ($admin['payments_records_view'] || $admin['payment_pending_records_view'] || $admin['students_records_view']  || $admin['not_taken_records_view']) { ?>
        <li class="header">RECORDS</li>
        <?php
        if ($admin['payments_records_view']) { ?>
          <li><a href="../records/Payments_records.php"><i class="fa fa-file-text"></i> <span>Payments List</span></a></li>
        <?php } ?>
        <?php
        if ($admin['payment_pending_records_view']) { ?>
          <li><a href="../records/Payments_pending_records.php"><i class="fa fa-hourglass-end"></i> <span>Payments Pending List</span></a></li>
        <?php } ?>
        <?php
        if ($admin['students_records_view']) { ?>
          <li><a href="../records/students_records.php"><i class="fa fa-list"></i> <span>Students List</span></a></li>
        <?php } ?>
        <?php
        if ($admin['not_taken_records_view']) { ?>
          <li><a href="../records/not_taken_records.php"><i class="fa fa-exclamation"></i> <span>Not Taken List</span></a></li>
        <?php } ?>
      <?php } ?>
      <?php
      if ($admin['admin_view'] || $admin['admin_type']) { ?>
        <li class="header">LOGIN'S</li>
        <?php
        if ($admin['admin_view'] && $admin['admin_type']==0 ) { ?>
          <li><a href="../admin/index.php"><i class="fa fa-grav"></i> <span>Admin</span></a></li>
        <?php } 
        if ($admin['admin_type']) { ?>
          <li><a href="../supper_admin/index.php"><i class="fa fa-lock"></i> <span>Supper Admin</span></a></li>
          <li><a href="../supper_admin_school_info/index.php"><i class="fa fa-id-card-o"></i> <span>School Info</span></a></li>
        <?php } ?>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
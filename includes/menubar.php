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
      <li><a href="../home/home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <?php
      if ($admin['payments_view']) { ?>
        <li class="header">PAYMENTS</li>
        <?php
        if ($admin['payments_view']) { ?>
          <li><a href="../payments/payments.php"><i class="fa fa-money"></i> <span>Payments</span></a></li>
        <?php } ?>
      <?php } ?>
      <?php
      if ($admin['students_view'] || $admin['classes_and_fee_view']) { ?>
        <li class="header">MANAGE</li>
        <?php
        if ($admin['students_view']) { ?>
          <li><a href="../students/students.php"><i class="fa fa-users"></i> <span>Students</span></a></li>
        <?php } ?>

        <?php
        if ($admin['classes_and_fee_view']) { ?>
          <li><a href="../classes_and_fee/classes_and_fee.php"><i class="fa fa-signal"></i> <span>Class and Fee</span></a></li>
        <?php } ?>
      <?php } ?>
      <?php
      if ($admin['admin_view']) { ?>
        <li class="header">LOGIN'S</li>
        <?php
        if ($admin['admin_view']) { ?>
          <li><a href="../admin/admin.php"><i class="fa fa-grav"></i> <span>Admin</span></a></li>
        <?php } ?>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
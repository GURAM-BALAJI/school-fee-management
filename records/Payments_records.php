<?php include '../session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['payments_records_view']) { ?>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include '../includes/navbar.php'; ?>
            <?php include '../includes/menubar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Payments Records
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Records</li>
                        <li class="active">Payments Records</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal" action="export/" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Starting Date :</label>
                                                <div class="col-sm-7">
                                                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Ending Date :</label>
                                                <div class="col-sm-7">
                                                    <input type="date" class="form-control" name="end_date" id="end_date" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Payments Type :</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="payment_types">
                                                        <option value="0"> All Payments </option>
                                                        <option value='1'>Tuition Payments</option>
                                                        <option value='2'>Books Payments</option>
                                                        <option value='3'>Dress Payments</option>
                                                        <option value='4'>Transport Payments</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <input type="submit" class="form-control-static pull-right" name="submit" id="submit" value=" Submit ">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>
        <!-- ./wrapper -->

        <?php include '../includes/scripts.php'; ?>
    </body>
<?php } ?>

</html>
<?php include '../session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['payment_pending_records_view']) { ?>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include '../includes/navbar.php'; ?>
            <?php include '../includes/menubar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Payments Pending List
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Records</li>
                        <li class="active">Payments Pending List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
        
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <form class="form-horizontal" action="export/pending_records.php" method="post">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Pending Payment Type :</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="payment_types">
                                                        <option value="0">All Pending Payments </option>
                                                        <option value='1'>Tuition Pending Payments</option>
                                                        <option value='2'>Books Pending Payments</option>
                                                        <option value='3'>Uniform Pending Payments</option>
                                                        <option value='4'>Transport Pending Payments</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="class" class="col-sm-4 control-label">Class :</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="classes_and_fee_value">
                                                        <option value="0">All Class</option>
                                                        <?php
                                                        $stmt1 = $conn->prepare("SELECT * FROM classes_and_fee");
                                                        $stmt1->execute();
                                                        foreach ($stmt1 as $row1)
                                                            echo "<option value='" . $row1['classes_and_fee_value'] . "'>" . $row1['classes_and_fee_class'] . '(' . $row1['classes_and_fee_fee'] . ')' . "</option>";
                                                        ?>
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
<?php include '../session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['students_view']) { ?>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include '../includes/navbar.php'; ?>
            <?php include '../includes/menubar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Students
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li>Manage</li>
                        <li class="active">Students</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                        unset($_SESSION['success']);
                    }
                    ?>
                    <div class="panel panel-default" style="overflow-x:auto;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <?php if ($admin['students_create']) { ?>
                                        <div class="box-header with-border">
                                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New Students</a>
                                        </div>
                                    <?php } ?>
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <th>SL NO.</th>
                                                <th>SATS ID</th>
                                                <th>PHOTO</th>
                                                <th>NAME</th>
                                                <th>CLASS</th>
                                                <th>TUITION FEES BALANCE</th>
                                                <th>BOOKS FEES BALANCE</th>
                                                <th>DRESS FEES BALANCE</th>
                                                <th>TRANSPORT FEES BALANCE</th>
                                                <th>TOTAL BALANCE</th>
                                                <th>TOOLS_AND_FEE_HISTORY</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $conn = $pdo->open();
                                                try {
                                                    $stmt = $conn->prepare("SELECT * FROM students WHERE students_deleted='0'");
                                                    $stmt->execute();
                                                    $slno=1;
                                                    foreach ($stmt as $row) {
                                                        $image = (!empty($row['students_photo'])) ? '../students_photo/' . $row['students_photo'] : '../students_photo/no-image.png';
                                                        echo "<tr>";
                                                        echo "<td>" . $slno++. "</td>";
                                                        echo "<td>" . $row['students_regestration_no'] . "</td>";
                                                        echo "<td><a href='students_full_image_view.php?image=" . $image . "'> <img src='" . $image . "' height='30px' width='30px'></a> ";
                                                        if ($admin['students_edit'])
                                                            echo " <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='" . $row['students_id'] . "'><i class='fa fa-edit'></i></a></span></td>";
                                                        echo "<td>" . $row['students_name'] . "</td>";
                                                        $stmt1 = $conn->prepare("SELECT * FROM classes_and_fee WHERE classes_and_fee_value='" . $row['students_class'] . "'");
                                                        $stmt1->execute();
                                                        echo "<td>";
                                                        foreach ($stmt1 as $row1)
                                                            echo $row1['classes_and_fee_class'];
                                                        echo "</td>";
                                                       
                                                        echo "<td>";
                                                        if ($row['students_total_school_fee'] == 0)
                                                            echo "&#10060;";
                                                        else
                                                            echo $row['students_total_school_fee_balance'];
                                                            echo "</td>";
                                                            echo "<td>";
                                                        if ($row['students_total_books_fee'] == 0)
                                                            echo "&#10060;";
                                                        else
                                                            echo $row['students_total_books_fee_balance'];
                                                            echo "</td>";
                                                            echo "<td>";
                                                        if ($row['students_total_dress_fee'] == 0)
                                                            echo "&#10060;";
                                                        else
                                                            echo  $row['students_total_dress_fee_balance'];
                                                            echo "</td>";
                                                            echo "<td>";
                                                        if ($row['students_total_transport_fee'] == 0)
                                                            echo "&#10060;";
                                                        else
                                                            echo $row['students_total_transport_fee_balance'];
                                                        echo "</td>";
                                                        $total = $row['students_total_school_fee_balance'] + $row['students_total_books_fee_balance'] + $row['students_total_dress_fee_balance'] + $row['students_total_transport_fee_balance'];
                                                        echo "<td>" . $total . "</td>";
                                                        echo "<td>";
                                                        echo "<button class='btn btn-primary btn-sm view_more btn-flat' data-id='" . $row['students_id'] . "'><i class='fa fa-chevron-circle-down'></i> More</button> ";
                                                        echo "<button class='btn btn-warning btn-sm fee_details btn-flat' data-id='" . $row['students_id'] . "'><i class='fa fa-money'></i> Fee Details</button> ";
                                                        if ($admin['students_edit'])
                                                            echo "<button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['students_id'] . "'><i class='fa fa-edit'></i> Edit</button> ";
                                                        if ($admin['students_del'])
                                                            echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['students_id'] . "'><i class='fa fa-trash'></i> Delete</button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } catch (PDOException $e) {
                                                    echo $e->getMessage();
                                                }
                                                $pdo->close();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <?php include 'students_modal.php'; ?>

        </div>
        <!-- ./wrapper -->

        <?php include '../includes/scripts.php'; ?>
        <script>
            $(function() {
                $(document).on('click', '.edit', function(e) {
                    e.preventDefault();
                    $('#edit').modal('show');
                    var id = $(this).data('id');
                    getRow_edit(id);
                });

                $(document).on('click', '.fee_details', function(e) {
                    e.preventDefault();
                    $('#fee_details').modal('show');
                    var id = $(this).data('id');
                    getRow_fee(id);
                });

                $(document).on('click', '.view_more', function(e) {
                    e.preventDefault();
                    $('#view_more').modal('show');
                    var id = $(this).data('id');
                    getRow(id);
                });

                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    $('#delete').modal('show');
                    var id = $(this).data('id');
                    getRow(id);
                });
                $(document).on('click', '.photo', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    getRow(id);
                });
            });

            function getRow_fee(id) {
                $.ajax({
                    type: 'POST',
                    url: 'students_fee_row.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#fee_view').html(response.fee_view);
                    }
                });
            }

            function getRow_edit(id) {
                $.ajax({
                    type: 'POST',
                    url: 'students_edit_row.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#edit_students_id').val(response.students_id);
                        $('#edit_students_name').val(response.students_name);
                        $('#edit_students_regestration_no').val(response.students_regestration_no);
                        $('#edit_students_gender').html(response.students_gender);
                        $('#edit_students_DOB').val(response.students_DOB);
                        $('#edit_students_class').html(response.students_class);
                        $('#edit_students_religion').val(response.students_religion);
                        $('#edit_students_cast').val(response.students_cast);
                        $('#edit_students_mother_tongue').val(response.students_mother_tongue);
                        $('#edit_students_blood_group').val(response.students_blood_group);
                        $('#edit_students_adher').val(response.students_adher);
                        $('#edit_students_address').val(response.students_address);
                        $('#edit_students_father_name').val(response.students_father_name);
                        $('#edit_students_father_phone').val(response.students_father_phone);
                        $('#edit_students_father_occupation').val(response.students_father_occupation);
                        $('#edit_students_mother_name').val(response.students_mother_name);
                        $('#edit_students_mother_phone').val(response.students_mother_phone);
                        $('#edit_students_mother_occupation').val(response.students_mother_occupation);
                    }
                });
            }

            function getRow(id) {
                $.ajax({
                    type: 'POST',
                    url: 'students_row.php',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.students_photo_name').html(response.students_name);
                        $('.students_photo_id').val(response.students_id);
                        $('.delete_students_id').val(response.students_id);
                        $('.delete_students_name').html(response.students_name);
                        $('.delete_students_id_view').html(response.students_regestration_no);
                        $('#view_students_name').html(response.students_name);
                        $('#view_students_gender').html(response.students_gender);
                        $('#view_students_DOB').html(response.students_DOB);
                        $('#view_students_religion').html(response.students_religion);
                        $('#view_students_cast').html(response.students_cast);
                        $('#view_students_mother_tongue').html(response.students_mother_tongue);
                        $('#view_students_blood_group').html(response.students_blood_group);
                        $('#view_students_adher').html(response.students_adher);
                        $('#view_students_address').html(response.students_address);
                        $('#view_students_father_name').html(response.students_father_name);
                        $('#view_students_father_phone').html(response.students_father_phone);
                        $('#view_students_father_occupation').html(response.students_father_occupation);
                        $('#view_students_mother_name').html(response.students_mother_name);
                        $('#view_students_mother_phone').html(response.students_mother_phone);
                        $('#view_students_mother_occupation').html(response.students_mother_occupation);
                        $('#view_students_updated_date').html(response.students_updated_date);
                        $('#view_students_created_date').html(response.students_created_date);
                        $('#view_students_total_school_fee').html(response.students_total_school_fee);
                        $('#view_students_total_school_fee_balance').html(response.students_total_school_fee_balance);
                        $('#view_students_total_books_fee').html(response.students_total_books_fee);
                        $('#view_students_total_books_fee_balance').html(response.students_total_books_fee_balance);
                        $('#view_students_total_dress_fee').html(response.students_total_dress_fee);
                        $('#view_students_total_dress_fee_balance').html(response.students_total_dress_fee_balance);
                        $('#view_students_total_transport_fee').html(response.students_total_transport_fee);
                        $('#view_students_total_transport_fee_balance').html(response.students_total_transport_fee_balance);
                        $('#view_student_total_school_fee_paid').html(response.student_total_school_fee_paid);
                        $('#view_student_total_books_fee_paid').html(response.student_total_books_fee_paid);
                        $('#view_student_total_dress_fee_paid').html(response.student_total_dress_fee_paid);
                        $('#view_student_total_transport_fee_paid').html(response.student_total_transport_fee_paid);

                    }
                });
            }
        </script>
    </body>
<?php } ?>
<?php include '../includes/req_end.php'; ?>

</html>
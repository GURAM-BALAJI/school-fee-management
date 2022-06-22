<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['payments_view']) { ?>

  <head>
    <script src='jquery-3.2.1.min.js' type='text/javascript'></script>
    <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>

    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include '../includes/navbar.php'; ?>
      <?php include '../includes/menubar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Payments
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Payments</li>
            <li class="active">Payments</li>
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
                  <?php if ($admin['payments_create']) { ?>
                    <div class="box-header with-border">
                      <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New payments</a>
                    </div>
                  <?php } ?>
                  <div class="box-body">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th>SLNO</th>
                        <th>Payment ID</th>
                        <th>Student</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Through</th>
                        <th>Created Date</th>
                        <th>By</th>
                        <?php if ($admin['payments_del']) { ?>
                          <th>Tools</th>
                        <?php } ?>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();

                        try {
                          date_default_timezone_set('Asia/Kolkata');
                          $today = date('d-m-Y');
                          $stmt = $conn->prepare("SELECT * FROM payments WHERE payments_date='$today' order by payments_id DESC");
                          $stmt->execute();
                          $slno = 1;
                          foreach ($stmt as $row) {
                            echo  "<td>" . $slno++ . "</td>";
                            echo  "<td>" . $row['payments_id'] . "</td>";
                            $stmt1 = $conn->prepare("SELECT students_id,students_name FROM students WHERE students_id='" . $row['payments_students_id'] . "'");
                            $stmt1->execute();
                            foreach ($stmt1 as $row1)
                              echo "<td>" . $row1['students_name'] . " ( " . $row1['students_id'] . " )</td>";
                            echo "<td>";
                            if ($row['payments_type'] == '1')
                              echo "School Fee";
                            elseif ($row['payments_type'] == '2')
                              echo "Books Fee";
                            elseif ($row['payments_type'] == '3')
                              echo "Dress Fee";
                            elseif ($row['payments_type'] == '4')
                              echo "Transport Fee";
                            echo "</td>";
                            echo "<td>" . $row['payments_fee'] . "</td>";
                            echo "<td>";
                            if ($row['payment_through'] == '1')
                              echo "CASH";
                            elseif ($row['payment_through'] == '2')
                              echo "CARD";
                            elseif ($row['payment_through'] == '3')
                              echo "CHECK";
                            elseif ($row['payment_through'] == '4')
                              echo "UPI";
                            elseif ($row['payment_through'] == '5')
                              echo "NET BANKING";
                            elseif ($row['payment_through'] == '6')
                              echo "OTHERS";
                            echo "</td>";
                            echo "<td>" . $row['payments_created_date'] . "</td>";
                            $stmt1 = $conn->prepare("SELECT admin_id,admin_name FROM admin WHERE admin_id='" . $row['payments_by'] . "'");
                            $stmt1->execute();
                            foreach ($stmt1 as $row1)
                              echo "<td>" . $row1['admin_name'] . " ( " . $row1['admin_id'] . " )</td>";

                            if ($admin['payments_del'])
                              echo "<td><button class='btn btn-warning btn-sm roll_back btn-flat' data-id='" . $row['payments_id'] . "'><i class='fa fa-undo'></i> Roll Back</button></td>";

                            echo "</tr>
                        ";
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
      <?php include 'payments_modal.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include '../includes/scripts.php'; ?>
    <script>
      $(document).ready(function() {
        // Initialize select2
        $("#student_id").select2();
        $('#student_id').change(function(ev) {
          var student_id = $('#student_id').val();
          if (student_id) {
            $.ajax({
              type: 'POST',
              url: 'payments_ajaxData.php',
              data: 'student_id=' + student_id,
              success: function(html) {
                $('#fees_type').html(html);
                $('#payment_pay').html('');
              }
            });
          } else {
            $('#fees_type').html('<option disabled selected> Select Payment </option>');
          }
        });

        $('#fees_type').change(function(ev) {
          var student_id = $('#student_id').val();
          var fees_type = $('#fees_type').val();
          if (student_id && fees_type) {
            $.ajax({
              type: 'POST',
              url: 'payments_pay_ajaxData.php',
              data: {
                student_id: student_id,
                fees_type: fees_type
              },
              success: function(html) {
                $('#payment_pay').html(html);
              }
            });
          } else {
            $('#payment_pay').html('');
          }
        });

      });

      $(function() {
        $(document).on('click', '.roll_back', function(e) {
          e.preventDefault();
          $('#roll_back').modal('show');
          var id = $(this).data('id');
          getRow(id);
        });

      });

      function getRow(id) {
        $.ajax({
          type: 'POST',
          url: 'payments_row.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('.payment_id').html(response.payments_id);
            $('#payment_id').val(response.payments_id);
          }
        });
      }
    </script>
  </body>
<?php } ?>

</html>
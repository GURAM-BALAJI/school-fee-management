<?php include '../session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['classes_and_fee_view']) { ?>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include '../includes/navbar.php'; ?>
      <?php include '../includes/menubar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Class and Fee
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage</li>
            <li class="active">Class and Fee</li>
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
                  <?php if ($admin['classes_and_fee_create']) { ?>
                    <div class="box-header with-border">
                      <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New Class And Fee</a>
                    </div>
                  <?php } ?>
                  <div class="box-body">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th>Value</th>
                        <th>Class</th>
                        <th>Fee</th>
                        <th>Updated Date</th>
                        <th>Created Date</th>
                        <?php if ($admin['classes_and_fee_edit'] || $admin['classes_and_fee_del']) { ?>
                          <th>Tools</th>
                        <?php } ?>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();
                        try {
                          $stmt = $conn->prepare("SELECT * FROM classes_and_fee WHERE classes_and_fee_school_id=" . $_SESSION['admin_school_id'] . " ");
                          $stmt->execute();
                          foreach ($stmt as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['classes_and_fee_value'] . "</td>";
                            echo "<td>" . $row['classes_and_fee_class'] . "</td>";
                            echo "<td>" . $row['classes_and_fee_fee'] . "</td>";
                            echo "<td>" . $row['classes_and_fee_updated_date'] . "</td>";
                            echo "<td>" . $row['classes_and_fee_created_date'] . "</td>";
                            if ($admin['classes_and_fee_edit'] || $admin['classes_and_fee_del'])
                              echo "<td>";
                            if ($admin['classes_and_fee_edit'])
                              echo "<button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['classes_and_fee_id'] . "'><i class='fa fa-edit'></i> Edit</button> ";
                            if ($admin['classes_and_fee_del'])
                              echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['classes_and_fee_id'] . "'><i class='fa fa-trash'></i> Delete</button>";
                            if ($admin['classes_and_fee_edit'] || $admin['classes_and_fee_del'])
                              echo "</td>";
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
      <?php include 'classes_and_fee_modal.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include '../includes/scripts.php'; ?>
    <script>
      $(function() {
        $(document).on('click', '.edit', function(e) {
          e.preventDefault();
          $('#edit').modal('show');
          var id = $(this).data('id');
          getRow(id);
        });

        $(document).on('click', '.delete', function(e) {
          e.preventDefault();
          $('#delete').modal('show');
          var id = $(this).data('id');
          getRow(id);
        });
      });

      function getRow(id) {
        $.ajax({
          type: 'POST',
          url: 'classes_and_fee_row.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('#edit_classes_and_fee_id').val(response.classes_and_fee_id);
            $('#edit_classes_and_fee_value').val(response.classes_and_fee_value);
            $('#edit_classes_and_fee_class').val(response.classes_and_fee_class);
            $('#edit_classes_and_fee_fee').val(response.classes_and_fee_fee);
            $('.delete_classes_and_fee_id').val(response.classes_and_fee_id);
            $('.delete_classes_and_fee_class').html(response.classes_and_fee_class);
            $('.delete_classes_and_fee_fee').html(response.classes_and_fee_fee);
          }
        });
      }
    </script>
  </body>
<?php } ?>
<?php include '../includes/req_end.php'; ?>

</html>
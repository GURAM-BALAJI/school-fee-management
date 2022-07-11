<?php include '../session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php if ($admin['admin_type']) { ?>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include '../includes/navbar.php'; ?>
      <?php include '../includes/menubar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          School info
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Manage</li>
            <li class="active">School info</li>
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
                  
                    <div class="box-header with-border">
                      <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> NEW SCHOOL</a>
                    </div>
                  <div class="box-body">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <th>SL NO.</th>
                        <th>SCHOOL ID</th>
                        <th>LOGO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>TOOLS</th>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();
                        try {
                          $stmt = $conn->prepare("SELECT * FROM school_info");
                          $stmt->execute();
                          foreach ($stmt as $row) {
                            $image = (!empty($row['school_info_logo'])) ? '../images/school/' . $row['school_info_logo'] : '../images/school/profile.jpg';
                            echo "<tr>";
                            echo "<td>" . $row['school_info_school_id'] . "</td>";
                            echo "<td><img src='" . $image . "' height='30px' width='30px'><span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='" . $row['admin_id'] . "'><i class='fa fa-edit'></i></a></span> </td>";
                            echo "<td>" . $row['school_info_class'] . "</td>";
                            echo "<td>" . $row['school_info_first_name'] . " " . $row['school_info_last_name'] . "</td>";
                            echo "<td>" . $row['school_info_email'] . "</td>";
                            echo "<td>" . $row['school_info_phone'] . "</td>";
                            echo "<td>" . $row['school_info_address'] . "</td>";
                              echo "<td>";
                              echo "<button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['school_info_id'] . "'><i class='fa fa-edit'></i> Edit</button> ";
                              echo "<button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['school_info_id'] . "'><i class='fa fa-trash'></i> Delete</button>";
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
      <?php include 'school_info_modal.php'; ?>

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

        $(document).on('click', '.photo', function(e) {
          e.preventDefault();
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
          url: 'school_info_row.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('#edit_school_info_id').val(response.school_info_id);
            $('#edit_school_info_school_id').val(response.school_info_school_id);
            $('#edit_school_info_first_name').val(response.school_info_first_name);
            $('#edit_school_info_last_name').val(response.school_info_last_name);
            $('#edit_school_info_email').val(response.school_info_email);
            $('#edit_school_info_phone').val(response.school_info_phone);
            $('#edit_school_info_address').val(response.school_info_address);

            $('.delete_school_info_id').val(response.school_info_id);
            $('.delete_school_info_class').html(response.school_info_first_name);
          }
        });
      }
    </script>
  </body>
<?php } ?>
<?php include '../includes/req_end.php'; ?>

</html>
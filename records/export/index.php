<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- jQuery -->
  <title>DEMO SCHOOL</title>
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpeg">
</head>

<body>
  <?php include '../../session.php';
  if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Kolkata');
    $starting_date = $_POST['start_date'];
    $ending_date = $_POST['end_date'];
    $payment_types = $_POST['payment_types'];
    $starting_date = strtotime($starting_date);
    $ending_date = strtotime($ending_date);
  ?>
    <div class="table-responsive">
      <div class="top-panel">
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Export <span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a class="dataExport" data-type="excel">Excel</a></li>
          </ul>
        </div>
      </div>
      <table id="dataTable" class="table table-striped">
        <thead>
          <th>SL NO.</th>
          <th>PAYMENT ID</th>
          <th>STUDENT</th>
          <th>TYPE</th>
          <th>AMOUNT</th>
          <th>PAYMENT MODE</th>
          <th>CREATED DATE</th>
          <th>BY</th>
        </thead>
        <tbody>
          <?php
          $conn = $pdo->open();
          try {
            $total = 0;
            $slno = 1;
            for ($i = $starting_date; $i <= $ending_date; $i += 86400) {
              $date = date("d-m-Y", $i);
              if ($payment_types == 0)
                $stmt = $conn->prepare("SELECT * FROM payments WHERE payments_date='$date' AND payments_school_id=" . $_SESSION['admin_school_id'] . "");
              else
                $stmt = $conn->prepare("SELECT * FROM payments WHERE payments_type=$payment_types AND payments_date='$date'  AND payments_school_id=" . $_SESSION['admin_school_id'] . "");
              $stmt->execute();
              foreach ($stmt as $row) {
                echo  "<td>" . $slno++ . "</td>";
                echo  "<td>" . $row['payments_id'] . "</td>";
                $stmt1 = $conn->prepare("SELECT students_regestration_no,students_name FROM students WHERE students_id=" . $row['payments_students_id'] . "  AND students_school_id=" . $_SESSION['admin_school_id'] . "");
                $stmt1->execute();
                foreach ($stmt1 as $row1)
                  echo "<td>" . $row1['students_name'] . " ( " . $row1['students_regestration_no'] . " )</td>";
                echo "<td>";
                if ($row['payments_type'] == '1')
                  echo "Tuition Fees";
                elseif ($row['payments_type'] == '2')
                  echo "Books Fees";
                elseif ($row['payments_type'] == '3')
                  echo "Uniform Fees";
                elseif ($row['payments_type'] == '4')
                  echo "Transport Fees";
                echo "</td>";
                $total += $row['payments_fee'];
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
                $stmt1 = $conn->prepare("SELECT admin_id,admin_name FROM admin WHERE admin_id=" . $row['payments_by'] . "  AND admin_school_id=" . $_SESSION['admin_school_id'] . "");
                $stmt1->execute();
                foreach ($stmt1 as $row1)
                  echo "<td>" . $row1['admin_name'] . " ( " . $row1['admin_id'] . " )</td>";
                echo "</tr>";
              }
            }
            echo "<tr><th colspan='4'>TOTAL:</th><th>" . $total . "</th><td colspan='2'></td></tr>";
          } catch (PDOException $e) {
            echo $e->getMessage();
          }

          $pdo->close();
          ?>
        </tbody>
      </table>
    <?php
  } else {
    header("location: ../records/");
  } ?>
    </div>

    <script src="tableExport/tableExport.js"></script>
    <script type="text/javascript" src="tableExport/jquery.base64.js"></script>
    <script src="js/export.js"></script>
    <div class="insert-post-ads1" style="margin-top:20px;">
</body>

</html>
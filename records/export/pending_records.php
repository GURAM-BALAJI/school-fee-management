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
        $payment_types = $_POST['payment_types'];
        $classes_and_fee_value = $_POST['classes_and_fee_value'];
        if ($payment_types != 0)
            if ($payment_types == 1)
                $payment_balance_name = 'students_total_school_fee_balance';
            elseif ($payment_types == 2)
                $payment_balance_name = 'students_total_books_fee_balance';
            elseif ($payment_types == 3)
                $payment_balance_name = 'students_total_dress_fee_balance';
            elseif ($payment_types == 4)
                $payment_balance_name = 'students_total_transport_fee_balance';
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
                    <th>SATS ID</th>
                    <th>NAME</th>
                    <th>CLASS</th>
                    <th>GENDER</th>
                    <?php if ($payment_types == 1 or $payment_types == 0) { ?>
                        <th>TUITION FEES BALANCE</th>
                    <?php } ?>
                    <?php if ($payment_types == 2 or $payment_types == 0) { ?>
                        <th>BOOKS FEES BALANCE</th>
                    <?php } ?>
                    <?php if ($payment_types == 3 or $payment_types == 0) { ?>
                        <th>UNIFORM FEES BALANCE</th>
                    <?php } ?>
                    <?php if ($payment_types == 4 or $payment_types == 0) { ?>
                        <th>TRANSPORT FEES BALANCE</th>
                    <?php } ?>
                    <?php if ($payment_types == 0) { ?>
                        <th>TOTAL BALANCE</th>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php
                    $conn = $pdo->open();
                    try {
                        $total_all = $total_school_fee = $total_books_fee = $total_dress_fee = $total_transport_fee = 0;
                        if ($classes_and_fee_value == 0) {
                            if ($payment_types == 0)
                                $stmt = $conn->prepare("SELECT * FROM students WHERE (students_total_school_fee_balance!='0' OR students_total_books_fee_balance!='0' OR students_total_dress_fee_balance!='0' OR students_total_transport_fee_balance!='0') AND students_deleted='0'");
                            else
                                $stmt = $conn->prepare("SELECT * FROM students WHERE $payment_balance_name!='0' AND students_deleted='0'");
                        } else {
                            if ($payment_types == 0)
                                $stmt = $conn->prepare("SELECT * FROM students WHERE (students_total_school_fee_balance!='0' OR students_total_books_fee_balance!='0' OR students_total_dress_fee_balance!='0' OR students_total_transport_fee_balance!='0') AND students_deleted='0' AND students_class=$classes_and_fee_value");
                            else
                                $stmt = $conn->prepare("SELECT * FROM students WHERE $payment_balance_name!='0' AND students_deleted='0' AND students_class='$classes_and_fee_value'");
                        }
                        $stmt->execute();
                        $slno = 1;
                        foreach ($stmt as $row) {
                            echo "<tr>";
                            echo "<td>" . $slno++ . "</td>";
                            echo "<td>" . $row['students_regestration_no'] . "</td>";
                            echo "<td>" . $row['students_name'] . "</td>";
                            $stmt1 = $conn->prepare("SELECT * FROM classes_and_fee WHERE classes_and_fee_value='" . $row['students_class'] . "'");
                            $stmt1->execute();
                            foreach ($stmt1 as $row1)
                                echo "<td>" . $row1['classes_and_fee_class'] . "</td>";
                            echo "<td>";
                            if ($row['students_gender'] == '0')
                                echo "Male";
                            elseif ($row['students_gender'] == '1')
                                echo "Female";
                            else
                                echo "Others";
                            echo "</td>";
                            if ($payment_types == 1 or $payment_types == 0)
                                if ($row['students_total_school_fee'] == 0)
                                    echo "<td style='color:red;'>NOT TAKEN</td>";
                                else {
                                    echo "<td>" . $row['students_total_school_fee_balance'] . "</td>";
                                    $total_school_fee += $row['students_total_school_fee_balance'];
                                }
                            if ($payment_types == 2 or $payment_types == 0)
                                if ($row['students_total_books_fee'] == 0)
                                    echo "<td style='color:red;'>NOT TAKEN</td>";
                                else {
                                    echo "<td>" . $row['students_total_books_fee_balance'] . "</td>";
                                    $total_books_fee += $row['students_total_books_fee_balance'];
                                }
                            if ($payment_types == 3 or $payment_types == 0)
                                if ($row['students_total_dress_fee'] == 0)
                                    echo "<td style='color:red;'>NOT TAKEN</td>";
                                else {
                                    echo "<td>" . $row['students_total_dress_fee_balance'] . "</td>";
                                    $total_dress_fee += $row['students_total_dress_fee_balance'];
                                }
                            if ($payment_types == 4 or $payment_types == 0)
                                if ($row['students_total_transport_fee'] == 0)
                                    echo "<td style='color:red;'>NOT TAKEN</td>";
                                else {
                                    echo "<td>" . $row['students_total_transport_fee_balance'] . "</td>";
                                    $total_transport_fee += $row['students_total_transport_fee_balance'];
                                }
                            if ($payment_types == 0) {
                                $total_all += $total = $row['students_total_school_fee_balance'] + $row['students_total_books_fee_balance'] + $row['students_total_dress_fee_balance'] + $row['students_total_transport_fee_balance'];
                                echo "<td>" . $total . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "<tr>
                        <th colspan='5'>TOTAL</th>";
                        if ($payment_types == 1 or $payment_types == 0)
                            echo "<th>$total_school_fee</th>";
                        if ($payment_types == 2 or $payment_types == 0)
                            echo "<th>$total_books_fee</th>";
                        if ($payment_types == 3 or $payment_types == 0)
                            echo "<th>$total_dress_fee</th>";
                        if ($payment_types == 4 or $payment_types == 0)
                            echo "<th>$total_transport_fee</th>";
                        if ($payment_types == 0)
                            echo "<th>$total_all</th>
                        </tr>";
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
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <title>ROYALPUPIL INTERNATIONAL SCHOOL</title>
    <link rel="icon" type="image/x-icon" href="../../images/favicon.jpeg">
</head>

<body>
    <?php include '../../session.php';
    if (isset($_POST['submit'])) {
        date_default_timezone_set('Asia/Kolkata');
        $payment_types = $_POST['payment_types'];
        $classes_and_fee_value = $_POST['classes_and_fee_value'];
        if ($payment_types == 2)
            $payment_balance_name = 'students_total_books_fee';
        elseif ($payment_types == 3)
            $payment_balance_name = 'students_total_dress_fee';
        elseif ($payment_types == 4)
            $payment_balance_name = 'students_total_transport_fee';
    ?>
        <div class="table-responsive">
            <h3><?php if ($payment_types == 2)
                    echo 'Books Not Taken List';
                elseif ($payment_types == 3)
                    echo 'Dress Not Taken List';
                elseif ($payment_types == 4)
                    echo 'Transport Not Taken List';
                ?></h3>
            <div class="top-panel">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Export <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dataExport" data-type="excel">Excel</a></li>
                        <li><a class="dataExport" data-type="csv">CSV</a></li>
                        <li><a class="dataExport" data-type="txt">Text</a></li>
                    </ul>
                </div>
            </div>
            <table id="dataTable" class="table table-striped">
                <thead>
                    <th>SLNO</th>
                    <th>STUDENT ID</th>
                    <th>NAME</th>
                    <th>CLASS</th>
                </thead>
                <tbody>
                    <?php
                    $conn = $pdo->open();
                    try {
                        if ($classes_and_fee_value == 0)
                            $stmt = $conn->prepare("SELECT * FROM students WHERE $payment_balance_name=0 AND students_deleted='0'");
                        else
                        $stmt = $conn->prepare("SELECT * FROM students WHERE $payment_balance_name=0 AND students_class=$classes_and_fee_value AND students_deleted='0'");
                            $stmt->execute();
                        $slno = 1;
                        foreach ($stmt as $row) {
                            echo "<tr>";
                            echo "<td>" . $slno++ . "</td>";
                            echo "<td>" . $row['students_id'] . "</td>";
                            echo "<td>" . $row['students_name'] . "</td>";
                            $stmt1 = $conn->prepare("SELECT * FROM classes_and_fee WHERE classes_and_fee_value='" . $row['students_class'] . "'");
                            $stmt1->execute();
                            foreach ($stmt1 as $row1)
                                echo "<td>" . $row1['classes_and_fee_class'] . "</td>";
                            echo "</tr>";
                        }
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
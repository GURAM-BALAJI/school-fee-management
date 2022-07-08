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
        $classes_and_fee_value = $_POST['classes_and_fee_value'];
        $students_gender = $_POST['students_gender'];
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
                    <th>DOB</th>
                    <th>RELIGION</th>
                    <th>CASTE</th>
                    <th>MOTHER TONGUE</th>
                    <th>BLOOD GROUP</th>
                    <th>AADHAR NO.</th>
                    <th>ADDRESS</th>
                    <th>FATHER'S NAME</th>
                    <th>FATHER'S PHONE NO</th>
                    <th>FATHER'S OCCUPATION </th>
                    <th>MOTHER'S NAME</th>
                    <th>MOTHER'S PHONE NO </th>
                    <th>MOTHER'S OCCUPATION</th>
                    <th>LAST UPDATEDED DATE</th>
                    <th>JOINED DATE</th>
                </thead>
                <tbody>
                    <?php
                    $conn = $pdo->open();
                    try {
                        if ($classes_and_fee_value == 0 &&  $students_gender == 3)
                            $stmt = $conn->prepare("SELECT * FROM students WHERE students_deleted='0'");
                        if ($classes_and_fee_value != 0 &&  $students_gender == 3)
                            $stmt = $conn->prepare("SELECT * FROM students WHERE students_class='$classes_and_fee_value' AND students_deleted='0'");
                        if ($classes_and_fee_value == 0 &&  $students_gender != 3)
                            $stmt = $conn->prepare("SELECT * FROM students WHERE students_gender='$students_gender' AND students_deleted='0'");
                        if ($classes_and_fee_value != 0 &&  $students_gender != 3)
                            $stmt = $conn->prepare("SELECT * FROM students WHERE students_gender='$students_gender' AND students_class='$classes_and_fee_value' AND students_deleted='0'");
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
                            echo "<td>" . $row['students_DOB'] . "</td>";
                            echo "<td>" . $row['students_religion'] . "</td>";
                            echo "<td>" . $row['students_cast'] . "</td>";
                            echo "<td>" . $row['students_mother_tongue'] . "</td>";
                            echo "<td>" . $row['students_blood_group'] . "</td>";
                            echo "<td>" . $row['students_adher'] . "</td>";
                            echo "<td>" . $row['students_address'] . "</td>";
                            echo "<td>" . $row['students_father_name'] . "</td>";
                            echo "<td>" . $row['students_father_phone'] . "</td>";
                            echo "<td>" . $row['students_father_occupation'] . "</td>";
                            echo "<td>" . $row['students_mother_name'] . "</td>";
                            echo "<td>" . $row['students_mother_phone'] . "</td>";
                            echo "<td>" . $row['students_mother_occupation'] . "</td>";
                            echo "<td>" . $row['students_updated_date'] . "</td>";
                            echo "<td>" . $row['students_created_date'] . "</td>";
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
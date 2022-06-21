<?php
//Include database configuration file
include '../includes/session.php';

if (isset($_POST["student_id"]) && !empty($_POST["student_id"])) {
    $student_id = $_POST["student_id"];

    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT * FROM students WHERE students_id=:student_id");
    $stmt->execute(['student_id' => $student_id]);
    $data = $stmt->fetchAll();
    if (!empty($data)) {
        echo "<option disabled selected> Select Payment </option>";
        foreach ($data as $row) {
            if ($row['students_total_school_fee'] != 0)
                echo "<option value='1'>School Fee, Total: " . $row['students_total_school_fee'] . ' Balance:' . $row['students_total_school_fee_balance'] . "</option>";
            else
                echo "<option value='1'>School Fee</option>";
            if ($row['students_total_books_fee'] != 0)
                echo "<option value='2'>Books Fee, Total: " . $row['students_total_books_fee'] . ' Balance:' . $row['students_total_books_fee_balance'] . "</option>";
            else
                echo "<option value='2'>Books Fee</option>";
            if ($row['students_total_dress_fee'] != 0)
                echo "<option value='3'>Dress Fee, Total: " . $row['students_total_dress_fee'] . ' Balance:' . $row['students_total_dress_fee_balance'] . "</option>";
            else
                echo "<option value='3'>Dress Fee</option>";
            if ($row['students_total_transport_fee'] != 0)
                echo "<option value='4'>Transport Fee, Total: " . $row['students_total_transport_fee'] . ' Balance:' . $row['students_total_transport_fee_balance'] . "</option>";
            else
                echo "<option value='4'>Transport Fee</option>";
        }
    } else {
        echo "Not Found..!";
    }
    $pdo->close();
}

<?php
//Include database configuration file
include '../includes/session.php';

if (isset($_POST["student_id"]) && !empty($_POST["student_id"]) && isset($_POST["fees_type"]) && !empty($_POST["fees_type"])) {
    $student_id = $_POST["student_id"];
    $fee_type = $_POST["fees_type"];

    if ($fee_type == 1)
        $type = "students_total_school_fee";
    elseif ($fee_type == 2)
        $type = "students_total_books_fee";
    elseif ($fee_type == 3)
        $type = "students_total_dress_fee";
    elseif ($fee_type == 4)
        $type = "students_total_transport_fee";
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT * FROM students WHERE students_id=:student_id");
    $stmt->execute(['student_id' => $student_id]);
    $data = $stmt->fetchAll();
    if (!empty($data)) {
        foreach ($data as $row) {
            if ($row[$type] != 0) {
                echo "<div class='form-group'>
                        <label for='total_fee' class='col-sm-3 control-label'>Total fee</label>
                        <div class='col-sm-9'>
                            <input type='text' autocomplete='OFF' class='form-control' id='total_fee' name='total_fee' onfocus='this.blur()' value='";
                if ($fee_type == 1)
                    echo $row['students_total_school_fee'];
                elseif ($fee_type == 2)
                    echo $row['students_total_books_fee'];
                elseif ($fee_type == 3)
                    echo $row['students_total_dress_fee'];
                elseif ($fee_type == 4)
                    echo $row['students_total_transport_fee'];
                echo "'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='balance_fee' class='col-sm-3 control-label'>Balance Fee</label>
                        <div class='col-sm-9'>
                            <input type='text' autocomplete='OFF' class='form-control' id='balance_fee' name='balance_fee' onfocus='this.blur()' value='";
                if ($fee_type == 1)
                    echo $row['students_total_school_fee_balance'];
                elseif ($fee_type == 2)
                    echo $row['students_total_books_fee_balance'];
                elseif ($fee_type == 3)
                    echo $row['students_total_dress_fee_balance'];
                elseif ($fee_type == 4)
                    echo $row['students_total_transport_fee_balance'];
                echo "'>
                        </div>
                    </div>
                    ";
            } else {
                echo "<div class='form-group'>
                <label for='total_fee'  class='col-sm-3 control-label'>Total fee</label>
                <div class='col-sm-9'>
                    <input type='text' autocomplete='OFF' class='form-control' id='total_fee' name='total_fee'>
                </div>
            </div>";
            }
            echo "<div class='form-group'>
            <label for='pay' class='col-sm-3 control-label'>Payment Through</label>
            <div class='col-sm-9'>
                <select name='payment_through' class='form-control'>
                <option value='1'>CASH</option>
                <option value='2'>CARD</option>
                <option value='3'>CHECK</option>
                <option value='4'>UPI</option>
                <option value='5'>NET BANKING</option>
                <option value='6'>OTHERS</option>
                </select>
            </div>
        </div>
        <div class='form-group'>
            <label for='pay' class='col-sm-3 control-label'>Paid</label>
            <div class='col-sm-9'>
                <input type='text' autocomplete='OFF' class='form-control' id='pay' name='pay''>
            </div>
        </div>";
        }
    } else {
        echo "Not Found..!";
    }
    $pdo->close();
}

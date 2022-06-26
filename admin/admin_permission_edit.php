<?php
include '../session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        if (isset($_POST['students_view']))
            $students_view = 1;
        else
            $students_view = 0;
        if (isset($_POST['students_create']))
            $students_create = 1;
        else
            $students_create = 0;
        if (isset($_POST['students_edit']))
            $students_edit = 1;
        else
            $students_edit = 0;
        if (isset($_POST['students_del']))
            $students_del = 1;
        else
            $students_del = 0;

        if (isset($_POST['admin_view']))
            $admin_view = 1;
        else
            $admin_view = 0;
        if (isset($_POST['admin_create']))
            $admin_create = 1;
        else
            $admin_create = 0;
        if (isset($_POST['admin_edit']))
            $admin_edit = 1;
        else
            $admin_edit = 0;
        if (isset($_POST['admin_del']))
            $admin_del = 1;
        else
            $admin_del = 0;
        if (isset($_POST['admin_special']))
            $admin_special = 1;
        else
            $admin_special = 0;

        if (isset($_POST['classes_and_fee_view']))
            $classes_and_fee_view = 1;
        else
            $classes_and_fee_view = 0;
        if (isset($_POST['classes_and_fee_create']))
            $classes_and_fee_create = 1;
        else
            $classes_and_fee_create = 0;
        if (isset($_POST['classes_and_fee_edit']))
            $classes_and_fee_edit = 1;
        else
            $classes_and_fee_edit = 0;
        if (isset($_POST['classes_and_fee_del']))
            $classes_and_fee_del = 1;
        else
            $classes_and_fee_del = 0;

        if (isset($_POST['payments_view']))
            $payments_view = 1;
        else
            $payments_view = 0;
        if (isset($_POST['payments_create']))
            $payments_create = 1;
        else
            $payments_create = 0;
        if (isset($_POST['payments_del']))
            $payments_del = 1;
        else
            $payments_del = 0;
        if (isset($_POST['payments_records_view']))
            $payments_records_view = 1;
        else
            $payments_records_view = 0;
        if (isset($_POST['payment_pending_records_view']))
            $payment_pending_records_view = 1;
        else
            $payment_pending_records_view = 0;
        if (isset($_POST['students_records_view']))
            $students_records_view = 1;
        else
            $students_records_view = 0;
            if (isset($_POST['not_taken_records_view']))
            $not_taken_records_view = 1;
        else
            $not_taken_records_view = 0;
        $conn = $pdo->open();
        try {
            $stmt = $conn->prepare("UPDATE admin SET not_taken_records_view=:not_taken_records_view,admin_special=:admin_special,students_view=:students_view,students_create=:students_create,students_edit=:students_edit,students_del=:students_del,admin_view=:admin_view,admin_create=:admin_create,admin_edit=:admin_edit,admin_del=:admin_del,classes_and_fee_view=:classes_and_fee_view,classes_and_fee_create=:classes_and_fee_create,classes_and_fee_edit=:classes_and_fee_edit,classes_and_fee_del=:classes_and_fee_del,payments_view=:payments_view,payments_create=:payments_create,payments_del=:payments_del,payments_records_view=:payments_records_view,payment_pending_records_view=:payment_pending_records_view,students_records_view=:students_records_view WHERE admin_id=:id");
            $stmt->execute(['not_taken_records_view'=>$not_taken_records_view,'admin_special' => $admin_special, 'students_view' => $students_view, 'students_create' => $students_create, 'students_edit' => $students_edit, 'students_del' => $students_del, 'admin_view' => $admin_view, 'admin_create' => $admin_create, 'admin_edit' => $admin_edit, 'admin_del' => $admin_del, 'classes_and_fee_view' => $classes_and_fee_view, 'classes_and_fee_create' => $classes_and_fee_create, 'classes_and_fee_edit' => $classes_and_fee_edit, 'classes_and_fee_del' => $classes_and_fee_del, 'payments_view' => $payments_view, 'payments_create' => $payments_create, 'payments_del' => $payments_del, 'payments_records_view' => $payments_records_view, 'payment_pending_records_view' => $payment_pending_records_view, 'students_records_view' => $students_records_view, 'id' => $id]);
            $_SESSION['success'] = 'Admin Permission Updated Successfully';
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        $pdo->close();
    }
}

header('location: index.php');

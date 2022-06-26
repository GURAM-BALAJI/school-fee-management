<?php
include '../includes/session.php';

if (isset($_POST['add'])) {
	$student_id = $_POST['student_id'];
	$fees_type = $_POST['fees_type'];
	$total_fee = $_POST['total_fee'];
	$payment_through = $_POST['payment_through'];
	$pay = $_POST['pay'];
	$by = $admin['admin_id'];
	$conn = $pdo->open();
	try {
		if ($fees_type == 1) {
			$type = "students_total_school_fee";
			$type_balance = "students_total_school_fee_balance";
		} elseif ($fees_type == 2) {
			$type = "students_total_books_fee";
			$type_balance = "students_total_books_fee_balance";
		} elseif ($fees_type == 3) {
			$type = "students_total_dress_fee";
			$type_balance = "students_total_dress_fee_balance";
		} elseif ($fees_type == 4) {
			$type = "students_total_transport_fee";
			$type_balance = "students_total_transport_fee_balance";
		}

		if (isset($_POST['balance_fee'])) {
			$balance_fee = $_POST['balance_fee'] - $pay;
			$stmt = $conn->prepare("UPDATE students set $type_balance=:balance WHERE students_id=:id");
			$stmt->execute(['balance' => $balance_fee, 'id' => $student_id]);
		} else {
			$balance_fee = $total_fee - $pay;
			$stmt = $conn->prepare("UPDATE students set $type=:total,$type_balance=:balance WHERE students_id=:id");
			$stmt->execute(['total' => $total_fee, 'balance' => $balance_fee, 'id' => $student_id]);
		}

		date_default_timezone_set('Asia/Kolkata');
		$now = date('d-m-Y h:i:s');
		$today = date('d-m-Y');
		$stmt = $conn->prepare("INSERT INTO payments (payment_through,payments_students_id,payments_type,payments_fee,payments_created_date,payments_by,payments_date) VALUES (:payment_through,:payments_students_id,:payments_type,:payments_fee,:payments_created_date,:payments_by,:payments_date)");
		$stmt->execute(['payment_through' => $payment_through, 'payments_students_id' => $student_id, 'payments_type' => $fees_type, 'payments_fee' => $pay, 'payments_created_date' => $now, 'payments_by' => $by, 'payments_date' => $today]);
		$stmt_id = $conn->prepare("SELECT payments_id FROM payments WHERE payments_created_date='$now' AND payments_by = $by");
		$stmt_id->execute();
		foreach ($stmt_id as $row_id){
			header('location: payments_printing.php?payment_id=' . $row_id['payments_id']);
			exit();
		}
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
	}
}
$pdo->close();
header('location: index.php');

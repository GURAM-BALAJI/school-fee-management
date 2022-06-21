<?php
include '../includes/session.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM students WHERE students_id=:id");
	$stmt->execute(['id' => $id]);
	$row = $stmt->fetch();
	$pdo->close();
	if ($row['students_total_school_fee'] == 0) {
		$student_total_school_fee_paid = '&#10060;';
		$student_total_school_fee_paid_balance = '&#10060;';
		$students_total_school_fee = '&#10060;';
	} else {
		$students_total_school_fee = $row['students_total_school_fee'];
		$student_total_school_fee_paid_balance = $row['students_total_school_fee_balance'];
		$student_total_school_fee_paid = $row['students_total_school_fee'] - $row['students_total_school_fee_balance'];
	}
	if ($row['students_total_books_fee'] == 0) {
		$student_total_books_fee_paid = '&#10060;';
		$student_total_books_fee_paid_balance = '&#10060;';
		$students_total_books_fee = '&#10060;';
	} else {
		$students_total_books_fee = $row['students_total_books_fee'];
		$student_total_books_fee_paid_balance = $row['students_total_books_fee_balance'];
		$student_total_books_fee_paid = $row['students_total_books_fee'] - $row['students_total_books_fee_balance'];
	}
	if ($row['students_total_dress_fee'] == 0) {
		$student_total_dress_fee_paid = '&#10060;';
		$student_total_dress_fee_paid_balance = '&#10060;';
		$students_total_dress_fee = '&#10060;';
	} else {
		$students_total_dress_fee = $row['students_total_dress_fee'];
		$student_total_dress_fee_paid_balance = $row['students_total_dress_fee_balance'];
		$student_total_dress_fee_paid = $row['students_total_dress_fee'] - $row['students_total_dress_fee_balance'];
	}
	if ($row['students_total_transport_fee'] == 0) {
		$student_total_transport_fee_paid = '&#10060;';
		$student_total_transport_fee_paid_balance = '&#10060;';
		$students_total_transport_fee = '&#10060;';
	} else {
		$students_total_transport_fee = $row['students_total_transport_fee'];
		$student_total_transport_fee_paid_balance = $row['students_total_transport_fee_balance'];
		$student_total_transport_fee_paid = $row['students_total_transport_fee'] - $row['students_total_transport_fee_balance'];
	}
	$row = array(
		'students_id' => $row['students_id'],
		'students_name' => $row['students_name'],
		'students_DOB' => $row['students_DOB'],
		'students_cast' => $row['students_cast'],
		'students_mother_tongue' => $row['students_mother_tongue'],
		'students_blood_group' => $row['students_blood_group'],
		'students_adher' => $row['students_adher'],
		'students_address' => $row['students_address'],
		'students_father_name' => $row['students_father_name'],
		'students_father_phone' => $row['students_father_phone'],
		'students_father_occupation' => $row['students_father_occupation'],
		'students_mother_name' => $row['students_mother_name'],
		'students_mother_phone' => $row['students_mother_phone'],
		'students_mother_occupation' => $row['students_mother_occupation'],
		'students_updated_date' => $row['students_updated_date'],
		'students_created_date' => $row['students_created_date'],
		'students_total_school_fee' => $students_total_school_fee,
		'students_total_school_fee_balance' => $student_total_school_fee_paid_balance,
		'students_total_books_fee' => $students_total_books_fee,
		'students_total_books_fee_balance' => $student_total_books_fee_paid_balance,
		'students_total_dress_fee' => $students_total_dress_fee,
		'students_total_dress_fee_balance' => $student_total_dress_fee_paid_balance,
		'students_total_transport_fee' => $students_total_transport_fee,
		'students_total_transport_fee_balance' => $student_total_transport_fee_paid_balance,
		'student_total_school_fee_paid' => $student_total_school_fee_paid,
		'student_total_books_fee_paid' => $student_total_books_fee_paid,
		'student_total_dress_fee_paid' => $student_total_dress_fee_paid,
		'student_total_transport_fee_paid' => $student_total_transport_fee_paid,
	);
	echo json_encode($row);
}

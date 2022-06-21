<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = $_POST['id'];
	$conn = $pdo->open();
	try {
		$stmt1 = $conn->prepare("SELECT * FROM payments WHERE payments_id=:id");
		$stmt1->execute(['id' => $id]);
		foreach ($stmt1 as $row1) {
			$payments_students_id = $row1['payments_students_id'];
			$payments_type = $row1['payments_type'];
			if ($payments_type == 1) {
				$type = "students_total_school_fee";
				$type_balance = "students_total_school_fee_balance";
			} elseif ($payments_type == 2) {
				$type = "students_total_books_fee";
				$type_balance = "students_total_books_fee_balance";
			} elseif ($payments_type == 3) {
				$type = "students_total_dress_fee";
				$type_balance = "students_total_dress_fee_balance";
			} elseif ($payments_type == 4) {
				$type = "students_total_transport_fee";
				$type_balance = "students_total_transport_fee_balance";
			}
			$stmt2 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM payments WHERE payments_students_id=:payments_students_id AND payments_type=:payments_type");
			$stmt2->execute(['payments_students_id' => $payments_students_id, 'payments_type' => $payments_type]);
			$row2 = $stmt2->fetch();
			if ($row2['numrows'] == 1) {
				$stmt3 = $conn->prepare("UPDATE students set $type=:type,$type_balance =:type_balance WHERE students_id=:id");
				$stmt3->execute(['type' => 0, 'type_balance' => 0, 'id' => $payments_students_id]);
			} else {
				$stmt4 = $conn->prepare("SELECT * FROM students WHERE students_id=:id");
				$stmt4->execute(['id' => $payments_students_id]);
				foreach ($stmt4 as $row4) {
					$balance = $row4[$type_balance] + $row1['payments_fee'];
					$stmt3 = $conn->prepare("UPDATE students set $type_balance=:balance WHERE students_id=:id");
					$stmt3->execute(['balance' => $balance, 'id' => $payments_students_id]);
				}
			}
			$stmt = $conn->prepare("DELETE FROM payments WHERE payments_id=:id");
			$stmt->execute(['id' => $id]);
		}
		$_SESSION['success'] = 'Payments roll bcaked successfully';
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
	}

	$pdo->close();
} else {
	$_SESSION['error'] = 'Select payments to delete first';
}

header('location: payments.php');

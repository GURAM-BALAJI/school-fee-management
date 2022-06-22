<?php
include '../includes/session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$value = $_POST['value'];
		$class = $_POST['class'];
		$fee = $_POST['fee'];
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM classes_and_fee WHERE classes_and_fee_value=:value AND classes_and_fee_id!=:id");
		$stmt->execute(['value' => $value,'id' => $id]);
		$row = $stmt->fetch();
		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'class and fee already exist..';
		} else {
			try {
				date_default_timezone_set('Asia/Kolkata');
				$today = date('d-m-Y h:i:s a');
				$stmt = $conn->prepare("UPDATE classes_and_fee SET classes_and_fee_value=:classes_and_fee_value,classes_and_fee_class=:classes_and_fee_class,classes_and_fee_fee=:classes_and_fee_fee,classes_and_fee_updated_date=:classes_and_fee_updated_date WHERE classes_and_fee_id=:id");
				$stmt->execute(['classes_and_fee_value' => $value, 'classes_and_fee_class' => $class, 'classes_and_fee_fee' => $fee, 'classes_and_fee_updated_date' => $today, 'id' => $id]);
				$_SESSION['success'] = 'Class and fee updated successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
			}
			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Fill up edit class and fee form first';
	}
}
header('location: index.php');

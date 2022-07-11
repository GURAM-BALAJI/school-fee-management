<?php
include '../session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['edit'])) {
		$id = $_POST['id'];
		$value = $_POST['value'];
		$class = $_POST['class'];
		$fee = $_POST['fee'];
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM school_info WHERE school_info_value=:value AND school_info_id!=:id AND school_info_school_id=" . $_SESSION['admin_school_id'] . " ");
		$stmt->execute(['value' => $value,'id' => $id]);
		$row = $stmt->fetch();
		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'School info already exist..';
		} else {
			try {
				date_default_timezone_set('Asia/Kolkata');
				$today = date('d-m-Y h:i:s a');
				$stmt = $conn->prepare("UPDATE school_info SET school_info_value=:school_info_value,school_info_class=:school_info_class,school_info_fee=:school_info_fee,school_info_updated_date=:school_info_updated_date WHERE school_info_id=:id AND school_info_school_id=" . $_SESSION['admin_school_id'] . " ");
				$stmt->execute(['school_info_value' => $value, 'school_info_class' => $class, 'school_info_fee' => $fee, 'school_info_updated_date' => $today, 'id' => $id]);
				$_SESSION['success'] = 'School info updated successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
			}
			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Fill up edit School info form first';
	}
}
header('location: index.php');

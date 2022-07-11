
<?php
include '../session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['add'])) {
		$value = $_POST['value'];
		$class = $_POST['class'];
		$fee = $_POST['fee'];

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM school_info WHERE school_info_value=:value AND school_info_school_id=" . $_SESSION['admin_school_id'] . " ");
		$stmt->execute(['value' => $value]);
		$row = $stmt->fetch();

		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'School info already exist..';
		} else {
			try {
				date_default_timezone_set('Asia/Kolkata');
				$today = date('d-m-Y h:i:s a');
				$stmt = $conn->prepare("INSERT INTO school_info (school_info_value,school_info_class,school_info_fee,school_info_updated_date,school_info_created_date,school_info_school_id) VALUES (:school_info_value,:school_info_class,:school_info_fee,:school_info_updated_date,:school_info_created_date,:school_info_school_id)");
				$stmt->execute(['school_info_value' => $value, 'school_info_class' => $class, 'school_info_fee' => $fee, 'school_info_updated_date' => $today, 'school_info_created_date' => $today, 'school_info_school_id' => $_SESSION['admin_school_id']]);
				$_SESSION['success'] = 'School info added successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	} else {
		$_SESSION['error'] = 'Fill up School info form first';
	}
}

header('location: index.php');

?>
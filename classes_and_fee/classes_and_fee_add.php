
<?php
include '../includes/session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['add'])) {
		$value = $_POST['value'];
		$class = $_POST['class'];
		$fee = $_POST['fee'];

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM classes_and_fee WHERE classes_and_fee_value=:value ");
		$stmt->execute(['value' => $value]);
		$row = $stmt->fetch();

		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'class and fee already exist..';
		} else {
			try {
				date_default_timezone_set('Asia/Kolkata');
				$today = date('d-m-Y h:i:s a');
				$stmt = $conn->prepare("INSERT INTO classes_and_fee (classes_and_fee_value,classes_and_fee_class,classes_and_fee_fee,classes_and_fee_updated_date,classes_and_fee_created_date) VALUES (:classes_and_fee_value,:classes_and_fee_class,:classes_and_fee_fee,:classes_and_fee_updated_date,:classes_and_fee_created_date)");
				$stmt->execute(['classes_and_fee_value' => $value, 'classes_and_fee_class' => $class, 'classes_and_fee_fee' => $fee, 'classes_and_fee_updated_date' => $today, 'classes_and_fee_created_date' => $today]);
				$_SESSION['success'] = 'Class and fee added successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	} else {
		$_SESSION['error'] = 'Fill up class and fee form first';
	}
}

header('location: index.php');

?>
<?php
include '../includes/session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['upload'])) {
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if (!empty($filename)) {
			$stmt = $conn->prepare("SELECT students_photo FROM students WHERE students_id=:id");
			$stmt->execute(['id' => $id]);
			foreach ($stmt as $row)
				unlink('../students_photo/' . $row['students_photo']);
			$filename = $_FILES['photo']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$filename = date('Y-m-d') . '_' . time() . '.' . $ext;
			move_uploaded_file($_FILES['photo']['tmp_name'], '../students_photo/' . $filename);
			$conn = $pdo->open();
			try {
				$stmt = $conn->prepare("UPDATE students SET students_photo=:photo WHERE students_id=:id");
				$stmt->execute(['photo' => $filename, 'id' => $id]);
				$_SESSION['success'] = 'students photo updated successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Select students to update photo first';
	}
}

header('location: students.php');

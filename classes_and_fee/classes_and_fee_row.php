<?php 
	include '../session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM classes_and_fee WHERE classes_and_fee_id=:id AND classes_and_fee_school_id=" . $_SESSION['admin_school_id'] . " ");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>
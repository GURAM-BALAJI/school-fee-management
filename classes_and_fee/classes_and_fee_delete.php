<?php
	include '../session.php';
	include '../includes/req_start.php';
	if($req_per==1){
	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("DELETE FROM classes_and_fee WHERE classes_and_fee_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Class and fee deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select class and fee to delete first';
	}
}
	header('location: index.php');
	
?>
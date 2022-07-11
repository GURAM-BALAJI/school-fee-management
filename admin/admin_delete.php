<?php
	include '../session.php';
	include '../includes/req_start.php';
	if($req_per==1){
	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE admin set admin_delete='1' WHERE admin_id=:id AND admin_school_id=" . $_SESSION['admin_school_id'] . "");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'admin deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select admin to delete first';
	}
}

	header('location: index.php');
	
?>
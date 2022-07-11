<?php
	include '../session.php';
	include '../includes/req_start.php';
	if($req_per==1){
	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("DELETE FROM school_info WHERE school_info_id=:id AND school_info_school_id=" . $_SESSION['admin_school_id'] . " ");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'School info deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select School info to delete first';
	}
}
	header('location: index.php');
	
?>
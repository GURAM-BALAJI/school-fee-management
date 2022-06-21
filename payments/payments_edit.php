<?php
	include '../includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
        $cost = $_POST['cost'];
		date_default_timezone_set('Asia/Kolkata');
		$today = date('d-m-Y h:i:s a');
		try{
			$stmt = $conn->prepare("UPDATE payments SET payments_name=:name, payments_cost=:cost, payments_updated_date=:payments_updated_date WHERE payments_id=:id");
			$stmt->execute(['name'=>$name,'cost'=>$cost,'payments_updated_date'=>$today, 'id'=>$id]);
			$_SESSION['success'] = 'payments updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit payments form first';
	}

	header('location: payments.php');

?>
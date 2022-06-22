<?php
	include '../includes/session.php';
	include '../includes/req_start.php';
	if($req_per==1){
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contact'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try{
			$stmt = $conn->prepare("UPDATE admin SET admin_email=:email, admin_password=:password, admin_name=:name,  admin_phone=:contact WHERE admin_id=:id");
			$stmt->execute(['email'=>$email, 'password'=>$password, 'name'=>$name, 'contact'=>$contact, 'id'=>$id]);
			$_SESSION['success'] = 'admin updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit admin form first';
	}
}

	header('location: index.php');

?>
<?php
	include '../includes/session.php';
	include '../includes/req_start.php';
	if($req_per==1){
	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			$stmt = $conn->prepare("SELECT admin_photo FROM admin WHERE admin_id=:id");
			$stmt->execute(['id' => $id]);
			foreach ($stmt as $row)
				unlink('../images/' . $row['admin_photo']);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $filename=date('Y-m-d').'_'.time().'.'.$ext;
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);
			$conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE admin SET admin_photo=:photo WHERE admin_id=:id");
				$stmt->execute(['photo'=>$filename, 'id'=>$id]);
				$_SESSION['success'] = 'admin photo updated successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}	
		}
		
	

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select admin to update photo first';
	}
}

	header('location: index.php');

<?php
include '../session.php';
include '../includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['add'])) {
		$name = strtoupper($_POST['name']);
		$classes_and_fee_value = $_POST['classes_and_fee_value'];
		$students_DOB = $_POST['students_DOB'];
		$students_gender = $_POST['students_gender'];
		$students_religion = strtoupper($_POST['students_religion']);
		$students_cast = strtoupper($_POST['students_cast']);
		$students_mother_tongue = strtoupper($_POST['students_mother_tongue']);
		$students_blood_group = $_POST['students_blood_group'];
		$students_adher = $_POST['students_adher'];
		$students_address = $_POST['students_address'];
		$students_father_name = strtoupper($_POST['students_father_name']);
		$students_father_phone = $_POST['students_father_phone'];
		$students_father_occupation = $_POST['students_father_occupation'];
		$students_mother_name = strtoupper($_POST['students_mother_name']);
		$students_mother_phone = $_POST['students_mother_phone'];
		$students_mother_occupation = $_POST['students_mother_occupation'];
		$stmt1 = $conn->prepare("SELECT classes_and_fee_fee  FROM classes_and_fee WHERE classes_and_fee_value='$classes_and_fee_value'");
		$stmt1->execute();
		foreach ($stmt1 as $row1)
			$classes_and_fee_fee = $row1['classes_and_fee_fee'];
		$conn = $pdo->open();
		try {

			date_default_timezone_set('Asia/Kolkata');
			$student_image = $_FILES['student_image']['name'];
			if (!empty($student_image)) {
				$ext = pathinfo($student_image, PATHINFO_EXTENSION);
				$student_image = date('Y-m-d') . time() . '.' . $ext;
				move_uploaded_file($_FILES['student_image']['tmp_name'], '../students_photo/' . $student_image);
			}
			$today = date('d-m-Y h:i:s a');

			$stmt = $conn->prepare("INSERT INTO students (students_religion,students_total_school_fee,students_total_school_fee_balance,students_name,students_class,students_photo,students_DOB,students_gender,students_cast,students_mother_tongue,students_blood_group,students_adher,students_father_name,students_mother_name,students_father_phone,students_mother_phone,students_father_occupation,students_mother_occupation,students_address,students_updated_date,students_created_date) VALUES (:students_religion,:students_total_school_fee,:students_total_school_fee_balance,:students_name,:students_class,:students_photo,:students_DOB,:students_gender,:students_cast,:students_mother_tongue,:students_blood_group,:students_adher,:students_father_name,:students_mother_name,:students_father_phone,:students_mother_phone,:students_father_occupation,:students_mother_occupation,:students_address,:students_updated_date,:students_created_date)");
			$stmt->execute(['students_religion' => $students_religion, 'students_total_school_fee' => $classes_and_fee_fee, 'students_total_school_fee_balance' => $classes_and_fee_fee, 'students_name' => $name, 'students_class' => $classes_and_fee_value, 'students_photo' => $student_image, 'students_DOB' => $students_DOB, 'students_gender' => $students_gender, 'students_cast' => $students_cast, 'students_mother_tongue' => $students_mother_tongue, 'students_blood_group' => $students_blood_group, 'students_adher' => $students_adher, 'students_father_name' => $students_father_name, 'students_mother_name' => $students_mother_name, 'students_father_phone' => $students_father_phone, 'students_mother_phone' => $students_mother_phone, 'students_father_occupation' => $students_father_occupation, 'students_mother_occupation' => $students_mother_occupation, 'students_address' => $students_address, 'students_updated_date' => $today, 'students_created_date' => $today]);


			$_SESSION['success'] = 'Students added successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	} else {
		$_SESSION['error'] = 'Fill up students form first';
	}
}

header('location: index.php');

?>
<?php
include '../session.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM students WHERE students_id=:id");
	$stmt->execute(['id' => $id]);
	$row = $stmt->fetch();

	$students_class = "<select class='form-control' name='classes_and_fee_value' required>";
	$stmt1 = $conn->prepare("SELECT * FROM classes_and_fee");
	$stmt1->execute();
	foreach ($stmt1 as $row1){
		if ($row1['classes_and_fee_value'] == $row['students_class'])
			$students_class .= "<option value='".$row1['classes_and_fee_value']."' selected>".$row1['classes_and_fee_class']." ( ".$row1['classes_and_fee_fee']." ) </option>";
		else
		$students_class .= "<option value='".$row1['classes_and_fee_value']."'>".$row1['classes_and_fee_class']." ( ".$row1['classes_and_fee_fee']." ) </option>";
	}
	$students_class .= "</select>";

	$students_gender = "<select class='form-control' name='students_gender'>";
	if($row['students_gender']=='0')
	$students_gender.= "<option value='0' selected>Male</option>";
else
$students_gender.= "<option value='0'>Male</option>";
	if($row['students_gender']=='1')
	$students_gender.= "<option value='1' selected>Female</option>";
	else
	$students_gender.= "<option value='1'>Female</option>";
	if($row['students_gender']=='2')
	$students_gender.= "<option value='2' selected>Others</option>";
	else
	$students_gender.= "<option value='2'>Others</option></select>";

	$row = array(
		'students_id' => $row['students_id'],
		'students_DOB' =>  $row['students_DOB'],
		'students_name' =>  $row['students_name'],
		'students_gender' => $students_gender,
		'students_class' =>  $students_class,
		'students_religion'=>$row['students_religion'],
		'students_cast' =>  $row['students_cast'],
		'students_mother_tongue' =>  $row['students_mother_tongue'],
		'students_blood_group' =>  $row['students_blood_group'],
		'students_adher' =>  $row['students_adher'],
		'students_address' => $row['students_address'],
		'students_father_name' => $row['students_father_name'],
		'students_father_phone' => $row['students_father_phone'],
		'students_father_occupation' => $row['students_father_occupation'],
		'students_mother_name' => $row['students_mother_name'],
		'students_mother_phone' => $row['students_mother_phone'],
		'students_mother_occupation' => $row['students_mother_occupation']
	);

	$pdo->close();

	echo json_encode($row);
}

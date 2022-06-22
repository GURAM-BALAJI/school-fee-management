<?php
include '../includes/session.php';

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM payments WHERE payments_students_id=:id order by payments_id DESC");
	$stmt->execute(['id' => $id]);
	$slno = 1;
	$fee_view = "<table border='1' style='width: 100%;'><tr ><th style='padding: 10px;'>SLNO</th><th style='padding: 10px;'>ID</th><th style='padding: 10px;'>TYPE</th><th style='padding: 10px;'>PAID</th><th style='padding: 10px;'>THROUGH</th><th style='padding: 10px;'>DATE AND TIME</th><th style='padding: 10px;'>BY</th></tr>";
	foreach ($stmt as $row) {
		$fee_view .= "
		<tr>
		<td style='padding: 5px;'>" . $slno++ . "</td>
		<td style='padding: 5px;'>" . $row['payments_id'] . "</td>";
		if ($row['payments_type'] == '1')
			$fee_view .= "<td style='padding: 5px;'>School Fee</td>";
		elseif ($row['payments_type'] == '2')
			$fee_view .= "<td style='padding: 5px;'>Books Fee</td>";
		elseif ($row['payments_type'] == '3')
			$fee_view .= "<td style='padding: 5px;'>Dress Fee</td>";
		elseif ($row['payments_type'] == '4')
			$fee_view .= "<td style='padding: 5px;'>Transport Fee</td>";
		$fee_view .= "<td style='padding: 5px;'>".$row['payments_fee']."</td>";
		$fee_view .="<td style='padding: 5px;'>";
		if ($row['payment_through'] == '1')
		  $fee_view .="CASH";
		elseif ($row['payment_through'] == '2')
		  $fee_view .="CARD";
		elseif ($row['payment_through'] == '3')
		  $fee_view .="CHECK";
		elseif ($row['payment_through'] == '4')
		  $fee_view .="UPI";
		elseif ($row['payment_through'] == '5')
		  $fee_view .="NET BANKING";
		elseif ($row['payment_through'] == '6')
		  $fee_view .="OTHERS";
		$fee_view .="</td>";
		$fee_view .="<td style='padding: 5px;'>".$row['payments_created_date']."</td>
		<td style='padding: 5px;'>".$row['payments_by']."</td>
		</tr>
		";

	}
	$fee_view .= "</table>";

	$row = array(
		'fee_view' => $fee_view
	);

	$pdo->close();

	echo json_encode($row);
}

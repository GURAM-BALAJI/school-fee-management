<?php
include 'conn.php';
session_start();

if (isset($_SESSION['rpis_admin'])) {
	$id = $_SESSION['rpis_id_admin'];
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
	$stmt->execute(['id' => $id]);
	$admin = $stmt->fetch();
	$pdo->close();
	if (!$admin['admin_status'])
		header('location: ../logout.php');
}

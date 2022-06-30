<?php 
$conn = $pdo->open();
try {
    $never_id_admin = $_SESSION['rpis_id_admin'];
            $stmt = $conn->prepare("UPDATE admin SET admin_req=:admin_req WHERE admin_id=:id");
            $stmt->execute(['admin_req' =>'0', 'id' => $never_id_admin]);
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
}
$pdo->close();
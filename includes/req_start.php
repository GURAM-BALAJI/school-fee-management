<?php
$conn = $pdo->open();
try {
    $never_id_admin = $_SESSION['rpis_id_admin'];
    $stmtreq = $conn->prepare("SELECT admin_req FROM admin WHERE admin_id = $never_id_admin");
    $stmtreq->execute();
    foreach ($stmtreq as $rowreq) {
        if ($rowreq['admin_req'] == 0) {
            $stmt = $conn->prepare("UPDATE admin SET admin_req=:admin_req WHERE admin_id=:id");
            $stmt->execute(['admin_req' => 1, 'id' => $never_id_admin]);
            $req_per=1;
        }else{
            $req_per=0;
        }
    }
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
}

$pdo->close();

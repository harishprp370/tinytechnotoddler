<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

include '../includes/conn.php';

$partner_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($partner_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid partner ID']);
    exit;
}

// Fetch partner details
$query = "SELECT * FROM franchises WHERE id = $partner_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo json_encode(['success' => false, 'message' => 'Partner not found']);
    exit;
}

$partner = mysqli_fetch_assoc($result);

echo json_encode([
    'success' => true,
    'partner' => $partner
]);
?>

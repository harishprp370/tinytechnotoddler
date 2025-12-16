<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit;
}

include '../includes/conn.php';

$seo_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($seo_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid SEO ID']);
    exit;
}

// Fetch SEO details
$query = "SELECT * FROM seo_meta WHERE id = $seo_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo json_encode(['success' => false, 'message' => 'SEO record not found']);
    exit;
}

$seo = mysqli_fetch_assoc($result);

echo json_encode([
    'success' => true,
    'seo' => $seo
]);
?>

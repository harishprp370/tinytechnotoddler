<?php
include '../includes/conn.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid partner ID']);
    exit;
}

$franchise_id = (int)$_GET['id'];

// Get franchise details
$franchise_query = "SELECT * FROM franchises WHERE id = $franchise_id AND is_active = 1";
$franchise_result = mysqli_query($conn, $franchise_query);

if (mysqli_num_rows($franchise_result) === 0) {
    echo json_encode(['success' => false, 'message' => 'Partner not found']);
    exit;
}

$franchise = mysqli_fetch_assoc($franchise_result);

// Get franchise images
$images_query = "
    SELECT * FROM franchise_images 
    WHERE franchise_id = $franchise_id 
    ORDER BY is_featured DESC, display_order ASC
";
$images_result = mysqli_query($conn, $images_query);
$images = mysqli_fetch_all($images_result, MYSQLI_ASSOC);

// Get franchise programs
$programs_query = "
    SELECT * FROM franchise_programs 
    WHERE franchise_id = $franchise_id AND is_active = 1 
    ORDER BY program_name ASC
";
$programs_result = mysqli_query($conn, $programs_query);
$programs = mysqli_fetch_all($programs_result, MYSQLI_ASSOC);

// Get franchise staff
$staff_query = "
    SELECT * FROM franchise_staff 
    WHERE franchise_id = $franchise_id 
    ORDER BY designation ASC
";
$staff_result = mysqli_query($conn, $staff_query);
$staff = mysqli_fetch_all($staff_result, MYSQLI_ASSOC);

// Return complete data
echo json_encode([
    'success' => true,
    'franchise' => $franchise,
    'images' => $images,
    'programs' => $programs,
    'staff' => $staff
]);
?>

<?php
include '../includes/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Validate required fields
$required_fields = ['firstName', 'lastName', 'email', 'phone', 'state', 'city', 'pincode', 'investmentBudget', 'motivation'];
$missing_fields = [];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $missing_fields[] = $field;
    }
}

if (!empty($missing_fields)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields: ' . implode(', ', $missing_fields)]);
    exit;
}

// Sanitize input data
$data = [];
foreach ($_POST as $key => $value) {
    $data[$key] = mysqli_real_escape_string($conn, trim($value));
}

// Insert into franchise_interest table
$insert_query = "
    INSERT INTO franchise_interest (
        name, email, phone, city, state, investment_range, message, 
        first_name, last_name, age, education, area, pincode, 
        business_experience, education_experience, timeline_to_start,
        submitted_at
    ) VALUES (
        '" . $data['firstName'] . " " . $data['lastName'] . "',
        '" . $data['email'] . "',
        '" . $data['phone'] . "',
        '" . $data['city'] . "',
        '" . $data['state'] . "',
        '" . $data['investmentBudget'] . "',
        '" . $data['motivation'] . "',
        '" . $data['firstName'] . "',
        '" . $data['lastName'] . "',
        '" . (isset($data['age']) ? $data['age'] : '') . "',
        '" . (isset($data['education']) ? $data['education'] : '') . "',
        '" . (isset($data['area']) ? $data['area'] : '') . "',
        '" . $data['pincode'] . "',
        '" . (isset($data['businessExperience']) ? $data['businessExperience'] : '') . "',
        '" . (isset($data['educationExperience']) ? $data['educationExperience'] : '') . "',
        '" . (isset($data['timelineToStart']) ? $data['timelineToStart'] : '') . "',
        NOW()
    )
";

if (mysqli_query($conn, $insert_query)) {
    $application_id = mysqli_insert_id($conn);
    
    // Send notification email (optional)
    $to = 'franchise@tinytechnotoddlers.com';
    $subject = 'New Franchise Application - ' . $data['firstName'] . ' ' . $data['lastName'];
    $message = "
        New franchise application received:
        
        Name: " . $data['firstName'] . " " . $data['lastName'] . "
        Email: " . $data['email'] . "
        Phone: " . $data['phone'] . "
        Location: " . $data['city'] . ", " . $data['state'] . "
        Investment Budget: " . $data['investmentBudget'] . "
        
        Application ID: " . $application_id . "
    ";
    
    // Uncomment the line below to enable email notifications
    // mail($to, $subject, $message);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Application submitted successfully!',
        'application_id' => $application_id
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}
?>

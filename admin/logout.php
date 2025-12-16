<?php
session_start();

// Log the logout action (optional)
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    // You can log this action if needed
    // error_log("Admin logout: User ID $admin_id at " . date('Y-m-d H:i:s'));
}

// Destroy all session data
$_SESSION = array();

// Destroy the session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Clear any other cookies that might exist
setcookie('admin_remember', '', time() - 3600, '/');

// Prevent caching of this page
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Redirect to login page with logout message
header("Location: ../login.php?logout=1");
exit;
?>

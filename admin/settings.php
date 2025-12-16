<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'settings';
include 'header.php';
include '../includes/conn.php';

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        $stmt = $conn->prepare("UPDATE settings SET value=? WHERE `key`=?");
        $stmt->bind_param("ss", $value, $key);
        $stmt->execute();
    }
    echo "<div style='background:#FFD700;color:#5B2D8F;padding:12px;text-align:center;'>Settings updated!</div>";
}

// Handle session messages
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Fetch all settings
$settings_query = "SELECT * FROM settings ORDER BY `key`";
$settings_result = mysqli_query($conn, $settings_query);

// Convert to associative array for easy access
$settings = [];
mysqli_data_seek($settings_result, 0);
while ($setting = mysqli_fetch_assoc($settings_result)) {
    $settings[$setting['key']] = $setting['value'];
}

// Get all settings for table display
mysqli_data_seek($settings_result, 0);

// Get system information
$php_version = phpversion();
$mysql_version = mysqli_get_server_info($conn);
$server_software = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
$upload_max_filesize = ini_get('upload_max_filesize');
$post_max_size = ini_get('post_max_size');
$max_execution_time = ini_get('max_execution_time');
$memory_limit = ini_get('memory_limit');
?>

<style>
    .settings-container { max-width:600px; margin:40px auto; background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(123,63,160,0.08); padding:32px; }
    .settings-form label { font-weight:600; color:#5B2D8F; margin-bottom:6px; display:block; }
    .settings-form input[type="text"], .settings-form select { width:100%; padding:10px; border-radius:8px; border:1px solid #F3E9FF; margin-bottom:18px; }
    .settings-form button { background:#7B3FA0; color:#FFD700; border:none; border-radius:10px; padding:12px 28px; font-size:16px; font-weight:600; cursor:pointer; }
    .settings-form button:hover { background:#FFD700; color:#7B3FA0; }
</style>
<div class="settings-container">
    <h2 style="color:#5B2D8F;">Site Settings</h2>
    <form method="post" class="settings-form">
        <label>Site Name</label>
        <input type="text" name="site_name" value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>">
        <label>Contact Email</label>
        <input type="text" name="contact_email" value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>">
        <label>Admissions Open</label>
        <select name="admissions_open">
            <option value="1" <?= ($settings['admissions_open'] ?? '') == '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($settings['admissions_open'] ?? '') == '0' ? 'selected' : '' ?>>No</option>
        </select>
        <label>Franchise Enabled</label>
        <select name="franchise_enabled">
            <option value="1" <?= ($settings['franchise_enabled'] ?? '') == '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($settings['franchise_enabled'] ?? '') == '0' ? 'selected' : '' ?>>No</option>
        </select>
        <button type="submit">Update Settings</button>
    </form>
</div>
<?php include 'footer.php'; ?>


<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'partners';
include 'header.php';
include '../includes/conn.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        if ($_POST['action'] === 'add_partner') {
            // Add new partner
            $franchise_name = mysqli_real_escape_string($conn, $_POST['franchise_name']);
            $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
            $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
            $landline = mysqli_real_escape_string($conn, $_POST['landline']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $state = mysqli_real_escape_string($conn, $_POST['state']);
            $district = mysqli_real_escape_string($conn, $_POST['district']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $about = mysqli_real_escape_string($conn, $_POST['about']);
            $features = mysqli_real_escape_string($conn, $_POST['features']);
            $established_year = (int)$_POST['established_year'];
            $student_capacity = (int)$_POST['student_capacity'];
            $current_students = (int)$_POST['current_students'];
            $rating = (float)$_POST['rating'];
            $maps_location = mysqli_real_escape_string($conn, $_POST['maps_location']);
            $website_url = mysqli_real_escape_string($conn, $_POST['website_url']);
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $display_order = (int)$_POST['display_order'];
            
            $insert_query = "
                INSERT INTO franchises (
                    franchise_name, contact_person, mobile, landline, email, address,
                    state, district, city, pincode, category, about, features,
                    established_year, student_capacity, current_students, rating,
                    maps_location, website_url, is_featured, display_order, created_at
                ) VALUES (
                    '$franchise_name', '$contact_person', '$mobile', '$landline', '$email', '$address',
                    '$state', '$district', '$city', '$pincode', '$category', '$about', '$features',
                    $established_year, $student_capacity, $current_students, $rating,
                    '$maps_location', '$website_url', $is_featured, $display_order, NOW()
                )
            ";
            
            if (mysqli_query($conn, $insert_query)) {
                $response['success'] = true;
                $response['message'] = 'Partner added successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
            
        } elseif ($_POST['action'] === 'update_partner') {
            // Update existing partner
            $partner_id = (int)$_POST['partner_id'];
            $franchise_name = mysqli_real_escape_string($conn, $_POST['franchise_name']);
            $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
            $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
            $landline = mysqli_real_escape_string($conn, $_POST['landline']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $state = mysqli_real_escape_string($conn, $_POST['state']);
            $district = mysqli_real_escape_string($conn, $_POST['district']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $about = mysqli_real_escape_string($conn, $_POST['about']);
            $features = mysqli_real_escape_string($conn, $_POST['features']);
            $established_year = (int)$_POST['established_year'];
            $student_capacity = (int)$_POST['student_capacity'];
            $current_students = (int)$_POST['current_students'];
            $rating = (float)$_POST['rating'];
            $maps_location = mysqli_real_escape_string($conn, $_POST['maps_location']);
            $website_url = mysqli_real_escape_string($conn, $_POST['website_url']);
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $display_order = (int)$_POST['display_order'];
            
            $update_query = "
                UPDATE franchises SET
                    franchise_name = '$franchise_name',
                    contact_person = '$contact_person',
                    mobile = '$mobile',
                    landline = '$landline',
                    email = '$email',
                    address = '$address',
                    state = '$state',
                    district = '$district',
                    city = '$city',
                    pincode = '$pincode',
                    category = '$category',
                    about = '$about',
                    features = '$features',
                    established_year = $established_year,
                    student_capacity = $student_capacity,
                    current_students = $current_students,
                    rating = $rating,
                    maps_location = '$maps_location',
                    website_url = '$website_url',
                    is_featured = $is_featured,
                    display_order = $display_order,
                    updated_at = NOW()
                WHERE id = $partner_id
            ";
            
            if (mysqli_query($conn, $update_query)) {
                $response['success'] = true;
                $response['message'] = 'Partner updated successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
            
        } elseif ($_POST['action'] === 'toggle_status') {
            // Toggle partner status
            $partner_id = (int)$_POST['partner_id'];
            $new_status = (int)$_POST['status'];
            
            $update_query = "UPDATE franchises SET is_active = $new_status, updated_at = NOW() WHERE id = $partner_id";
            
            if (mysqli_query($conn, $update_query)) {
                $response['success'] = true;
                $response['message'] = 'Partner status updated successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
            
        } elseif ($_POST['action'] === 'delete_partner') {
            // Delete partner
            $partner_id = (int)$_POST['partner_id'];
            
            // Delete related records first
            mysqli_query($conn, "DELETE FROM franchise_images WHERE franchise_id = $partner_id");
            mysqli_query($conn, "DELETE FROM franchise_programs WHERE franchise_id = $partner_id");
            mysqli_query($conn, "DELETE FROM franchise_staff WHERE franchise_id = $partner_id");
            
            // Delete main record
            $delete_query = "DELETE FROM franchises WHERE id = $partner_id";
            
            if (mysqli_query($conn, $delete_query)) {
                $response['success'] = true;
                $response['message'] = 'Partner deleted successfully!';
            } else {
                throw new Exception('Database error: ' . mysqli_error($conn));
            }
        }
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    // Return JSON response for AJAX calls
    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    // Redirect to avoid resubmission
    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
    } else {
        $_SESSION['error_message'] = $response['message'];
    }
    header("Location: partners.php");
    exit;
}

// Handle session messages
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Filters and pagination
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = [];
if ($status_filter === 'active') {
    $where_conditions[] = "is_active = 1";
} elseif ($status_filter === 'inactive') {
    $where_conditions[] = "is_active = 0";
}
if ($category_filter !== 'all') {
    $where_conditions[] = "category = '" . mysqli_real_escape_string($conn, $category_filter) . "'";
}
if (!empty($search)) {
    $search_term = mysqli_real_escape_string($conn, $search);
    $where_conditions[] = "(franchise_name LIKE '%$search_term%' OR contact_person LIKE '%$search_term%' OR city LIKE '%$search_term%' OR state LIKE '%$search_term%')";
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM franchises $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_partners = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_partners / $per_page);

// Fetch partners
$partners_query = "SELECT * FROM franchises $where_clause ORDER BY display_order ASC, created_at DESC LIMIT $per_page OFFSET $offset";
$partners_result = mysqli_query($conn, $partners_query);

// Get statistics
$stats_query = "
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active,
        SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactive,
        SUM(CASE WHEN is_featured = 1 THEN 1 ELSE 0 END) as featured,
        SUM(CASE WHEN category = 'metro' THEN 1 ELSE 0 END) as metro,
        SUM(CASE WHEN category = 'tier2' THEN 1 ELSE 0 END) as tier2
    FROM franchises
";
$stats_result = mysqli_query($conn, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);
?>

<style>

.admin-main {
    margin-left: 280px;
    margin-top: 80px;
    padding: 30px;
    background: #f8f9ff;
    min-height: calc(100vh - 80px);
    transition: all 0.3s ease;
}

.dashboard-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.2);
}

.dashboard-header h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #FFD700;
}

.dashboard-header p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    margin: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    margin-bottom: 20px;
}

.stat-icon.admissions { background: linear-gradient(135deg, #4CAF50, #66BB6A); }
.stat-icon.contacts { background: linear-gradient(135deg, #2196F3, #42A5F5); }
.stat-icon.franchise { background: linear-gradient(135deg, #FF9800, #FFB74D); }
.stat-icon.partners { background: linear-gradient(135deg, #9C27B0, #BA68C8); }

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 10px;
}

.stat-label {
    color: #666;
    font-weight: 600;
    font-size: 1rem;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.chart-card,
.activity-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9ff;
}

.card-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #6B2C91;
    margin: 0;
}

.card-actions {
    display: flex;
    gap: 10px;
}

.btn-sm {
    padding: 8px 15px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(107, 44, 145, 0.3);
}

.chart-container {
    position: relative;
    height: 300px;
    margin-bottom: 20px;
}

.activity-list {
    max-height: 350px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 15px;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 10px;
    border-left: 4px solid #FFD700;
    transition: all 0.3s ease;
}

.activity-item:hover {
    transform: translateX(5px);
    background: linear-gradient(135deg, #e8ebff 0%, #d8dbff 100%);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
    font-size: 16px;
}

.activity-icon.admission { background: #4CAF50; }
.activity-icon.contact { background: #2196F3; }
.activity-icon.franchise { background: #FF9800; }

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #6B2C91;
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.activity-meta {
    color: #666;
    font-size: 0.85rem;
}

.quick-actions {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    margin-bottom: 30px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 15px;
    text-decoration: none;
    color: #6B2C91;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.action-btn:hover {
    transform: translateY(-3px);
    border-color: #FFD700;
    box-shadow: 0 8px 25px rgba(107, 44, 145, 0.15);
    color: #6B2C91;
}

.action-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.action-icon.admissions { background: linear-gradient(135deg, #4CAF50, #66BB6A); }
.action-icon.contacts { background: linear-gradient(135deg, #2196F3, #42A5F5); }
.action-icon.franchise { background: linear-gradient(135deg, #FF9800, #FFB74D); }
.action-icon.partners { background: linear-gradient(135deg, #9C27B0, #BA68C8); }
.action-icon.seo { background: linear-gradient(135deg, #E91E63, #F06292); }
.action-icon.settings { background: linear-gradient(135deg, #607D8B, #78909C); }

.no-data {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.no-data i {
    font-size: 3rem;
    color: #ccc;
    margin-bottom: 15px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    
    .content-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .dashboard-header h1 {
        font-size: 2rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

/* Loading animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card,
.chart-card,
.activity-card,
.quick-actions {
    animation: fadeInUp 0.6s ease-out;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

.partners-actions {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.btn-add {
    background: linear-gradient(135deg, #4CAF50, #66BB6A);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    color: white;
}

.partner-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    border: 2px solid #f0f0f0;
    transition: all 0.3s ease;
}

.partner-card:hover {
    border-color: #FFD700;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(107, 44, 145, 0.12);
}

.partner-header {
    display: grid;
    grid-template-columns: auto 1fr auto auto;
    gap: 20px;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.partner-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: #FFD700;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    flex-shrink: 0;
}

.partner-basic-info h3 {
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    margin-bottom: 5px;
    font-weight: 600;
}

.partner-location {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.partner-meta {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: #E8F5E8;
    color: #1B5E20;
}

.status-inactive {
    background: #FFEBEE;
    color: #B71C1C;
}

.category-badge {
    background: #6B2C91;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.featured-badge {
    background: #FFD700;
    color: #5B2D8F;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.partner-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.partner-body {
    padding: 20px;
    display: none;
}

.partner-body.expanded {
    display: block;
}

.partner-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.detail-group h4 {
    color: #6B2C91;
    font-size: 1rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.9rem;
}

.detail-label {
    color: #666;
    font-weight: 500;
}

.detail-value {
    color: #333;
    font-weight: 600;
}

.rating-display {
    display: flex;
    align-items: center;
    gap: 5px;
}

.stars {
    color: #FFD700;
}

.partner-form {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin: 20px 0;
    border: 2px solid #e8ebff;
    display: none;
}

.partner-form.active {
    display: block;
}

.form-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.form-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    color: #6B2C91;
    margin: 0;
}

.form-close {
    background: #ff4757;
    color: white;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.form-close:hover {
    transform: scale(1.1);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    color: #6B2C91;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 2px solid #e8ebff;
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #FFD700;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 15px 0;
}

.checkbox-group input[type="checkbox"] {
    transform: scale(1.2);
    accent-color: #6B2C91;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.btn-save {
    background: #4CAF50;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.btn-save:hover {
    background: #45a049;
}

.btn-cancel {
    background: #757575;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.btn-cancel:hover {
    background: #616161;
}

/* Action buttons */
.btn-toggle {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 0.8rem;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-activate {
    background: #E8F5E8;
    color: #2E7D32;
}

.btn-activate:hover {
    background: #4CAF50;
    color: white;
}

.btn-deactivate {
    background: #FFEBEE;
    color: #D32F2F;
}

.btn-deactivate:hover {
    background: #F44336;
    color: white;
}

.btn-expand {
    background: #E3F2FD;
    color: #1976D2;
}

.btn-expand:hover {
    background: #2196F3;
    color: white;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    
    .partner-header {
        grid-template-columns: 1fr;
        gap: 15px;
        text-align: center;
    }
    
    .partner-actions {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
}
</style>

<div class="admin-main">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Partners Management</h1>
        <p class="page-subtitle">Manage franchise partners, their information, and status</p>
    </div>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon partners">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number"><?php echo $stats['total']; ?></div>
            <div class="stat-label">Total Partners</div>
        </div>
        
        <div class="stat-card enrolled">
            <div class="stat-icon partners">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number"><?php echo $stats['active']; ?></div>
            <div class="stat-label">Active Partners</div>
        </div>
        
        <div class="stat-card rejected">
            <div class="stat-icon partners">
                <i class="fas fa-pause-circle"></i>
            </div>
            <div class="stat-number"><?php echo $stats['inactive']; ?></div>
            <div class="stat-label">Inactive Partners</div>
        </div>
        
        <div class="stat-card franchise">
            <div class="stat-icon partners">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-number"><?php echo $stats['featured']; ?></div>
            <div class="stat-label">Featured Partners</div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="partners-actions">
        <button class="btn-add" onclick="showAddForm()">
            <i class="fas fa-plus"></i>
            Add New Partner
        </button>
    </div>

    <!-- Add/Edit Partner Form -->
    <div id="partnerForm" class="partner-form">
        <div class="form-header">
            <h3 class="form-title" id="formTitle">Add New Partner</h3>
            <button type="button" class="form-close" onclick="hidePartnerForm()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="partnerFormElement" method="POST">
            <input type="hidden" name="action" id="formAction" value="add_partner">
            <input type="hidden" name="partner_id" id="partnerId" value="">
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="franchise_name">Franchise Name *</label>
                    <input type="text" id="franchise_name" name="franchise_name" required placeholder="Enter franchise name">
                </div>
                <div class="form-group">
                    <label for="contact_person">Contact Person *</label>
                    <input type="text" id="contact_person" name="contact_person" required placeholder="Enter contact person name">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number *</label>
                    <input type="tel" id="mobile" name="mobile" required placeholder="Enter mobile number">
                </div>
                <div class="form-group">
                    <label for="landline">Landline</label>
                    <input type="tel" id="landline" name="landline" placeholder="Enter landline number">
                </div>
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="metro">Metro</option>
                        <option value="tier2">Tier 2</option>
                        <option value="tier3">Tier 3</option>
                        <option value="rural">Rural</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">State *</label>
                    <input type="text" id="state" name="state" required placeholder="Enter state">
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" id="district" name="district" placeholder="Enter district">
                </div>
                <div class="form-group">
                    <label for="city">City *</label>
                    <input type="text" id="city" name="city" required placeholder="Enter city">
                </div>
                <div class="form-group">
                    <label for="pincode">PIN Code</label>
                    <input type="text" id="pincode" name="pincode" placeholder="Enter PIN code" maxlength="6">
                </div>
                <div class="form-group">
                    <label for="established_year">Established Year</label>
                    <input type="number" id="established_year" name="established_year" min="2000" max="2024" placeholder="e.g., 2020">
                </div>
                <div class="form-group">
                    <label for="student_capacity">Student Capacity</label>
                    <input type="number" id="student_capacity" name="student_capacity" min="0" placeholder="e.g., 150">
                </div>
                <div class="form-group">
                    <label for="current_students">Current Students</label>
                    <input type="number" id="current_students" name="current_students" min="0" placeholder="e.g., 120">
                </div>
                <div class="form-group">
                    <label for="rating">Rating (1-5)</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" step="0.1" placeholder="e.g., 4.5">
                </div>
                <div class="form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" id="display_order" name="display_order" min="0" placeholder="e.g., 1" value="0">
                </div>
                <div class="form-group full-width">
                    <label for="address">Full Address *</label>
                    <textarea id="address" name="address" rows="3" required placeholder="Enter complete address"></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="about">About Franchise</label>
                    <textarea id="about" name="about" rows="4" placeholder="Describe the franchise..."></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="features">Features (comma-separated)</label>
                    <textarea id="features" name="features" rows="3" placeholder="e.g., Smart Classrooms, CCTV Monitoring, Play Area"></textarea>
                </div>
                <div class="form-group">
                    <label for="maps_location">Google Maps Location</label>
                    <input type="url" id="maps_location" name="maps_location" placeholder="https://goo.gl/maps/...">
                </div>
                <div class="form-group">
                    <label for="website_url">Website URL</label>
                    <input type="url" id="website_url" name="website_url" placeholder="https://example.com">
                </div>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="is_featured" name="is_featured" value="1">
                <label for="is_featured">Mark as Featured Partner</label>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="hidePartnerForm()">Cancel</button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save Partner
                </button>
            </div>
        </form>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" action="">
            <div class="filters-grid">
                <div class="filter-group">
                    <label>Status Filter</label>
                    <select name="status">
                        <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All Status</option>
                        <option value="active" <?php echo $status_filter === 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo $status_filter === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Category Filter</label>
                    <select name="category">
                        <option value="all" <?php echo $category_filter === 'all' ? 'selected' : ''; ?>>All Categories</option>
                        <option value="metro" <?php echo $category_filter === 'metro' ? 'selected' : ''; ?>>Metro</option>
                        <option value="tier2" <?php echo $category_filter === 'tier2' ? 'selected' : ''; ?>>Tier 2</option>
                        <option value="tier3" <?php echo $category_filter === 'tier3' ? 'selected' : ''; ?>>Tier 3</option>
                        <option value="rural" <?php echo $category_filter === 'rural' ? 'selected' : ''; ?>>Rural</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Search partners..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Partners List -->
    <div class="admissions-table">
        <div class="table-header">
            <h3 class="table-title">Partners (<?php echo $total_partners; ?>)</h3>
            <div class="table-actions">
                <button class="action-btn" onclick="exportData()">
                    <i class="fas fa-download"></i> Export
                </button>
                <button class="action-btn" onclick="refreshData()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>
        
        <div class="partners-list">
            <?php if (mysqli_num_rows($partners_result) > 0): ?>
                <?php while ($partner = mysqli_fetch_assoc($partners_result)): ?>
                <div class="partner-card">
                    <div class="partner-header">
                        <div class="partner-avatar">
                            <?php echo strtoupper(substr($partner['franchise_name'], 0, 2)); ?>
                        </div>
                        
                        <div class="partner-basic-info">
                            <h3><?php echo htmlspecialchars($partner['franchise_name']); ?></h3>
                            <div class="partner-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($partner['city'] . ', ' . $partner['state']); ?>
                            </div>
                            <div class="partner-meta">
                                <span class="status-badge status-<?php echo $partner['is_active'] ? 'active' : 'inactive'; ?>">
                                    <?php echo $partner['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                                <span class="category-badge"><?php echo ucfirst($partner['category']); ?></span>
                                <?php if ($partner['is_featured']): ?>
                                    <span class="featured-badge">Featured</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="rating-display">
                            <span class="stars">
                                <?php 
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $partner['rating']) {
                                        echo '<i class="fas fa-star"></i>';
                                    } elseif ($i - 0.5 <= $partner['rating']) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    } else {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                }
                                ?>
                            </span>
                            <span>(<?php echo $partner['rating']; ?>)</span>
                        </div>
                        
                        <div class="partner-actions">
                            <button class="btn-sm btn-expand" onclick="togglePartnerDetails(<?php echo $partner['id']; ?>)">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="btn-sm btn-edit" onclick="editPartner(<?php echo $partner['id']; ?>)">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <?php if ($partner['is_active']): ?>
                                <button class="btn-sm btn-deactivate" onclick="togglePartnerStatus(<?php echo $partner['id']; ?>, 0)">
                                    <i class="fas fa-pause"></i> Deactivate
                                </button>
                            <?php else: ?>
                                <button class="btn-sm btn-activate" onclick="togglePartnerStatus(<?php echo $partner['id']; ?>, 1)">
                                    <i class="fas fa-play"></i> Activate
                                </button>
                            <?php endif; ?>
                            <button class="btn-sm" style="background: #FFEBEE; color: #D32F2F;" onclick="deletePartner(<?php echo $partner['id']; ?>)">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="partner-body" id="partner-<?php echo $partner['id']; ?>">
                        <div class="partner-details-grid">
                            <div class="detail-group">
                                <h4>Contact Information</h4>
                                <div class="detail-item">
                                    <span class="detail-label">Contact Person:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['contact_person']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Mobile:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['mobile']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['email']); ?></span>
                                </div>
                                <?php if ($partner['landline']): ?>
                                <div class="detail-item">
                                    <span class="detail-label">Landline:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['landline']); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="detail-group">
                                <h4>Location Details</h4>
                                <div class="detail-item">
                                    <span class="detail-label">Address:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['address']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">District:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['district']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">PIN Code:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($partner['pincode']); ?></span>
                                </div>
                            </div>
                            
                            <div class="detail-group">
                                <h4>Franchise Details</h4>
                                <div class="detail-item">
                                    <span class="detail-label">Established:</span>
                                    <span class="detail-value"><?php echo $partner['established_year']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Capacity:</span>
                                    <span class="detail-value"><?php echo $partner['student_capacity']; ?> students</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Current Students:</span>
                                    <span class="detail-value"><?php echo $partner['current_students']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Display Order:</span>
                                    <span class="detail-value"><?php echo $partner['display_order']; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($partner['about']): ?>
                        <div class="detail-group">
                            <h4>About</h4>
                            <p style="color: #666; line-height: 1.6; margin: 10px 0;">
                                <?php echo nl2br(htmlspecialchars($partner['about'])); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($partner['features']): ?>
                        <div class="detail-group">
                            <h4>Features</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin: 10px 0;">
                                <?php 
                                $features = explode(',', $partner['features']);
                                foreach ($features as $feature): 
                                ?>
                                    <span style="background: #e8ebff; color: #6B2C91; padding: 4px 12px; border-radius: 12px; font-size: 0.8rem;">
                                        <?php echo trim(htmlspecialchars($feature)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($partner['maps_location'] || $partner['website_url']): ?>
                        <div class="detail-group">
                            <h4>Links</h4>
                            <div style="display: flex; gap: 15px; margin: 10px 0;">
                                <?php if ($partner['maps_location']): ?>
                                    <a href="<?php echo htmlspecialchars($partner['maps_location']); ?>" target="_blank" style="color: #6B2C91; text-decoration: none;">
                                        <i class="fas fa-map-marker-alt"></i> View on Maps
                                    </a>
                                <?php endif; ?>
                                <?php if ($partner['website_url']): ?>
                                    <a href="<?php echo htmlspecialchars($partner['website_url']); ?>" target="_blank" style="color: #6B2C91; text-decoration: none;">
                                        <i class="fas fa-globe"></i> Visit Website
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-data">
                    <i class="fas fa-users"></i>
                    <h4>No Partners Found</h4>
                    <p>No partners match your current filters.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page-1; ?>&status=<?php echo $status_filter; ?>&category=<?php echo $category_filter; ?>&search=<?php echo urlencode($search); ?>">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            
            <?php for ($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>&category=<?php echo $category_filter; ?>&search=<?php echo urlencode($search); ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&status=<?php echo $status_filter; ?>&category=<?php echo $category_filter; ?>&search=<?php echo urlencode($search); ?>">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
// Show add partner form
function showAddForm() {
    document.getElementById('partnerForm').classList.add('active');
    document.getElementById('formTitle').textContent = 'Add New Partner';
    document.getElementById('formAction').value = 'add_partner';
    document.getElementById('partnerId').value = '';
    document.getElementById('partnerFormElement').reset();
    document.body.style.overflow = 'hidden'; // Prevent body scroll
}

// Hide partner form
function hidePartnerForm() {
    document.getElementById('partnerForm').classList.remove('active');
    document.body.style.overflow = 'auto'; // Restore body scroll
}

// Edit partner
function editPartner(partnerId) {
    // Fetch partner data and populate form
    fetch(`get_partner_data.php?id=${partnerId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const partner = data.partner;
                
                // Populate form fields
                document.getElementById('formTitle').textContent = 'Edit Partner';
                document.getElementById('formAction').value = 'update_partner';
                document.getElementById('partnerId').value = partnerId;
                
                document.getElementById('franchise_name').value = partner.franchise_name || '';
                document.getElementById('contact_person').value = partner.contact_person || '';
                document.getElementById('mobile').value = partner.mobile || '';
                document.getElementById('landline').value = partner.landline || '';
                document.getElementById('email').value = partner.email || '';
                document.getElementById('address').value = partner.address || '';
                document.getElementById('state').value = partner.state || '';
                document.getElementById('district').value = partner.district || '';
                document.getElementById('city').value = partner.city || '';
                document.getElementById('pincode').value = partner.pincode || '';
                document.getElementById('category').value = partner.category || '';
                document.getElementById('about').value = partner.about || '';
                document.getElementById('features').value = partner.features || '';
                document.getElementById('established_year').value = partner.established_year || '';
                document.getElementById('student_capacity').value = partner.student_capacity || '';
                document.getElementById('current_students').value = partner.current_students || '';
                document.getElementById('rating').value = partner.rating || '';
                document.getElementById('maps_location').value = partner.maps_location || '';
                document.getElementById('website_url').value = partner.website_url || '';
                document.getElementById('display_order').value = partner.display_order || 0;
                document.getElementById('is_featured').checked = partner.is_featured == '1';
                
                // Show form
                document.getElementById('partnerForm').classList.add('active');
                document.body.style.overflow = 'hidden';
            } else {
                alert('Error loading partner data: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error loading partner data');
            console.error('Error:', error);
        });
}

// Toggle partner details
function togglePartnerDetails(partnerId) {
    const detailsDiv = document.getElementById(`partner-${partnerId}`);
    const isExpanded = detailsDiv.classList.contains('expanded');
    
    // Close all other expanded details
    document.querySelectorAll('.partner-body').forEach(div => {
        div.classList.remove('expanded');
    });
    
    // Toggle current details
    if (!isExpanded) {
        detailsDiv.classList.add('expanded');
    }
}

// Toggle partner status
function togglePartnerStatus(partnerId, status) {
    const statusText = status ? 'activate' : 'deactivate';
    if (confirm(`Are you sure you want to ${statusText} this partner?`)) {
        const formData = new FormData();
        formData.append('action', 'toggle_status');
        formData.append('partner_id', partnerId);
        formData.append('status', status);
        formData.append('ajax', '1');
        
        fetch('partners.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error updating partner status');
            console.error('Error:', error);
        });
    }
}

// Delete partner
function deletePartner(partnerId) {
    if (confirm('Are you sure you want to delete this partner? This action cannot be undone.')) {
        const formData = new FormData();
        formData.append('action', 'delete_partner');
        formData.append('partner_id', partnerId);
        formData.append('ajax', '1');
        
        fetch('partners.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error deleting partner');
            console.error('Error:', error);
        });
    }
}

// Form validation
document.getElementById('partnerFormElement').addEventListener('submit', function(e) {
    const mobile = document.getElementById('mobile').value;
    const email = document.getElementById('email').value;
    const pincode = document.getElementById('pincode').value;
    
    // Validate mobile number
    if (mobile && !/^\d{10}$/.test(mobile)) {
        e.preventDefault();
        alert('Please enter a valid 10-digit mobile number');
        return;
    }
    
    // Validate email
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        return;
    }
    
    // Validate PIN code
    if (pincode && !/^\d{6}$/.test(pincode)) {
        e.preventDefault();
        alert('Please enter a valid 6-digit PIN code');
        return;
    }
});

// Export functionality
function exportData() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', 'csv');
    window.location.href = 'partners.php?' + params.toString();
}

// Refresh functionality
function refreshData() {
    window.location.reload();
}

// Close form when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('partner-form') && e.target.classList.contains('active')) {
        hidePartnerForm();
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hidePartnerForm();
    }
});

// Auto-refresh stats every 5 minutes
setInterval(function() {
    fetch('get_partner_stats.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.stat-number').forEach((el, index) => {
                    const keys = ['total', 'active', 'inactive', 'featured'];
                    if (keys[index] && data.stats[keys[index]] !== undefined) {
                        el.textContent = data.stats[keys[index]];
                    }
                });
            }
        })
        .catch(error => console.error('Error refreshing stats:', error));
}, 300000); // 5 minutes
</script>

<?php include 'footer.php'; ?>

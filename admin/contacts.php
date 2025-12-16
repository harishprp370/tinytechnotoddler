<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'contacts';
include 'header.php';
include '../includes/conn.php';

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status') {
        $query_id = (int)$_POST['query_id'];
        $new_status = mysqli_real_escape_string($conn, $_POST['status']);
        $priority = mysqli_real_escape_string($conn, $_POST['priority']);
        $assigned_to = mysqli_real_escape_string($conn, $_POST['assigned_to']);
        $resolution_notes = mysqli_real_escape_string($conn, $_POST['resolution_notes']);
        $follow_up_date = !empty($_POST['follow_up_date']) ? "'" . $_POST['follow_up_date'] . "'" : 'NULL';
        $response_sent = isset($_POST['response_sent']) ? 1 : 0;
        
        $update_query = "UPDATE contact_queries SET 
                        status = '$new_status',
                        priority = '$priority',
                        assigned_to = '$assigned_to',
                        resolution_notes = '$resolution_notes',
                        follow_up_date = $follow_up_date,
                        response_sent = $response_sent,
                        updated_at = NOW()
                        WHERE id = $query_id";
        
        if (mysqli_query($conn, $update_query)) {
            $success_message = "Query status updated successfully!";
        } else {
            $error_message = "Error updating status: " . mysqli_error($conn);
        }
    }
}

// Filters and pagination
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$type_filter = isset($_GET['type']) ? $_GET['type'] : 'all';
$priority_filter = isset($_GET['priority']) ? $_GET['priority'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = [];
if ($status_filter !== 'all') {
    $where_conditions[] = "status = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
}
if ($type_filter !== 'all') {
    $where_conditions[] = "query_type = '" . mysqli_real_escape_string($conn, $type_filter) . "'";
}
if ($priority_filter !== 'all') {
    $where_conditions[] = "priority = '" . mysqli_real_escape_string($conn, $priority_filter) . "'";
}
if (!empty($search)) {
    $search_term = mysqli_real_escape_string($conn, $search);
    $where_conditions[] = "(name LIKE '%$search_term%' OR email LIKE '%$search_term%' OR subject LIKE '%$search_term%' OR message LIKE '%$search_term%')";
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM contact_queries $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_contacts = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_contacts / $per_page);

// Fetch contact queries
$contacts_query = "SELECT * FROM contact_queries $where_clause ORDER BY submitted_at DESC LIMIT $per_page OFFSET $offset";
$contacts_result = mysqli_query($conn, $contacts_query);

// Get statistics
$stats_query = "
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_queries,
        SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress,
        SUM(CASE WHEN status = 'resolved' THEN 1 ELSE 0 END) as resolved,
        SUM(CASE WHEN status = 'closed' THEN 1 ELSE 0 END) as closed,
        SUM(CASE WHEN priority = 'urgent' THEN 1 ELSE 0 END) as urgent
    FROM contact_queries
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
    
    .filters-section { margin-bottom: 40px; }
    .filters-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px; }
    .filter-group { display: flex; flex-direction: column; }
    .filter-group label { font-size: 14px; margin-bottom: 8px; color: #333; }
    .filter-group select, .filter-group input { padding: 10px; border: 1px solid #ccc; border-radius: 8px; font-size: 14px; }
    .filter-btn { padding: 10px 20px; background: #7B3FA0; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; }
    .filter-btn:hover { background: #6f2c91; }
    
    .admissions-table { background: #fff; border-radius: 12px; overflow: hidden; }
    .table-header { background: #7B3FA0; color: #fff; padding: 16px; }
    .table-title { font-size: 18px; margin: 0; }
    .table-actions { display: flex; gap: 10px; }
    .action-btn { background: #FFD700; color: #5B2D8F; border: none; border-radius: 8px; padding: 10px 20px; font-size: 14px; cursor: pointer; }
    .action-btn:hover { background: #5B2D8F; color: #FFD700; }
    
    .table-responsive { padding: 16px; }
    .admissions-data-table { width: 100%; border-collapse: collapse; }
    .admissions-data-table th, .admissions-data-table td { padding: 12px 8px; border-bottom: 1px solid #F3E9FF; text-align: left; }
    .admissions-data-table th { background: #7B3FA0; color: #FFD700; font-weight: 600; }
    .admissions-data-table tr:hover { background: #F3E9FF; }
    
    .pagination { text-align: center; margin: 20px 0; }
    .pagination a, .pagination span { display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 8px; font-size: 14px; }
    .pagination a { background: #7B3FA0; color: #fff; text-decoration: none; }
    .pagination a:hover { background: #6f2c91; }
    .pagination .current { background: #FFD700; color: #5B2D8F; font-weight: 600; }
    
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4); }
    .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 600px; border-radius: 8px; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; }
    .modal-title { font-size: 18px; margin: 0; }
    .close { cursor: pointer; font-size: 18px; }
    
    .query-type-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .query-admission { background: #E3F2FD; color: #0D47A1; }
    .query-franchise { background: #FFF3E0; color: #E65100; }
    .query-general { background: #F3E5F5; color: #4A148C; }
    .query-complaint { background: #FFEBEE; color: #B71C1C; }
    .query-feedback { background: #E8F5E8; color: #1B5E20; }
    .query-partnership { background: #FFF8E1; color: #F57F17; }

    .priority-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .priority-low { background: #E8F5E8; color: #2E7D32; }
    .priority-medium { background: #FFF3E0; color: #F57C00; }
    .priority-high { background: #FFEBEE; color: #D32F2F; }
    .priority-urgent { background: #FFEBEE; color: #B71C1C; animation: pulse 2s infinite; }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .contact-name {
        font-weight: 600;
        color: #333;
    }

    .contact-details {
        color: #666;
        font-size: 0.8rem;
    }
    
</style>

<div class="admin-main">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Contact Queries Management</h1>
        <p class="page-subtitle">Manage customer inquiries and support requests</p>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon contacts">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-number"><?php echo $stats['total']; ?></div>
            <div class="stat-label">Total Queries</div>
        </div>
        
        <div class="stat-card pending">
            <div class="stat-icon contacts">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number"><?php echo $stats['new_queries']; ?></div>
            <div class="stat-label">New Queries</div>
        </div>
        
        <div class="stat-card contacted">
            <div class="stat-icon contacts">
                <i class="fas fa-spinner"></i>
            </div>
            <div class="stat-number"><?php echo $stats['in_progress']; ?></div>
            <div class="stat-label">In Progress</div>
        </div>
        
        <div class="stat-card enrolled">
            <div class="stat-icon contacts">
                <i class="fas fa-check"></i>
            </div>
            <div class="stat-number"><?php echo $stats['resolved']; ?></div>
            <div class="stat-label">Resolved</div>
        </div>
        
        <div class="stat-card rejected">
            <div class="stat-icon contacts">
                <i class="fas fa-archive"></i>
            </div>
            <div class="stat-number"><?php echo $stats['closed']; ?></div>
            <div class="stat-label">Closed</div>
        </div>
        
        <div class="stat-card urgent">
            <div class="stat-icon contacts">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number"><?php echo $stats['urgent']; ?></div>
            <div class="stat-label">Urgent</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" action="">
            <div class="filters-grid">
                <div class="filter-group">
                    <label>Status Filter</label>
                    <select name="status">
                        <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All Status</option>
                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>New</option>
                        <option value="in_progress" <?php echo $status_filter === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                        <option value="resolved" <?php echo $status_filter === 'resolved' ? 'selected' : ''; ?>>Resolved</option>
                        <option value="closed" <?php echo $status_filter === 'closed' ? 'selected' : ''; ?>>Closed</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Query Type</label>
                    <select name="type">
                        <option value="all" <?php echo $type_filter === 'all' ? 'selected' : ''; ?>>All Types</option>
                        <option value="admission" <?php echo $type_filter === 'admission' ? 'selected' : ''; ?>>Admission</option>
                        <option value="franchise" <?php echo $type_filter === 'franchise' ? 'selected' : ''; ?>>Franchise</option>
                        <option value="general" <?php echo $type_filter === 'general' ? 'selected' : ''; ?>>General</option>
                        <option value="complaint" <?php echo $type_filter === 'complaint' ? 'selected' : ''; ?>>Complaint</option>
                        <option value="feedback" <?php echo $type_filter === 'feedback' ? 'selected' : ''; ?>>Feedback</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Priority</label>
                    <select name="priority">
                        <option value="all" <?php echo $priority_filter === 'all' ? 'selected' : ''; ?>>All Priorities</option>
                        <option value="urgent" <?php echo $priority_filter === 'urgent' ? 'selected' : ''; ?>>Urgent</option>
                        <option value="high" <?php echo $priority_filter === 'high' ? 'selected' : ''; ?>>High</option>
                        <option value="medium" <?php echo $priority_filter === 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="low" <?php echo $priority_filter === 'low' ? 'selected' : ''; ?>>Low</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Search by name, email, subject..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Contacts Table -->
    <div class="admissions-table">
        <div class="table-header">
            <h3 class="table-title">Contact Queries (<?php echo $total_contacts; ?>)</h3>
            <div class="table-actions">
                <button class="action-btn" onclick="exportData()">
                    <i class="fas fa-download"></i> Export
                </button>
                <button class="action-btn" onclick="refreshData()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="admissions-data-table">
                <thead>
                    <tr>
                        <th>Query ID</th>
                        <th>Contact Info</th>
                        <th>Query Type</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($contacts_result) > 0): ?>
                        <?php while ($contact = mysqli_fetch_assoc($contacts_result)): ?>
                        <tr>
                            <td><strong>#<?php echo str_pad($contact['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                            <td>
                                <div class="contact-info">
                                    <span class="contact-name"><?php echo htmlspecialchars($contact['name']); ?></span>
                                    <span class="contact-details"><?php echo htmlspecialchars($contact['email']); ?></span>
                                    <?php if ($contact['phone']): ?>
                                        <span class="contact-details"><?php echo htmlspecialchars($contact['phone']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <span class="query-type-badge query-<?php echo $contact['query_type']; ?>">
                                    <?php echo ucfirst($contact['query_type']); ?>
                                </span>
                            </td>
                            <td>
                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo htmlspecialchars(substr($contact['subject'], 0, 50)); ?>
                                    <?php if (strlen($contact['subject']) > 50): ?>...<?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <span class="priority-badge priority-<?php echo $contact['priority']; ?>">
                                    <?php echo ucfirst($contact['priority']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo str_replace('_', '-', $contact['status']); ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $contact['status'])); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($contact['submitted_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-sm btn-view" onclick="viewContact(<?php echo $contact['id']; ?>)">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn-sm btn-edit" onclick="editContact(<?php echo $contact['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: #666;">
                                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 20px; color: #ccc;"></i><br>
                                No contact queries found matching your criteria.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page-1; ?>&status=<?php echo $status_filter; ?>&type=<?php echo $type_filter; ?>&priority=<?php echo $priority_filter; ?>&search=<?php echo urlencode($search); ?>">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            
            <?php for ($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>&type=<?php echo $type_filter; ?>&priority=<?php echo $priority_filter; ?>&search=<?php echo urlencode($search); ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&status=<?php echo $status_filter; ?>&type=<?php echo $type_filter; ?>&priority=<?php echo $priority_filter; ?>&search=<?php echo urlencode($search); ?>">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Contact Details Modal -->
<div id="contactModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Contact Query Details</h3>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
// Modal functionality
function viewContact(id) {
    openModal(id, 'view');
}

function editContact(id) {
    openModal(id, 'edit');
}

function openModal(contactId, mode) {
    const modal = document.getElementById('contactModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    modalTitle.textContent = mode === 'edit' ? 'Edit Contact Query' : 'Contact Query Details';
    modalBody.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
    modal.style.display = 'block';
    
    // Fetch contact details
    fetch(`get_contact_details.php?id=${contactId}&mode=${mode}`)
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = '<div style="text-align:center;padding:40px;color:red;">Error loading contact details.</div>';
            console.error('Error:', error);
        });
}

// Close modal
document.querySelector('.close').onclick = function() {
    document.getElementById('contactModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('contactModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Export and refresh functions
function exportData() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', 'csv');
    window.location.href = 'contacts.php?' + params.toString();
}

function refreshData() {
    window.location.reload();
}
</script>

<?php include 'footer.php'; ?>

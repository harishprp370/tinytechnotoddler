<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'admissions';
include 'header.php';
include '../includes/conn.php';

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status') {
        $admission_id = (int)$_POST['admission_id'];
        $new_status = mysqli_real_escape_string($conn, $_POST['status']);
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);
        $counselor = mysqli_real_escape_string($conn, $_POST['counselor']);
        $follow_up_date = !empty($_POST['follow_up_date']) ? "'" . $_POST['follow_up_date'] . "'" : 'NULL';
        
        $update_query = "UPDATE admissions SET 
                        application_status = '$new_status',
                        notes = '$notes',
                        assigned_counselor = '$counselor',
                        follow_up_date = $follow_up_date,
                        updated_at = NOW()
                        WHERE id = $admission_id";
        
        if (mysqli_query($conn, $update_query)) {
            $success_message = "Application status updated successfully!";
        } else {
            $error_message = "Error updating status: " . mysqli_error($conn);
        }
    }
}

// Filters and pagination
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$program_filter = isset($_GET['program']) ? $_GET['program'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = [];
if ($status_filter !== 'all') {
    $where_conditions[] = "application_status = '" . mysqli_real_escape_string($conn, $status_filter) . "'";
}
if ($program_filter !== 'all') {
    $where_conditions[] = "program = '" . mysqli_real_escape_string($conn, $program_filter) . "'";
}
if (!empty($search)) {
    $search_term = mysqli_real_escape_string($conn, $search);
    $where_conditions[] = "(child_name LIKE '%$search_term%' OR parent_name LIKE '%$search_term%' OR email LIKE '%$search_term%' OR phone LIKE '%$search_term%')";
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM admissions $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_admissions = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_admissions / $per_page);

// Fetch admissions
$admissions_query = "SELECT * FROM admissions $where_clause ORDER BY submitted_at DESC LIMIT $per_page OFFSET $offset";
$admissions_result = mysqli_query($conn, $admissions_query);

// Get statistics for dashboard
$stats_query = "
    SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN application_status = 'pending' THEN 1 ELSE 0 END) as pending,
        SUM(CASE WHEN application_status = 'contacted' THEN 1 ELSE 0 END) as contacted,
        SUM(CASE WHEN application_status = 'visited' THEN 1 ELSE 0 END) as visited,
        SUM(CASE WHEN application_status = 'enrolled' THEN 1 ELSE 0 END) as enrolled,
        SUM(CASE WHEN application_status = 'rejected' THEN 1 ELSE 0 END) as rejected
    FROM admissions
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
}

.page-header {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 10px;
}

.page-subtitle {
    color: #666;
    margin: 0;
    font-size: 1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
    text-align: center;
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
    background: var(--card-color, #6B2C91);
}

.stat-card.pending { --card-color: #FF9800; }
.stat-card.contacted { --card-color: #2196F3; }
.stat-card.visited { --card-color: #9C27B0; }
.stat-card.enrolled { --card-color: #4CAF50; }
.stat-card.rejected { --card-color: #F44336; }

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--card-color, #6B2C91);
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 5px;
}

.stat-label {
    color: #666;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.filters-section {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
}

.filters-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 2fr auto;
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    color: #6B2C91;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.filter-group select,
.filter-group input {
    padding: 10px 15px;
    border: 2px solid #e8ebff;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: border-color 0.3s;
}

.filter-group select:focus,
.filter-group input:focus {
    outline: none;
    border-color: #FFD700;
}

.filter-btn {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(107, 44, 145, 0.3);
}

.admissions-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    border: 1px solid #e8ebff;
}

.table-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.3rem;
    margin: 0;
}

.table-actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.3s;
}

.action-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.table-responsive {
    overflow-x: auto;
}

.admissions-data-table {
    width: 100%;
    border-collapse: collapse;
}

.admissions-data-table th {
    background: #f8f9ff;
    color: #6B2C91;
    font-weight: 600;
    padding: 15px 12px;
    text-align: left;
    border-bottom: 2px solid #e8ebff;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.admissions-data-table td {
    padding: 15px 12px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: top;
    font-size: 0.9rem;
}

.admissions-data-table tr:hover {
    background: #f8f9ff;
}

.student-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.student-name {
    font-weight: 600;
    color: #333;
}

.student-age {
    color: #666;
    font-size: 0.8rem;
}

.parent-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.parent-name {
    font-weight: 600;
    color: #333;
}

.parent-contact {
    color: #666;
    font-size: 0.8rem;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-pending {
    background: #FFF3E0;
    color: #E65100;
}

.status-contacted {
    background: #E3F2FD;
    color: #0D47A1;
}

.status-visited {
    background: #F3E5F5;
    color: #4A148C;
}

.status-enrolled {
    background: #E8F5E8;
    color: #1B5E20;
}

.status-rejected {
    background: #FFEBEE;
    color: #B71C1C;
}

.program-badge {
    background: #6B2C91;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-sm {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 0.8rem;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-view {
    background: #E3F2FD;
    color: #1976D2;
}

.btn-view:hover {
    background: #1976D2;
    color: white;
}

.btn-edit {
    background: #FFF3E0;
    color: #F57C00;
}

.btn-edit:hover {
    background: #F57C00;
    color: white;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin: 30px 0;
}

.pagination a,
.pagination span {
    padding: 10px 15px;
    border: 2px solid #6B2C91;
    color: #6B2C91;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination a:hover,
.pagination .current {
    background: #6B2C91;
    color: white;
}

.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    backdrop-filter: blur(5px);
}

.modal-content {
    background: white;
    margin: 2% auto;
    padding: 0;
    border-radius: 15px;
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from { 
        transform: translateY(-50px);
        opacity: 0;
    }
    to { 
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 20px;
    border-radius: 15px 15px 0 0;
    position: relative;
}

.modal-header h3 {
    margin: 0;
    font-family: 'Fredoka', sans-serif;
    font-size: 1.5rem;
}

.close {
    position: absolute;
    right: 20px;
    top: 20px;
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s;
}

.close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.modal-body {
    padding: 30px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.info-group {
    display: flex;
    flex-direction: column;
}

.info-group label {
    font-weight: 600;
    color: #6B2C91;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.info-group span,
.info-group input,
.info-group select,
.info-group textarea {
    padding: 10px;
    background: #f8f9ff;
    border: 1px solid #e8ebff;
    border-radius: 8px;
    font-size: 0.9rem;
}

.info-group.full-width {
    grid-column: 1 / -1;
}

.update-form {
    margin-top: 30px;
    padding: 20px;
    background: #f8f9ff;
    border-radius: 10px;
}

.form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 20px;
}

.btn-save {
    background: #4CAF50;
    color: white;
    padding: 10px 20px;
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
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.btn-cancel:hover {
    background: #616161;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admin-main {
        margin-left: 0;
        padding: 20px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-content {
        width: 95%;
        margin: 5% auto;
    }
    
    .table-responsive {
        font-size: 0.8rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-weight: 600;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>

<div class="admin-main">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Admissions Management</h1>
        <p class="page-subtitle">Manage student admission applications and track enrollment progress</p>
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
            <div class="stat-number"><?php echo $stats['total']; ?></div>
            <div class="stat-label">Total Applications</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-number"><?php echo $stats['pending']; ?></div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card contacted">
            <div class="stat-number"><?php echo $stats['contacted']; ?></div>
            <div class="stat-label">Contacted</div>
        </div>
        <div class="stat-card visited">
            <div class="stat-number"><?php echo $stats['visited']; ?></div>
            <div class="stat-label">Visited</div>
        </div>
        <div class="stat-card enrolled">
            <div class="stat-number"><?php echo $stats['enrolled']; ?></div>
            <div class="stat-label">Enrolled</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-number"><?php echo $stats['rejected']; ?></div>
            <div class="stat-label">Rejected</div>
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
                        <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="contacted" <?php echo $status_filter === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                        <option value="visited" <?php echo $status_filter === 'visited' ? 'selected' : ''; ?>>Visited</option>
                        <option value="enrolled" <?php echo $status_filter === 'enrolled' ? 'selected' : ''; ?>>Enrolled</option>
                        <option value="rejected" <?php echo $status_filter === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Program Filter</label>
                    <select name="program">
                        <option value="all" <?php echo $program_filter === 'all' ? 'selected' : ''; ?>>All Programs</option>
                        <option value="PlayGroup" <?php echo $program_filter === 'PlayGroup' ? 'selected' : ''; ?>>PlayGroup</option>
                        <option value="Nursery" <?php echo $program_filter === 'Nursery' ? 'selected' : ''; ?>>Nursery</option>
                        <option value="Junior KG" <?php echo $program_filter === 'Junior KG' ? 'selected' : ''; ?>>Junior KG</option>
                        <option value="Senior KG" <?php echo $program_filter === 'Senior KG' ? 'selected' : ''; ?>>Senior KG</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Search by name, email, phone..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Admissions Table -->
    <div class="admissions-table">
        <div class="table-header">
            <h3 class="table-title">Admission Applications (<?php echo $total_admissions; ?>)</h3>
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
                        <th>Application ID</th>
                        <th>Student Info</th>
                        <th>Parent Info</th>
                        <th>Program</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($admissions_result) > 0): ?>
                        <?php while ($admission = mysqli_fetch_assoc($admissions_result)): ?>
                        <tr>
                            <td><strong>#<?php echo str_pad($admission['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name"><?php echo htmlspecialchars($admission['child_name']); ?></span>
                                    <span class="student-age"><?php echo htmlspecialchars($admission['child_age']); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="parent-info">
                                    <span class="parent-name"><?php echo htmlspecialchars($admission['parent_name']); ?></span>
                                    <span class="parent-contact"><?php echo htmlspecialchars($admission['phone']); ?></span>
                                    <span class="parent-contact"><?php echo htmlspecialchars($admission['email']); ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="program-badge"><?php echo htmlspecialchars($admission['program']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($admission['city'] . ', ' . $admission['state']); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo $admission['application_status']; ?>">
                                    <?php echo ucfirst($admission['application_status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($admission['submitted_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-sm btn-view" onclick="viewAdmission(<?php echo $admission['id']; ?>)">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn-sm btn-edit" onclick="editAdmission(<?php echo $admission['id']; ?>)">
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
                                No admissions found matching your criteria.
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
                <a href="?page=<?php echo $page-1; ?>&status=<?php echo $status_filter; ?>&program=<?php echo $program_filter; ?>&search=<?php echo urlencode($search); ?>">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            
            <?php for ($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>&status=<?php echo $status_filter; ?>&program=<?php echo $program_filter; ?>&search=<?php echo urlencode($search); ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&status=<?php echo $status_filter; ?>&program=<?php echo $program_filter; ?>&search=<?php echo urlencode($search); ?>">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- View/Edit Modal -->
<div id="admissionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Admission Details</h3>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
// Modal functionality
function viewAdmission(id) {
    openModal(id, 'view');
}

function editAdmission(id) {
    openModal(id, 'edit');
}

function openModal(admissionId, mode) {
    const modal = document.getElementById('admissionModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    modalTitle.textContent = mode === 'edit' ? 'Edit Admission' : 'Admission Details';
    modalBody.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
    modal.style.display = 'block';
    
    // Fetch admission details
    fetch(`get_admission_details.php?id=${admissionId}&mode=${mode}`)
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = '<div style="text-align:center;padding:40px;color:red;">Error loading admission details.</div>';
            console.error('Error:', error);
        });
}

// Close modal
document.querySelector('.close').onclick = function() {
    document.getElementById('admissionModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('admissionModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Export functionality
function exportData() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', 'csv');
    window.location.href = 'admissions.php?' + params.toString();
}

// Refresh functionality
function refreshData() {
    window.location.reload();
}

// Auto-refresh every 5 minutes
setInterval(function() {
    // Update stats only
    fetch('get_admission_stats.php')
        .then(response => response.json())
        .then(data => {
            document.querySelectorAll('.stat-number').forEach((el, index) => {
                const keys = ['total', 'pending', 'contacted', 'visited', 'enrolled', 'rejected'];
                if (keys[index] && data[keys[index]] !== undefined) {
                    el.textContent = data[keys[index]];
                }
            });
        })
        .catch(error => console.error('Error refreshing stats:', error));
}, 300000); // 5 minutes
</script>

<?php include 'footer.php'; ?>

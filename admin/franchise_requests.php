<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'franchise_requests';
include 'header.php';

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status') {
        $request_id = (int)$_POST['request_id'];
        $notes = mysqli_real_escape_string($conn, $_POST['notes']);
        $follow_up_date = !empty($_POST['follow_up_date']) ? "'" . $_POST['follow_up_date'] . "'" : 'NULL';
        
        $update_query = "UPDATE franchise_interest SET 
                        message = '$notes',
                        submitted_at = submitted_at
                        WHERE id = $request_id";
        
        if (mysqli_query($conn, $update_query)) {
            $success_message = "Franchise request updated successfully!";
        } else {
            $error_message = "Error updating request: " . mysqli_error($conn);
        }
    }
}

// Filters and pagination
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = [];
if (!empty($search)) {
    $search_term = mysqli_real_escape_string($conn, $search);
    $where_conditions[] = "(name LIKE '%$search_term%' OR email LIKE '%$search_term%' OR phone LIKE '%$search_term%' OR city LIKE '%$search_term%' OR state LIKE '%$search_term%')";
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get total count
$count_query = "SELECT COUNT(*) as total FROM franchise_interest $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_requests = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_requests / $per_page);

// Fetch franchise requests
$requests_query = "SELECT * FROM franchise_interest $where_clause ORDER BY submitted_at DESC LIMIT $per_page OFFSET $offset";
$requests_result = mysqli_query($conn, $requests_query);

// Get statistics
$stats_query = "SELECT COUNT(*) as total FROM franchise_interest";
$stats_result = mysqli_query($conn, $stats_query);
$total_franchise_requests = mysqli_fetch_assoc($stats_result)['total'];
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
</style>

<div class="admin-main">
    <div class="page-header">
        <h1 class="page-title">Franchise Requests Management</h1>
        <p class="page-subtitle">Manage franchise applications and business partner inquiries</p>
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
            <div class="stat-icon franchise">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-number"><?php echo $total_franchise_requests; ?></div>
            <div class="stat-label">Total Franchise Requests</div>
        </div>
    </div>

    <!-- Search Filter -->
    <div class="filters-section">
        <form method="GET" action="">
            <div class="filters-grid" style="grid-template-columns: 1fr auto;">
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Search by name, email, phone, city..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i> Search
                </button>
            </div>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="admissions-table">
        <div class="table-header">
            <h3 class="table-title">Franchise Requests (<?php echo $total_requests; ?>)</h3>
            <div class="table-actions">
                <button class="action-btn" onclick="exportData()">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="admissions-data-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Applicant Info</th>
                        <th>Location</th>
                        <th>Investment Range</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($requests_result) > 0): ?>
                        <?php while ($request = mysqli_fetch_assoc($requests_result)): ?>
                        <tr>
                            <td><strong>#<?php echo str_pad($request['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                            <td>
                                <div class="contact-info">
                                    <span class="contact-name"><?php echo htmlspecialchars($request['name']); ?></span>
                                    <span class="contact-details"><?php echo htmlspecialchars($request['email']); ?></span>
                                    <span class="contact-details"><?php echo htmlspecialchars($request['phone']); ?></span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($request['city'] . ', ' . $request['state']); ?></td>
                            <td>
                                <span class="program-badge"><?php echo htmlspecialchars($request['investment_range']); ?></span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($request['submitted_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-sm btn-view" onclick="viewRequest(<?php echo $request['id']; ?>)">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn-sm btn-edit" onclick="editRequest(<?php echo $request['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                                <i class="fas fa-handshake" style="font-size: 3rem; margin-bottom: 20px; color: #ccc;"></i><br>
                                No franchise requests found.
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
                <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            
            <?php for ($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="current"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Request Details Modal -->
<div id="requestModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Franchise Request Details</h3>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
function viewRequest(id) {
    openModal(id, 'view');
}

function editRequest(id) {
    openModal(id, 'edit');
}

function openModal(requestId, mode) {
    const modal = document.getElementById('requestModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    modalTitle.textContent = mode === 'edit' ? 'Edit Franchise Request' : 'Franchise Request Details';
    modalBody.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
    modal.style.display = 'block';
    
    // Fetch request details
    fetch(`get_franchise_details.php?id=${requestId}&mode=${mode}`)
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = '<div style="text-align:center;padding:40px;color:red;">Error loading request details.</div>';
            console.error('Error:', error);
        });
}

// Close modal
document.querySelector('.close').onclick = function() {
    document.getElementById('requestModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('requestModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function exportData() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', 'csv');
    window.location.href = 'franchise_requests.php?' + params.toString();
}
</script>

<?php include 'footer.php'; ?>

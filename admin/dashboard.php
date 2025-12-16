<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$page_key = 'dashboard';
include 'header.php';

// Fetch dashboard statistics
$admissions_query = "SELECT COUNT(*) as total_admissions FROM admissions";
$admissions_result = mysqli_query($conn, $admissions_query);
$total_admissions = mysqli_fetch_assoc($admissions_result)['total_admissions'];

$contacts_query = "SELECT COUNT(*) as total_contacts FROM contact_queries";
$contacts_result = mysqli_query($conn, $contacts_query);
$total_contacts = mysqli_fetch_assoc($contacts_result)['total_contacts'];

$franchise_query = "SELECT COUNT(*) as total_franchise FROM franchise_interest";
$franchise_result = mysqli_query($conn, $franchise_query);
$total_franchise = mysqli_fetch_assoc($franchise_result)['total_franchise'];

$partners_query = "SELECT COUNT(*) as total_partners FROM franchises WHERE is_active = 1";
$partners_result = mysqli_query($conn, $partners_query);
$total_partners = mysqli_fetch_assoc($partners_result)['total_partners'];

// Recent activities
$recent_admissions = mysqli_query($conn, "SELECT * FROM admissions ORDER BY submitted_at DESC LIMIT 5");
$recent_contacts = mysqli_query($conn, "SELECT * FROM contact_queries ORDER BY submitted_at DESC LIMIT 5");
$recent_franchise = mysqli_query($conn, "SELECT * FROM franchise_interest ORDER BY submitted_at DESC LIMIT 5");

// Monthly data for charts
$monthly_admissions = mysqli_query($conn, "SELECT DATE_FORMAT(submitted_at, '%Y-%m') as month, COUNT(*) as count FROM admissions WHERE submitted_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH) GROUP BY month ORDER BY month");
$monthly_franchise = mysqli_query($conn, "SELECT DATE_FORMAT(submitted_at, '%Y-%m') as month, COUNT(*) as count FROM franchise_interest WHERE submitted_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH) GROUP BY month ORDER BY month");
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
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Welcome back! Here's what's happening with TinyTechnoToddlers today.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon admissions">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-number"><?php echo $total_admissions; ?></div>
            <div class="stat-label">Total Admissions</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon contacts">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-number"><?php echo $total_contacts; ?></div>
            <div class="stat-label">Contact Queries</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon franchise">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-number"><?php echo $total_franchise; ?></div>
            <div class="stat-label">Franchise Requests</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon partners">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number"><?php echo $total_partners; ?></div>
            <div class="stat-label">Active Partners</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="actions-grid">
            <a href="admissions.php" class="action-btn">
                <div class="action-icon admissions">
                    <i class="fas fa-plus"></i>
                </div>
                <span>View Admissions</span>
            </a>
            <a href="contacts.php" class="action-btn">
                <div class="action-icon contacts">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <span>Check Messages</span>
            </a>
            <a href="franchise_requests.php" class="action-btn">
                <div class="action-icon franchise">
                    <i class="fas fa-handshake"></i>
                </div>
                <span>Franchise Requests</span>
            </a>
            <a href="partners.php" class="action-btn">
                <div class="action-icon partners">
                    <i class="fas fa-building"></i>
                </div>
                <span>Manage Partners</span>
            </a>
            <a href="seo.php" class="action-btn">
                <div class="action-icon seo">
                    <i class="fas fa-search"></i>
                </div>
                <span>SEO Settings</span>
            </a>
            <a href="settings.php" class="action-btn">
                <div class="action-icon settings">
                    <i class="fas fa-cogs"></i>
                </div>
                <span>System Settings</span>
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Chart Card -->
        <div class="chart-card">
            <div class="card-header">
                <h3 class="card-title">Monthly Overview</h3>
                <div class="card-actions">
                    <button class="btn-sm btn-primary">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="activity-card">
            <div class="card-header">
                <h3 class="card-title">Recent Activities</h3>
                <div class="card-actions">
                    <a href="#" class="btn-sm btn-primary">View All</a>
                </div>
            </div>
            <div class="activity-list">
                <?php if (mysqli_num_rows($recent_admissions) > 0 || mysqli_num_rows($recent_contacts) > 0 || mysqli_num_rows($recent_franchise) > 0): ?>
                    <!-- Recent Admissions -->
                    <?php while ($admission = mysqli_fetch_assoc($recent_admissions)): ?>
                    <div class="activity-item">
                        <div class="activity-icon admission">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title"><?php echo htmlspecialchars($admission['child_name']); ?> - New Admission</div>
                            <div class="activity-meta">
                                <?php echo htmlspecialchars($admission['program']); ?> • 
                                <?php echo date('M j, Y', strtotime($admission['submitted_at'])); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <!-- Recent Contacts -->
                    <?php while ($contact = mysqli_fetch_assoc($recent_contacts)): ?>
                    <div class="activity-item">
                        <div class="activity-icon contact">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title"><?php echo htmlspecialchars($contact['name']); ?> - New Message</div>
                            <div class="activity-meta">
                                <?php echo htmlspecialchars($contact['subject']); ?> • 
                                <?php echo date('M j, Y', strtotime($contact['submitted_at'])); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <!-- Recent Franchise Requests -->
                    <?php while ($franchise = mysqli_fetch_assoc($recent_franchise)): ?>
                    <div class="activity-item">
                        <div class="activity-icon franchise">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title"><?php echo htmlspecialchars($franchise['name']); ?> - Franchise Interest</div>
                            <div class="activity-meta">
                                <?php echo htmlspecialchars($franchise['city']); ?> • 
                                <?php echo date('M j, Y', strtotime($franchise['submitted_at'])); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-data">
                        <i class="fas fa-calendar"></i>
                        <h4>No Recent Activities</h4>
                        <p>No activities to show yet. Check back later!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Chart
const ctx = document.getElementById('monthlyChart').getContext('2d');
const monthlyChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: 'Admissions',
                data: [<?php 
                    $months = [];
                    while ($row = mysqli_fetch_assoc($monthly_admissions)) {
                        $months[] = $row['count'];
                    }
                    echo implode(',', array_pad($months, 12, 0));
                ?>],
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            },
            {
                label: 'Franchise Requests',
                data: [<?php 
                    mysqli_data_seek($monthly_franchise, 0);
                    $months = [];
                    while ($row = mysqli_fetch_assoc($monthly_franchise)) {
                        $months[] = $row['count'];
                    }
                    echo implode(',', array_pad($months, 12, 0));
                ?>],
                borderColor: '#FF9800',
                backgroundColor: 'rgba(255, 152, 0, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            }
        }
    }
});

// Counter animation for stats
function animateCounter(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 20);
}

// Animate counters on load
document.addEventListener('DOMContentLoaded', function() {
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.textContent);
        animateCounter(stat, target);
    });
});

// Real-time updates (simulate with setInterval)
setInterval(() => {
    // Add subtle animation to indicate live updates
    document.querySelectorAll('.stat-card').forEach(card => {
        card.style.transform = 'scale(1.02)';
        setTimeout(() => {
            card.style.transform = 'scale(1)';
        }, 200);
    });
}, 30000); // Every 30 seconds
</script>

<?php include 'footer.php'; ?>

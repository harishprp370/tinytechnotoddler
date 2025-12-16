<?php
require_once __DIR__ . '/../includes/conn.php';
$page_key = $page_key ?? 'dashboard';

// Fetch admin user info (if needed)
$admin_query = "SELECT * FROM users WHERE id = " . $_SESSION['admin_id'];
$admin_result = mysqli_query($conn, $admin_query);
$admin_user = mysqli_fetch_assoc($admin_result);

// Fetch SEO meta from DB
$stmt = $conn->prepare("SELECT meta_title, meta_description FROM seo_meta WHERE page_key = ? LIMIT 1");
$stmt->bind_param("s", $page_key);
$stmt->execute();
$result = $stmt->get_result();
$seo = $result->fetch_assoc();

$meta_title = $seo['meta_title'] ?? 'TinyTechnoToddlers Admin Panel';
$meta_description = $seo['meta_description'] ?? 'Manage TinyTechnoToddlers Preschool admissions, partners, and settings.';
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9ff;
            margin: 0;
            line-height: 1.6;
            color: #333;
        }
        
        /* Admin Header */
        .admin-header {
            background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
            box-shadow: 0 4px 20px rgba(107, 44, 145, 0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 3px solid #FFD700;
            height: 80px;
        }

        .admin-nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 100%;
            margin: 0;
            padding: 15px 30px;
            height: 100%;
        }

        .admin-logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .admin-logo {
            height: 50px;
            width: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
            object-fit: cover;
        }

        .admin-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .admin-brand-text h3 {
            color: #FFD700;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .admin-brand-text p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.85rem;
            margin: 0;
            font-weight: 500;
        }

        .admin-nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 8px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            min-width: 250px;
        }

        .search-box:focus-within {
            background: rgba(255, 255, 255, 0.15);
            border-color: #FFD700;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.3);
        }

        .search-box input {
            background: none;
            border: none;
            outline: none;
            color: white;
            font-size: 0.9rem;
            flex: 1;
            padding: 0;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-box i {
            color: rgba(255, 255, 255, 0.7);
            margin-right: 10px;
        }

        .notifications {
            position: relative;
        }

        .notification-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-user-menu {
            position: relative;
        }

        .user-menu-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 8px 15px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .user-menu-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #FFD700;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #5B2D8F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
        }

        .user-dropdown {
            position: absolute;
            top: 110%;
            right: 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
            border: 2px solid #FFD700;
        }

        .user-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            color: #6B2C91;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-item:first-child {
            border-radius: 13px 13px 0 0;
        }

        .dropdown-item:last-child {
            border-radius: 0 0 13px 13px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
            color: #FFD700;
            transform: translateX(5px);
        }

        .dropdown-item i {
            width: 18px;
            text-align: center;
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 80px;
            width: 280px;
            height: calc(100vh - 80px);
            background: white;
            box-shadow: 4px 0 20px rgba(107, 44, 145, 0.1);
            border-right: 2px solid #FFD700;
            z-index: 999;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar-content {
            padding: 30px 0;
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-section h4 {
            color: #6B2C91;
            font-family: 'Fredoka', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            padding: 0 25px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 5px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: #666;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-nav a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: #FFD700;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-nav a:hover {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
            color: #6B2C91;
            transform: translateX(10px);
        }

        .sidebar-nav a:hover::before {
            transform: scaleY(1);
        }

        .sidebar-nav a.active {
            background: linear-gradient(135deg, #6B2C91, #8E44AD);
            color: white;
            transform: translateX(10px);
        }

        .sidebar-nav a.active::before {
            transform: scaleY(1);
        }

        .sidebar-nav a.active i {
            color: #FFD700;
        }

        .sidebar-nav i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 25px;
            text-align: center;
            color: #666;
            font-size: 0.85rem;
        }

        .sidebar-footer a {
            color: #6B2C91;
            text-decoration: none;
            font-weight: 600;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .admin-nav-container {
                padding: 15px 20px;
            }
            
            .search-box {
                display: none;
            }
            
            .mobile-toggle {
                display: flex;
            }
            
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-brand-text h3 {
                font-size: 1.2rem;
            }
            
            .admin-brand-text p {
                display: none;
            }
            
            .admin-nav-right {
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .admin-nav-container {
                padding: 10px 15px;
            }
            
            .admin-logo {
                height: 40px;
                width: 40px;
            }
            
            .admin-brand-text h3 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-nav-container">
            <div class="admin-logo-section">
                <img src="../assets/img/logo.jpeg" alt="TinyTechnoToddlers" class="admin-logo">
                <div class="admin-brand-text">
                    <h3>TinyTechnoToddlers</h3>
                    <p>Admin Control Panel</p>
                </div>
            </div>
            
            <div class="admin-nav-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search admissions, contacts, partners...">
                </div>
                
                <div class="notifications">
                    <button class="notification-btn" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
                
                <div class="admin-user-menu">
                    <button class="user-menu-btn" onclick="toggleUserMenu()">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($admin_user['username'], 0, 1)); ?>
                        </div>
                        <span><?php echo htmlspecialchars($admin_user['username']); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            Profile Settings
                        </a>
                        <a href="settings.php" class="dropdown-item">
                            <i class="fas fa-cogs"></i>
                            System Settings
                        </a>
                       
                        <a href="../index.php" class="dropdown-item" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            View Website
                        </a>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </div>
                
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Admin Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-content">
            <div class="sidebar-section">
                <h4>Main Menu</h4>
                <ul class="sidebar-nav">
                    <li><a href="dashboard.php" class="<?= $page_key == 'dashboard' ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a></li>

                </ul>
            </div>
            
            <div class="sidebar-section">
                <h4>Data Management</h4>
                <ul class="sidebar-nav">
                    <li><a href="admissions.php" class="<?= $page_key == 'admissions' ? 'active' : '' ?>">
                        <i class="fas fa-graduation-cap"></i>
                        Admissions
                    </a></li>
                    <li><a href="contacts.php" class="<?= $page_key == 'contacts' ? 'active' : '' ?>">
                        <i class="fas fa-envelope"></i>
                        Contact Queries
                    </a></li>
                    <li><a href="franchise_requests.php" class="<?= $page_key == 'franchise_requests' ? 'active' : '' ?>">
                        <i class="fas fa-handshake"></i>
                        Franchise Requests
                    </a></li>
                    <li><a href="partners.php" class="<?= $page_key == 'partners' ? 'active' : '' ?>">
                        <i class="fas fa-users"></i>
                        Partners Management
                    </a></li>
                </ul>
            </div>
            
            <div class="sidebar-section">
                <h4>Configuration</h4>
                <ul class="sidebar-nav">
                    <li><a href="seo.php" class="<?= $page_key == 'seo' ? 'active' : '' ?>">
                        <i class="fas fa-search"></i>
                        SEO Management
                    </a></li>
                    <li><a href="settings.php" class="<?= $page_key == 'settings' ? 'active' : '' ?>">
                        <i class="fas fa-cogs"></i>
                        System Settings
                    </a></li>
                    
                </ul>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <p>&copy; 2025 <a href="../index.php">Tiny Techno Toddlers</a><br>Admin Panel v2.0</p>
        </div>
    </aside>

    <script>
        // Toggle user dropdown
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        // Toggle notifications (placeholder)
        function toggleNotifications() {
            alert('Notification system coming soon!');
        }

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('active');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.admin-user-menu');
            const userDropdown = document.getElementById('userDropdown');
            
            if (!userMenu.contains(event.target)) {
                userDropdown.classList.remove('active');
            }
        });

        // Search functionality (basic)
        document.querySelector('.search-box input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query) {
                    alert('Search functionality coming soon for: ' + query);
                }
            }
        });

        // Responsive sidebar
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('adminSidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
            }
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>

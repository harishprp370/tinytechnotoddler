<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TinyToddlers Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .admin-footer {
            background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
            color: white;
            padding: 40px 30px 20px;
            margin-left: 280px;
            margin-top: 50px;
            position: relative;
        }

        .admin-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #FFD700, #FFC107);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h4 {
            font-family: 'Fredoka', sans-serif;
            color: #FFD700;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: #FFD700;
            transform: translateX(5px);
        }

        .footer-links i {
            width: 16px;
            text-align: center;
        }

        .system-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .system-info h4 {
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.85rem;
        }

        .info-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .info-value {
            color: #FFD700;
            font-weight: 600;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .footer-bottom a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .footer-btn {
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-btn:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: #FFD700;
            color: #FFD700;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4CAF50;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .admin-footer {
                margin-left: 0;
                padding: 30px 20px 15px;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .footer-actions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <footer class="admin-footer">
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="admissions.php"><i class="fas fa-graduation-cap"></i> Admissions</a></li>
                        <li><a href="contacts.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a href="partners.php"><i class="fas fa-users"></i> Partners</a></li>
                        <li><a href="settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul class="footer-links">
                        <li><a href="../index.php" target="_blank"><i class="fas fa-globe"></i> Main Website</a></li>
                        <li><a href="../partner_portal/index.php" target="_blank"><i class="fas fa-handshake"></i> Partner Portal</a></li>
                        <li><a href="#"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                        <li><a href="#"><i class="fas fa-book"></i> Documentation</a></li>
                        <li><a href="#"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <div class="system-info">
                        <h4>System Status</h4>
                        <div class="info-item">
                            <span class="info-label">Version:</span>
                            <span class="info-value">v2.0.1</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value"><?php echo date('M j, Y'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Database:</span>
                            <span class="info-value">MySQL 8.0</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">PHP Version:</span>
                            <span class="info-value"><?php echo phpversion(); ?></span>
                        </div>
                        <div class="status-indicator">
                            <div class="status-dot"></div>
                            <span style="color: rgba(255, 255, 255, 0.8);">System Online</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <a href="../index.php">TinyTechnoToddlers</a>. All rights reserved. Admin Panel by <a href="#">Tech Team</a></p>
                
                <div class="footer-actions">
                    <a href="#" class="footer-btn">
                        <i class="fas fa-download"></i> Backup
                    </a>
                    <a href="logout.php" class="footer-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Auto-hide footer in mobile when scrolling
        let lastScrollTop = 0;
        const footer = document.querySelector('.admin-footer');

        window.addEventListener('scroll', function() {
            if (window.innerWidth <= 768) {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    footer.style.transform = 'translateY(100%)';
                } else {
                    // Scrolling up
                    footer.style.transform = 'translateY(0)';
                }
                lastScrollTop = scrollTop;
            }
        }, false);

        // System status check simulation
        setInterval(() => {
            const statusDot = document.querySelector('.status-dot');
            statusDot.style.background = '#4CAF50'; // Green for online
            
            // Simulate occasional checks
            setTimeout(() => {
                statusDot.style.background = '#FF9800'; // Orange for checking
                setTimeout(() => {
                    statusDot.style.background = '#4CAF50'; // Back to green
                }, 500);
            }, Math.random() * 30000 + 30000); // Random interval between 30-60 seconds
        }, 1000);
    </script>
</body>
</html>

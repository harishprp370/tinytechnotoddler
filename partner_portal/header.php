<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>TinyTechnoToddlers Franchise Portal</title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Join India\'s leading preschool franchise. Explore franchise opportunities with TinyTechnoToddlers - 20+ years of excellence in early childhood education.'; ?>">
    <meta name="keywords" content="preschool franchise, education franchise India, TinyTechnoToddlers franchise, early childhood education business">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
            margin: 0;
            line-height: 1.6;
            color: #333;
        }
        
        /* Enhanced Header Styles */
        .partner-header {
            background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
            box-shadow: 0 4px 20px rgba(107, 44, 145, 0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 3px solid #FFD700;
        }

        .partner-nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            padding: 12px 40px;
            position: relative;
            min-height: 70px;
        }

        .partner-logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .partner-logo {
            height: 50px;
            width: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
            object-fit: cover;
        }

        .partner-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .partner-brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .partner-brand {
            color: #FFD700;
            font-family: 'Fredoka', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            line-height: 1.1;
            white-space: nowrap;
        }

        .partner-tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            font-weight: 500;
            line-height: 1;
            white-space: nowrap;
        }

        .partner-nav-menu {
            display: flex;
            gap: 8px;
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }

        .partner-nav-menu li {
            margin: 0;
        }

        .partner-nav-menu li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 10px 16px;
            border-radius: 25px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .partner-nav-menu li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .partner-nav-menu li a:hover::before {
            left: 100%;
        }

        .partner-nav-menu li a:hover,
        .partner-nav-menu li a.active {
            background: rgba(255, 255, 255, 0.15);
            color: #FFD700;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
        }

        .partner-nav-menu li a.cta-btn {
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #5B2D8F;
            font-weight: 700;
            padding: 10px 20px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
            margin-left: 8px;
        }

        .partner-nav-menu li a.cta-btn:hover {
            background: linear-gradient(135deg, #FFC107, #FFD700);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
            color: #4A2373;
        }
        
        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .mobile-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: #FFD700;
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        
        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }
        
        .mobile-menu-toggle.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .partner-nav-container {
                padding: 10px 25px;
            }
            
            .partner-nav-menu {
                gap: 4px;
            }
            
            .partner-nav-menu li a {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 992px) {
            .partner-brand {
                font-size: 1.1rem;
            }
            
            .partner-tagline {
                font-size: 0.75rem;
            }
            
            .partner-logo {
                height: 45px;
                width: 45px;
            }
            
            .partner-nav-menu li a {
                padding: 8px 10px;
                font-size: 0.85rem;
            }
            
            .partner-nav-menu li a.cta-btn {
                padding: 8px 16px;
                margin-left: 4px;
            }
        }
        
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }
            
            .partner-nav-container {
                padding: 8px 20px;
                min-height: 60px;
            }
            
            .partner-nav-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
                flex-direction: column;
                gap: 0;
                padding: 20px;
                box-shadow: 0 4px 20px rgba(107, 44, 145, 0.2);
                transform: translateY(-20px);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border-top: 2px solid rgba(255, 215, 0, 0.3);
                z-index: 999;
            }
            
            .partner-nav-menu.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }
            
            .partner-nav-menu li {
                width: 100%;
                margin: 5px 0;
            }
            
            .partner-nav-menu li a {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 15px 20px;
                border-radius: 10px;
                margin: 0;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                width: 100%;
                box-sizing: border-box;
                text-align: center;
            }
            
            .partner-nav-menu li a.cta-btn {
                background: linear-gradient(135deg, #FFD700, #FFC107);
                border: none;
                margin-left: 0;
                margin-top: 10px;
            }
        }
        
        @media (max-width: 480px) {
            .partner-nav-container {
                padding: 8px 15px;
                min-height: 55px;
            }
            
            .partner-logo-section {
                gap: 8px;
            }
            
            .partner-brand {
                font-size: 1rem;
            }
            
            .partner-tagline {
                font-size: 0.7rem;
            }
            
            .partner-logo {
                height: 40px;
                width: 40px;
            }
        }
        
        /* Page Spacing */
        .page-content {
            margin-top: 73px;
        }

        @media (max-width: 768px) {
            .page-content {
                margin-top: 63px;
            }
        }
        
        /* Notification Bar */
        .notification-bar {
            background: linear-gradient(90deg, #FFD700, #FFC107);
            color: #5B2D8F;
            text-align: center;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 10px rgba(255, 215, 0, 0.2);
            position: relative;
            z-index: 999;
            animation: slideDown 0.5s ease-out;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .notification-bar i {
            margin-right: 8px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .notification-close {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #5B2D8F;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 4px;
            border-radius: 3px;
            transition: background 0.3s ease;
        }

        .notification-close:hover {
            background: rgba(91, 45, 143, 0.1);
        }

        @media (max-width: 768px) {
            .notification-bar {
                padding: 6px 15px;
                font-size: 0.85rem;
            }
            
            .notification-close {
                right: 15px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Notification Bar -->
    <div class="notification-bar" id="notificationBar">
        <i class="fas fa-star"></i>
        Limited Time: Get 25% off on franchise setup fees! Contact us today.
        <button class="notification-close" onclick="document.getElementById('notificationBar').style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Header -->
    <header class="partner-header">
        <div class="partner-nav-container">
            <div class="partner-logo-section">
                <a href="index.php">
                    <img src="../assets/img/franchiselogo.jpeg" alt="TinyTechnoToddlers Franchise" class="partner-logo">
                </a>
                <div class="partner-brand-text">
                    <div class="partner-brand">Franchise Portal</div>
                    <div class="partner-tagline">Build Your Education Empire</div>
                </div>
            </div>
            
            <nav>
                <ul class="partner-nav-menu" id="partnerNavMenu">
                    <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Home
                    </a></li>
                    <li><a href="our_partners.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'our_partners.php' ? 'active' : ''; ?>">
                        <i class="fas fa-handshake"></i> Our Partners
                    </a></li>
                    <li><a href="interest_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'interest_form.php' ? 'active' : ''; ?>">
                        <i class="fas fa-clipboard-list"></i> Apply Now
                    </a></li>
                    <li><a href="faqs.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'faqs.php' ? 'active' : ''; ?>">
                        <i class="fas fa-question-circle"></i> FAQs
                    </a></li>
                    <li><a href="../index.php" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Main Website
                    </a></li>
                    <li><a href="interest_form.php" class="cta-btn">
                        <i class="fas fa-rocket"></i> Start Franchise
                    </a></li>
                </ul>
                
                <!-- Mobile Menu Toggle -->
                <div class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Page Content Container -->
    <div class="page-content">
        
    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const partnerNavMenu = document.getElementById('partnerNavMenu');
            
            mobileMenuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                partnerNavMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideNav = partnerNavMenu.contains(event.target);
                const isClickOnToggle = mobileMenuToggle.contains(event.target);
                
                if (!isClickInsideNav && !isClickOnToggle && partnerNavMenu.classList.contains('active')) {
                    mobileMenuToggle.classList.remove('active');
                    partnerNavMenu.classList.remove('active');
                }
            });
            
            // Close mobile menu when clicking on a link
            partnerNavMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    partnerNavMenu.classList.remove('active');
                });
            });
        });
        
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading state to buttons
        function addLoadingState(button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<span class="loading"></span> Processing...';
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        }
    </script>
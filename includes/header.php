<?php
require_once __DIR__ . '/conn.php';
$page_key = $page_key ?? 'home';

// Fetch SEO meta from DB
$stmt = $conn->prepare("SELECT meta_title, meta_description, meta_keywords, og_title, og_description, og_image, canonical_url, extras FROM seo_meta WHERE page_key = ? LIMIT 1");
$stmt->bind_param("s", $page_key);
$stmt->execute();
$result = $stmt->get_result();
$seo = $result->fetch_assoc();

$meta_title = $seo['meta_title'] ?? 'TinyToddlers - Building a Foundation for Lifetime Learning';
$meta_description = $seo['meta_description'] ?? 'Join India\'s largest preschool chain. Admissions and franchise opportunities available.';
$meta_keywords = $seo['meta_keywords'] ?? 'preschool, kidzee, admissions, franchise';
$og_title = $seo['og_title'] ?? $meta_title;
$og_description = $seo['og_description'] ?? $meta_description;
$og_image = $seo['og_image'] ?? '/assets/img/logo.jpeg';
$canonical_url = $seo['canonical_url'] ?? 'https://tinytechnotoddlers.com/';
$schema_json = '';
if (!empty($seo['extras'])) {
    $extras = json_decode($seo['extras'], true);
    if (isset($extras['schema'])) {
        $schema_json = json_encode($extras['schema']);
    }
}
if (!$schema_json) {
    $schema_json = json_encode([
        "@context" => "https://schema.org",
        "@type" => "Preschool",
        "name" => "TinyToddlers Preschool",
        "url" => $canonical_url,
        "logo" => $og_image,
        "description" => $meta_description
    ]);
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($og_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($og_description) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
    <meta property="og:type" content="website">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
    <script type="application/ld+json"><?= $schema_json ?></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #F3E9FF;
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            transition: all 0.4s ease;
            background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 50%, #9B59B6 100%);
            box-shadow: 0 2px 25px rgba(107, 44, 145, 0.15);
            backdrop-filter: blur(10px);
        }

        header.scrolled {
            background: linear-gradient(135deg, #5B2D8F 0%, #7B3FA0 50%, #8E44AD 100%);
            box-shadow: 0 4px 35px rgba(107, 44, 145, 0.25);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 40px;
            max-width: 1400px;
            margin: 0 auto;
            transition: all 0.4s ease;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        .logo {
            height: 55px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .logo-name {
            font-family: 'Fredoka', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #FFD700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header.scrolled .logo {
            height: 45px;
        }

        header.scrolled .nav-container {
            padding: 8px 40px;
        }

        .nav-menu {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            padding: 8px 12px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin: 0;
        }

        .nav-menu > li {
            list-style: none;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 18px;
            border-radius: 25px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
            position: relative;
            white-space: nowrap;
        }

        .nav-menu li a:hover,
        .nav-menu li a.active {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.9), rgba(255, 235, 59, 0.8));
            color: #5B2D8F;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
        }

        .nav-menu li a.active::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: #FFD700;
            border-radius: 2px;
        }

        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 12px;
            border-radius: 12px;
            backdrop-filter: blur(15px);
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: #FFD700;
        }

        @media (max-width: 1200px) {
            .nav-container {
                padding: 12px 25px;
            }
            
            .nav-menu li a {
                padding: 10px 14px;
                font-size: 13px;
            }
        }

        @media (max-width: 1024px) {
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 20px;
                right: 20px;
                flex-direction: column;
                background: linear-gradient(135deg, rgba(107, 44, 145, 0.98), rgba(139, 69, 173, 0.95));
                backdrop-filter: blur(20px);
                padding: 25px;
                border-radius: 20px;
                margin-top: 15px;
                gap: 0;
                align-items: stretch;
                box-shadow: 0 10px 40px rgba(107, 44, 145, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu li {
                width: 100%;
            }

            .nav-menu li a {
                width: 100%;
                text-align: center;
                padding: 15px 20px;
                color: white;
                background: none;
                border-radius: 12px;
                margin-bottom: 5px;
            }

            .nav-menu li a:hover,
            .nav-menu li a.active {
                background: linear-gradient(135deg, #FFD700, #FFC107);
                color: #5B2D8F;
                transform: none;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
                font-size: 20px;
                cursor: pointer;
                padding: 12px;
                border-radius: 12px;
                backdrop-filter: blur(15px);
                transition: all 0.3s ease;
            }

            .mobile-menu-btn:hover {
                background: rgba(255, 215, 0, 0.2);
                border-color: #FFD700;
            }

            .nav-container {
                padding: 12px 20px;
            }

            .logo-name {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .logo {
                height: 45px;
            }
            
            .logo-name {
                font-size: 20px;
            }
            
            .nav-container {
                padding: 10px 15px;
            }
        }

        /* Main Content Spacing */
        main {
            margin-top: 80px;
        }

        @media (max-width: 1024px) {
            main {
                margin-top: 75px;
            }
        }

        @media (max-width: 768px) {
            main {
                margin-top: 70px;
            }
        }

        /* Dropdown Styles */
        .nav-menu .dropdown {
            position: relative;
        }
        .nav-menu .dropdown > a {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-menu .dropdown-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 110%;
            left: 0;
            min-width: 220px;
            background: #fff;
            box-shadow: 0 8px 32px rgba(123,63,160,0.12);
            border-radius: 16px;
            z-index: 100;
            padding: 12px 0;
            animation: fadeIn 0.3s;
        }
        .nav-menu .dropdown:hover .dropdown-menu,
        .nav-menu .dropdown:focus-within .dropdown-menu,
        .nav-menu .dropdown.active .dropdown-menu {
            display: flex;
        }
        .nav-menu .dropdown-menu li {
            list-style: none;
            padding: 0;
        }
        .nav-menu .dropdown-menu li a {
            color: #5B2D8F;
            padding: 12px 24px;
            font-size: 15px;
            border-radius: 0 !important;
            background: none !important;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-menu .dropdown-menu li a:hover {
            background: #F3E9FF;
            color: #FFD700;
        }
        @media (max-width: 1024px) {
            .nav-menu .dropdown-menu {
                position: static;
                box-shadow: none;
                background: none;
                border-radius: 0;
                padding: 0;
                min-width: 0;
                display: none;
            }
            .nav-menu .dropdown.active .dropdown-menu {
                display: flex;
                flex-direction: column;
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <header id="mainHeader">
        <div class="nav-container">
            <div class="logo-wrapper">
                <img src="assets/img/logo.jpeg" alt="TinyToddlers Logo" class="logo">
                <span class="logo-name">TinyToddlers</span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="<?= $page_key == 'home' ? 'active' : '' ?>">Home</a></li>
                <li class="dropdown">
                    <a href="about.php" class="<?= $page_key == 'about' ? 'active' : '' ?> about-link">About Us <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about.php#vision-mission"><i class="fas fa-eye"></i> Vision & Mission</a></li>
                        <li><a href="about.php#legacy"><i class="fas fa-history"></i> Legacy</a></li>
                        <li><a href="about.php#recognition"><i class="fas fa-trophy"></i> Recognition & Awards</a></li>
                        <li><a href="about.php#team"><i class="fas fa-users"></i> Our Team</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="programs.php" class="<?= $page_key == 'programs' ? 'active' : '' ?> programs-link">Programs <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="playgroup.php"><i class="fas fa-child"></i> PlayGroup</a></li>
                        <li><a href="nursery.php"><i class="fas fa-cubes"></i> Nursery</a></li>
                        <li><a href="kindergarten.php"><i class="fas fa-puzzle-piece"></i> Kindergarten</a></li>
                        <li><a href="teacher-training.php"><i class="fas fa-chalkboard-teacher"></i> Teacher Training</a></li>
                    </ul>
                </li>
                <li><a href="admissions.php" class="<?= $page_key == 'admission' ? 'active' : '' ?>">Admissions</a></li>
                <li><a href="partner_portal/index.php" target="_blank" class="<?= $page_key == 'franchise' ? 'active' : '' ?>">Franchise Opportunity</a></li>
                <li><a href="contact.php" class="<?= $page_key == 'contact' ? 'active' : '' ?>">Locate Us</a></li>
            </ul>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <script>
        // Header scroll effect
        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');
        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            if (navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Prevent dropdown from closing when clicking inside
        document.querySelectorAll('.nav-menu .dropdown').forEach(drop => {
            drop.addEventListener('click', function(e) {
                if(window.innerWidth > 1024) {
                    this.classList.add('active');
                }
            });
            drop.addEventListener('mouseleave', function(e) {
                if(window.innerWidth > 1024) {
                    this.classList.remove('active');
                }
            });
        });

        // Dropdown for mobile
        document.querySelectorAll('.nav-menu .dropdown > a').forEach(el => {
            el.addEventListener('click', function(e) {
                if(window.innerWidth <= 1024) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('active');
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-container')) {
                navMenu.classList.remove('active');
                document.querySelectorAll('.nav-menu .dropdown').forEach(drop => drop.classList.remove('active'));
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
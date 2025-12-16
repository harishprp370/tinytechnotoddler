<?php 
$page_title = "Our Success Partners";
$page_description = "Meet our successful franchise partners across India. Discover their journey and success stories with TinyTechnoToddlers preschool franchise.";
include 'header.php'; 
include '../includes/conn.php';

// Fetch franchises with pagination and filtering
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 9;
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = ["is_active = 1"];
if ($filter !== 'all') {
    $where_conditions[] = "category = '" . mysqli_real_escape_string($conn, $filter) . "'";
}
if (!empty($search)) {
    $search_term = mysqli_real_escape_string($conn, $search);
    $where_conditions[] = "(franchise_name LIKE '%$search_term%' OR city LIKE '%$search_term%' OR state LIKE '%$search_term%' OR contact_person LIKE '%$search_term%')";
}

$where_clause = implode(' AND ', $where_conditions);

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM franchises WHERE $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_franchises = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_franchises / $per_page);

// Fetch franchises
$franchises_query = "
    SELECT f.*, 
           (SELECT image_url FROM franchise_images WHERE franchise_id = f.id AND is_featured = 1 LIMIT 1) as featured_image
    FROM franchises f 
    WHERE $where_clause 
    ORDER BY display_order ASC, is_featured DESC, created_at DESC 
    LIMIT $per_page OFFSET $offset
";
$franchises_result = mysqli_query($conn, $franchises_query);

// Get overall statistics
$stats_query = "
    SELECT 
        COUNT(*) as total_partners,
        COUNT(DISTINCT city) as total_cities,
        AVG(rating) as avg_rating,
        SUM(current_students) as total_students
    FROM franchises 
    WHERE is_active = 1
";
$stats_result = mysqli_query($conn, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);
?>

<style>
/* Partners Hero Section */
.partners-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 100px 0 60px 0;
    position: relative;
    overflow: hidden;
    color: white;
    text-align: center;
}

.partners-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    z-index: 1;
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

.partners-hero h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.5rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
    line-height: 1.2;
}

.partners-hero p {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.partners-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px 20px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    min-width: 150px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    border-color: #FFD700;
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #FFD700;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 40px 20px;
    border-bottom: 1px solid rgba(107, 44, 145, 0.1);
}

.filter-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}

.filter-tabs {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-tab {
    padding: 12px 25px;
    border-radius: 25px;
    background: white;
    color: #6B2C91;
    text-decoration: none;
    font-weight: 600;
    border: 2px solid #6B2C91;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.filter-tab:hover,
.filter-tab.active {
    background: #6B2C91;
    color: white;
    transform: translateY(-2px);
}

.search-box {
    display: flex;
    gap: 0;
    min-width: 300px;
}

.search-box input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #6B2C91;
    border-right: none;
    border-radius: 25px 0 0 25px;
    outline: none;
    font-size: 1rem;
}

.search-box button {
    padding: 12px 20px;
    background: #6B2C91;
    color: white;
    border: none;
    border-radius: 0 25px 25px 0;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
}

.search-box button:hover {
    background: #5B2D8F;
}

/* Partners Grid */
.partners-main {
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.partner-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    overflow: hidden;
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    position: relative;
}

.partner-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
}

.partner-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.partner-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.partner-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.partner-card:hover .partner-image img {
    transform: scale(1.05);
}

.category-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.category-metro { background: #FF6B6B; color: white; }
.category-tier2 { background: #4ECDC4; color: white; }
.category-tier3 { background: #45B7D1; color: white; }
.category-rural { background: #96CEB4; color: white; }

.featured-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    color: #5B2D8F;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 700;
}

.partner-header1 {
    padding: 25px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-bottom: 1px solid rgba(107, 44, 145, 0.1);
}

.partner-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.5rem;
    color: #6B2C91;
    margin-bottom: 8px;
    font-weight: 700;
}

.partner-location {
    color: #8E44AD;
    font-weight: 600;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.partner-content {
    padding: 25px;
}

.partner-owner {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding: 15px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 12px;
}

.owner-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
}

.owner-info h4 {
    color: #6B2C91;
    margin-bottom: 3px;
    font-size: 1.1rem;
}

.owner-info p {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
}

.partner-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #555;
}

.detail-item i {
    color: #FFD700;
    width: 16px;
}

.partner-actions {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-top: 20px;
}

.contact-btn {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(107, 44, 145, 0.3);
}

.view-details-btn {
    background: linear-gradient(135deg, #FFD700, #FFC107);
    color: #5B2D8F;
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
    border: none;
    cursor: pointer;
}

.view-details-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
}

.modal-content {
    background: white;
    margin: 2% auto;
    padding: 0;
    border-radius: 20px;
    width: 90%;
    max-width: 1000px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
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
    padding: 25px;
    border-radius: 20px 20px 0 0;
    position: relative;
}

.modal-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    margin: 0;
    color: #FFD700;
}

.modal-header p {
    margin: 5px 0 0;
    color: rgba(255, 255, 255, 0.9);
}

.close {
    position: absolute;
    right: 25px;
    top: 25px;
    color: white;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.modal-body {
    padding: 30px;
}

.modal-tabs {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    border-bottom: 2px solid #f0f0f0;
}

.modal-tab {
    padding: 10px 20px;
    border: none;
    background: none;
    color: #666;
    font-weight: 600;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.modal-tab.active {
    color: #6B2C91;
    border-bottom-color: #FFD700;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.gallery-image {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    aspect-ratio: 16/9;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 10px;
    font-size: 0.9rem;
}

.programs-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.program-item {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #FFD700;
}

.program-item h4 {
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 10px;
}

.staff-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.staff-item {
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.staff-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Success Stories Section */
.success-stories {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 80px 20px;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.success-stories::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    z-index: 1;
}

.success-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.success-stories h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
    position: relative;
}

.success-stories h2::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFC107);
    border-radius: 2px;
}

.success-stories > p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 50px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    text-align: left;
    position: relative;
    overflow: hidden;
}

.testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFC107);
}

.testimonial-card:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.15);
    border-color: #FFD700;
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
}

.testimonial-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 25px;
    font-style: italic;
    color: rgba(255, 255, 255, 0.9);
    position: relative;
}

.testimonial-text::before {
    content: '"';
    font-size: 4rem;
    color: #FFD700;
    position: absolute;
    top: -20px;
    left: -10px;
    font-family: serif;
    opacity: 0.5;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #5B2D8F;
    font-size: 1.2rem;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    flex-shrink: 0;
}

.author-info h4 {
    color: #FFD700;
    margin-bottom: 5px;
    font-size: 1.1rem;
    font-weight: 600;
    font-family: 'Fredoka', sans-serif;
}

.author-info p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    margin: 0;
}

/* Partners CTA Section */
.partners-cta {
    background: white;
    padding: 80px 20px;
    text-align: center;
    position: relative;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
}

.partners-cta h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 20px;
    font-weight: 700;
    position: relative;
    display: inline-block;
}

.partners-cta h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFC107);
    border-radius: 2px;
}

.partners-cta p {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 40px;
    line-height: 1.6;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-button {
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.cta-primary {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
}

.cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(107, 44, 145, 0.3);
}

.cta-secondary {
    background: white;
    color: #6B2C91;
    border: 2px solid #6B2C91;
}

.cta-secondary:hover {
    background: #6B2C91;
    color: white;
    transform: translateY(-3px);
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
}

.modal-content {
    background: white;
    margin: 2% auto;
    padding: 0;
    border-radius: 20px;
    width: 90%;
    max-width: 1000px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
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
    padding: 25px;
    border-radius: 20px 20px 0 0;
    position: relative;
}

.modal-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    margin: 0;
    color: #FFD700;
}

.modal-header p {
    margin: 5px 0 0;
    color: rgba(255, 255, 255, 0.9);
}

.close {
    position: absolute;
    right: 25px;
    top: 25px;
    color: white;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.modal-body {
    padding: 30px;
}

.modal-tabs {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    border-bottom: 2px solid #f0f0f0;
}

.modal-tab {
    padding: 10px 20px;
    border: none;
    background: none;
    color: #666;
    font-weight: 600;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.modal-tab.active {
    color: #6B2C91;
    border-bottom-color: #FFD700;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.gallery-image {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    aspect-ratio: 16/9;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 10px;
    font-size: 0.9rem;
}

.programs-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.program-item {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #FFD700;
}

.program-item h4 {
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 10px;
}

.staff-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.staff-item {
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.staff-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 40px 0;
}

.pagination a,
.pagination span {
    padding: 10px 15px;
    border: 2px solid #6B2C91;
    color: #6B2C91;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination a:hover,
.pagination .current {
    background: #6B2C91;
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 4rem;
    color: #ccc;
    margin-bottom: 20px;
}

/* Loading State */
.loading-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #6B2C91;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .partners-hero {
        padding: 80px 0 40px 0;
    }
    
    .partners-hero h1 {
        font-size: 2.5rem;
    }
    
    .partners-hero p {
        font-size: 1.1rem;
    }
    
    .partners-stats {
        gap: 20px;
    }
    
    .filter-content {
        flex-direction: column;
        gap: 20px;
    }
    
    .search-box {
        min-width: auto;
        width: 100%;
    }
    
    .partners-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .partner-details {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .modal-content {
        width: 95%;
        margin: 1% auto;
    }
    
    .modal-header {
        padding: 20px;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-tabs {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .image-gallery {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .partners-hero h1 {
        font-size: 2rem;
    }
    
    .filter-tabs {
        justify-content: center;
    }
    
    .filter-tab {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .partner-header1 {
        padding: 20px;
    }
    
    .partner-content {
        padding: 20px;
    }
    
    .partner-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .image-gallery {
        grid-template-columns: 1fr;
    }
}
</style>

<main>
    <section class="partners-hero">
        <div class="hero-content">
            <h1>Our Success Partners</h1>
            <p>
                Meet our incredible franchise partners who are transforming early childhood education across India. Their success stories inspire us and showcase the power of the TinyTechnoToddlers brand.
            </p>
            
            <div class="partners-stats">
                <div class="stat-item">
                    <span class="stat-number"><?php echo $stats['total_partners']; ?>+</span>
                    <span class="stat-label">Active Partners</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo $stats['total_cities']; ?>+</span>
                    <span class="stat-label">Cities Covered</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo number_format($stats['avg_rating'], 1); ?></span>
                    <span class="stat-label">Average Rating</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo number_format($stats['total_students']); ?>+</span>
                    <span class="stat-label">Students Served</span>
                </div>
            </div>
        </div>
    </section>

    <section class="filter-section">
        <div class="filter-content">
            <div class="filter-tabs">
                <a href="?filter=all<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                   class="filter-tab <?php echo $filter === 'all' ? 'active' : ''; ?>">All Partners</a>
                <a href="?filter=metro<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                   class="filter-tab <?php echo $filter === 'metro' ? 'active' : ''; ?>">Metro Cities</a>
                <a href="?filter=tier2<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                   class="filter-tab <?php echo $filter === 'tier2' ? 'active' : ''; ?>">Tier 2 Cities</a>
                <a href="?filter=tier3<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                   class="filter-tab <?php echo $filter === 'tier3' ? 'active' : ''; ?>">Tier 3 Cities</a>
                <a href="?filter=rural<?php echo !empty($search) ? '&search='.urlencode($search) : ''; ?>" 
                   class="filter-tab <?php echo $filter === 'rural' ? 'active' : ''; ?>">Rural Areas</a>
            </div>
            
            <form class="search-box" method="GET">
                <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
                <input type="text" name="search" placeholder="Search by city, name, or state..." 
                       value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="partners-main">
        <div class="partners-grid" id="partnersGrid">
            <?php if (mysqli_num_rows($franchises_result) > 0): ?>
                <?php while ($franchise = mysqli_fetch_assoc($franchises_result)): ?>
                    <div class="partner-card" data-category="<?php echo $franchise['category']; ?>" 
                         data-city="<?php echo strtolower($franchise['city']); ?>">
                        
                        <div class="partner-image">
                            <img src="<?php echo $franchise['featured_image'] ?: 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=600&h=400&fit=crop'; ?>" 
                                 alt="<?php echo htmlspecialchars($franchise['franchise_name']); ?>">
                            
                            <?php if ($franchise['is_featured']): ?>
                                <div class="featured-badge">
                                    <i class="fas fa-star"></i> Featured
                                </div>
                            <?php endif; ?>
                            
                            <div class="category-badge category-<?php echo $franchise['category']; ?>">
                                <?php echo ucfirst($franchise['category']); ?>
                            </div>
                        </div>
                        
                        <div class="partner-header1">
                            <h3 class="partner-title"><?php echo htmlspecialchars($franchise['franchise_name']); ?></h3>
                            <div class="partner-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($franchise['city'] . ', ' . $franchise['state']); ?>
                            </div>
                        </div>
                        
                        <div class="partner-content">
                            <div class="partner-owner">
                                <div class="owner-avatar">
                                    <?php echo strtoupper(substr($franchise['contact_person'], 0, 2)); ?>
                                </div>
                                <div class="owner-info">
                                    <h4><?php echo htmlspecialchars($franchise['contact_person']); ?></h4>
                                    <p>Partner since <?php echo $franchise['established_year']; ?></p>
                                </div>
                            </div>
                            
                            <div class="partner-details">
                                <div class="detail-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo htmlspecialchars($franchise['mobile']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php echo htmlspecialchars($franchise['email']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-users"></i>
                                    <span><?php echo $franchise['current_students']; ?> Students</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-star"></i>
                                    <span><?php echo number_format($franchise['rating'], 1); ?>/5 Rating</span>
                                </div>
                            </div>
                            
                            <div class="partner-actions">
                                <a href="tel:<?php echo $franchise['mobile']; ?>" class="contact-btn">
                                    <i class="fas fa-phone"></i>
                                    Call Now
                                </a>
                                <button class="view-details-btn" onclick="openPartnerModal(<?php echo $franchise['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h3>No partners found</h3>
                    <p>Try adjusting your search criteria or filters.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page-1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <span class="current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page+1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>

    <section class="success-stories">
        <div class="success-content">
            <h2>Success Stories</h2>
            <p>
                Hear directly from our franchise partners about their journey, challenges overcome, and the success they've achieved with TinyTechnoToddlers.
            </p>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        "Joining TinyTechnoToddlers was the best business decision I made. The support team guided us through every step, and within 2 years, we've become the most preferred preschool in our city. ROI exceeded expectations!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">RS</div>
                        <div class="author-info">
                            <h4>Rajesh Sharma</h4>
                            <p>Mumbai Franchise Partner</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        "As a working mother, I wanted to create quality education opportunities in my city. TinyTechnoToddlers provided the perfect platform. The curriculum, training, and ongoing support have been exceptional."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">PM</div>
                        <div class="author-info">
                            <h4>Priya Mehta</h4>
                            <p>Pune Franchise Partner</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        "Starting a preschool seemed daunting, but TinyTechnoToddlers made it achievable. From site selection to curriculum training, their comprehensive support ensured our success from day one."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">AK</div>
                        <div class="author-info">
                            <h4>Amit Kumar</h4>
                            <p>Nashik Franchise Partner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partners-cta">
        <div class="cta-content">
            <h2>Ready to Join Our Success Network?</h2>
            <p>
                Be part of India's most successful preschool franchise network. Start your journey towards educational entrepreneurship with comprehensive support and proven systems.
            </p>
            
            <div class="cta-buttons">
                <a href="interest_form.php" class="cta-button cta-primary">
                    <i class="fas fa-rocket"></i>
                    Start Your Application
                </a>
                <a href="tel:+918000333555" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Talk to Our Team
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Partner Details Modal -->
<div id="partnerModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Partner Details</h2>
            <p id="modalLocation">Location</p>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="modal-tabs">
                <button class="modal-tab active" onclick="showTab('overview')">Overview</button>
                <button class="modal-tab" onclick="showTab('gallery')">Gallery</button>
                <button class="modal-tab" onclick="showTab('programs')">Programs</button>
                <button class="modal-tab" onclick="showTab('staff')">Staff</button>
            </div>
            
            <div id="overview-tab" class="tab-content active">
                <div id="modalOverview">
                    <!-- Content loaded via AJAX -->
                </div>
            </div>
            
            <div id="gallery-tab" class="tab-content">
                <div id="modalGallery" class="image-gallery">
                    <!-- Images loaded via AJAX -->
                </div>
            </div>
            
            <div id="programs-tab" class="tab-content">
                <div id="modalPrograms" class="programs-list">
                    <!-- Programs loaded via AJAX -->
                </div>
            </div>
            
            <div id="staff-tab" class="tab-content">
                <div id="modalStaff" class="staff-list">
                    <!-- Staff loaded via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Modal functionality
function openPartnerModal(partnerId) {
    const modal = document.getElementById('partnerModal');
    modal.style.display = 'block';
    
    // Load partner details via AJAX
    fetch(`get_partner_details.php?id=${partnerId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalTitle').textContent = data.franchise.franchise_name;
                document.getElementById('modalLocation').textContent = `${data.franchise.city}, ${data.franchise.state}`;
                
                // Load overview
                document.getElementById('modalOverview').innerHTML = `
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                        <div>
                            <h4 style="color: #6B2C91; margin-bottom: 15px;">About</h4>
                            <p style="line-height: 1.6;">${data.franchise.about || 'No description available.'}</p>
                            
                            <h4 style="color: #6B2C91; margin: 20px 0 15px;">Contact Information</h4>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <div><strong>Contact Person:</strong> ${data.franchise.contact_person}</div>
                                <div><strong>Mobile:</strong> ${data.franchise.mobile}</div>
                                <div><strong>Email:</strong> ${data.franchise.email}</div>
                                <div><strong>Address:</strong> ${data.franchise.address}</div>
                            </div>
                        </div>
                        <div>
                            <h4 style="color: #6B2C91; margin-bottom: 15px;">Key Metrics</h4>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                                <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #6B2C91;">${data.franchise.current_students}</div>
                                    <div style="color: #666;">Students</div>
                                </div>
                                <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #6B2C91;">${data.franchise.rating}</div>
                                    <div style="color: #666;">Rating</div>
                                </div>
                                <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #6B2C91;">${data.franchise.student_capacity}</div>
                                    <div style="color: #666;">Capacity</div>
                                </div>
                                <div style="background: #f8f9ff; padding: 15px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #6B2C91;">${data.franchise.established_year}</div>
                                    <div style="color: #666;">Since</div>
                                </div>
                            </div>
                            
                            <h4 style="color: #6B2C91; margin: 20px 0 15px;">Features</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                ${data.franchise.features ? data.franchise.features.split(',').map(feature => 
                                    `<span style="background: #e8ebff; color: #6B2C91; padding: 5px 12px; border-radius: 15px; font-size: 0.85rem;">${feature.trim()}</span>`
                                ).join('') : 'No features listed.'}
                            </div>
                        </div>
                    </div>
                `;
                
                // Load gallery
                if (data.images && data.images.length > 0) {
                    document.getElementById('modalGallery').innerHTML = data.images.map(image => `
                        <div class="gallery-image" onclick="openImageViewer('${image.image_url}')">
                            <img src="${image.image_url}" alt="${image.image_title || 'Gallery Image'}" loading="lazy">
                            <div class="image-overlay">
                                <strong>${image.image_title || 'Gallery Image'}</strong>
                                ${image.image_description ? `<br><small>${image.image_description}</small>` : ''}
                            </div>
                        </div>
                    `).join('');
                } else {
                    document.getElementById('modalGallery').innerHTML = '<p>No images available.</p>';
                }
                
                // Load programs
                if (data.programs && data.programs.length > 0) {
                    document.getElementById('modalPrograms').innerHTML = data.programs.map(program => `
                        <div class="program-item">
                            <h4>${program.program_name}</h4>
                            <p><strong>Age Group:</strong> ${program.age_group}</p>
                            <p><strong>Duration:</strong> ${program.duration}</p>
                            <p><strong>Fee Range:</strong> ${program.fee_range}</p>
                            <p>${program.description || ''}</p>
                        </div>
                    `).join('');
                } else {
                    document.getElementById('modalPrograms').innerHTML = '<p>No programs information available.</p>';
                }
                
                // Load staff
                if (data.staff && data.staff.length > 0) {
                    document.getElementById('modalStaff').innerHTML = data.staff.map(staff => `
                        <div class="staff-item">
                            <div class="staff-avatar">${staff.staff_name.substring(0, 2).toUpperCase()}</div>
                            <h4 style="color: #6B2C91; margin-bottom: 5px;">${staff.staff_name}</h4>
                            <p><strong>${staff.designation}</strong></p>
                            <p>${staff.qualification}</p>
                            <p>${staff.experience_years} years experience</p>
                        </div>
                    `).join('');
                } else {
                    document.getElementById('modalStaff').innerHTML = '<p>No staff information available.</p>';
                }
            }
        })
        .catch(error => {
            console.error('Error loading partner details:', error);
            document.getElementById('modalOverview').innerHTML = '<p>Error loading partner details. Please try again.</p>';
        });
}

function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.modal-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-tab').classList.add('active');
    
    // Add active class to selected tab
    event.target.classList.add('active');
}

function openImageViewer(imageUrl) {
    // Create a simple image viewer
    const viewer = document.createElement('div');
    viewer.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
        background: rgba(0,0,0,0.9); z-index: 99999; display: flex; 
        align-items: center; justify-content: center; cursor: pointer;
    `;
    
    const img = document.createElement('img');
    img.src = imageUrl;
    img.style.cssText = 'max-width: 90%; max-height: 90%; border-radius: 10px;';
    
    viewer.appendChild(img);
    viewer.onclick = () => document.body.removeChild(viewer);
    document.body.appendChild(viewer);
}

// Close modal functionality
document.querySelector('.close').onclick = function() {
    document.getElementById('partnerModal').style.display = 'none';
};

window.onclick = function(event) {
    const modal = document.getElementById('partnerModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.partner-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
});
</script>

<?php include 'footer.php'; ?>

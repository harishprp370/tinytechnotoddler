<?php 

include 'includes/conn.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        // Validate required fields
        $required_fields = ['name', 'email', 'subject', 'query_type', 'message'];
        $missing_fields = [];
        
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                $missing_fields[] = $field;
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception('Missing required fields: ' . implode(', ', $missing_fields));
        }
        
        // Email validation
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }
        
        // Use prepared statements for security (OWASP)
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $designation = trim($_POST['designation'] ?? '');
        $subject = trim($_POST['subject']);
        $query_type = trim($_POST['query_type']);
        $message = trim($_POST['message']);
        $city = trim($_POST['city'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $preferred_contact_time = trim($_POST['preferred_contact_time'] ?? 'anytime');
        $contact_method = trim($_POST['contact_method'] ?? 'phone');
        
        // Validate query type
        $allowed_query_types = ['admission', 'franchise', 'general', 'complaint'];
        if (!in_array($query_type, $allowed_query_types)) {
            throw new Exception('Invalid query type');
        }
        
        // Use prepared statement
        $stmt = $conn->prepare("
            INSERT INTO contact_queries (
                name, email, phone, company, designation, subject, query_type, message,
                city, state, preferred_contact_time, contact_method, submitted_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        if (!$stmt) {
            throw new Exception('Database error: ' . $conn->error);
        }
        
        $stmt->bind_param(
            "ssssssssssss",
            $name, $email, $phone, $company, $designation, $subject, 
            $query_type, $message, $city, $state, $preferred_contact_time, $contact_method
        );
        
        if ($stmt->execute()) {
            $query_id = $stmt->insert_id;
            $response['success'] = true;
            $response['message'] = 'Your message has been sent successfully!';
            $response['query_id'] = $query_id;
        } else {
            throw new Exception('Failed to submit query: ' . $stmt->error);
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    // Return JSON response for AJAX calls
    if (isset($_POST['ajax'])) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// Fetch franchise locations for map
$franchises_query = "
    SELECT id, franchise_name, address, city, state, mobile, email, maps_location
    FROM franchises 
    WHERE is_active = 1 
    ORDER BY established_year DESC
    LIMIT 50
";
$franchises_result = mysqli_query($conn, $franchises_query);
$franchises = mysqli_fetch_all($franchises_result, MYSQLI_ASSOC);

// Convert to JSON for JavaScript
$franchises_json = json_encode($franchises);
?>
<?php 
$page_key = 'contact';
include 'includes/header.php'; 
?>

<style>
    /* Contact Hero Section */
    .contact-hero {
        min-height: 380px;
        background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 50%, #9B59B6 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 50px 20px;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        z-index: 1;
    }

    .contact-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 120px;
        background: linear-gradient(180deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
        z-index: 1;
    }

    .contact-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInDown 0.8s ease-out;
    }

    .contact-hero h1 {
        font-family: 'Fredoka', sans-serif;
        font-size: 3.5rem;
        color: #FFD700;
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: 1px;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        line-height: 1.2;
    }

    .contact-hero p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.2rem;
        margin-bottom: 0;
        line-height: 1.8;
        font-weight: 400;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .contact-hero {
            min-height: 300px;
            padding: 80px 20px 40px 20px;
        }

        .contact-hero h1 {
            font-size: 2.5rem;
        }

        .contact-hero p {
            font-size: 1rem;
        }
    }

    /* Main Contact Section */
    .contact-main {
        padding: 80px 20px 60px 20px;
        background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }

    .contact-info-box {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(107, 44, 145, 0.1);
        border: 2px solid #f0f0f0;
        transition: all 0.3s ease;
        animation: slideInLeft 0.8s ease-out;
    }

    .contact-info-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(107, 44, 145, 0.15);
        border-color: #FFD700;
    }

    .contact-info-box h2 {
        font-family: 'Fredoka', sans-serif;
        color: #6B2C91;
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .contact-info-box h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFC107);
        border-radius: 2px;
    }

    .contact-info-item {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .contact-info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .contact-info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6B2C91, #8E44AD);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFD700;
        font-size: 1.3rem;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(107, 44, 145, 0.2);
    }

    .contact-info-content h3 {
        color: #6B2C91;
        margin-bottom: 8px;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .contact-info-content p {
        color: #555;
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .contact-info-content a {
        color: #6B2C91;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-info-content a:hover {
        color: #FFD700;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Contact Form */
    .contact-form-box {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(107, 44, 145, 0.1);
        border: 2px solid #f0f0f0;
        animation: slideInRight 0.8s ease-out;
    }

    .contact-form-box h2 {
        font-family: 'Fredoka', sans-serif;
        color: #6B2C91;
        margin-bottom: 10px;
        font-size: 2rem;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .contact-form-box h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #FFD700, #FFC107);
        border-radius: 2px;
    }

    .form-description {
        color: #777;
        font-size: 0.95rem;
        margin-bottom: 30px;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    .form-group label {
        margin-bottom: 10px;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .required {
        color: #FF6B6B;
        font-weight: 700;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        padding: 14px 16px;
        border: 2px solid #E8D7FF;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #333;
        background: #f9f9ff;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #6B2C91;
        outline: none;
        background: white;
        box-shadow: 0 0 0 3px rgba(107, 44, 145, 0.1);
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-group select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B2C91' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }

    .submit-btn {
        background: linear-gradient(135deg, #6B2C91, #8E44AD);
        color: white;
        padding: 14px 32px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
        width: 100%;
    }

    .submit-btn:hover:not(:disabled) {
        background: linear-gradient(135deg, #8E44AD, #9B59B6);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 44, 145, 0.4);
    }

    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .loading-spinner {
        width: 16px;
        height: 16px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .success-message,
    .error-message {
        display: none;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 0.95rem;
        border-left: 4px solid;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-message {
        background: #E8F5E9;
        color: #2E7D32;
        border-left-color: #4CAF50;
    }

    .error-message {
        background: #FFEBEE;
        color: #C62828;
        border-left-color: #F44336;
    }

    .message-icon {
        margin-right: 10px;
    }

    /* Locations Section */
    .locations-section {
        padding: 80px 20px 60px 20px;
        background: white;
    }

    .section-header {
        max-width: 1200px;
        margin: 0 auto 60px;
        text-align: center;
    }

    .section-header h2 {
        font-family: 'Fredoka', sans-serif;
        font-size: 2.8rem;
        color: #6B2C91;
        margin-bottom: 20px;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .section-header h2::after {
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

    .section-header p {
        color: #666;
        font-size: 1.1rem;
        margin-top: 30px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Map Container */
    .map-container {
        max-width: 1200px;
        margin: 0 auto 60px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(107, 44, 145, 0.15);
        height: 500px;
        background: #f0f0f0;
        position: relative;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .map-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        text-align: center;
    }

    .map-loading .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #6B2C91;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    /* Locations Grid */
    .locations-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .locations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 30px;
    }

    .location-card {
        background: white;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(107, 44, 145, 0.08);
        border: 2px solid #f8f9ff;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .location-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #6B2C91, #FFD700);
    }

    .location-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(107, 44, 145, 0.15);
        border-color: #FFD700;
    }

    .location-header {
        margin-bottom: 20px;
    }

    .location-name {
        font-family: 'Fredoka', sans-serif;
        font-size: 1.5rem;
        color: #6B2C91;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .location-category {
        display: inline-block;
        background: linear-gradient(135deg, #6B2C91, #8E44AD);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .location-details {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        background: #f0f0ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6B2C91;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .detail-content h4 {
        color: #333;
        margin-bottom: 4px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .detail-content p {
        color: #666;
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .detail-content a {
        color: #6B2C91;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .detail-content a:hover {
        color: #FFD700;
    }

    .location-actions {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        gap: 10px;
    }

    .action-btn {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }

    .action-btn.call-btn {
        background: linear-gradient(135deg, #6B2C91, #8E44AD);
        color: white;
    }

    .action-btn.call-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(107, 44, 145, 0.3);
    }

    .action-btn.map-btn {
        background: #f0f0ff;
        color: #6B2C91;
        border: 2px solid #E8D7FF;
    }

    .action-btn.map-btn:hover {
        background: #6B2C91;
        color: white;
        border-color: #6B2C91;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .contact-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .locations-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .contact-info-box,
        .contact-form-box {
            padding: 30px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full-width {
            grid-column: span 1;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .locations-grid {
            grid-template-columns: 1fr;
        }

        .map-container {
            height: 400px;
            margin-bottom: 40px;
        }

        .contact-hero h1 {
            font-size: 2rem;
        }

        .contact-hero p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .contact-main {
            padding: 60px 15px 40px 15px;
        }

        .contact-info-box,
        .contact-form-box {
            padding: 25px;
        }

        .section-header h2 {
            font-size: 1.8rem;
        }

        .location-actions {
            flex-direction: column;
        }

        .action-btn {
            padding: 12px;
        }
    }
</style>

<main>
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Get In Touch With Us</h1>
            <p>
                Have questions about admissions, franchise opportunities, or need more information? 
                Our dedicated team is ready to help you. Reach out to us through any of the channels below.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-main">
        <div class="contact-container">
            <!-- Contact Information -->
            <div class="contact-info-box">
                <h2>Contact Information</h2>
                
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Visit Us</h3>
                        <p>#102 above, Kai Ruchi Hotel, 3rd floor<br>Konanakunte Main Road<br>Bengaluru, Karnataka 560062</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Call Us</h3>
                        <p><a href="tel:+919739561697">+91 9739561697</a><br><a href="tel:+919739561245">+91 9739561245</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Email Us</h3>
                        <p><a href="mailto:info@tinytechnotoddlers.com">info@tinytechnotoddlers.com</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3>Business Hours</h3>
                        <p>Monday - Saturday: 9:00 AM - 5:00 PM<br>Sunday: Closed</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-box">
                <h2>Send us a Message</h2>
                <p class="form-description">Fill out the form below and we'll get back to you within 24 hours</p>

                <form id="contactForm" method="POST" novalidate>
                    <input type="hidden" name="ajax" value="1">
                    
                    <div class="success-message" id="successMessage">
                        <span class="message-icon"><i class="fas fa-check-circle"></i></span>
                        <span id="successText"></span>
                    </div>
                    <div class="error-message" id="errorMessage">
                        <span class="message-icon"><i class="fas fa-exclamation-triangle"></i></span>
                        <span id="errorText"></span>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email address" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" maxlength="20">
                        </div>

                        <div class="form-group">
                            <label for="company">Company/School Name</label>
                            <input type="text" id="company" name="company" placeholder="Enter your organization name" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="designation">Designation/Position</label>
                            <input type="text" id="designation" name="designation" placeholder="Enter your job title" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter your city" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" placeholder="Enter your state" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="query_type">Query Type <span class="required">*</span></label>
                            <select id="query_type" name="query_type" required>
                                <option value="">-- Select a Query Type --</option>
                                <option value="admission">Admission Inquiry</option>
                                <option value="franchise">Franchise Opportunity</option>
                                <option value="general">General Inquiry</option>
                                <option value="complaint">Complaint/Feedback</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="subject">Subject <span class="required">*</span></label>
                            <input type="text" id="subject" name="subject" required placeholder="Enter message subject" maxlength="150">
                        </div>

                        <div class="form-group full-width">
                            <label for="message">Your Message <span class="required">*</span></label>
                            <textarea id="message" name="message" required placeholder="Please describe your inquiry in detail..." maxlength="2000"></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="preferred_contact_time">Preferred Contact Time</label>
                            <select id="preferred_contact_time" name="preferred_contact_time">
                                <option value="anytime">Anytime</option>
                                <option value="morning">Morning (9 AM - 12 PM)</option>
                                <option value="afternoon">Afternoon (12 PM - 3 PM)</option>
                                <option value="evening">Evening (3 PM - 5 PM)</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="contact_method">Preferred Contact Method</label>
                            <select id="contact_method" name="contact_method">
                                <option value="phone">Phone Call</option>
                                <option value="email">Email</option>
                                <option value="whatsapp">WhatsApp</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Google Map Section - Main Branch -->
    <section class="locations-section">
        <div class="section-header">
            <h2>Our Main Office Location</h2>
            <p>Visit our headquarters in Bengaluru. Find us on the map below.</p>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.8155548070374!2d77.59380772346897!3d12.923567987346598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3d8c8f8f8f8f%3A0x0!2sTinyTechnoToddlers!5e0!3m2!1sen!2sin!4v1234567890" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Franchise Locations Grid -->
    <section class="locations-section" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%); padding-top: 40px;">
        <div class="locations-content">
            <div class="section-header" style="margin-bottom: 40px;">
                <h2>Our Franchise Locations</h2>
                <p>Visit any of our franchise centers across India. Find the nearest TinyTechnoToddlers location to you.</p>
            </div>
            
            <div class="locations-grid" id="locationsGrid">
                <!-- Locations loaded dynamically -->
            </div>
        </div>
    </section>
</main>

<script>
// Load locations grid
document.addEventListener('DOMContentLoaded', function() {
    const locationsGrid = document.getElementById('locationsGrid');
    const franchises = <?php echo $franchises_json; ?>;
    
    if (franchises && franchises.length > 0) {
        locationsGrid.innerHTML = franchises.map(franchise => `
            <div class="location-card">
                <div class="location-header">
                    <h3 class="location-name">${franchise.franchise_name}</h3>
                    <span class="location-category">
                        <i class="fas fa-star"></i> Active Partner
                    </span>
                </div>
                
                <div class="location-details">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Address</h4>
                            <p>${franchise.address}</p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Phone</h4>
                            <p><a href="tel:${franchise.mobile}">${franchise.mobile}</a></p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Email</h4>
                            <p><a href="mailto:${franchise.email}">${franchise.email}</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="location-actions">
                    <a href="tel:${franchise.mobile}" class="action-btn call-btn">
                        <i class="fas fa-phone"></i>
                        Call Now
                    </a>
                    <a href="${franchise.maps_location || '#'}" target="_blank" rel="noopener noreferrer" class="action-btn map-btn">
                        <i class="fas fa-directions"></i>
                        Directions
                    </a>
                </div>
            </div>
        `).join('');
    } else {
        locationsGrid.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-map-marker-alt"></i>
                <h3>No locations found</h3>
                <p>Please check back soon for updates on new centers.</p>
            </div>
        `;
    }
});

// Contact Form Handling
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('.submit-btn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    // Reset messages
    successMessage.style.display = 'none';
    errorMessage.style.display = 'none';
    
    // Validate form
    if (!this.checkValidity()) {
        errorMessage.style.display = 'block';
        document.getElementById('errorText').textContent = 'Please fill in all required fields correctly.';
        return;
    }
    
    // Show loading state
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Sending...';
    submitBtn.disabled = true;
    
    // Get form data
    const formData = new FormData(this);
    
    // Send AJAX request
    fetch('contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            successMessage.style.display = 'block';
            document.getElementById('successText').innerHTML = `
                <strong>Message Sent Successfully!</strong><br>
                Your query ID: <strong>#${data.query_id}</strong><br>
                We'll get back to you within 24 hours.
            `;
            this.reset();
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            errorMessage.style.display = 'block';
            document.getElementById('errorText').innerHTML = `
                <strong>Error:</strong> ${data.message}
            `;
            errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    })
    .catch(error => {
        errorMessage.style.display = 'block';
        document.getElementById('errorText').innerHTML = `
            <strong>Error:</strong> Something went wrong. Please try again later.
        `;
        console.error('Error:', error);
    })
    .finally(() => {
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
    });
});

// Phone number formatting
document.getElementById('phone').addEventListener('input', function() {
    this.value = this.value.replace(/[^\d]/g, '').slice(0, 10);
});
</script>

<?php include 'includes/footer.php'; ?>

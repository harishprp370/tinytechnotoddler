<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/conn.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        // Validate required fields
        $required_fields = ['child_name', 'parent_name', 'email', 'phone', 'program'];
        $missing_fields = [];
        
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                $missing_fields[] = $field;
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception('Missing required fields: ' . implode(', ', $missing_fields));
        }
        
        // Sanitize and prepare data
        $child_name = mysqli_real_escape_string($conn, trim($_POST['child_name']));
        $child_age = mysqli_real_escape_string($conn, trim($_POST['child_age'] ?? ''));
        $parent_name = mysqli_real_escape_string($conn, trim($_POST['parent_name']));
        $relationship = mysqli_real_escape_string($conn, trim($_POST['relationship'] ?? 'father'));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
        $alternate_phone = mysqli_real_escape_string($conn, trim($_POST['alternate_phone'] ?? ''));
        $address = mysqli_real_escape_string($conn, trim($_POST['address'] ?? ''));
        $city = mysqli_real_escape_string($conn, trim($_POST['city'] ?? ''));
        $state = mysqli_real_escape_string($conn, trim($_POST['state'] ?? ''));
        $pincode = mysqli_real_escape_string($conn, trim($_POST['pincode'] ?? ''));
        $program = mysqli_real_escape_string($conn, trim($_POST['program']));
        $preferred_location = mysqli_real_escape_string($conn, trim($_POST['preferred_location'] ?? ''));
        $session = mysqli_real_escape_string($conn, trim($_POST['session'] ?? '2024-25'));
        $previous_school = mysqli_real_escape_string($conn, trim($_POST['previous_school'] ?? ''));
        $special_needs = mysqli_real_escape_string($conn, trim($_POST['special_needs'] ?? ''));
        $medical_conditions = mysqli_real_escape_string($conn, trim($_POST['medical_conditions'] ?? ''));
        $allergies = mysqli_real_escape_string($conn, trim($_POST['allergies'] ?? ''));
        $emergency_contact_name = mysqli_real_escape_string($conn, trim($_POST['emergency_contact_name'] ?? ''));
        $emergency_contact_phone = mysqli_real_escape_string($conn, trim($_POST['emergency_contact_phone'] ?? ''));
        $emergency_contact_relationship = mysqli_real_escape_string($conn, trim($_POST['emergency_contact_relationship'] ?? ''));
        
        // Boolean fields
        $transport_required = isset($_POST['transport_required']) ? 1 : 0;
        $lunch_required = isset($_POST['lunch_required']) ? 1 : 0;
        $extended_care_required = isset($_POST['extended_care_required']) ? 1 : 0;
        
        // Insert into database
        $insert_query = "
            INSERT INTO admissions (
                child_name, child_age, parent_name, relationship, email, phone, alternate_phone,
                address, city, state, pincode, program, preferred_location, session,
                previous_school, special_needs, medical_conditions, allergies,
                emergency_contact_name, emergency_contact_phone, emergency_contact_relationship,
                transport_required, lunch_required, extended_care_required, submitted_at
            ) VALUES (
                '$child_name', '$child_age', '$parent_name', '$relationship', '$email', '$phone', '$alternate_phone',
                '$address', '$city', '$state', '$pincode', '$program', '$preferred_location', '$session',
                '$previous_school', '$special_needs', '$medical_conditions', '$allergies',
                '$emergency_contact_name', '$emergency_contact_phone', '$emergency_contact_relationship',
                $transport_required, $lunch_required, $extended_care_required, NOW()
            )
        ";
        
        if (mysqli_query($conn, $insert_query)) {
            $application_id = mysqli_insert_id($conn);
            $response['success'] = true;
            $response['message'] = 'Application submitted successfully!';
            $response['application_id'] = $application_id;
            
            // Send email notification (you can implement this)
            // mail('admissions@tinytechnotoddlers.com', 'New Admission Application', $email_content);
        } else {
            throw new Exception('Database error: ' . mysqli_error($conn));
        }
        
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
?>
<?php
$page_key = 'admissions';
include 'includes/header.php'; 
?>

<style>
.admissions-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 120px 0 80px 0;
    position: relative;
    overflow: hidden;
    color: white;
    margin-top: 0;
}

.admissions-hero::before {
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
    text-align: center;
}

.admissions-hero h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.5rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.admissions-hero p {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.admissions-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    min-width: 150px;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #FFD700;
    font-family: 'Fredoka', sans-serif;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 5px;
}

.admission-main {
    padding: 80px 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    min-height: 100vh;
}

.admission-container {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(107, 44, 145, 0.1);
    overflow: hidden;
    border: 2px solid rgba(255, 215, 0, 0.2);
}

.form-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 40px;
    text-align: center;
}

.form-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    margin-bottom: 10px;
    color: #FFD700;
}

.form-header p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    font-size: 1.1rem;
}

.form-content {
    padding: 50px;
}

.form-section {
    margin-bottom: 40px;
}

.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.5rem;
    color: #6B2C91;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #FFD700;
}

.section-title i {
    color: #FFD700;
    font-size: 1.2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    color: #6B2C91;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.required {
    color: #FF4757;
    font-size: 1.1rem;
    margin-left: 3px;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 15px;
    border: 2px solid #e8ebff;
    border-radius: 10px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #f8f9ff;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #FFD700;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin: 20px 0;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #f8f9ff;
    border-radius: 10px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.checkbox-item:hover {
    border-color: #FFD700;
    background: white;
}

.checkbox-item input[type="checkbox"] {
    transform: scale(1.2);
    accent-color: #6B2C91;
}

.checkbox-label {
    color: #555;
    font-weight: 500;
}

.submit-section {
    text-align: center;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.submit-btn {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    border: none;
    padding: 18px 50px;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    min-width: 250px;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.3);
    background: linear-gradient(135deg, #5B2D8F, #7B3FA0);
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.success-message, .error-message {
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    text-align: center;
    display: none;
}

.success-message {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.error-message {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.form-note {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    padding: 20px;
    border-radius: 10px;
    color: #856404;
    margin: 30px 0;
    text-align: center;
    font-size: 0.95rem;
}

.loading-spinner {
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .admissions-hero {
        padding: 100px 0 60px 0;
    }
    
    .admissions-hero h1 {
        font-size: 2.5rem;
    }
    
    .admissions-stats {
        gap: 20px;
    }
    
    .form-content {
        padding: 30px 25px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-header {
        padding: 30px 25px;
    }
    
    .submit-btn {
        width: 100%;
        padding: 15px;
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .admissions-hero h1 {
        font-size: 2rem;
    }
    
    .admission-main {
        padding: 60px 15px;
    }
    
    .admission-container {
        margin: 0 10px;
    }
    
    .form-content {
        padding: 25px 20px;
    }
}
</style>

<main>
    <section class="admissions-hero">
        <div class="hero-content">
            <h1>Admissions Open</h1>
            <p>
                Secure your child's future with quality preschool education. Join thousands of families who have chosen TinyTechnoToddlers for their child's first learning experience.
            </p>
            
            <!-- <div class="admissions-stats">
                <div class="stat-item">
                    <span class="stat-number">2000+</span>
                    <span class="stat-label">Centers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1.5M+</span>
                    <span class="stat-label">Children Educated</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">Parent Satisfaction</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">20+</span>
                    <span class="stat-label">Years Experience</span>
                </div>
            </div> -->
        </div>
    </section>

    <section class="admission-main">
        <div class="admission-container">
            <div class="form-header">
                <h2>Admission Application Form</h2>
                <p>Fill out the form below to apply for admission to TinyTechnoToddlers</p>
            </div>

            <div class="form-content">
                <form id="admissionForm" method="POST">
                    <input type="hidden" name="ajax" value="1">
                    
                    <div class="success-message" id="successMessage"></div>
                    <div class="error-message" id="errorMessage"></div>
                    
                    <!-- Child Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-child"></i>
                            Child Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="child_name">Child's Full Name <span class="required">*</span></label>
                                <input type="text" id="child_name" name="child_name" required placeholder="Enter child's complete name">
                            </div>
                            <div class="form-group">
                                <label for="child_age">Child's Age <span class="required">*</span></label>
                                <select id="child_age" name="child_age" required>
                                    <option value="">Select Age</option>
                                    <option value="2 years">2 Years</option>
                                    <option value="2.5 years">2.5 Years</option>
                                    <option value="3 years">3 Years</option>
                                    <option value="3.5 years">3.5 Years</option>
                                    <option value="4 years">4 Years</option>
                                    <option value="4.5 years">4.5 Years</option>
                                    <option value="5 years">5 Years</option>
                                    <option value="5.5 years">5.5 Years</option>
                                    <option value="6 years">6 Years</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="program">Program <span class="required">*</span></label>
                                <select id="program" name="program" required>
                                    <option value="">Select Program</option>
                                    <option value="PlayGroup">PlayGroup (2-3 Years)</option>
                                    <option value="Nursery">Nursery (3-4 Years)</option>
                                    <option value="Junior KG">Junior KG (4-5 Years)</option>
                                    <option value="Senior KG">Senior KG (5-6 Years)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="session">Academic Session</label>
                                <select id="session" name="session">
                                    <option value="2025-26">2026-27</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-users"></i>
                            Parent/Guardian Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="parent_name">Parent/Guardian Name <span class="required">*</span></label>
                                <input type="text" id="parent_name" name="parent_name" required placeholder="Enter parent/guardian full name">
                            </div>
                            <div class="form-group">
                                <label for="relationship">Relationship with Child</label>
                                <select id="relationship" name="relationship">
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" required placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Primary Phone <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" required placeholder="Enter primary phone number">
                            </div>
                            <div class="form-group">
                                <label for="alternate_phone">Alternate Phone</label>
                                <input type="tel" id="alternate_phone" name="alternate_phone" placeholder="Enter alternate phone number">
                            </div>
                            <div class="form-group">
                                <label for="preferred_location">Preferred Center Location</label>
                                <input type="text" id="preferred_location" name="preferred_location" placeholder="Enter preferred center location">
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Address Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="address">Full Address</label>
                                <textarea id="address" name="address" rows="3" placeholder="Enter complete residential address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" placeholder="Enter city">
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state">
                                    <option value="">Select State</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pincode">PIN Code</label>
                                <input type="text" id="pincode" name="pincode" placeholder="Enter PIN code" pattern="[0-9]{6}">
                            </div>
                        </div>
                    </div>

                    <!-- Previous School & Special Requirements -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-clipboard-list"></i>
                            Additional Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="previous_school">Previous School (if any)</label>
                                <input type="text" id="previous_school" name="previous_school" placeholder="Enter previous school name">
                            </div>
                            <div class="form-group">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text" id="emergency_contact_name" name="emergency_contact_name" placeholder="Enter emergency contact name">
                            </div>
                            <div class="form-group">
                                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" placeholder="Enter emergency contact phone">
                            </div>
                            <div class="form-group">
                                <label for="emergency_contact_relationship">Emergency Contact Relationship</label>
                                <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" placeholder="e.g., Grandparent, Uncle, etc.">
                            </div>
                            <div class="form-group full-width">
                                <label for="special_needs">Special Needs/Requirements</label>
                                <textarea id="special_needs" name="special_needs" rows="2" placeholder="Please mention any special needs or learning requirements"></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="medical_conditions">Medical Conditions</label>
                                <textarea id="medical_conditions" name="medical_conditions" rows="2" placeholder="Please mention any medical conditions we should be aware of"></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="allergies">Allergies</label>
                                <textarea id="allergies" name="allergies" rows="2" placeholder="Please mention any food or other allergies"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Services -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-concierge-bell"></i>
                            Additional Services Required
                        </h3>
                        
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="transport_required" name="transport_required" value="1">
                                <label for="transport_required" class="checkbox-label">
                                    Transport Service Required
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="lunch_required" name="lunch_required" value="1">
                                <label for="lunch_required" class="checkbox-label">
                                    School Lunch Service Required
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="extended_care_required" name="extended_care_required" value="1">
                                <label for="extended_care_required" class="checkbox-label">
                                    Extended Day Care Required
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-note">
                        <i class="fas fa-info-circle"></i>
                        <strong>Note:</strong> All information provided will be kept confidential. Our admissions team will contact you within 24-48 hours to schedule a center visit and discuss the enrollment process.
                    </div>
                </form>
            </div>

            <div class="submit-section">
                <button type="submit" form="admissionForm" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Application
                </button>
                
                <p style="margin-top: 20px; color: #666; font-size: 0.9rem;">
                    Need help? Call our admissions helpline: <a href="tel:+918000333555" style="color: #6B2C91; font-weight: 600;">+91 8000 333 555</a>
                </p>
            </div>
        </div>
    </section>
</main>

<script>
document.getElementById('admissionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    // Hide previous messages
    successMessage.style.display = 'none';
    errorMessage.style.display = 'none';
    
    // Show loading state
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Submitting...';
    submitBtn.disabled = true;
    
    // Get form data
    const formData = new FormData(this);
    formData.append('ajax', '1');
    
    // Send AJAX request
    fetch('admissions.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            successMessage.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <strong>Application Submitted Successfully!</strong><br>
                Your application ID is: <strong>#${data.application_id}</strong><br>
                Our admissions team will contact you within 24-48 hours.
            `;
            successMessage.style.display = 'block';
            
            // Reset form
            this.reset();
            
            // Scroll to success message
            successMessage.scrollIntoView({ behavior: 'smooth' });
        } else {
            errorMessage.innerHTML = `
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Error:</strong> ${data.message}
            `;
            errorMessage.style.display = 'block';
            errorMessage.scrollIntoView({ behavior: 'smooth' });
        }
    })
    .catch(error => {
        errorMessage.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error:</strong> Something went wrong. Please try again.
        `;
        errorMessage.style.display = 'block';
        console.error('Error:', error);
    })
    .finally(() => {
        // Reset button
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
    });
});

// Auto-update program based on age
document.getElementById('child_age').addEventListener('change', function() {
    const age = parseFloat(this.value);
    const programSelect = document.getElementById('program');
    
    if (age >= 2 && age < 3) {
        programSelect.value = 'PlayGroup';
    } else if (age >= 3 && age < 4) {
        programSelect.value = 'Nursery';
    } else if (age >= 4 && age < 5) {
        programSelect.value = 'Junior KG';
    } else if (age >= 5 && age <= 6) {
        programSelect.value = 'Senior KG';
    }
});

// Phone number validation
document.querySelectorAll('input[type="tel"]').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
});

// PIN code validation
document.getElementById('pincode').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 6) {
        this.value = this.value.slice(0, 6);
    }
});
</script>

<?php include 'includes/footer.php'; ?>

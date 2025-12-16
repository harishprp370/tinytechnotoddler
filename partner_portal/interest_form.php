<?php 
$page_title = "Franchise Application";
$page_description = "Apply for TinyTechnoToddlers franchise opportunity. Start your journey in early childhood education with India's leading preschool brand.";
include 'header.php'; 
?>

<style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Application Hero Section */
.application-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 80px 0 60px 0;
    position: relative;
    overflow: hidden;
    color: white;
}

.application-hero::before {
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
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
    text-align: center;
}

.application-hero h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.2rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.application-hero p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    line-height: 1.6;
}

.progress-steps {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.step-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.1);
    padding: 12px 20px;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 215, 0, 0.3);
    min-width: 140px;
    justify-content: center;
}

.step-number {
    width: 25px;
    height: 25px;
    background: #FFD700;
    color: #5B2D8F;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
}

.step-text {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    font-size: 0.9rem;
}

/* Main Form Section */
.form-main {
    padding: 60px 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    min-height: 100vh;
}

.form-container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(107, 44, 145, 0.1);
    overflow: hidden;
    border: 1px solid rgba(255, 215, 0, 0.2);
}

.form-header {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 30px;
    text-align: center;
}

.form-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    margin-bottom: 10px;
}

.form-header p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
}

.form-content {
    padding: 40px;
}

.form-section {
    margin-bottom: 40px;
}

.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #6B2C91;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #FFD700;
    text-align: left;
}

.section-title i {
    color: #FFD700;
    font-size: 1.2rem;
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
    text-align: left;
}

.form-group label {
    color: #6B2C91;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 5px;
    text-align: left;
}

.required {
    color: #FF4757;
    font-size: 1.2rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 15px;
    border: 2px solid #e8ebff;
    border-radius: 10px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #f8f9ff;
    text-align: left;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #FFD700;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
}

.form-group input.error,
.form-group select.error {
    border-color: #FF4757;
    background: #fff5f5;
}

.error-message {
    color: #FF4757;
    font-size: 0.85rem;
    margin-top: 5px;
    display: none;
    text-align: left;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 10px;
}

.checkbox-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 15px;
    background: #f8f9ff;
    border-radius: 10px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    text-align: left;
}

.checkbox-item:hover {
    border-color: #FFD700;
    background: white;
}

.checkbox-item input[type="checkbox"] {
    margin: 0;
    transform: scale(1.2);
    accent-color: #6B2C91;
    margin-top: 3px;
}

.checkbox-label {
    color: #555;
    line-height: 1.5;
    text-align: left;
}

.checkbox-label strong {
    color: #6B2C91;
}

.file-upload {
    position: relative;
    display: inline-block;
    cursor: pointer;
    width: 100%;
}

.file-upload input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 20px;
    border: 2px dashed #6B2C91;
    border-radius: 10px;
    background: #f8f9ff;
    color: #6B2C91;
    font-weight: 600;
    transition: all 0.3s ease;
    min-height: 60px;
}

.file-upload:hover .file-upload-label {
    background: white;
    border-color: #FFD700;
    color: #FFD700;
}

.file-list {
    margin-top: 10px;
    font-size: 0.9rem;
    color: #666;
    text-align: left;
}

/* Investment Calculator */
.investment-calculator {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 25px;
    border-radius: 15px;
    margin: 20px 0;
}

.calculator-header {
    text-align: center;
    margin-bottom: 20px;
}

.calculator-header h4 {
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 10px;
}

.investment-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 20px 0;
}

.investment-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.investment-card:hover,
.investment-card.selected {
    border-color: #FFD700;
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
}

.investment-card h5 {
    color: #6B2C91;
    font-weight: 700;
    margin-bottom: 5px;
}

.investment-card .amount {
    color: #FFD700;
    font-weight: 700;
    font-size: 1.2rem;
    font-family: 'Fredoka', sans-serif;
}

.investment-card .details {
    font-size: 0.85rem;
    color: #666;
    margin-top: 5px;
}

/* Submit Section */
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
    padding: 15px 40px;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    min-width: 200px;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(107, 44, 145, 0.3);
    background: linear-gradient(135deg, #5B2D8F, #7B3FA0);
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
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

.form-note {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    padding: 15px;
    border-radius: 10px;
    margin: 20px 0;
    color: #856404;
    font-size: 0.9rem;
    text-align: center;
}

.success-message {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    padding: 20px;
    border-radius: 10px;
    color: #155724;
    text-align: center;
    margin: 20px 0;
    display: none;
}

/* Fixed text alignment */
.form-content * {
    text-align: left;
}

.form-content .section-title,
.form-content .calculator-header,
.form-content .submit-section,
.form-content .form-note,
.form-content .success-message,
.form-content .investment-card {
    text-align: center;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .application-hero {
        padding: 60px 0 40px 0;
    }
    
    .application-hero h1 {
        font-size: 2.2rem;
    }
    
    .progress-steps {
        gap: 10px;
    }
    
    .step-item {
        min-width: auto;
        padding: 8px 15px;
    }
    
    .form-container {
        margin: 0 10px;
    }
    
    .form-content {
        padding: 25px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .investment-options {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .submit-btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .application-hero h1 {
        font-size: 1.8rem;
    }
    
    .form-header {
        padding: 20px;
    }
    
    .form-content {
        padding: 20px;
    }
    
    .progress-steps {
        flex-direction: column;
        align-items: center;
    }
    
    .step-item {
        width: 100%;
        max-width: 200px;
    }
}
</style>

<main>
    <section class="application-hero">
        <div class="hero-content">
            <h1>Apply for Franchise</h1>
            <p>
                Take the first step towards becoming a successful education entrepreneur. Fill out our comprehensive application form and our team will guide you through the next steps.
            </p>
            
            <div class="progress-steps">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-text">Application</div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-text">Review</div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-text">Interview</div>
                </div>
                <div class="step-item">
                    <div class="step-number">4</div>
                    <div class="step-text">Launch</div>
                </div>
            </div>
        </div>
    </section>

    <section class="form-main">
        <div class="form-container">
            <div class="form-header">
                <h2>Franchise Application Form</h2>
                <p>Please provide accurate information for faster processing</p>
            </div>

            <div class="form-content">
                <form id="franchiseApplicationForm" novalidate>
                    <!-- Personal Information -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Personal Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="firstName">First Name <span class="required">*</span></label>
                                <input type="text" id="firstName" name="firstName" required>
                                <div class="error-message">Please enter your first name</div>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name <span class="required">*</span></label>
                                <input type="text" id="lastName" name="lastName" required>
                                <div class="error-message">Please enter your last name</div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" required>
                                <div class="error-message">Please enter a valid email address</div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Mobile Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
                                <div class="error-message">Please enter a valid 10-digit mobile number</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Preference -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Location Preference
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="state">Preferred State <span class="required">*</span></label>
                                <select id="state" name="state" required>
                                    <option value="">Select State</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="karnataka">Karnataka</option>
                                    <option value="delhi">Delhi</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="punjab">Punjab</option>
                                    <option value="haryana">Haryana</option>
                                    <option value="up">Uttar Pradesh</option>
                                    <option value="other">Other</option>
                                </select>
                                <div class="error-message">Please select your preferred state</div>
                            </div>
                            <div class="form-group">
                                <label for="city">Preferred City <span class="required">*</span></label>
                                <input type="text" id="city" name="city" placeholder="Enter city name" required>
                                <div class="error-message">Please enter your preferred city</div>
                            </div>
                        </div>
                    </div>

                    <!-- Investment & Business -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-chart-line"></i>
                            Investment & Business Details
                        </h3>
                        
                        <div class="investment-calculator">
                            <div class="calculator-header">
                                <h4>Choose Your Investment Model</h4>
                                <p style="color: #666; margin: 0;">Select the franchise model that suits your investment capacity</p>
                            </div>
                            
                            <div class="investment-options">
                                <div class="investment-card" data-value="micro">
                                    <h5>Micro Center</h5>
                                    <div class="amount">₹1 Lakhs</div>
                                    <div class="details">600-1000 sq ft<br>50-80 children</div>
                                </div>
                                <div class="investment-card" data-value="standard">
                                    <h5>Standard Center</h5>
                                    <div class="amount">₹3 Lakhs</div>
                                    <div class="details">1000-1500 sq ft<br>80-120 children</div>
                                </div>
                                <div class="investment-card" data-value="premium">
                                    <h5>Premium Center</h5>
                                    <div class="amount">₹5 Lakhs</div>
                                    <div class="details">1500+ sq ft<br>120+ children</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="investmentBudget">Total Investment Budget <span class="required">*</span></label>
                                <select id="investmentBudget" name="investmentBudget" required>
                                    <option value="">Select Investment Range</option>
                                    <option value="8-15">₹8-15 Lakhs</option>
                                    <option value="15-25">₹15-25 Lakhs</option>
                                    <option value="25-40">₹25-40 Lakhs</option>
                                    <option value="40+">₹40+ Lakhs</option>
                                </select>
                                <div class="error-message">Please select your investment budget</div>
                            </div>
                            <div class="form-group">
                                <label for="businessExperience">Business Experience</label>
                                <select id="businessExperience" name="businessExperience">
                                    <option value="">Select Experience</option>
                                    <option value="none">No Business Experience</option>
                                    <option value="1-3">1-3 years</option>
                                    <option value="4-7">4-7 years</option>
                                    <option value="8+">8+ years</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Motivation & Goals -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-bullseye"></i>
                            Motivation & Goals
                        </h3>
                        
                        <div class="form-group full-width">
                            <label for="motivation">What motivates you to start a preschool franchise? <span class="required">*</span></label>
                            <textarea id="motivation" name="motivation" rows="4" placeholder="Tell us about your passion for early childhood education and entrepreneurial goals..." required></textarea>
                            <div class="error-message">Please share your motivation</div>
                        </div>
                    </div>

                    <!-- Agreements and Declarations -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-gavel"></i>
                            Agreements & Declarations
                        </h3>
                        
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="info-accuracy" name="declarations[]" value="info-accuracy" required>
                                <label for="info-accuracy" class="checkbox-label">
                                    <strong>Information Accuracy *</strong><br>
                                    I declare that all information provided in this application is true and accurate to the best of my knowledge.
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="communication-consent" name="declarations[]" value="communication-consent">
                                <label for="communication-consent" class="checkbox-label">
                                    <strong>Communication Consent</strong><br>
                                    I consent to receive calls, emails, and SMS from TinyTechnoToddlers regarding this franchise application.
                                </label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="privacy-policy" name="declarations[]" value="privacy-policy" required>
                                <label for="privacy-policy" class="checkbox-label">
                                    <strong>Privacy Policy Agreement *</strong><br>
                                    I have read and agree to the <a href="#privacy" style="color: #6B2C91;">Privacy Policy</a> and <a href="#terms" style="color: #6B2C91;">Terms of Service</a>.
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-note">
                        <i class="fas fa-info-circle"></i>
                        <strong>Please Note:</strong> This application will be reviewed by our franchise team within 24-48 hours. We will contact you to discuss the next steps in the evaluation process. Fields marked with * are mandatory.
                    </div>
                </form>
            </div>

            <!-- Submit Section -->
            <div class="submit-section">
                <button type="submit" form="franchiseApplicationForm" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Franchise Application
                </button>
                
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <h3>Application Submitted Successfully!</h3>
                    <p>Thank you for your interest in TinyTechnoToddlers franchise. Our team will review your application and contact you within 24-48 hours.</p>
                </div>
                
                <p style="text-align: center; margin-top: 20px; color: #666; font-size: 0.9rem;">
                    Need help? Call our franchise helpline: <a href="tel:+919739561697" style="color: #6B2C91; font-weight: 600;">+91 9739561697</a>
                </p>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('franchiseApplicationForm');
    const submitBtn = document.getElementById('submitBtn');
    const successMessage = document.getElementById('successMessage');

    // Investment calculator functionality
    const investmentCards = document.querySelectorAll('.investment-card');
    const investmentBudgetSelect = document.getElementById('investmentBudget');

    investmentCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            investmentCards.forEach(c => c.classList.remove('selected'));
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Auto-select corresponding budget option
            const value = this.dataset.value;
            if (value === 'micro') {
                investmentBudgetSelect.value = '8-15';
            } else if (value === 'standard') {
                investmentBudgetSelect.value = '15-25';
            } else if (value === 'premium') {
                investmentBudgetSelect.value = '25-40';
            }
        });
    });

    // Form validation
    function validateForm() {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                showError(field);
                isValid = false;
            } else {
                hideError(field);
            }
        });

        // Validate email
        const emailField = document.getElementById('email');
        if (emailField.value && !isValidEmail(emailField.value)) {
            showError(emailField, 'Please enter a valid email address');
            isValid = false;
        }

        // Validate phone
        const phoneField = document.getElementById('phone');
        if (phoneField.value && !isValidPhone(phoneField.value)) {
            showError(phoneField, 'Please enter a valid 10-digit phone number');
            isValid = false;
        }

        // Validate required checkboxes
        const requiredCheckboxes = ['info-accuracy', 'privacy-policy'];
        requiredCheckboxes.forEach(id => {
            const checkbox = document.getElementById(id);
            if (!checkbox.checked) {
                showError(checkbox, 'This declaration is required');
                isValid = false;
            } else {
                hideError(checkbox);
            }
        });

        return isValid;
    }

    function showError(field, message = null) {
        const formGroup = field.closest('.form-group') || field.closest('.checkbox-item');
        const errorDiv = formGroup.querySelector('.error-message');
        
        field.classList.add('error');
        if (errorDiv) {
            errorDiv.style.display = 'block';
            if (message) {
                errorDiv.textContent = message;
            }
        }
    }

    function hideError(field) {
        const formGroup = field.closest('.form-group') || field.closest('.checkbox-item');
        const errorDiv = formGroup.querySelector('.error-message');
        
        field.classList.remove('error');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^[0-9]{10}$/;
        return phoneRegex.test(phone.replace(/\D/g, ''));
    }

    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                showError(this);
            } else {
                hideError(this);
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('error') && this.value.trim()) {
                hideError(this);
            }
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="loading-spinner"></span> Submitting...';
            submitBtn.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                // Hide form container and show success message
                document.querySelector('.form-container').style.display = 'none';
                successMessage.style.display = 'block';
                
                // Scroll to success message
                successMessage.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                console.log('Form submitted successfully');
            }, 2000);
        } else {
            // Scroll to first error
            const firstError = form.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });
});
</script>

<?php include 'footer.php'; ?>

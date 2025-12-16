<?php 
$page_title = "Franchise FAQs";
$page_description = "Get answers to frequently asked questions about TinyTechnoToddlers franchise opportunities, investment, support, and more.";
include 'header.php'; 
?>

<style>
/* FAQ Hero Section */
.faq-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 100px 0 60px 0;
    position: relative;
    overflow: hidden;
    color: white;
    text-align: center;
}

.faq-hero::before {
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
}

.faq-hero h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.2rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.faq-hero p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    line-height: 1.6;
}

.faq-quick-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
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
    min-width: 120px;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #FFD700;
    font-family: 'Fredoka', sans-serif;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    margin-top: 5px;
}

/* FAQ Categories */
.faq-categories {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 60px 20px;
}

.categories-content {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.categories-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.categories-title::after {
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

.category-tabs {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 40px 0;
    flex-wrap: wrap;
}

.category-tab {
    padding: 12px 25px;
    border-radius: 25px;
    background: white;
    color: #6B2C91;
    text-decoration: none;
    font-weight: 600;
    border: 2px solid #6B2C91;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.category-tab:hover,
.category-tab.active {
    background: #6B2C91;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
}

/* FAQ Main Section */
.faq-main {
    padding: 60px 20px;
    background: white;
}

.faq-container {
    max-width: 900px;
    margin: 0 auto;
}

.faq-category {
    margin-bottom: 50px;
}

.category-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    border-radius: 15px;
}

.category-icon {
    width: 50px;
    height: 50px;
    background: #FFD700;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #5B2D8F;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.category-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    margin: 0;
    font-weight: 600;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.faq-item {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(107, 44, 145, 0.08);
    border: 2px solid transparent;
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    border-color: #FFD700;
    box-shadow: 0 8px 30px rgba(107, 44, 145, 0.12);
}

.faq-question {
    width: 100%;
    background: none;
    border: none;
    color: #6B2C91;
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    padding: 25px;
    text-align: left;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    outline: none;
    transition: all 0.3s ease;
}

.faq-question:hover {
    background: rgba(255, 255, 255, 0.5);
}

.faq-arrow {
    color: #FFD700;
    font-size: 1.3rem;
    transition: transform 0.3s ease;
    flex-shrink: 0;
    margin-left: 15px;
}

.faq-answer {
    background: white;
    color: #555;
    font-size: 1rem;
    padding: 0 25px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.4s ease;
    line-height: 1.7;
}

.faq-item.open .faq-answer {
    max-height: 300px;
    padding: 25px;
    border-top: 1px solid rgba(107, 44, 145, 0.1);
}

.faq-item.open .faq-arrow {
    transform: rotate(180deg);
}

/* Search Section */
.faq-search {
    background: white;
    padding: 40px 20px;
    text-align: center;
    border-bottom: 1px solid rgba(107, 44, 145, 0.1);
}

.search-container {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 15px 50px 15px 20px;
    border: 2px solid #6B2C91;
    border-radius: 25px;
    font-size: 1rem;
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #FFD700;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
}

.search-btn {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: #6B2C91;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: #FFD700;
    color: #5B2D8F;
}

/* Contact Support Section */
.support-section {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 60px 20px;
    color: white;
    text-align: center;
}

.support-content {
    max-width: 800px;
    margin: 0 auto;
}

.support-section h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.2rem;
    color: #FFD700;
    margin-bottom: 20px;
}

.support-section p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    line-height: 1.6;
}

.support-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-top: 40px;
}

.support-option {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    text-decoration: none;
    color: white;
}

.support-option:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    border-color: #FFD700;
    color: white;
}

.support-icon {
    font-size: 2rem;
    color: #FFD700;
    margin-bottom: 15px;
}

.support-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #FFD700;
}

.support-description {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.5;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .faq-hero {
        padding: 80px 0 40px 0;
    }
    
    .faq-hero h1 {
        font-size: 2.2rem;
    }
    
    .faq-quick-stats {
        gap: 20px;
    }
    
    .category-tabs {
        gap: 10px;
    }
    
    .category-tab {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .faq-question {
        padding: 20px;
        font-size: 1rem;
    }
    
    .category-header {
        padding: 15px;
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .category-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
    
    .category-title {
        font-size: 1.5rem;
    }
    
    .support-options {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .faq-hero h1 {
        font-size: 1.8rem;
    }
    
    .faq-categories,
    .faq-main,
    .support-section {
        padding: 40px 15px;
    }
    
    .categories-title {
        font-size: 2rem;
    }
    
    .faq-question {
        padding: 15px;
        font-size: 0.95rem;
    }
    
    .faq-answer {
        padding: 0 15px;
    }
    
    .faq-item.open .faq-answer {
        padding: 20px 15px;
    }
}
</style>

<main>
    <section class="faq-hero">
        <div class="hero-content">
            <h1>Franchise FAQs</h1>
            <p>
                Get comprehensive answers to all your questions about TinyTechnoToddlers franchise opportunities. From investment details to ongoing support, we've got you covered.
            </p>
            
            <div class="faq-quick-stats">
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Common Questions</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Support Available</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">Success Rate</span>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-search">
        <div class="search-container">
            <input type="text" class="search-input" id="faqSearch" placeholder="Search for specific questions...">
            <button class="search-btn" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </section>

    <section class="faq-categories">
        <div class="categories-content">
            <h2 class="categories-title">Browse by Category</h2>
            <div class="category-tabs">
                <button class="category-tab active" data-category="all">
                    <i class="fas fa-list"></i> All FAQs
                </button>
                <button class="category-tab" data-category="investment">
                    <i class="fas fa-rupee-sign"></i> Investment
                </button>
                <button class="category-tab" data-category="support">
                    <i class="fas fa-hands-helping"></i> Support
                </button>
                <button class="category-tab" data-category="operations">
                    <i class="fas fa-cogs"></i> Operations
                </button>
                <button class="category-tab" data-category="training">
                    <i class="fas fa-graduation-cap"></i> Training
                </button>
                <button class="category-tab" data-category="marketing">
                    <i class="fas fa-bullhorn"></i> Marketing
                </button>
            </div>
        </div>
    </section>

    <section class="faq-main">
        <div class="faq-container">
            <!-- Investment Category -->
            <div class="faq-category" data-category="investment">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <h3 class="category-title">Investment & Financial Information</h3>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the total investment required to start a TinyTechnoToddlers franchise?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            The investment varies based on the model you choose: Micro Center (₹8-12 lakhs), Standard Center (₹15-25 lakhs), and Premium Center (₹30-45 lakhs). This includes franchise fee, setup costs, equipment, and working capital for the first few months.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            What does the franchise fee include?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            The franchise fee includes brand licensing, PENTEMIND curriculum access, initial training programs, marketing materials, operational manuals, setup guidance, and ongoing support for the first year.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            Are there any hidden costs or ongoing fees?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            We believe in transparency. Apart from the initial investment, there's a monthly royalty fee (typically 8-12% of revenue) and a marketing fee (2-4% of revenue) for national campaigns. No hidden costs or surprise charges.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            What is the expected return on investment (ROI)?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Most franchisees achieve break-even within 18-24 months. Annual ROI typically ranges from 25-40% after the break-even period, depending on location, management, and market conditions.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            Do you provide financing assistance?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Yes, we have partnerships with leading banks and financial institutions. We provide documentation support and can connect you with lenders who offer education sector loans at competitive rates.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Category -->
            <div class="faq-category" data-category="support">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="category-title">Ongoing Support & Assistance</h3>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            What kind of ongoing support do you provide?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            We provide comprehensive ongoing support including regular center visits, academic monitoring, staff training updates, marketing campaigns, operational guidance, technology support, and 24/7 helpline assistance.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            How often will someone from headquarters visit my center?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Our regional managers visit each center at least once every quarter for academic and operational reviews. Additional visits are scheduled during the launch phase and whenever support is needed.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            Is there a dedicated support team for franchisees?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Yes, each franchisee is assigned a dedicated relationship manager who serves as your primary point of contact for all support needs. We also have specialized teams for academics, operations, marketing, and technology.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            What happens if I face operational challenges?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Our experienced support team is always available to help troubleshoot any operational issues. We provide immediate guidance via phone/email and can arrange urgent on-site visits if required.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operations Category -->
            <div class="faq-category" data-category="operations">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="category-title">Operations & Management</h3>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            Do I need prior experience in education to run a franchise?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            While education background is beneficial, it's not mandatory. We provide comprehensive training on preschool operations, curriculum delivery, and child development. Many successful franchisees come from diverse professional backgrounds.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            How many staff members will I need to hire?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Staffing requirements depend on your center size: Micro centers need 3-4 staff, Standard centers need 5-7 staff, and Premium centers need 8-12 staff. This includes teachers, helpers, administrator, and security personnel.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            What are the space requirements for different franchise models?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Micro Center: 600-1000 sq ft, Standard Center: 1000-1500 sq ft, Premium Center: 1500+ sq ft. The space should be ground floor, child-safe, well-ventilated, and comply with local education department norms.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            What are the operating hours for a TinyTechnoToddlers center?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Standard operating hours are 8:00 AM to 6:00 PM, with core program hours from 9:00 AM to 1:00 PM. Extended daycare services can be offered based on local demand and regulations.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training Category -->
            <div class="faq-category" data-category="training">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="category-title">Training & Curriculum</h3>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            What training do I and my staff receive?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            You'll receive comprehensive training covering PENTEMIND methodology, center management, financial planning, and parent relations. Your teaching staff will be trained in curriculum delivery, child psychology, and classroom management.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            How long is the training period?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Initial training is 2 weeks (80 hours) covering all aspects of franchise operations. Teacher training is 1 week (40 hours) focusing on PENTEMIND curriculum. Additional refresher training sessions are conducted regularly.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            Is the PENTEMIND curriculum regularly updated?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Yes, our curriculum is continuously enhanced based on latest research in early childhood education. Updates are shared with all centers, and training is provided for any significant changes.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Marketing Category -->
            <div class="faq-category" data-category="marketing">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="category-title">Marketing & Student Enrollment</h3>
                </div>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            What marketing support do you provide?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            We provide national brand campaigns, local marketing materials, digital marketing support, event planning assistance, and promotional strategies. Launch marketing campaigns are specially designed for new centers.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            How do you help with student enrollment and admission campaigns?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            We provide admission campaign templates, enrollment tracking systems, parent counseling training, and targeted marketing strategies. Our team also assists in planning local events and community outreach programs.
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            Can I do my own local marketing activities?
                            <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            Absolutely! Local marketing initiatives are encouraged. We provide guidelines and pre-approved marketing materials. All marketing activities should maintain brand consistency and follow our quality standards.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="support-section">
        <div class="support-content">
            <h2>Still Have Questions?</h2>
            <p>
                Our franchise support team is here to help you with any additional questions about starting and operating your TinyTechnoToddlers franchise.
            </p>
            
            <div class="support-options">
                <a href="tel:+918000333555" class="support-option">
                    <div class="support-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h4 class="support-title">Call Us</h4>
                    <p class="support-description">Speak directly with our franchise consultants</p>
                </a>
                
                <a href="mailto:franchise@tinytechnotoddlers.com" class="support-option">
                    <div class="support-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="support-title">Email Support</h4>
                    <p class="support-description">Get detailed answers to your questions</p>
                </a>
                
                <a href="interest_form.php" class="support-option">
                    <div class="support-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h4 class="support-title">Apply Now</h4>
                    <p class="support-description">Start your franchise application process</p>
                </a>
                
                <a href="our_partners.php" class="support-option">
                    <div class="support-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="support-title">Meet Partners</h4>
                    <p class="support-description">Connect with existing franchise partners</p>
                </a>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ toggle functionality
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', function() {
            const faqItem = this.closest('.faq-item');
            const isOpen = faqItem.classList.contains('open');
            
            // Close all other FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('open');
                }
            });
            
            // Toggle current item
            faqItem.classList.toggle('open', !isOpen);
        });
    });

    // Category filtering
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active tab
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show/hide categories
            document.querySelectorAll('.faq-category').forEach(cat => {
                if (category === 'all' || cat.dataset.category === category) {
                    cat.style.display = 'block';
                } else {
                    cat.style.display = 'none';
                }
            });
            
            // Close all open FAQ items when switching categories
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('open');
            });
        });
    });

    // Search functionality
    const searchInput = document.getElementById('faqSearch');
    const searchBtn = document.querySelector('.search-btn');
    
    function searchFAQs() {
        const searchTerm = searchInput.value.toLowerCase();
        const faqItems = document.querySelectorAll('.faq-item');
        let hasResults = false;
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                item.closest('.faq-category').style.display = 'block';
                hasResults = true;
                
                // Highlight search term (basic implementation)
                if (searchTerm.length > 2) {
                    const questionElement = item.querySelector('.faq-question');
                    const originalText = questionElement.dataset.original || questionElement.childNodes[0].textContent;
                    questionElement.dataset.original = originalText;
                    
                    const highlightedText = originalText.replace(
                        new RegExp(`(${searchTerm})`, 'gi'),
                        '<mark>$1</mark>'
                    );
                    questionElement.childNodes[0].innerHTML = highlightedText;
                }
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show message if no results
        if (!hasResults && searchTerm.length > 0) {
            // You can add a "no results" message here
            console.log('No results found');
        }
        
        // Hide categories with no visible items
        if (searchTerm.length > 0) {
            document.querySelectorAll('.faq-category').forEach(category => {
                const visibleItems = category.querySelectorAll('.faq-item[style*="block"]').length;
                if (visibleItems === 0) {
                    category.style.display = 'none';
                }
            });
        }
    }
    
    // Clear highlights and show all items when search is empty
    function clearSearch() {
        document.querySelectorAll('.faq-item').forEach(item => {
            item.style.display = 'block';
            const questionElement = item.querySelector('.faq-question');
            if (questionElement.dataset.original) {
                questionElement.childNodes[0].textContent = questionElement.dataset.original;
                delete questionElement.dataset.original;
            }
        });
        
        document.querySelectorAll('.faq-category').forEach(category => {
            category.style.display = 'block';
        });
    }
    
    searchInput.addEventListener('input', function() {
        if (this.value.length === 0) {
            clearSearch();
        } else if (this.value.length >= 2) {
            searchFAQs();
        }
    });
    
    searchBtn.addEventListener('click', searchFAQs);
    
    // Enter key search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchFAQs();
        }
    });

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Initialize animations
    document.querySelectorAll('.faq-item, .support-option').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.4s ease ${index * 0.05}s, transform 0.4s ease ${index * 0.05}s`;
        observer.observe(item);
    });
});
</script>

<?php include 'footer.php'; ?>

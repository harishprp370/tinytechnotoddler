<?php 
$page_key = 'programs';
include 'includes/header.php'; 
?>

<style>
/* Program Page Styles - Reuse from previous pages */
.program-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 120px 0 80px 0;
    position: relative;
    overflow: hidden;
    color: white;
    margin-top: 0;
}

.program-hero::before {
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
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.hero-text h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #FFD700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.4rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 15px;
    font-weight: 500;
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
    color: rgba(255, 255, 255, 0.85);
}

.hero-stats {
    display: flex;
    gap: 30px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
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
    color: rgba(255, 255, 255, 0.8);
    margin-top: 5px;
}

.hero-actions {
    display: flex;
    gap: 20px;
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.cta-primary {
    background: linear-gradient(135deg, #FFD700, #FFC107);
    color: #5B2D8F;
}

.cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
}

.cta-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.cta-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: #FFD700;
    color: #FFD700;
}

.hero-image {
    position: relative;
    text-align: center;
}

.hero-image img {
    width: 100%;
    max-width: 500px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    border: 4px solid rgba(255, 215, 0, 0.3);
}

/* Content sections - reuse styles from previous pages */
.content-section {
    padding: 80px 0;
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 20px;
    padding-right: 20px;
}

.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    text-align: center;
    margin-bottom: 50px;
    position: relative;
}

.section-title::after {
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

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.feature-card {
    background: white;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
}

.feature-icon i {
    color: white;
    font-size: 24px;
}

.feature-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #6B2C91;
    margin-bottom: 15px;
    font-weight: 600;
}

.feature-description {
    color: #666;
    line-height: 1.6;
    font-size: 1rem;
}

.curriculum-section {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 80px 0;
}

.curriculum-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.curriculum-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-top: 50px;
}

.curriculum-text h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 25px;
}

.curriculum-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.curriculum-highlights {
    list-style: none;
    padding: 0;
}

.curriculum-highlights li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(107, 44, 145, 0.05);
}

.curriculum-highlights li i {
    color: #FFD700;
    font-size: 20px;
    margin-right: 15px;
    margin-top: 3px;
}

.curriculum-highlights li span {
    color: #555;
    font-size: 1rem;
    line-height: 1.5;
}

.curriculum-image {
    text-align: center;
}

.curriculum-image img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(107, 44, 145, 0.2);
}

.admission-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
    text-align: center;
    position: relative;
}

.admission-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.admission-section h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #FFD700;
    margin-bottom: 25px;
}

.admission-section p {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 40px;
    color: rgba(255, 255, 255, 0.9);
}

.admission-form {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    margin: 40px auto;
    border: 1px solid rgba(255, 255, 255, 0.2);
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

.form-group label {
    color: #FFD700;
    margin-bottom: 8px;
    font-weight: 500;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 12px 15px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 1rem;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.submit-btn {
    background: linear-gradient(135deg, #FFD700, #FFC107);
    color: #5B2D8F;
    border: none;
    padding: 15px 40px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 20px;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .program-hero {
        padding: 100px 0 60px 0;
    }
    
    .hero-content {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
    
    .hero-text h1 {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 20px;
    }
    
    .curriculum-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .cta-button {
        padding: 12px 25px;
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .admission-form {
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .hero-text h1 {
        font-size: 1.8rem;
    }
    
    .content-section {
        padding: 60px 0;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .feature-card {
        padding: 25px;
    }
    
    .curriculum-section,
    .admission-section {
        padding: 60px 0;
    }
}
</style>

<main>
    <section class="program-hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Teacher Training Program</h1>
                <p class="hero-subtitle">Professional Development for Early Childhood Educators</p>
                <p class="hero-description">
                    Zee Learn's comprehensive teacher training program sets unparalleled standards in Child Development & Education (CDE). Empowering educators with world-class pedagogy, practical skills, and ongoing support for excellence in Early Childhood Care & Education (ECCE).
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">20+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Teachers Trained</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Certification Rate</span>
                    </div>
                </div>
                <div class="hero-actions">
                    <a href="#admission" class="cta-button cta-primary">
                        <i class="fas fa-certificate"></i>
                        Register Now
                    </a>
                    <a href="#curriculum" class="cta-button cta-secondary">
                        <i class="fas fa-book-open"></i>
                        View Program
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=500&h=400&fit=crop&crop=faces" alt="Teacher training session">
            </div>
        </div>
    </section>

    <section class="content-section">
        <h2 class="section-title">Why Choose Our Training Program?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="feature-title">Industry-Leading Certification</h3>
                <p class="feature-description">
                    Nationally recognized certification in Early Childhood Care & Education, enhancing career prospects and professional credibility.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="feature-title">PENTEMIND Pedagogy</h3>
                <p class="feature-description">
                    Master our proven holistic teaching methodology that focuses on comprehensive child development and learning outcomes.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="feature-title">Practical Learning</h3>
                <p class="feature-description">
                    Hands-on training sessions, real classroom experiences, and practical application of theoretical knowledge.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Expert Faculty</h3>
                <p class="feature-description">
                    Learn from experienced early childhood education specialists and industry experts with decades of combined experience.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3 class="feature-title">Blended Learning</h3>
                <p class="feature-description">
                    Flexible online modules combined with in-person workshops for comprehensive learning at your own pace.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="feature-title">Career Support</h3>
                <p class="feature-description">
                    Job placement assistance, career guidance, and networking opportunities within the TinyTechnoToddlers ecosystem.
                </p>
            </div>
        </div>
    </section>

    <section id="curriculum" class="curriculum-section">
        <div class="curriculum-content">
            <h2 class="section-title">Comprehensive Training Curriculum</h2>
            <div class="curriculum-grid">
                <div class="curriculum-text">
                    <h3>Professional Development Modules</h3>
                    <p>
                        Our structured training program covers all essential aspects of early childhood education, ensuring educators are well-equipped to nurture and inspire young minds.
                    </p>
                    <ul class="curriculum-highlights">
                        <li>
                            <i class="fas fa-child"></i>
                            <span><strong>Child Development:</strong> Understanding developmental milestones, learning theories, and age-appropriate practices</span>
                        </li>
                        <li>
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span><strong>Teaching Methodologies:</strong> PENTEMIND pedagogy, play-based learning, and innovative teaching techniques</span>
                        </li>
                        <li>
                            <i class="fas fa-clipboard-list"></i>
                            <span><strong>Curriculum Planning:</strong> Lesson planning, activity design, and assessment strategies for effective learning</span>
                        </li>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span><strong>Classroom Management:</strong> Behavior management, creating positive environments, and conflict resolution</span>
                        </li>
                        <li>
                            <i class="fas fa-comments"></i>
                            <span><strong>Parent Communication:</strong> Building partnerships with families and effective communication strategies</span>
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            <span><strong>Safety & Ethics:</strong> Child safety protocols, ethical practices, and legal requirements in ECCE</span>
                        </li>
                    </ul>
                </div>
                <div class="curriculum-image">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&h=450&fit=crop" alt="Teacher training workshop">
                </div>
            </div>
        </div>
    </section>

    <section id="admission" class="admission-section">
        <div class="admission-content">
            <h2>Join Our Teacher Training Program</h2>
            <p>
                Transform your passion for early childhood education into a rewarding career. Our comprehensive training program will equip you with the skills, knowledge, and confidence to make a lasting impact on young learners.
            </p>
            
            <div class="admission-form">
                <form id="teacher-training-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="participant-name">Full Name</label>
                            <input type="text" id="participant-name" name="participant_name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="education">Educational Qualification</label>
                            <select id="education" name="education" required>
                                <option value="">Select Qualification</option>
                                <option value="12th">12th Pass</option>
                                <option value="graduate">Graduate</option>
                                <option value="postgraduate">Post Graduate</option>
                                <option value="bed">B.Ed</option>
                                <option value="med">M.Ed</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience">Teaching Experience</label>
                            <select id="experience" name="experience" required>
                                <option value="">Select Experience</option>
                                <option value="none">No Experience</option>
                                <option value="0-2">0-2 Years</option>
                                <option value="3-5">3-5 Years</option>
                                <option value="6-10">6-10 Years</option>
                                <option value="10+">10+ Years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Preferred Training Location</label>
                            <select id="location" name="location" required>
                                <option value="">Select Location</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="delhi">Delhi</option>
                                <option value="hyderabad">Hyderabad</option>
                                <option value="online">Online Program</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="program-type">Program Type</label>
                            <select id="program-type" name="program_type" required>
                                <option value="">Select Program</option>
                                <option value="basic">Basic Teacher Training (30 hours)</option>
                                <option value="advanced">Advanced ECCE Certification (60 hours)</option>
                                <option value="master">Master Trainer Program (120 hours)</option>
                                <option value="refresher">Refresher Course (15 hours)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start-date">Preferred Start Date</label>
                            <select id="start-date" name="start_date" required>
                                <option value="">Select Date</option>
                                <option value="march-2024">March 2024 Batch</option>
                                <option value="april-2024">April 2024 Batch</option>
                                <option value="may-2024">May 2024 Batch</option>
                                <option value="flexible">Flexible</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="motivation">Why do you want to join this program?</label>
                            <textarea id="motivation" name="motivation" rows="4" placeholder="Tell us about your motivation and career goals in early childhood education..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i>
                        Submit Training Application
                    </button>
                </form>
            </div>
            
            <div class="hero-actions" style="margin-top: 40px;">
                <a href="tel:+918000333555" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Call for Details
                </a>
                <a href="/programs.php" class="cta-button cta-secondary">
                    <i class="fas fa-arrow-left"></i>
                    All Programs
                </a>
            </div>
        </div>
    </section>
</main>

<script>
document.getElementById('teacher-training-form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Thank you for your interest in our Teacher Training Program! Our team will contact you shortly to discuss the next steps.');
});
</script>

<?php include 'includes/footer.php'; ?>

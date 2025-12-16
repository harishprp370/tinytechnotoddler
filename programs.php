<?php 
$page_key = 'programs';
include 'includes/header.php'; 
?>

<style>
.programs-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 120px 0 80px 0;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-top: 0;
}

.programs-hero::before {
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
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.programs-hero h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 3.5rem;
    color: #FFD700;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.programs-hero p {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.programs-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #FFD700;
    font-family: 'Fredoka', sans-serif;
}

.stat-label {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 5px;
}

.programs-list {
    max-width: 1800px;
    margin: 80px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
}

.program-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(107, 44, 145, 0.1);
    border: 2px solid #F3E9FF;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.program-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
}

.program-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-top-left-radius: 24px;
    border-top-right-radius: 24px;
}

.program-content {
    padding: 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

.program-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    color: #6B2C91;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: left;
}

.program-subtitle {
    color: #8E44AD;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.program-desc {
    color: #555;
    font-size: 1rem;
    margin-bottom: 25px;
    text-align: left;
    line-height: 1.6;
    flex: 1;
}

.program-features {
    list-style: none;
    padding: 0;
    margin-bottom: 25px;
}

.program-features li {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    color: #666;
    font-size: 0.95rem;
}

.program-features li i {
    color: #FFD700;
    margin-right: 10px;
    font-size: 1rem;
}

.program-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 12px;
}

.info-item {
    text-align: center;
}

.info-label {
    font-size: 0.85rem;
    color: #888;
    margin-bottom: 5px;
    font-weight: 500;
}

.info-value {
    font-size: 1.1rem;
    color: #6B2C91;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
}

.program-actions {
    display: flex;
    gap: 15px;
    margin-top: auto;
}

.program-btn {
    padding: 12px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(107, 44, 145, 0.4);
    background: linear-gradient(135deg, #5B2D8F, #7B3FA0);
}

.btn-secondary {
    background: rgba(107, 44, 145, 0.1);
    color: #6B2C91;
    border: 2px solid #6B2C91;
}

.btn-secondary:hover {
    background: #6B2C91;
    color: white;
}

.program-note {
    font-size: 0.85rem;
    color: #888;
    text-align: center;
    margin-top: 15px;
    font-style: italic;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 80px 0;
    text-align: center;
    color: white;
    margin-top: 40px;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.cta-section h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #FFD700;
    margin-bottom: 20px;
}

.cta-section p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    color: rgba(255, 255, 255, 0.9);
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

/* Methodology Section */
.methodology-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.methodology-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.methodology-header {
    text-align: center;
    margin-bottom: 60px;
}

.methodology-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.methodology-header h2::after {
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

.methodology-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.methodology-text h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 25px;
}

.methodology-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.methodology-points {
    list-style: none;
    padding: 0;
}

.methodology-points li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(107, 44, 145, 0.05);
}

.methodology-points li i {
    color: #FFD700;
    font-size: 20px;
    margin-right: 15px;
    margin-top: 3px;
}

.methodology-points li span {
    color: #555;
    font-size: 1rem;
    line-height: 1.5;
}

.methodology-image {
    text-align: center;
}

.methodology-image img {
    width: 100%;
    max-width: 500px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(107, 44, 145, 0.2);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .programs-hero {
        padding: 100px 0 60px 0;
    }
    
    .programs-hero h1 {
        font-size: 2.5rem;
    }
    
    .programs-hero p {
        font-size: 1.1rem;
    }
    
    .programs-stats {
        gap: 30px;
    }
    
    .programs-list {
        grid-template-columns: 1fr;
        gap: 25px;
        margin: 60px auto;
    }
    
    .program-content {
        padding: 25px;
    }
    
    .program-title {
        font-size: 1.5rem;
    }
    
    .program-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .program-btn {
        padding: 10px 18px;
        font-size: 0.9rem;
    }
    
    .methodology-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .cta-button {
        padding: 12px 25px;
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .programs-hero h1 {
        font-size: 2rem;
    }
    
    .program-info {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .cta-section,
    .methodology-section {
        padding: 60px 0;
    }
}
</style>

<main>
    <section class="programs-hero">
        <div class="hero-content">
            <h1>Our Educational Programs</h1>
            <p>Comprehensive early childhood education programs designed to nurture every child's unique potential through our scientifically-proven PENTEMIND methodology.</p>
            
            <!-- <div class="programs-stats">
                <div class="stat-item">
                    <span class="stat-number">4</span>
                    <span class="stat-label">Age-Specific Programs</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2000+</span>
                    <span class="stat-label">Centers Nationwide</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1.5M+</span>
                    <span class="stat-label">Children Nurtured</span>
                </div>
            </div> -->
        </div>
    </section>

    <div class="programs-list">
        <div class="program-card">
            <img src="assets/img/playgroup.jpg" alt="PlayGroup" class="program-img">
            <div class="program-content">
                <div class="program-title">PlayGroup Program</div>
                <div class="program-subtitle">For Curious Toddlers (2-3 Years)</div>
                <div class="program-desc">
                    Where little explorers begin their learning journey through play, discovery, and joyful experiences. Our PlayGroup program nurtures natural curiosity and builds foundation skills through engaging activities.
                </div>
                <ul class="program-features">
                    <li><i class="fas fa-puzzle-piece"></i> Play-based learning approach</li>
                    <li><i class="fas fa-heart"></i> Emotional & social development</li>
                    <li><i class="fas fa-users"></i> Small class sizes (15 children)</li>
                    <li><i class="fas fa-shield-alt"></i> Safe & nurturing environment</li>
                </ul>
                <div class="program-info">
                    <div class="info-item">
                        <div class="info-label">Age Group</div>
                        <div class="info-value">2-3 Years</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Duration</div>
                        <div class="info-value">3 Hours/Day</div>
                    </div>
                </div>
                <div class="program-actions">
                    <a href="playgroup.php" class="program-btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Learn More
                    </a>
                    <a href="admissions.php" class="program-btn btn-secondary">
                        <i class="fas fa-calendar-check"></i>
                        Enroll Now
                    </a>
                </div>
                <div class="program-note">(Duration based on state regulations)</div>
            </div>
        </div>

        <div class="program-card">
            <img src="assets/img/nursery.jpg" alt="Nursery" class="program-img">
            <div class="program-content">
                <div class="program-title">Nursery Program</div>
                <div class="program-subtitle">Foundational Stage Level 1 (3-4 Years)</div>
                <div class="program-desc">
                    The first mandatory level of NEP's Foundational Stage. Our Nursery program builds essential skills through structured learning activities, creative expression, and social development.
                </div>
                <ul class="program-features">
                    <li><i class="fas fa-graduation-cap"></i> NEP 2020 aligned curriculum</li>
                    <li><i class="fas fa-book-reader"></i> Language & communication skills</li>
                    <li><i class="fas fa-calculator"></i> Early numeracy concepts</li>
                    <li><i class="fas fa-music"></i> Arts & creative expression</li>
                </ul>
                <div class="program-info">
                    <div class="info-item">
                        <div class="info-label">Age Group</div>
                        <div class="info-value">3-4 Years</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Duration</div>
                        <div class="info-value">3 Hours/Day</div>
                    </div>
                </div>
                <div class="program-actions">
                    <a href="nursery.php" class="program-btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Learn More
                    </a>
                    <a href="admissions.php" class="program-btn btn-secondary">
                        <i class="fas fa-calendar-check"></i>
                        Enroll Now
                    </a>
                </div>
                <div class="program-note">(Duration based on state regulations)</div>
            </div>
        </div>

        <div class="program-card">
            <img src="assets/img/learning.jpg" alt="Kindergarten" class="program-img">
            <div class="program-content">
                <div class="program-title">Kindergarten Program</div>
                <div class="program-subtitle">Junior KG & Senior KG (4-6 Years)</div>
                <div class="program-desc">
                    Levels 2 & 3 of the Foundational Stage preparing children for primary school success. Advanced literacy, numeracy, and comprehensive school readiness development.
                </div>
                <ul class="program-features">
                    <li><i class="fas fa-book-open"></i> Advanced literacy & reading skills</li>
                    <li><i class="fas fa-calculator"></i> Mathematical thinking & problem solving</li>
                    <li><i class="fas fa-flask"></i> Scientific inquiry & experimentation</li>
                    <li><i class="fas fa-users"></i> Leadership & teamwork skills</li>
                </ul>
                <div class="program-info">
                    <div class="info-item">
                        <div class="info-label">Jr. KG</div>
                        <div class="info-value">4-5 Years</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Sr. KG</div>
                        <div class="info-value">5-6 Years</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Duration</div>
                        <div class="info-value">4 Hours/Day</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Class Size</div>
                        <div class="info-value">20 Children</div>
                    </div>
                </div>
                <div class="program-actions">
                    <a href="kindergarden.php" class="program-btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Learn More
                    </a>
                    <a href="admissions.php" class="program-btn btn-secondary">
                        <i class="fas fa-graduation-cap"></i>
                        Apply Now
                    </a>
                </div>
                <div class="program-note">(Duration based on state regulations)</div>
            </div>
        </div>

        <div class="program-card">
            <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=600&h=400&fit=crop&crop=faces" alt="Teacher Training" class="program-img">
            <div class="program-content">
                <div class="program-title">Teacher Training Program</div>
                <div class="program-subtitle">Professional Development for Educators</div>
                <div class="program-desc">
                    Comprehensive certification program setting industry standards in Early Childhood Care & Education. Transform your passion into professional expertise.
                </div>
                <ul class="program-features">
                    <li><i class="fas fa-award"></i> Industry-leading certification</li>
                    <li><i class="fas fa-brain"></i> PENTEMIND pedagogy mastery</li>
                    <li><i class="fas fa-hands-helping"></i> Practical learning approach</li>
                    <li><i class="fas fa-briefcase"></i> Career placement support</li>
                </ul>
                <div class="program-info">
                    <div class="info-item">
                        <div class="info-label">Duration</div>
                        <div class="info-value">30-120 Hours</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Certification</div>
                        <div class="info-value">National Recognition</div>
                    </div>
                </div>
                <div class="program-actions">
                    <a href="teacher-training.php" class="program-btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Learn More
                    </a>
                    <a href="teacher-training.php#admission" class="program-btn btn-secondary">
                        <i class="fas fa-certificate"></i>
                        Register Now
                    </a>
                </div>
                <div class="program-note">Multiple program tracks available</div>
            </div>
        </div>
    </div>

    <section class="methodology-section">
        <div class="methodology-content">
            <div class="methodology-header">
                <h2>Our PENTEMIND Methodology</h2>
                <p style="color: #666; font-size: 1.1rem; max-width: 800px; margin: 20px auto 0;">A scientifically-proven approach to holistic child development combining traditional wisdom with modern educational research.</p>
            </div>
            <div class="methodology-grid">
                <div class="methodology-text">
                    <h3>Five Pillars of Development</h3>
                    <p>
                        PENTEMIND is our unique pedagogy that addresses five crucial areas of child development, ensuring comprehensive growth and readiness for future learning.
                    </p>
                    <ul class="methodology-points">
                        <li>
                            <i class="fas fa-brain"></i>
                            <span><strong>Cognitive Development:</strong> Building thinking, reasoning, and problem-solving abilities</span>
                        </li>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span><strong>Social-Emotional Learning:</strong> Developing empathy, self-awareness, and emotional intelligence</span>
                        </li>
                        <li>
                            <i class="fas fa-running"></i>
                            <span><strong>Physical Development:</strong> Enhancing motor skills, coordination, and healthy habits</span>
                        </li>
                        <li>
                            <i class="fas fa-palette"></i>
                            <span><strong>Creative Expression:</strong> Fostering imagination, artistic abilities, and innovative thinking</span>
                        </li>
                        <li>
                            <i class="fas fa-comments"></i>
                            <span><strong>Communication Skills:</strong> Building language, literacy, and effective expression</span>
                        </li>
                    </ul>
                </div>
                <div class="methodology-image">
                    <img src="assets/img/pen.webp" alt="PENTEMIND Methodology">
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Begin Your Child's Learning Journey?</h2>
            <p>
                Join thousands of families who trust TinyTechnoToddlers for quality early childhood education. Our expert team is ready to guide you through the admission process and help you choose the perfect program for your child.
            </p>
            
            <div class="cta-buttons">
                <a href="admissions.php" class="cta-button cta-primary">
                    <i class="fas fa-clipboard-list"></i>
                    Schedule School Visit
                </a>
                <a href="contact.php" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Talk to Counselor
                </a>
                <a href="partner_portal/index.php" class="cta-button cta-secondary">
                    <i class="fas fa-handshake"></i>
                    Franchise Opportunity
                </a>
            </div>
        </div>
    </section>
</main>

<script>
// Smooth scroll for program links
document.querySelectorAll('a[href*="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href.includes('#') && !href.startsWith('http')) {
            e.preventDefault();
            const targetId = href.split('#')[1];
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// Add animation on scroll for program cards
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
document.querySelectorAll('.program-card').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
    observer.observe(card);
});
</script>

<?php include 'includes/footer.php'; ?>

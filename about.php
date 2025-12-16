<?php 
$page_key = 'about';
include 'includes/header.php'; 
?>

<style>
/* About Page Styles */
.about-hero {
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    padding: 120px 0 80px 0;
    position: relative;
    overflow: hidden;
    color: white;
    margin-top: 0;
}

.about-hero::before {
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
    max-width: 1800px;
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
    font-size: 3.5rem;
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

/* Main Content Sections */
.content-section {
    padding: 80px 0;
    max-width: 1800px;
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

/* Vision & Mission Section */
.vision-mission-section {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 80px 0;
}

.vision-mission-content {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 20px;
}

.vision-mission-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-top: 60px;
}

.vm-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    position: relative;
    text-align: center;
}

.vm-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
    border-radius: 20px 20px 0 0;
}

.vm-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.vm-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 35px;
    color: white;
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
}

.vm-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.8rem;
    color: #6B2C91;
    margin-bottom: 20px;
    font-weight: 700;
}

.vm-description {
    color: #666;
    line-height: 1.7;
    font-size: 1.1rem;
}

/* Legacy Section */
.legacy-section {
    padding: 80px 0;
    background: white;
}

.legacy-content {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 20px;
}

.legacy-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.legacy-card {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid rgba(255, 215, 0, 0.2);
    transition: all 0.3s ease;
    position: relative;
}

.legacy-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.legacy-number {
    font-family: 'Fredoka', sans-serif;
    font-size: 3rem;
    font-weight: 700;
    color: #6B2C91;
    margin-bottom: 15px;
    display: block;
}

.legacy-label {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.3rem;
    color: #8E44AD;
    font-weight: 600;
    margin-bottom: 10px;
}

.legacy-description {
    color: #666;
    font-size: 1rem;
    line-height: 1.6;
}

.legacy-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 25px;
    color: #5B2D8F;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

/* Recognition Section */
.recognition-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
}

.recognition-content {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 20px;
}

.recognition-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.recognition-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.recognition-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    border-color: #FFD700;
}

.recognition-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 30px;
    color: #5B2D8F;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

.recognition-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #FFD700;
    margin-bottom: 15px;
    font-weight: 600;
}

.recognition-description {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    font-size: 1rem;
}

/* Team Section */
.team-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.team-content {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 20px;
}

.team-intro {
    text-align: center;
    margin-bottom: 60px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.team-intro p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.team-member {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    position: relative;
}

.team-member::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
    border-radius: 20px 20px 0 0;
}

.team-member:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.team-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 20px;
    border: 4px solid #FFD700;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

.team-name {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #6B2C91;
    margin-bottom: 8px;
    font-weight: 600;
}

.team-role {
    color: #8E44AD;
    font-size: 1.1rem;
    font-weight: 500;
    margin-bottom: 15px;
}

.team-description {
    color: #666;
    line-height: 1.6;
    font-size: 1rem;
    margin-bottom: 20px;
}

.team-social {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-link {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 18px;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: linear-gradient(135deg, #FFD700, #FFC107);
    color: #5B2D8F;
    transform: translateY(-2px);
}

/* Company Values Section */
.values-section {
    padding: 80px 0;
    background: white;
}

.values-content {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 20px;
}

.values-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-top: 50px;
}

.values-text h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 25px;
}

.values-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.values-list {
    list-style: none;
    padding: 0;
}

.values-list li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(107, 44, 145, 0.05);
    border-left: 4px solid #FFD700;
}

.values-list li i {
    color: #6B2C91;
    font-size: 24px;
    margin-right: 20px;
    margin-top: 5px;
}

.value-content h4 {
    font-family: 'Fredoka', sans-serif;
    color: #6B2C91;
    font-size: 1.2rem;
    margin-bottom: 8px;
    font-weight: 600;
}

.value-content p {
    color: #666;
    font-size: 1rem;
    line-height: 1.5;
    margin: 0;
}

.values-image {
    text-align: center;
}

.values-image img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(107, 44, 145, 0.2);
}

/* CTA Section */
.cta-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
    text-align: center;
    position: relative;
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
    margin-bottom: 25px;
}

.cta-section p {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 40px;
    color: rgba(255, 255, 255, 0.9);
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .about-hero {
        padding: 100px 0 60px 0;
    }
    
    .hero-content {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
    
    .hero-text h1 {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 20px;
    }
    
    .vision-mission-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-button {
        padding: 12px 25px;
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
}

@media (max-width: 480px) {
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .content-section {
        padding: 60px 0;
    }
    
    .legacy-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .recognition-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .vm-card,
    .team-member,
    .legacy-card {
        padding: 25px;
    }
}
</style>

<main>
    <section class="about-hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>About TinyTechnoToddlers</h1>
                <p class="hero-subtitle">India's Leading Preschool Chain</p>
                <p class="hero-description">
                    With over 20 years of excellence in early childhood education, we have nurtured more than 1.5 million children across India and Nepal, setting new standards in holistic child development.
                </p>
                <!-- <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">2000+</span>
                        <span class="stat-label">Centers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">750+</span>
                        <span class="stat-label">Cities</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1.5M+</span>
                        <span class="stat-label">Children Nurtured</span>
                    </div>
                </div> -->
                <div class="hero-actions">
                    <a href="admissions.php" class="cta-button cta-primary">
                        <i class="fas fa-graduation-cap"></i>
                        Join Our Family
                    </a>
                    <a href="#vision-mission" class="cta-button cta-secondary">
                        <i class="fas fa-arrow-down"></i>
                        Learn More
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=500&h=400&fit=crop&crop=faces" alt="Happy children learning at TinyTechnoToddlers">
            </div>
        </div>
    </section>

    <section id="vision-mission" class="vision-mission-section">
        <div class="vision-mission-content">
            <h2 class="section-title">Our Vision & Mission</h2>
            <div class="vision-mission-grid">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="vm-title">Our Vision</h3>
                    <p class="vm-description">
                        To be the global leader in early childhood education, creating a generation of confident, creative, and compassionate individuals who are ready to shape the future with wisdom and innovation.
                    </p>
                </div>
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="vm-title">Our Mission</h3>
                    <p class="vm-description">
                        To provide exceptional early childhood education through our innovative PENTEMIND pedagogy, fostering holistic development in a safe, nurturing environment that celebrates each child's unique potential.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="legacy" class="legacy-section">
        <div class="legacy-content">
            <h2 class="section-title">Our Legacy of Excellence</h2>
            <div class="legacy-grid">
                <div class="legacy-card">
                    <div class="legacy-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <span class="legacy-number">10+</span>
                    <div class="legacy-label">Preschool Centers</div>
                    <div class="legacy-description">Across Karnataka, providing quality education to communities nationwide</div>
                </div>
                <div class="legacy-card">
                    <div class="legacy-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <span class="legacy-number">10+</span>
                    <div class="legacy-label">Cities Covered</div>
                    <div class="legacy-description">Making quality early education accessible in urban and rural areas</div>
                </div>
                <div class="legacy-card">
                    <div class="legacy-icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <span class="legacy-number">1500+</span>
                    <div class="legacy-label">Children Educated</div>
                    <div class="legacy-description">Young minds nurtured and prepared for lifelong learning success</div>
                </div>
                <div class="legacy-card">
                    <div class="legacy-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="legacy-number">5+</span>
                    <div class="legacy-label">Years of Excellence</div>
                    <div class="legacy-description">Two decades of innovation and leadership in early childhood education</div>
                </div>
            </div>
        </div>
    </section>

    <section id="recognition" class="recognition-section">
        <div class="recognition-content">
            <h2 class="section-title" style="color: #FFD700;">Recognition & Awards</h2>
            <div class="recognition-grid">
                <div class="recognition-card">
                    <div class="recognition-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="recognition-title">Best Preschool Chain 2024</h3>
                    <p class="recognition-description">
                        Recognized for excellence in early childhood education and innovative teaching methodologies.
                    </p>
                </div>
                <div class="recognition-card">
                    <div class="recognition-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="recognition-title">Innovation in ECCE Award</h3>
                    <p class="recognition-description">
                        Honored for pioneering the PENTEMIND pedagogy and transforming early childhood education.
                    </p>
                </div>
                <div class="recognition-card">
                    <div class="recognition-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="recognition-title">Parent's Choice Award</h3>
                    <p class="recognition-description">
                        Consistently rated as the top choice by parents for quality education and child safety.
                    </p>
                </div>
                <div class="recognition-card">
                    <div class="recognition-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="recognition-title">International Recognition</h3>
                    <p class="recognition-description">
                        Global acknowledgment for contribution to early childhood education and child development.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="values-section">
        <div class="values-content">
            <h2 class="section-title">Our Core Values</h2>
            <div class="values-grid">
                <div class="values-text">
                    <h3>What Drives Us Forward</h3>
                    <p>
                        Our values are the foundation of everything we do. They guide our interactions with children, parents, educators, and communities, ensuring that we remain true to our mission of providing exceptional early childhood education.
                    </p>
                    <ul class="values-list">
                        <li>
                            <i class="fas fa-heart"></i>
                            <div class="value-content">
                                <h4>Child-Centric Approach</h4>
                                <p>Every decision we make puts the child's well-being, development, and happiness at the center.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-lightbulb"></i>
                            <div class="value-content">
                                <h4>Innovation & Excellence</h4>
                                <p>We continuously evolve our methods and maintain the highest standards in early education.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-hands-helping"></i>
                            <div class="value-content">
                                <h4>Community Partnership</h4>
                                <p>Building strong relationships with families and communities for holistic child development.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            <div class="value-content">
                                <h4>Safety & Trust</h4>
                                <p>Creating a secure, nurturing environment where children can explore and learn fearlessly.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="values-image">
                    <img src="https://images.unsplash.com/photo-1503676382389-4809596d5290?w=600&h=450&fit=crop" alt="Children learning together">
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team-section">
        <div class="team-content">
            <h2 class="section-title">Meet Our Leadership Team</h2>
            <div class="team-intro">
                <p>
                    Our passionate leadership team combines decades of experience in education, child development, and business innovation. Together, they guide TinyTechnoToddlers in its mission to transform early childhood education.
                </p>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <img src="assets/img/member1.webp" alt="Mrs. Hamsa Kumari" class="team-photo">
                    <h3 class="team-name">Mrs. Hamsa Kumari</h3>
                    <p class="team-role">Founder & Chief Executive Officer</p>
                    <p class="team-description">
                        Visionary leader with 25+ years in early childhood education. Mrs. Hamsa Kumari pioneered the PENTEMIND methodology and has been instrumental in TinyTechnoToddlers' growth.
                    </p>
                    <!-- <div class="team-social">
                        <a href="linkedin.com" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="x.com" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="mail.com" class="social-link"><i class="fas fa-envelope"></i></a>
                    </div> -->
                </div>
                <div class="team-member">
                    <img src="assets/img/member2.webp" alt="Mr. Raghavendra" class="team-photo">
                    <h3 class="team-name">Mr. Raghavendra</h3>
                    <p class="team-role">Academic Head & Curriculum Director</p>
                    <p class="team-description">
                        Expert in curriculum design with 20+ years experience. Leads our academic excellence initiatives and teacher training programs across all centers.
                    </p>
                    <!-- <div class="team-social">
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                    </div> -->
                </div>
                <!-- <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop&crop=face" alt="Ms. Anjali Mehta" class="team-photo">
                    <h3 class="team-name">Ms. Anjali Mehta</h3>
                    <p class="team-role">Chief Operations Officer</p>
                    <p class="team-description">
                        Operations expert ensuring quality standards across all centers. Specializes in franchise development and maintaining educational excellence.
                    </p>
                    <div class="team-social">
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face" alt="Mr. Suresh Patil" class="team-photo">
                    <h3 class="team-name">Mr. Suresh Patil</h3>
                    <p class="team-role">Head of Child Safety & Development</p>
                    <p class="team-description">
                        Child safety specialist ensuring secure, nurturing environments. Develops safety protocols and child protection policies across all facilities.
                    </p>
                    <div class="team-social">
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Join the TinyTechnoToddlers Family?</h2>
            <p>
                Experience the difference that 20+ years of excellence in early childhood education can make. Give your child the best foundation for lifelong learning and success.
            </p>
            <div class="cta-buttons">
                <a href="admissions.php" class="cta-button cta-primary">
                    <i class="fas fa-graduation-cap"></i>
                    Apply for Admission
                </a>
                <a href="contact.php" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Contact Us
                </a>
                <a href="partner_portal/index.php" class="cta-button cta-secondary">
                    <i class="fas fa-handshake"></i>
                    Franchise Inquiry
                </a>
            </div>
        </div>
    </section>
</main>

<script>
// Smooth scroll for navigation links
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

// Add animation on scroll
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

// Initialize animations for cards
document.querySelectorAll('.vm-card, .legacy-card, .recognition-card, .team-member').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
    observer.observe(card);
});
</script>

<?php include 'includes/footer.php'; ?>

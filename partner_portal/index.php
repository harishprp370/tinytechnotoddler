<?php 
$page_title = "Franchise Opportunities";
$page_description = "Start your own TinyTechnoToddlers preschool franchise. Join India's largest preschool chain with proven business model and comprehensive support.";
include 'header.php'; 
?>

<style>
/* Enhanced Hero Section */
.franchise-hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 50%, #9B5CC7 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 60px 20px;
}

.franchise-hero::before {
    content: '';
    position: absolute;
    top: -30%;
    right: -25%;
    width: 800px;
    height: 800px;
    background: conic-gradient(from 0deg, rgba(255, 215, 0, 0.3), rgba(255, 193, 7, 0.2), rgba(255, 235, 59, 0.15), rgba(255, 215, 0, 0.25));
    border-radius: 50%;
    z-index: 1;
    animation: heroRotate 25s ease-in-out infinite;
    filter: blur(1px);
}

.franchise-hero::after {
    content: '';
    position: absolute;
    bottom: -20%;
    left: -15%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, rgba(255, 193, 7, 0.15) 40%, transparent 70%);
    border-radius: 60% 40% 50% 70%;
    z-index: 1;
    animation: heroMorph 20s ease-in-out infinite reverse;
}

@keyframes heroRotate {
    0%, 100% {
        transform: rotate(0deg) scale(1);
        border-radius: 50% 40% 60% 50%;
    }
    25% {
        transform: rotate(90deg) scale(1.05);
        border-radius: 40% 60% 50% 40%;
    }
    50% {
        transform: rotate(180deg) scale(0.95);
        border-radius: 60% 40% 40% 60%;
    }
    75% {
        transform: rotate(270deg) scale(1.02);
        border-radius: 40% 50% 60% 40%;
    }
}

@keyframes heroMorph {
    0%, 100% {
        transform: translateY(0px) scale(1) rotate(0deg);
        border-radius: 60% 40% 50% 70%;
    }
    25% {
        transform: translateY(-20px) scale(1.1) rotate(5deg);
        border-radius: 50% 60% 40% 50%;
    }
    50% {
        transform: translateY(10px) scale(0.9) rotate(-3deg);
        border-radius: 40% 50% 70% 40%;
    }
    75% {
        transform: translateY(-10px) scale(1.05) rotate(2deg);
        border-radius: 70% 40% 50% 60%;
    }
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    position: relative;
    z-index: 3;
}

.hero-text h1 {
    font-family: 'Fredoka', sans-serif;
    font-size: 4rem;
    color: #FFD700;
    margin-bottom: 25px;
    line-height: 1.1;
    font-weight: 800;
    text-shadow: 
        0 0 20px rgba(255, 215, 0, 0.5),
        0 4px 8px rgba(0,0,0,0.3),
        2px 2px 0px #B8860B;
    letter-spacing: -1px;
}

.hero-subtitle {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.6rem;
    margin-bottom: 20px;
    font-weight: 600;
    background: linear-gradient(45deg, #FFD700, #FFFFFF, #FFD700);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.hero-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 35px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.hero-stats {
    display: flex;
    gap: 35px;
    margin-bottom: 45px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 20px 15px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 120px;
}

.stat-item:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 
        0 15px 45px rgba(255, 215, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    border-color: #FFD700;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    color: #FFD700;
    font-family: 'Fredoka', sans-serif;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.5);
    margin-bottom: 5px;
}

.stat-label {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    margin-top: 5px;
    font-weight: 500;
}

.hero-actions {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.cta-button {
    padding: 18px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.2rem;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    box-shadow: 
        0 8px 25px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.cta-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.cta-button:hover::before {
    left: 100%;
}

.cta-primary {
    background: linear-gradient(135deg, #FFD700, #FFA000);
    color: #5B2D8F;
    font-weight: 800;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.cta-primary:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
        0 15px 40px rgba(255, 215, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.cta-secondary {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    border: 2px solid rgba(255, 215, 0, 0.5);
    backdrop-filter: blur(10px);
}

.cta-secondary:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: #FFD700;
    color: #FFD700;
    transform: translateY(-4px) scale(1.05);
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

.hero-image-wrapper {
    position: relative;
    z-index: 4;
    perspective: 1000px;
}

.hero-image {
    width: 100%;
    max-width: 580px;
    height: auto;
    border-radius: 25px;
    box-shadow: 
        0 25px 80px rgba(0,0,0,0.3),
        0 0 0 1px rgba(255, 215, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    border: 6px solid rgba(255, 215, 0, 0.4);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.hero-image:hover {
    transform: rotateY(5deg) scale(1.02);
    box-shadow: 
        0 35px 100px rgba(0,0,0,0.4),
        0 0 60px rgba(255, 215, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.2);
}

/* Why Partner Section */
.why-partner-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.why-partner-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    text-align: center;
    margin-bottom: 50px;
    position: relative;
    display: inline-block;
    width: 100%;
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
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.feature-card {
    background: white;
    border-radius: 20px;
    padding: 35px 25px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    position: relative;
    text-align: center;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
    border-radius: 20px 20px 0 0;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 28px;
    color: white;
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
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

/* Investment Section */
.investment-section {
    padding: 80px 0;
    background: white;
}

.investment-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.investment-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-top: 50px;
}

.investment-text h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 25px;
}

.investment-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.investment-highlights {
    list-style: none;
    padding: 0;
}

.investment-highlights li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 15px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(107, 44, 145, 0.05);
}

.investment-highlights li i {
    color: #FFD700;
    font-size: 20px;
    margin-right: 15px;
    width: 25px;
}

.investment-highlights li span {
    color: #555;
    font-size: 1rem;
    line-height: 1.5;
}

.investment-packages {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.package-card {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.package-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFC107);
}

.package-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(107, 44, 145, 0.3);
}

.package-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.5rem;
    color: #FFD700;
    margin-bottom: 15px;
    font-weight: 700;
}

.package-investment {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
    font-family: 'Fredoka', sans-serif;
}

.package-subtitle {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.package-features {
    list-style: none;
    padding: 0;
    text-align: left;
}

.package-features li {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.package-features li i {
    color: #FFD700;
    font-size: 14px;
}

/* Process Section */
.process-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
}

.process-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.process-step {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    transition: all 0.3s ease;
}

.process-step:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    border-color: #FFD700;
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    font-weight: 700;
    color: #5B2D8F;
    font-family: 'Fredoka', sans-serif;
}

.step-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.2rem;
    color: #FFD700;
    margin-bottom: 10px;
    font-weight: 600;
}

.step-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Support Section */
.support-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
}

.support-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.support-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.support-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
    text-align: center;
}

.support-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #6B2C91, #FFD700);
    border-radius: 20px 20px 0 0;
}

.support-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(107, 44, 145, 0.15);
    border-color: #FFD700;
}

.support-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 24px;
    color: #5B2D8F;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

/* CTA Section */
.final-cta-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
    text-align: center;
    position: relative;
}

.final-cta-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.final-cta-section h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #FFD700;
    margin-bottom: 25px;
}

.final-cta-section p {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 40px;
    color: rgba(255, 255, 255, 0.9);
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .franchise-hero {
        padding: 100px 20px 60px;
        min-height: 80vh;
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
    
    .investment-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .features-grid,
    .process-grid,
    .support-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .cta-button {
        padding: 15px 30px;
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .franchise-hero,
    .why-partner-section,
    .investment-section,
    .process-section,
    .support-section,
    .final-cta-section {
        padding: 60px 0;
    }
}
</style>

<main>
    <section class="franchise-hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Transform Lives, Build Wealth</h1>
                <p class="hero-subtitle">Join India's #1 Preschool Franchise</p>
                <p class="hero-description">
                    Partner with TinyTechnoToddlers and become part of India's largest preschool network. With 20+ years of proven success, comprehensive support, and a time-tested business model, your journey to educational entrepreneurship starts here.
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
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">20+</span>
                        <span class="stat-label">Years Legacy</span>
                    </div>
                </div> -->
                <div class="hero-actions">
                    <a href="interest_form.php" class="cta-button cta-primary">
                        <i class="fas fa-rocket"></i>
                        Start Your Franchise
                    </a>
                    <a href="#investment" class="cta-button cta-secondary">
                        <i class="fas fa-calculator"></i>
                        View Investment
                    </a>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <img src="../assets/img/franchise.jpg" alt="Successful franchise owners" class="hero-image">
            </div>
        </div>
    </section>

    <section class="why-partner-section">
        <div class="why-partner-content">
            <h2 class="section-title">Why Partner with TinyTechnoToddlers?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="feature-title">Market Leader</h3>
                    <p class="feature-description">
                        India's largest preschool chain with unmatched brand recognition and trust among parents nationwide.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Proven Business Model</h3>
                    <p class="feature-description">
                        Time-tested franchise model with 95% success rate and consistent profitability across all centers.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">PENTEMIND Pedagogy</h3>
                    <p class="feature-description">
                        Exclusive access to our scientifically-proven curriculum that ensures superior learning outcomes.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="feature-title">Comprehensive Support</h3>
                    <p class="feature-description">
                        End-to-end assistance from setup to operations, including training, marketing, and ongoing support.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="feature-title">Fast ROI</h3>
                    <p class="feature-description">
                        Quick return on investment with break-even typically achieved within 18-24 months of operation.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Protected Territory</h3>
                    <p class="feature-description">
                        Exclusive territorial rights ensuring no competition from other TinyTechnoToddlers centers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="investment" class="investment-section">
        <div class="investment-content">
            <h2 class="section-title">Investment Options</h2>
            <div class="investment-grid">
                <div class="investment-text">
                    <h3>Flexible Investment Models</h3>
                    <p>
                        We offer multiple franchise models to suit different investment capabilities and market opportunities. Each model comes with comprehensive support and proven systems.
                    </p>
                    <ul class="investment-highlights">
                        <li>
                            <i class="fas fa-rupee-sign"></i>
                            <span>Low initial investment with high returns</span>
                        </li>
                        <li>
                            <i class="fas fa-calendar-check"></i>
                            <span>Flexible payment terms and financing options</span>
                        </li>
                        <li>
                            <i class="fas fa-handshake"></i>
                            <span>No hidden costs or surprise fees</span>
                        </li>
                        <li>
                            <i class="fas fa-chart-pie"></i>
                            <span>Transparent revenue sharing model</span>
                        </li>
                    </ul>
                </div>
                <div class="investment-packages">
                    <div class="package-card">
                        <div class="package-title">Micro Center</div>
                        <div class="package-investment">₹1 lakh</div>
                        <div class="package-subtitle">min. 2400 sq ft</div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Brand Name usage – Tiny Techno Toddlers</li>
                            <li><i class="fas fa-check"></i> Interior setup ideas & guidance</li>
                            <li><i class="fas fa-check"></i> Soft copy – Flyers</li>
                            <li><i class="fas fa-check"></i> Soft copy – Banners </li>
                            <li><i class="fas fa-check"></i> Furniture for 30 students </li>
                            <li><i class="fas fa-check"></i> Learning material for 30 students </li>
                            <li><i class="fas fa-check"></i> Virtual training for teachers and admin </li>
                            <li><i class="fas fa-check"></i> Sample Tiny Techno Kid Kit for each class </li>
                            <li><i class="fas fa-check"></i> Monthly once virtual meeting for support </li>


                        </ul>
                    </div>
                    <div class="package-card">
                        <div class="package-title">Standard Center</div>
                        <div class="package-investment">₹3 Lakhs</div>
                        <div class="package-subtitle">2400 sq ft</div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Includes everything in the BASIC package PLUS</li>
                            <li><i class="fas fa-check"></i> Complete office setup </li>
                            <li><i class="fas fa-check"></i> 1 Digital TV 3. Tiny Lab Items (Activity learning material)</li>
                            <li><i class="fas fa-check"></i> Indoor play equipment</li>
                        </ul>
                    </div>
                    <div class="package-card">
                        <div class="package-title">Premium Center</div>
                        <div class="package-investment">₹5 Lakhs</div>
                        <div class="package-subtitle">2400+ sq ft</div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Includes everything in the STANDARD package PLUS</li>
                            <li><i class="fas fa-check"></i> Outdoor play equipment </li>
                            <li><i class="fas fa-check"></i> State Government Permission Assistance (Included)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="process-content">
            <h2 class="section-title" style="color: #FFD700;">Simple 6-Step Process</h2>
            <div class="process-grid">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Express Interest</h3>
                    <p class="step-description">Fill out our franchise interest form and schedule a preliminary discussion with our team.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Initial Screening</h3>
                    <p class="step-description">Background verification, financial assessment, and compatibility evaluation.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Site Selection</h3>
                    <p class="step-description">Location analysis, site approval, and feasibility study with our experts.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Agreement Signing</h3>
                    <p class="step-description">Franchise agreement finalization and initial investment processing.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3 class="step-title">Setup & Training</h3>
                    <p class="step-description">Complete center setup, staff recruitment, and comprehensive training programs.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">6</div>
                    <h3 class="step-title">Grand Opening</h3>
                    <p class="step-description">Center launch with marketing support and ongoing operational assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="support-section">
        <div class="support-content">
            <h2 class="section-title">Ongoing Support & Services</h2>
            <div class="support-grid">
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="feature-title">Training & Development</h3>
                    <p class="feature-description">
                        Continuous training programs for staff, regular workshops, and certification courses to maintain quality standards.
                    </p>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="feature-title">Marketing Support</h3>
                    <p class="feature-description">
                        National and local marketing campaigns, promotional materials, and digital marketing assistance.
                    </p>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="feature-title">Operational Guidance</h3>
                    <p class="feature-description">
                        Regular center visits, performance analysis, troubleshooting, and best practices sharing.
                    </p>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="feature-title">Technology Platform</h3>
                    <p class="feature-description">
                        Advanced management software, parent communication app, and digital learning resources.
                    </p>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="feature-title">Curriculum Updates</h3>
                    <p class="feature-description">
                        Regular curriculum enhancements, new program launches, and educational material updates.
                    </p>
                </div>
                <div class="support-card">
                    <div class="support-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p class="feature-description">
                        Round-the-clock helpline, dedicated relationship manager, and quick resolution of queries.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="final-cta-section">
        <div class="final-cta-content">
            <h2>Ready to Start Your Educational Empire?</h2>
            <p>
                Join the TinyTechnoToddlers family and be part of India's most successful preschool franchise network. With our proven systems, comprehensive support, and growing demand for quality early education, your success is guaranteed.
            </p>
            <div class="hero-actions">
                <a href="interest_form.php" class="cta-button cta-primary">
                    <i class="fas fa-rocket"></i>
                    Apply for Franchise
                </a>
                <a href="tel:+919739561697" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Call Now: +91 9739561697
                </a>
            </div>
        </div>
    </section>
</main>

<script>
// Enhanced animations and interactions
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = counter.textContent;
            const numericValue = parseInt(target.replace(/[^\d]/g, ''));
            let current = 0;
            const increment = numericValue / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= numericValue) {
                    counter.textContent = target;
                    clearInterval(timer);
                } else {
                    if (target.includes('%')) {
                        counter.textContent = Math.floor(current) + '%';
                    } else if (target.includes('+')) {
                        counter.textContent = Math.floor(current) + '+';
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }
            }, 20);
        });
    }

    // Trigger counter animation when hero section is visible
    const heroObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                heroObserver.unobserve(entry.target);
            }
        });
    });

    heroObserver.observe(document.querySelector('.franchise-hero'));

    // Smooth scroll for anchor links
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

    // Card hover effects
    document.querySelectorAll('.feature-card, .package-card, .process-step, .support-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

<?php include 'footer.php'; ?>

<?php
$page_key = 'home';
include 'includes/header.php';
?>

<style>
/* Hero Section with Enhanced Design - UNIQUE FOR HOME PAGE */
.hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 50%, #9B5CC7 100%);
    position: relative;
    overflow: hidden;
    padding: 120px 20px 60px;
    display: flex;
    align-items: center;
    margin-top: 0;
}

/* Multiple animated background elements for visual impact */
.hero::before {
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

.hero::after {
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

/* Additional floating orbs for depth */
.hero-orb-1, .hero-orb-2, .hero-orb-3 {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%, rgba(255, 215, 0, 0.4), rgba(255, 193, 7, 0.2));
    z-index: 1;
    animation: float-gentle 15s ease-in-out infinite;
}

.hero-orb-1 {
    width: 120px;
    height: 120px;
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.hero-orb-2 {
    width: 80px;
    height: 80px;
    top: 60%;
    right: 25%;
    animation-delay: -5s;
}

.hero-orb-3 {
    width: 150px;
    height: 150px;
    bottom: 20%;
    left: 5%;
    animation-delay: -10s;
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

@keyframes float-gentle {
    0%, 100% {
        transform: translateY(0px) translateX(0px);
    }
    33% {
        transform: translateY(-20px) translateX(10px);
    }
    66% {
        transform: translateY(10px) translateX(-10px);
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

/* Enhanced typography for maximum impact */
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
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
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
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
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
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.4s;
}

/* Enhanced stats with glassmorphism effect */
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
    opacity: 0;
    transform: translateY(30px) scale(0.9);
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

/* Premium action buttons */
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
    opacity: 0;
    transform: translateY(30px);
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

/* Enhanced image section with 3D effect */
.hero-image-wrapper {
    position: relative;
    z-index: 9999;
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
    opacity: 1;
    transform: translateX(0) scale(1);
    position: relative;
    overflow: hidden;
    display: block;
}

.hero-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, transparent 50%);
    z-index: 1;
    opacity: 0;
    transition: opacity 0.4s;
    pointer-events: none;
}

.hero-image:hover {
    transform: translateX(0) scale(1.02) rotateY(5deg);
    box-shadow: 
        0 35px 100px rgba(0,0,0,0.4),
        0 0 60px rgba(255, 215, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.2);
}

.hero-image:hover::before {
    opacity: 1;
}

/* Decorative elements around the image */
.hero-image-wrapper::before,
.hero-image-wrapper::after {
    content: '';
    position: absolute;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 1;
    animation: pulse 4s ease-in-out infinite;
}

.hero-image-wrapper::before {
    top: -20px;
    right: -20px;
    animation-delay: 0s;
}

.hero-image-wrapper::after {
    bottom: -20px;
    left: -20px;
    animation-delay: 2s;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.6;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.9;
    }
}

/* About Section Enhanced */
.about {
    padding: 80px 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    position: relative;
    overflow: hidden;
}

.about-content {
    max-width: 1200px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
}

.section-header h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.section-header h2::after {
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

.section-header p {
    color: #666;
    font-size: 1.1rem;
    max-width: 800px;
    margin: 20px auto 0;
    line-height: 1.6;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 40px;
}

.about-image-wrapper {
    position: relative;
    text-align: center;
}

.about-image {
    width: 100%;
    max-width: 600px;
    height: 450px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(107, 44, 145, 0.2);
    border: 4px solid #FFD700;
    position: relative;
    z-index: 2;
    margin: 0 auto;
}

.about-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.about-text h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    color: #6B2C91;
    margin-bottom: 25px;
    font-weight: 600;
}

.about-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 1rem;
    text-align: justify;
}

.about-features {
    list-style: none;
    padding: 0;
    margin: 30px 0;
}

.about-features li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 15px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(107, 44, 145, 0.05);
    border-left: 4px solid #FFD700;
}

.about-features li i {
    color: #6B2C91;
    font-size: 20px;
    margin-right: 15px;
    width: 25px;
}

.about-features li span {
    color: #555;
    font-weight: 500;
}

.learn-more-btn {
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.learn-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(107, 44, 145, 0.3);
    background: linear-gradient(135deg, #5B2D8F, #7B3FA0);
}

/* Programs Section Enhanced */
.programs-preview {
    padding: 80px 20px;
    background: white;
    text-align: center;
}

.programs-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 40px auto 0;
    max-width: 1800px;
    justify-items: center;
}

.program-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(107, 44, 145, 0.1);
    overflow: hidden;
    position: relative;
    width: 100%;
    max-width: 350px;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    transition: all 0.3s ease;
    border: 2px solid #f8f9ff;
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
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.program-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.program-card:hover .program-img img {
    transform: scale(1.05);
}

.program-icon {
    position: absolute;
    top: 160px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #6B2C91, #8E44AD);
    color: #FFD700;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 15px rgba(107, 44, 145, 0.3);
    border: 4px solid #fff;
    z-index: 3;
}

.program-content {
    padding: 50px 25px 25px 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    position: relative;
}

.program-content h3 {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.5rem;
    color: #6B2C91;
    margin-bottom: 12px;
    font-weight: 700;
    text-align: center;
}

.program-content p {
    color: #555;
    font-size: 1rem;
    margin-bottom: 15px;
    text-align: center;
    line-height: 1.6;
    flex: 1;
}

.program-link {
    color: #6B2C91;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 20px;
    font-size: 1rem;
    text-align: center;
    display: block;
    transition: color 0.3s;
    padding: 10px 20px;
    border: 2px solid #6B2C91;
    border-radius: 25px;
}

.program-link:hover {
    background: #6B2C91;
    color: white;
}

.program-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px 15px;
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #666;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 15px;
    border-radius: 10px;
}

.detail-label {
    font-weight: 600;
    color: #6B2C91;
    display: block;
}

.detail-value {
    color: #555;
    font-weight: 500;
    display: block;
}

.program-note {
    font-size: 0.8rem;
    color: #888;
    text-align: center;
    margin-top: 10px;
    font-style: italic;
}

/* Why Choose Section Enhanced */
.why-choose-section {
    padding: 80px 20px;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
    text-align: center;
}

.why-choose-content {
    max-width: 1200px;
    margin: 0 auto;
}

.why-choose-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.feature-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    border-color: #FFD700;
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #FFD700, #FFC107);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 28px;
    color: #5B2D8F;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
}

.feature-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 1.4rem;
    color: #FFD700;
    margin-bottom: 15px;
    font-weight: 600;
}

.feature-description {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    font-size: 1rem;
}

/* Franchise Section Enhanced */
.franchise-section {
    padding: 80px 20px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.franchise-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.franchise-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    font-weight: 700;
    margin-bottom: 20px;
}

.franchise-subtitle {
    font-size: 1.3rem;
    color: #8E44AD;
    margin-bottom: 30px;
    font-weight: 500;
}

.franchise-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin: 40px 0;
    flex-wrap: wrap;
}

.franchise-stat {
    text-align: center;
}

.franchise-stat-number {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    font-weight: 700;
    display: block;
}

.franchise-stat-label {
    color: #666;
    font-weight: 500;
    margin-top: 5px;
}

.franchise-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin: 50px 0;
}

.franchise-feature {
    background: white;
    padding: 30px 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(107, 44, 145, 0.1);
    border: 2px solid #f8f9ff;
    transition: all 0.3s ease;
}

.franchise-feature:hover {
    transform: translateY(-5px);
    border-color: #FFD700;
    box-shadow: 0 10px 30px rgba(107, 44, 145, 0.15);
}

.franchise-feature h4 {
    color: #6B2C91;
    font-family: 'Fredoka', sans-serif;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.franchise-feature p {
    color: #666;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* FAQ Section Enhanced */
.faq-section {
    padding: 80px 20px;
    background: white;
    text-align: center;
}

.faq-header {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 50px;
    font-weight: 700;
}

.faq-list {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(107, 44, 145, 0.08);
    border: 2px solid #e8ebff;
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
    font-family: 'Fredoka', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    padding: 20px 25px;
    text-align: left;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    outline: none;
    transition: background 0.3s;
}

.faq-question:hover {
    background: rgba(255, 255, 255, 0.5);
}

.faq-arrow {
    color: #FFD700;
    font-size: 1.2rem;
    transition: transform 0.3s;
}

.faq-answer {
    background: white;
    color: #555;
    font-size: 1rem;
    padding: 0 25px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
    line-height: 1.6;
}

.faq-item.open .faq-answer {
    max-height: 200px;
    padding: 20px 25px;
}

.faq-item.open .faq-arrow {
    transform: rotate(180deg);
}

/* Testimonials Section */
.testimonials-section {
    padding: 80px 20px;
    background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
    color: white;
    text-align: center;
}

.testimonials-content {
    max-width: 1200px;
    margin: 0 auto;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 60px;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    text-align: left;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.testimonial-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 20px;
    font-style: italic;
    color: rgba(255, 255, 255, 0.9);
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #FFD700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #5B2D8F;
}

.author-info h4 {
    color: #FFD700;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.author-info p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    margin: 0;
}

/* CTA Section */
.cta-section {
    padding: 80px 20px;
    background: white;
    text-align: center;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
}

.cta-section h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 2.5rem;
    color: #6B2C91;
    margin-bottom: 25px;
}

.cta-section p {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 40px;
    color: #666;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .hero {
        padding: 100px 20px 40px;
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
    
    .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .about-image {
        margin: 0 auto;
    }
    
    .programs-cards {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .why-choose-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .franchise-features {
        grid-template-columns: 1fr;
    }
    
    .franchise-stats {
        gap: 20px;
    }
    
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .section-header h2 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .program-content {
        padding: 40px 20px 20px;
    }
    
    .program-details {
        grid-template-columns: 1fr;
        gap: 8px;
        text-align: center;
    }
    
    .faq-question {
        font-size: 1rem;
        padding: 15px 20px;
    }
    
    .feature-card,
    .testimonial-card {
        padding: 25px 20px;
    }
}
</style>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Build a Foundation for a Lifetime of Learning</h1>
                <p class="hero-subtitle">India's Leading Preschool Chain</p>
                <p class="hero-description">
                    Give your child the best start in life with our scientifically-proven PENTEMIND methodology. Over 20 years of excellence in early childhood education, nurturing young minds across India and Nepal.
                </p>
                <!-- <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">2000+</span>
                        <span class="stat-label">Centers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1.5M+</span>
                        <span class="stat-label">Children Nurtured</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">750+</span>
                        <span class="stat-label">Cities</span>
                    </div>
                </div> -->
                <div class="hero-actions">
                    <a href="admissions.php" class="cta-button cta-primary">
                        <i class="fas fa-graduation-cap"></i>
                        Enroll Now
                    </a>
                    <a href="#about" class="cta-button cta-secondary">
                        <i class="fas fa-play"></i>
                        Watch Video
                    </a>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=600&h=500&fit=crop&crop=faces" alt="Happy children learning" class="hero-image">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-content">
            <div class="section-header">
                <h2>About Tiny Techno Toddlers</h2>
                <p>Leading the way in early childhood education with innovative teaching methods and a commitment to nurturing every child's potential.</p>
            </div>
            <div class="about-grid">
                <div class="about-image-wrapper">
                    <div class="about-image">
                        <img src="assets/img/about.webp" alt="Tiny Techno Toddlers Preschool">
                    </div>
                </div>
                <div class="about-text">
                    <h3>India's Most Trusted Preschool Brand</h3>
                    <p>Tiny Techno Toddlers Preschool is a leading chain of preschools backed by V-Techno T3 Academy India Private Limited. With more than two decades of experience in the preschool industry, we have nurtured more than 1.5 million children throughout India and Nepal.</p>
                    
                    <ul class="about-features">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>20+ years of proven excellence in early childhood education</span>
                        </li>
                        <li>
                            <i class="fas fa-award"></i>
                            <span>PENTEMIND pedagogy for holistic child development</span>
                        </li>
                        <li>
                            <i class="fas fa-users"></i>
                            <span>Expert educators trained in child psychology</span>
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            <span>Safe and nurturing learning environment</span>
                        </li>
                    </ul>
                    
                    <p>Our Business Partners don't just take the name, they also take our pedagogy, guidelines, and proven methodologies to create exceptional learning experiences for children.</p>
                    
                    <a href="about.php" class="learn-more-btn">
                        <i class="fas fa-arrow-right"></i>
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="programs-preview">
        <div class="section-header">
            <h2>Our Educational Programs</h2>
            <p>Age-appropriate curriculum designed to nurture every child's potential through our scientifically-proven PENTEMIND methodology.</p>
        </div>
        
        <div class="programs-cards">
            <!-- PlayGroup Card -->
            <div class="program-card">
                <div class="program-img">
                    <img src="assets/img/playgroup.jpg" alt="PlayGroup">
                </div>
                <div class="program-icon"><i class="fas fa-child"></i></div>
                <div class="program-content">
                    <h3>PlayGroup</h3>
                    <p>Where little explorers begin their learning journey through play, discovery, and joyful experiences. Perfect for curious toddlers ready to explore the world.</p>
                    <a href="playgroup.php" class="program-link">Learn More</a>
                    <div class="program-details">
                        <div>
                            <span class="detail-label">Age Group</span>
                            <span class="detail-value">2 – 3 Years</span>
                        </div>
                        <div>
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">3 Hours/Day</span>
                        </div>
                    </div>
                    <div class="program-note">(Duration: 4 Hours/Day)</div>
                </div>
            </div>

            <!-- Nursery Card -->
            <div class="program-card">
                <div class="program-img">
                    <img src="assets/img/nursery.jpg" alt="Nursery">
                </div>
                <div class="program-icon"><i class="fas fa-book-reader"></i></div>
                <div class="program-content">
                    <h3>Nursery</h3>
                    <p>A vibrant learning environment fostering creativity, social skills, and foundational knowledge. Ideal for young learners eager to expand their horizons.</p>
                    <a href="nursery.php" class="program-link">Learn More</a>
                    <div class="program-details">
                        <div>
                            <span class="detail-label">Age Group</span>
                            <span class="detail-value">3 – 4 Years</span>
                        </div>  
                        <div>
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">4 Hours/Day</span>
                        </div>
                    </div>
                    <div class="program-note">(Duration: 4 Hours/Day)</div>
                </div>
            </div>

            <!-- Kindergarten Card -->
            <div class="program-card">
                <div class="program-img">
                    <img src="assets/img/learning.jpg" alt="Kindergarten">
                </div>
                <div class="program-icon"><i class="fas fa-school"></i></div>
                <div class="program-content">
                    <h3>Kindergarten</h3>
                    <p>A dynamic curriculum preparing children for formal schooling with a focus on critical thinking, problem-solving, and social-emotional skills. Perfect for confident young learners.</p>
                    <a href="kindergarten.php" class="program-link">Learn More</a>
                    <div class="program-details">
                        <div>
                            <span class="detail-label">Age Group</span>
                            <span class="detail-value">4 – 6 Years</span>
                        </div>
                        <div>
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">5 Hours/Day</span>
                        </div>
                    </div>
                    <div class="program-note">(Duration: 5 Hours/Day)</div>
                </div>
            </div>

            <!-- Teacher Training Card -->
            <div class="program-card">
                <div class="program-img">
                    <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=600&h=400&fit=crop&crop=faces" alt="Teacher Training">
                </div>
                <div class="program-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="program-content">
                    <h3>Teacher Training</h3>
                    <p>Comprehensive certification program setting industry standards in Early Childhood Care & Education. Transform your passion into professional expertise.</p>
                    <a href="teacher-training.php" class="program-link">Learn More</a>
                    <div class="program-details">
                        <div>
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">30-120 Hours</span>
                        </div>
                        <div>
                            <span class="detail-label">Certification</span>
                            <span class="detail-value">National</span>
                        </div>
                    </div>
                    <div class="program-note">Multiple program tracks available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-choose-section">
        <div class="why-choose-content">
            <div class="section-header">
                <h2 style="color: #FFD700;">Why Choose Tiny Techno Toddlers?</h2>
                <p style="color: rgba(255, 255, 255, 0.9);">Experience the difference that 20+ years of excellence in early childhood education can make for your child's future.</p>
            </div>
            <div class="why-choose-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">PENTEMIND Pedagogy</h3>
                    <p class="feature-description">
                        Our scientifically designed curriculum ensures holistic development across cognitive, social, emotional, and physical domains.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Expert Educators</h3>
                    <p class="feature-description">
                        Highly qualified and trained teachers who understand child psychology and development milestones.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Safe Environment</h3>
                    <p class="feature-description">
                        Child-safe infrastructure, CCTV monitoring, and strict safety protocols to ensure your child's well-being.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="feature-title">Proven Excellence</h3>
                    <p class="feature-description">
                        Over 20 years of experience with a track record of nurturing more than 1.5 million children successfully.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="feature-title">Nationwide Presence</h3>
                    <p class="feature-description">
                        2000+ centers across 750+ cities, making quality early education accessible wherever you are.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="feature-title">Parent Partnership</h3>
                    <p class="feature-description">
                        Regular communication, progress updates, and parent involvement activities to support your child's growth.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Franchise Section -->
    <section id="franchise" class="franchise-section">
        <div class="franchise-content">
            <h2 class="franchise-title">Franchise Opportunity</h2>
            <p class="franchise-subtitle">Start Your Own Preschool Today!</p>
            
            <!-- <div class="franchise-stats">
                <div class="franchise-stat">
                    <span class="franchise-stat-number">2000+</span>
                    <span class="franchise-stat-label">Centers</span>
                </div>
                <div class="franchise-stat">
                    <span class="franchise-stat-number">750+</span>
                    <span class="franchise-stat-label">Cities</span>
                </div>
                <div class="franchise-stat">
                    <span class="franchise-stat-number">20+</span>
                    <span class="franchise-stat-label">Years Experience</span>
                </div>
            </div> -->

            <div class="franchise-features">
                <div class="franchise-feature">
                    <h4>Market Leadership</h4>
                    <p>India's largest preschool chain with strong brand recall and 20+ years of proven success in early childhood education.</p>
                </div>
                <div class="franchise-feature">
                    <h4>Proven Business Model</h4>
                    <p>Time-tested franchise model with comprehensive support systems ensuring profitable and sustainable operations.</p>
                </div>
                <div class="franchise-feature">
                    <h4>PENTEMIND Pedagogy</h4>
                    <p>Access to our proprietary curriculum and teaching methodology that ensures quality education and parent satisfaction.</p>
                </div>
                <div class="franchise-feature">
                    <h4>Complete Support</h4>
                    <p>End-to-end support including setup, training, operations, academics, and marketing to ensure your success.</p>
                </div>
            </div>

            <div class="hero-actions">
                <a href="partner_portal/index.php" class="cta-button cta-primary">
                    <i class="fas fa-handshake"></i>
                    Start a Franchise
                </a>
                <a href="contact.php" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Get in Touch
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="testimonials-content">
            <div class="section-header">
                <h2 style="color: #FFD700;">What Parents Say</h2>
                <p style="color: rgba(255, 255, 255, 0.9);">Hear from families who have experienced the Tiny Techno Toddlers difference.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"The PENTEMIND approach has truly transformed my daughter's learning experience. She's more confident, creative, and excited about learning every day."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">P</div>
                        <div class="author-info">
                            <h4>Priya Sharma</h4>
                            <p>Parent - Nursery Student</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Excellent faculty, safe environment, and the best curriculum. My son has developed amazing social skills and is well-prepared for primary school."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">R</div>
                        <div class="author-info">
                            <h4>Rajesh Kumar</h4>
                            <p>Parent - Senior KG Student</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"The teacher training program equipped me with modern teaching techniques. I feel confident and prepared to nurture young minds effectively."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">A</div>
                        <div class="author-info">
                            <h4>Anjali Mehta</h4>
                            <p>Certified Teacher</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <h2 class="faq-header">Frequently Asked Questions</h2>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question">
                    What is the PENTEMIND methodology?
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    PENTEMIND is our scientifically-designed pedagogy that focuses on five key areas of child development: cognitive, social-emotional, physical, creative, and communication skills, ensuring holistic growth.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    What age groups do you cater to?
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    We offer programs for children aged 2-6 years: PlayGroup (2-3 years), Nursery (3-4 years), Junior KG (4-5 years), and Senior KG (5-6 years), all aligned with NEP 2020.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How can I enroll my child?
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    You can fill out our admission enquiry form, schedule a school visit, or call us directly. Our admissions team will guide you through the simple enrollment process.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    What safety measures do you have in place?
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    We maintain strict safety protocols including CCTV monitoring, child-safe infrastructure, trained security staff, and regular safety audits to ensure a secure learning environment.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    How do you keep parents involved in their child's progress?
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    We maintain regular communication through parent-teacher meetings, progress reports, educational events, and digital updates to keep you informed about your child's development.
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Give Your Child the Best Start?</h2>
            <p>
                Join thousands of families who have chosen Tiny Techno Toddlers for their child's early education. Experience the difference that quality education and caring teachers can make.
            </p>
            <div class="cta-buttons">
                <a href="admissions.php" class="cta-button cta-primary">
                    <i class="fas fa-graduation-cap"></i>
                    Apply for Admission
                </a>
                <a href="contact.php" class="cta-button cta-secondary">
                    <i class="fas fa-phone"></i>
                    Schedule a Visit
                </a>
            </div>
        </div>
    </section>
</main>

<script>
// Smooth scroll for navigation
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

// FAQ toggle functionality
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', function() {
        const item = this.closest('.faq-item');
        const isOpen = item.classList.contains('open');
        
        // Close all items
        document.querySelectorAll('.faq-item').forEach(faqItem => {
            faqItem.classList.remove('open');
        });
        
        // Open clicked item if it wasn't already open
        if (!isOpen) {
            item.classList.add('open');
        }
    });
});

// Animation on scroll for cards
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
document.querySelectorAll('.program-card, .feature-card, .testimonial-card, .franchise-feature').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
    observer.observe(card);
});

// Hero stats counter animation
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    function updateCounter() {
        start += increment;
        if (start < target) {
            element.textContent = Math.floor(start) + '+';
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target + '+';
        }
    }
    
    updateCounter();
}

// Trigger counter animation when hero is in view
const heroObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            document.querySelectorAll('.stat-number').forEach(stat => {
                const text = stat.textContent;
                if (text.includes('2000')) {
                    animateCounter(stat, 2000);
                } else if (text.includes('1.5M')) {
                    stat.textContent = '1.5M+';
                } else if (text.includes('750')) {
                    animateCounter(stat, 750);
                }
            });
            heroObserver.unobserve(entry.target);
        }
    });
});

heroObserver.observe(document.querySelector('.hero'));

// Enhanced hero animations
const heroTitle = document.querySelector('.hero-text h1');
const heroSubtitle = document.querySelector('.hero-subtitle');
const heroDescription = document.querySelector('.hero-description');
const heroStats = document.querySelectorAll('.stat-item');
const heroActions = document.querySelectorAll('.hero-actions .cta-button');
const heroImage = document.querySelector('.hero-image img');

// Stagger animations
setTimeout(() => {
    heroTitle.style.opacity = '1';
    heroTitle.style.transform = 'translateY(0)';
}, 100);

setTimeout(() => {
    heroSubtitle.style.opacity = '1';
    heroSubtitle.style.transform = 'translateY(0)';
}, 300);

setTimeout(() => {
    heroDescription.style.opacity = '1';
    heroDescription.style.transform = 'translateY(0)';
}, 500);

setTimeout(() => {
    heroStats.forEach((stat, index) => {
        setTimeout(() => {
            stat.style.opacity = '1';
            stat.style.transform = 'translateY(0) scale(1)';
        }, index * 100);
    });
}, 700);

setTimeout(() => {
    heroActions.forEach((action, index) => {
        setTimeout(() => {
            action.style.opacity = '1';
            action.style.transform = 'translateY(0)';
        }, index * 150);
    });
}, 1000);

setTimeout(() => {
    heroImage.style.opacity = '1';
    heroImage.style.transform = 'translateX(0) scale(1)';
}, 1200);

// Parallax effect for hero background
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero && scrolled < hero.offsetHeight) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Interactive floating elements
function createFloatingElement() {
    const element = document.createElement('div');
    element.className = 'floating-element';
    element.innerHTML = ['📚', '🎨', '🎵', '🌟', '🎭', '🧸'][Math.floor(Math.random() * 6)];
    element.style.cssText = `
        position: absolute;
        font-size: ${Math.random() * 20 + 20}px;
        opacity: 0.6;
        pointer-events: none;
        z-index: 1;
        animation: float ${Math.random() * 10 + 10}s infinite linear;
        left: ${Math.random() * 100}%;
        top: ${Math.random() * 100}%;
    `;
    
    document.querySelector('.hero').appendChild(element);
    
    setTimeout(() => {
        element.remove();
    }, 15000);
}

// Add floating elements periodically
setInterval(createFloatingElement, 3000);

// Add CSS animation for floating elements
const style = document.createElement('style');
style.textContent = `
@keyframes float {
    0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 0.6;
    }
    90% {
        opacity: 0.6;
    }
    100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
    }
}

.floating-element {
    animation: float 15s infinite linear;
}
`;
document.head.appendChild(style);
</script>

<?php include 'includes/footer.php'; ?>

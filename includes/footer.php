<footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Tiny Techno Toddlers</h3>
                <p>Building a foundation for lifelong learning through play-based education and nurturing care.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="programs.php">Our Programs</a></li>
                    <li><a href="admissions.php">Admissions</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="partner_portal/index.php">Partner Portal</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Programs</h3>
                <ul>
                    <li><a href="playgroup.php">Playgroup</a></li>
                    <li><a href="nursery.php">Nursery</a></li>
                    
                    <li><a href="kindergarten.php">Kindergarten</a></li>
                    <li><a href="teacher-training.php">Teacher Training Program</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="contact-list">
                    <li><i class="fas fa-map-marker-alt"></i> #102 above, Kai Ruchi Hotel, 3rd floor, Konanakunte Main Road, Bengaluru</li>
                    <li><i class="fas fa-phone"></i> +91 9739561697</li>
                    <li><i class="fas fa-phone"></i> +91 9739561245</li>
                    <li><i class="fas fa-envelope"></i> info@tinytechnotoddlers.com</li>
                    <li><i class="fas fa-clock"></i> Mon - Sat: 9:00 AM - 5:00 PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Tiny Techno Toddlers Preschool. All rights reserved.</p>
            <div class="footer-links">
                <a href="index.php">Home</a>
                <a href="admissions.php">Admissions</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </footer>

    <style>
        footer {
            background: #5B2D8F;
            color: white;
            padding: 60px 0 0;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: #FFD700;
            clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);
            z-index: 0;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        .footer-section h3 {
            font-family: 'Fredoka', sans-serif;
            font-size: 22px;
            margin-bottom: 20px;
            color: #FFD700;
        }

        .footer-section p {
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 12px;
            list-style: none;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s, padding-left 0.3s;
            display: inline-block;
        }

        .footer-section ul li a:hover {
            color: #FFD700;
            padding-left: 5px;
        }

        .contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }

        .contact-list i {
            color: #FFD700;
            margin-top: 3px;
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .footer-social a {
            width: 40px;
            height: 40px;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFD700;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: #FFD700;
            color: #5B2D8F;
            transform: translateY(-5px);
        }

        .footer-bottom {
            background: #4A2373;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
            color: #FFD700;
        }

        .footer-bottom i {
            color: #FF6B6B;
        }

        .footer-links {
            margin-top: 10px;
        }

        .footer-links a {
            color: #FFD700;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #FF6B6B;
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>

    <script>
        // Smooth scrolling
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

        // Active nav on scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const scrollY = window.pageYOffset;

            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 100;
                const sectionId = section.getAttribute('id');
                
                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    document.querySelectorAll('.nav-menu a').forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "TinyToddlers Preschool",
      "url": "https://tinytoddlers.com/",
      "logo": "/assets/img/logo.jpeg",
      "contactPoint": {
        "@type": "ContactPoint",
        "email": "info@tinytoddlers.com",
        "contactType": "customer service"
      }
    }
    </script>
</body>
</html>
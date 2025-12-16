<!-- Privacy policy of Tiny TechnoToddlers Franchise -->
<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Tiny TechnoToddlers Franchise</title>
    <link rel="stylesheet" href="../assets/css/partner_portal.css">
    <link rel="icon" href="../assets/img/franchiselogo.jpeg" type="image/jpeg">
</head>
<body>
    <?php include 'header.php'; ?>
    <style>
    .policy-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 60px 20px;
        background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
        min-height: 100vh;
    }

    .policy-header {
        background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
        color: white;
        padding: 50px 20px;
        border-radius: 20px;
        margin-bottom: 40px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(107, 44, 145, 0.2);
    }

    .policy-header h1 {
        font-family: 'Fredoka', sans-serif;
        font-size: 2.5rem;
        margin-bottom: 15px;
        font-weight: 700;
        color: #FFD700;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .policy-header p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    .policy-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(107, 44, 145, 0.1);
        line-height: 1.8;
    }

    .policy-section {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f0f0f0;
    }

    .policy-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .policy-section h2 {
        font-family: 'Fredoka', sans-serif;
        color: #6B2C91;
        font-size: 1.8rem;
        margin-bottom: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .policy-section h2::before {
        content: '';
        width: 6px;
        height: 30px;
        background: linear-gradient(180deg, #6B2C91, #FFD700);
        border-radius: 3px;
    }

    .policy-section h3 {
        font-family: 'Fredoka', sans-serif;
        color: #8E44AD;
        font-size: 1.3rem;
        margin-top: 25px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .policy-section p {
        color: #555;
        font-size: 1rem;
        margin-bottom: 15px;
        text-align: justify;
    }

    .policy-section ul, 
    .policy-section ol {
        margin: 15px 0 15px 30px;
        color: #555;
    }

    .policy-section ul li,
    .policy-section ol li {
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .policy-section ul li::marker {
        color: #FFD700;
        font-weight: 700;
    }

    .highlight-box {
        background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
        border-left: 4px solid #FFD700;
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
        color: #555;
    }

    .contact-info {
        background: linear-gradient(135deg, #6B2C91 0%, #8E44AD 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-top: 30px;
        text-align: center;
    }

    .contact-info h3 {
        color: #FFD700;
        margin-bottom: 20px;
        font-family: 'Fredoka', sans-serif;
    }

    .contact-info a {
        color: #FFD700;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .contact-info a:hover {
        text-decoration: underline;
        transform: scale(1.05);
        display: inline-block;
    }

    .last-updated {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        color: #856404;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .policy-header h1 {
            font-size: 2rem;
        }

        .policy-content {
            padding: 25px;
        }

        .policy-section h2 {
            font-size: 1.5rem;
        }

        .policy-section h3 {
            font-size: 1.1rem;
        }
    }
</style>

<main class="policy-container">
    <div class="policy-header">
        <h1>Privacy Policy</h1>
        <p>How we protect your personal information</p>
    </div>

    <div class="policy-content">
        <div class="last-updated">
            <strong>Last Updated:</strong> <?php echo date('F d, Y'); ?>
        </div>

        <div class="policy-section">
            <h2>Introduction</h2>
            <p>
                Welcome to TinyTechnoToddlers Franchise Portal ("we," "us," "our," or "Company"). TinyTechnoToddlers is committed to protecting your privacy and ensuring you have a positive experience on our website and services. This Privacy Policy explains our online information practices and the choices you can make about how your information is collected and used.
            </p>
            <p>
                If you have any questions about this Privacy Policy or our privacy practices, please contact us at the address provided at the end of this document.
            </p>
        </div>

        <div class="policy-section">
            <h2>1. Information We Collect</h2>
            
            <h3>Personal Information Provided By You</h3>
            <p>We collect information you provide directly to us, including:</p>
            <ul>
                <li><strong>Contact Information:</strong> Name, email address, phone number, mailing address</li>
                <li><strong>Business Information:</strong> Company name, business type, years of experience, educational background</li>
                <li><strong>Financial Information:</strong> Bank details (for payments and fund transfers), investment capacity</li>
                <li><strong>Document Information:</strong> Government-issued IDs, business licenses, property documents</li>
                <li><strong>Communication Data:</strong> Messages, inquiries, and correspondence you send us</li>
            </ul>

            <h3>Automatically Collected Information</h3>
            <p>When you visit our portal, we automatically collect:</p>
            <ul>
                <li>IP address and location data</li>
                <li>Device information (browser type, operating system)</li>
                <li>Usage data (pages visited, time spent, actions taken)</li>
                <li>Cookies and similar tracking technologies</li>
                <li>Referrer information</li>
            </ul>

            <h3>Information From Third Parties</h3>
            <p>We may receive information about you from:</p>
            <ul>
                <li>Business partners and affiliates</li>
                <li>Credit reference agencies</li>
                <li>Public databases and records</li>
                <li>Social media platforms (if you connect your accounts)</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>2. How We Use Your Information</h2>
            <p>We use the information we collect for various purposes:</p>
            <ul>
                <li><strong>To Process Your Application:</strong> Reviewing franchise applications, conducting background checks, verification of documents</li>
                <li><strong>To Provide Services:</strong> Facilitating franchise partnerships, managing accounts, providing support</li>
                <li><strong>Communication:</strong> Responding to inquiries, sending updates, important notices, and newsletters</li>
                <li><strong>Improvement:</strong> Analyzing usage patterns to improve our portal and services</li>
                <li><strong>Marketing:</strong> Sending promotional materials and information about new opportunities (with your consent)</li>
                <li><strong>Legal Compliance:</strong> Complying with legal obligations and enforcing agreements</li>
                <li><strong>Security:</strong> Detecting and preventing fraud, protecting against unauthorized access</li>
                <li><strong>Research:</strong> Conducting surveys and market research</li>
            </ul>

            <div class="highlight-box">
                <strong>Note:</strong> We will not sell or rent your personal information to third parties without your explicit consent, except as required by law.
            </div>
        </div>

        <div class="policy-section">
            <h2>3. Data Security</h2>
            <p>
                We implement comprehensive security measures to protect your information from unauthorized access, alteration, disclosure, or destruction. Our security practices include:
            </p>
            <ul>
                <li>SSL encryption for data transmission</li>
                <li>Secure servers with restricted access</li>
                <li>Regular security audits and updates</li>
                <li>Employee training on data protection</li>
                <li>Firewalls and intrusion detection systems</li>
                <li>Regular backups of critical data</li>
            </ul>
            <p>
                However, no method of transmission over the internet is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.
            </p>
        </div>

        <div class="policy-section">
            <h2>4. Information Sharing</h2>
            <p>We may share your information in the following circumstances:</p>
            <ul>
                <li><strong>Service Providers:</strong> Third-party vendors who assist us in operating our portal and providing services</li>
                <li><strong>Legal Requirements:</strong> When required by law, court order, or government request</li>
                <li><strong>Business Transfers:</strong> In case of merger, acquisition, or sale of assets</li>
                <li><strong>Franchise Partners:</strong> Selected information shared with approved franchise partners for operational purposes</li>
                <li><strong>Your Consent:</strong> When you explicitly authorize us to share information</li>
            </ul>
            <p>
                All third parties are bound by confidentiality agreements and are required to use your information only for the specific purpose we provide it.
            </p>
        </div>

        <div class="policy-section">
            <h2>5. Your Rights and Choices</h2>
            <p>You have the following rights regarding your personal information:</p>
            <ul>
                <li><strong>Access:</strong> You can request a copy of the information we hold about you</li>
                <li><strong>Correction:</strong> You can request corrections to inaccurate or incomplete information</li>
                <li><strong>Deletion:</strong> You can request deletion of your information (subject to legal retention requirements)</li>
                <li><strong>Opt-Out:</strong> You can opt out of marketing communications at any time</li>
                <li><strong>Data Portability:</strong> You can request your data in a structured, commonly used format</li>
                <li><strong>Restriction:</strong> You can request restriction of processing in certain circumstances</li>
            </ul>

            <h3>Cookies and Tracking</h3>
            <p>
                You can control cookies through your browser settings. Most browsers allow you to refuse cookies or alert you when cookies are being sent. Note that disabling cookies may affect the functionality of our portal.
            </p>
        </div>

        <div class="policy-section">
            <h2>6. Data Retention</h2>
            <p>
                We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy. The retention period may vary depending on the context:
            </p>
            <ul>
                <li><strong>Application Data:</strong> Retained for 2 years after application decision</li>
                <li><strong>Customer Data:</strong> Retained during the business relationship and for 5 years after termination</li>
                <li><strong>Marketing Communications:</strong> Retained until you unsubscribe</li>
                <li><strong>Legal/Compliance:</strong> Retained as required by applicable laws (minimum 7 years)</li>
            </ul>
            <p>
                After the retention period, we securely dispose of your information or anonymize it so it can no longer be associated with you.
            </p>
        </div>

        <div class="policy-section">
            <h2>7. Children's Privacy</h2>
            <p>
                Our portal is not intended for children under the age of 18. We do not knowingly collect personal information from children. If we become aware that a child has provided us with personal information, we will take steps to delete such information and terminate the child's access to our services.
            </p>
        </div>

        <div class="policy-section">
            <h2>8. Third-Party Links</h2>
            <p>
                Our portal may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to review the privacy policies of any third-party sites before providing your information.
            </p>
        </div>

        <div class="policy-section">
            <h2>9. International Data Transfers</h2>
            <p>
                If you are accessing our portal from outside India, please be aware that your information may be transferred to, stored in, and processed in India and other countries. By using our portal, you consent to such transfers.
            </p>
        </div>

        <div class="policy-section">
            <h2>10. Changes to This Privacy Policy</h2>
            <p>
                We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of material changes by posting the updated policy on our portal and updating the "Last Updated" date. Your continued use of our portal after such changes constitutes your acceptance of the updated Privacy Policy.
            </p>
        </div>

        <div class="policy-section">
            <h2>11. Compliance with Laws</h2>
            <p>
                This Privacy Policy complies with applicable data protection laws including:
            </p>
            <ul>
                <li>Information Technology Act, 2000 (IT Act)</li>
                <li>Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Data or Information) Rules, 2011</li>
                <li>General Data Protection Regulation (GDPR) - for EU residents</li>
                <li>California Consumer Privacy Act (CCPA) - for California residents</li>
            </ul>
        </div>

        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>
                If you have any questions, concerns, or requests regarding this Privacy Policy or our privacy practices, please contact us:
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:privacy@tinytechnotoddlers.com">privacy@tinytechnotoddlers.com</a><br>
                <strong>Phone:</strong> <a href="tel:+918000333555">+91 8000 333 555</a><br>
                <strong>Address:</strong> #102 above, Kai Ruchi Hotel, 3rd floor, Konanakunte Main Road, Bengaluru, Karnataka 560062, India
            </p>
        </div>
    </div>
</main>

    <?php include 'footer.php'; ?>
</body>
</html>
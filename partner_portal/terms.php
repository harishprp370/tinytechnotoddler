<?php
$page_title = "Terms & Conditions";
$page_description = "Terms & Conditions - TinyTechnoToddlers Franchise Portal. Please read these terms carefully before using our services.";
include 'header.php';
?>

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
        background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
        border-left: 4px solid #FF6B6B;
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
        color: #856404;
        font-weight: 500;
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
        <h1>Terms & Conditions</h1>
        <p>Please read these terms carefully before using our services</p>
    </div>

    <div class="policy-content">
        <div class="last-updated">
            <strong>Last Updated:</strong> <?php echo date('F d, Y'); ?>
        </div>

        <div class="policy-section">
            <h2>1. Acceptance of Terms</h2>
            <p>
                By accessing and using the TinyTechnoToddlers Franchise Portal ("Portal"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
            </p>
            <p>
                We reserve the right to update these Terms & Conditions at any time without notice. Your continued use of the Portal following the posting of revised Terms & Conditions means that you accept and agree to the changes.
            </p>
        </div>

        <div class="policy-section">
            <h2>2. Use License</h2>
            <p>
                Permission is granted to temporarily access and view the materials (information, documents, and services) contained in this Portal for lawful purposes only. This is the grant of a license, not a transfer of title, and under this license you may not:
            </p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose or for any public display</li>
                <li>Attempt to decompile or reverse engineer any software contained on the Portal</li>
                <li>Remove any copyright or other proprietary notations from the materials</li>
                <li>Transfer the materials to another person or "mirror" the materials on any other server</li>
                <li>Violate any applicable laws or regulations</li>
                <li>Engage in any conduct that restricts or inhibits anyone's use or enjoyment of the Portal</li>
                <li>Attempt to gain unauthorized access to any portion or feature of the Portal</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>3. Franchise Application Process</h2>
            
            <h3>Application Requirements</h3>
            <p>
                To apply for a TinyTechnoToddlers franchise, you must:
            </p>
            <ul>
                <li>Be at least 21 years of age</li>
                <li>Have the financial capacity to invest in the franchise</li>
                <li>Provide accurate and complete information in your application</li>
                <li>Pass background verification</li>
                <li>Submit all required documents in the specified format</li>
            </ul>

            <h3>Application Processing</h3>
            <p>
                We will review your application and contact you within 7-10 business days. The decision to approve or reject your application is at the sole discretion of TinyTechnoToddlers. We may request additional information or conduct interviews during the evaluation process.
            </p>

            <h3>Franchise Agreement</h3>
            <p>
                Upon approval, you will be required to sign the Franchise Agreement. This agreement outlines:
            </p>
            <ul>
                <li>Rights and responsibilities of the franchisee</li>
                <li>Franchise fees and royalty structure</li>
                <li>Operating guidelines and standards</li>
                <li>Term and renewal conditions</li>
                <li>Termination and dispute resolution procedures</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>4. Franchise Fees and Payment</h2>
            <p>
                Franchise fees and royalties are subject to change and will be clearly communicated before you enter into a Franchise Agreement. Payment terms and methods will be specified in the agreement.
            </p>
            <div class="highlight-box">
                <strong>Important:</strong> All fees must be paid in full as per the agreed schedule. Late payments may result in penalties or termination of the franchise relationship.
            </div>
        </div>

        <div class="policy-section">
            <h2>5. Intellectual Property Rights</h2>
            <p>
                All content on the Portal, including but not limited to text, graphics, logos, images, audio clips, digital downloads, and data compilations, is the property of TinyTechnoToddlers or its content suppliers and is protected by international copyright laws.
            </p>
            <p>
                As a franchisee, you are granted a limited license to use TinyTechnoToddlers trademarks, logos, and materials solely for operating your franchise in accordance with the Franchise Agreement.
            </p>
        </div>

        <div class="policy-section">
            <h2>6. Limitation of Liability</h2>
            <p>
                To the fullest extent permitted by law, TinyTechnoToddlers shall not be liable for:
            </p>
            <ul>
                <li>Any damages arising from use of or reliance on the Portal or its materials</li>
                <li>Loss of profits, revenue, data, or goodwill</li>
                <li>Indirect, incidental, special, or consequential damages</li>
                <li>Business interruption</li>
                <li>Any claims arising from third parties</li>
            </ul>
            <p>
                The total liability of TinyTechnoToddlers for any claim shall not exceed the amount paid by you, if any, in connection with your use of the Portal.
            </p>
        </div>

        <div class="policy-section">
            <h2>7. Disclaimer of Warranties</h2>
            <p>
                The materials on the Portal are provided "as is" without warranty of any kind, either express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, or non-infringement.
            </p>
            <p>
                We do not warrant that:
            </p>
            <ul>
                <li>The Portal will be uninterrupted or error-free</li>
                <li>Defects will be corrected</li>
                <li>The Portal or its servers are free of viruses or harmful components</li>
                <li>The information on the Portal is accurate or complete</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>8. User Conduct</h2>
            <p>
                You agree not to engage in any conduct that:
            </p>
            <ul>
                <li>Violates any law or regulation</li>
                <li>Infringes upon intellectual property rights</li>
                <li>Contains defamatory, offensive, or obscene content</li>
                <li>Constitutes unauthorized commercial solicitation</li>
                <li>Interferes with others' use of the Portal</li>
                <li>Transmits viruses or malicious code</li>
                <li>Harvests or collects personal information of others</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>9. Confidentiality</h2>
            <p>
                All information shared during the franchise application process, including financial statements, business plans, and proprietary information, is considered confidential. You agree to maintain the confidentiality of this information and use it solely for evaluating the franchise opportunity.
            </p>
            <p>
                TinyTechnoToddlers will maintain the confidentiality of your information in accordance with our Privacy Policy.
            </p>
        </div>

        <div class="policy-section">
            <h2>10. Termination of Access</h2>
            <p>
                We reserve the right to terminate or suspend your access to the Portal at any time, without notice, for:
            </p>
            <ul>
                <li>Violation of these Terms & Conditions</li>
                <li>Unauthorized use of the Portal</li>
                <li>Legal compliance</li>
                <li>Maintenance or operational reasons</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>11. Indemnification</h2>
            <p>
                You agree to indemnify, defend, and hold harmless TinyTechnoToddlers and its officers, directors, employees, and agents from any claims, damages, losses, and expenses arising from:
            </p>
            <ul>
                <li>Your use of the Portal</li>
                <li>Your violation of these Terms & Conditions</li>
                <li>Your violation of any law or third-party rights</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>12. Dispute Resolution</h2>
            <p>
                Any disputes arising from your use of the Portal or these Terms & Conditions shall be governed by the laws of India. Both parties agree to submit to the exclusive jurisdiction of the courts in Bengaluru.
            </p>
            <p>
                Before initiating legal proceedings, we encourage you to contact us to attempt resolution through negotiation.
            </p>
        </div>

        <div class="policy-section">
            <h2>13. Entire Agreement</h2>
            <p>
                These Terms & Conditions, along with the Privacy Policy and any other agreements you enter into with TinyTechnoToddlers, constitute the entire agreement between you and us regarding your use of the Portal and supersede all prior understandings and agreements.
            </p>
        </div>

        <div class="contact-info">
            <h3>Contact Us</h3>
            <p>
                If you have any questions or concerns regarding these Terms & Conditions, please contact us:
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:legal@tinytechnotoddlers.com">legal@tinytechnotoddlers.com</a><br>
                <strong>Phone:</strong> <a href="tel:+918000333555">+91 8000 333 555</a><br>
                <strong>Address:</strong> #102 above, Kai Ruchi Hotel, 3rd floor, Konanakunte Main Road, Bengaluru, Karnataka 560062, India
            </p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
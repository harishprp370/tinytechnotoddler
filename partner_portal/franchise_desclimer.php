<?php
$page_title = "Franchise Disclaimer";
$page_description = "Franchise Disclaimer - TinyTechnoToddlers. Important information about franchise disclosure and legal obligations.";
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

    .warning-box {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
        border-left: 4px solid #FF6B6B;
        padding: 25px;
        border-radius: 10px;
        margin: 25px 0;
        color: #856404;
    }

    .warning-box strong {
        color: #FF6B6B;
        font-size: 1.1rem;
    }

    .warning-box ul {
        margin: 15px 0 0 20px;
    }

    .highlight-box {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        border-left: 4px solid #4CAF50;
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
        color: #2e7d32;
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
        <h1>Franchise Disclaimer</h1>
        <p>Important disclosure and legal information for franchise applicants</p>
    </div>

    <div class="policy-content">
        <div class="last-updated">
            <strong>Last Updated:</strong> <?php echo date('F d, Y'); ?>
        </div>

        <div class="warning-box">
            <strong>⚠️ IMPORTANT DISCLAIMER</strong>
            <p>
                This franchise opportunity involves substantial risk. Before investing in a TinyTechnoToddlers franchise, you should carefully review all franchise disclosure documents, conduct independent due diligence, and consult with qualified legal and financial advisors.
            </p>
        </div>

        <div class="policy-section">
            <h2>1. Forward-Looking Statements</h2>
            <p>
                This Portal and all materials therein contain forward-looking statements about TinyTechnoToddlers' franchise opportunities, growth potential, profitability, and success rates. These statements are subject to risks and uncertainties and should not be relied upon as guarantees of future performance.
            </p>
            <p>
                Actual results may differ materially from those projected or implied in any forward-looking statement. TinyTechnoToddlers does not undertake any obligation to update forward-looking statements.
            </p>
        </div>

        <div class="policy-section">
            <h2>2. No Earnings Guarantee</h2>
            <p>
                TinyTechnoToddlers makes no representation, warranty, or guarantee regarding:
            </p>
            <ul>
                <li>Projected earnings or revenues</li>
                <li>Return on investment (ROI)</li>
                <li>Profitability timelines</li>
                <li>Market demand in your territory</li>
                <li>Success rates of existing or new franchisees</li>
            </ul>

            <div class="warning-box">
                <strong>Critical:</strong> Franchise success depends on numerous factors including your location, local market conditions, your management abilities, capital availability, and market competition. Past performance of other franchisees does not guarantee your success.
            </div>
        </div>

        <div class="policy-section">
            <h2>3. Risk Factors</h2>
            <p>
                Investing in a TinyTechnoToddlers franchise involves substantial risks, including but not limited to:
            </p>
            <ul>
                <li><strong>Financial Risk:</strong> You may lose your entire investment or more</li>
                <li><strong>Market Risk:</strong> Demand for preschool services varies by location and economic conditions</li>
                <li><strong>Competition Risk:</strong> Your franchise may face competition from established and new competitors</li>
                <li><strong>Operational Risk:</strong> Managing a preschool requires expertise in education, childcare, and business operations</li>
                <li><strong>Regulatory Risk:</strong> Compliance with education and childcare regulations is mandatory and costly</li>
                <li><strong>Personnel Risk:</strong> Finding and retaining qualified teachers and staff is challenging</li>
                <li><strong>Legal Risk:</strong> Liability issues related to child safety and welfare</li>
                <li><strong>Brand Risk:</strong> Your success is tied to the TinyTechnoToddlers brand and its reputation</li>
                <li><strong>Technology Risk:</strong> Requirement to maintain up-to-date systems and compliance</li>
                <li><strong>Economic Risk:</strong> Franchise viability depends on local economic conditions</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>4. Investment Requirements</h2>
            <p>
                Total investment in a TinyTechnoToddlers franchise varies based on location, size, and configuration. This typically includes:
            </p>
            <ul>
                <li>Franchise fee</li>
                <li>Property lease/purchase</li>
                <li>Construction and renovation</li>
                <li>Furniture and equipment</li>
                <li>Initial inventory and supplies</li>
                <li>Technology and software systems</li>
                <li>Training and certification</li>
                <li>Marketing and grand opening</li>
                <li>Working capital reserves (minimum 6-12 months)</li>
            </ul>

            <div class="warning-box">
                <strong>Financial Obligation:</strong> You must have adequate capital and access to financing. Failed financing arrangements can prevent franchise establishment or operational continuity.
            </div>
        </div>

        <div class="policy-section">
            <h2>5. Due Diligence Requirements</h2>
            <p>
                Before investing, you should:
            </p>
            <ul>
                <li>Request and thoroughly review the Franchise Disclosure Document (FDD)</li>
                <li>Consult with a franchise lawyer to review all agreements</li>
                <li>Consult with a business accountant regarding financial projections</li>
                <li>Interview at least 10-15 existing franchisees about their experiences</li>
                <li>Conduct market research in your intended location</li>
                <li>Verify all claims made by TinyTechnoToddlers</li>
                <li>Understand all obligations and restrictions in the Franchise Agreement</li>
                <li>Evaluate your own qualifications and commitment</li>
                <li>Assess local regulatory requirements and compliance costs</li>
            </ul>

            <div class="highlight-box">
                ✓ TinyTechnoToddlers encourages you to conduct comprehensive due diligence before making any investment commitment.
            </div>
        </div>

        <div class="policy-section">
            <h2>6. Franchise Agreement Terms</h2>
            <p>
                The Franchise Agreement governs the relationship between TinyTechnoToddlers and franchisees. Important terms include:
            </p>
            <ul>
                <li><strong>Term:</strong> Usually 5-10 years with renewal options</li>
                <li><strong>Fees:</strong> Franchise fee, royalties, marketing contributions</li>
                <li><strong>Territory:</strong> Exclusive or non-exclusive operating territory</li>
                <li><strong>Obligations:</strong> Compliance with standards, training, reporting requirements</li>
                <li><strong>Termination:</strong> Conditions for termination and renewal procedures</li>
                <li><strong>Non-Competition:</strong> Restrictions on competing businesses</li>
                <li><strong>Trademark Rights:</strong> Limited license to use TinyTechnoToddlers brand</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>7. Regulatory Compliance</h2>
            <p>
                Operating a preschool requires compliance with multiple regulations and requirements:
            </p>
            <ul>
                <li>State and local educational regulations</li>
                <li>Childcare licensing requirements</li>
                <li>Health and safety standards</li>
                <li>Food safety regulations</li>
                <li>Child protection laws</li>
                <li>Employment laws and minimum wage requirements</li>
                <li>Tax obligations (federal, state, local)</li>
                <li>Insurance requirements (liability, property, workers' compensation)</li>
                <li>Background checks and fingerprinting</li>
            </ul>

            <div class="warning-box">
                <strong>Compliance Costs:</strong> Regulatory compliance can be costly and time-consuming. Non-compliance can result in fines, closure orders, and legal liability.
            </div>
        </div>

        <div class="policy-section">
            <h2>8. Liability and Insurance</h2>
            <p>
                Operating a preschool involves liability risks. You must maintain adequate insurance including:
            </p>
            <ul>
                <li>General liability insurance</li>
                <li>Abuse and molestation liability insurance</li>
                <li>Property insurance</li>
                <li>Workers' compensation insurance</li>
                <li>Employers' liability insurance</li>
            </ul>
            <p>
                TinyTechnoToddlers is not liable for any injuries, damages, or claims arising from operation of your franchise. You are responsible for all liability matters.
            </p>
        </div>

        <div class="policy-section">
            <h2>9. No Guarantee of Territory</h2>
            <p>
                While TinyTechnoToddlers may grant you an operating territory, this grant:
            </p>
            <ul>
                <li>Does not guarantee market demand in the territory</li>
                <li>May be modified or revoked under certain conditions</li>
                <li>Does not prevent TinyTechnoToddlers from establishing other franchises in adjacent territories</li>
                <li>Does not protect you from competition from non-franchised entities</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>10. Franchisor Support and Training</h2>
            <p>
                TinyTechnoToddlers provides initial and ongoing support including:
            </p>
            <ul>
                <li>Pre-opening training and consultation</li>
                <li>Curriculum and operational guidelines</li>
                <li>Technology platform access</li>
                <li>Marketing materials and support</li>
                <li>Ongoing operational guidance</li>
            </ul>
            <p>
                However, TinyTechnoToddlers does not guarantee that this support will ensure your success. Your success ultimately depends on your effort, execution, and local market conditions.
            </p>
        </div>

        <div class="policy-section">
            <h2>11. Termination and Exit</h2>
            <p>
                Terminating a franchise relationship is complex and may involve:
            </p>
            <ul>
                <li>Significant financial penalties or obligations</li>
                <li>Ongoing royalty or other fee obligations</li>
                <li>Restrictions on continuing in the educational business</li>
                <li>Loss of brand rights and name recognition</li>
                <li>Difficulty in finding a buyer for your franchise</li>
            </ul>
            <p>
                Exiting a franchise should be carefully considered before signing the Franchise Agreement.
            </p>
        </div>

        <div class="policy-section">
            <h2>12. No Implied Warranties</h2>
            <p>
                TinyTechnoToddlers makes no implied or express warranties regarding:
            </p>
            <ul>
                <li>Curriculum effectiveness</li>
                <li>Teacher training quality</li>
                <li>Student outcomes or results</li>
                <li>Franchise profitability or success</li>
                <li>Brand recognition or market demand</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>13. Information Accuracy</h2>
            <p>
                While TinyTechnoToddlers strives to provide accurate information, we:
            </p>
            <ul>
                <li>Do not warrant the accuracy or completeness of all information</li>
                <li>May update information without notice</li>
                <li>Recommend independent verification of all claims</li>
                <li>Do not warrant that websites or systems will be error-free or uninterrupted</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>14. Legal and Financial Advice</h2>
            <div class="highlight-box">
                <strong>Strongly Recommended:</strong> Before making any investment decision, consult with:
                <ul style="margin-top: 15px;">
                    <li>A lawyer specializing in franchise law</li>
                    <li>A CPA or financial advisor</li>
                    <li>A business advisor or consultant</li>
                    <li>Existing TinyTechnoToddlers franchisees</li>
                </ul>
            </div>
        </div>

        <div class="policy-section">
            <h2>15. Modification of Disclaimer</h2>
            <p>
                TinyTechnoToddlers reserves the right to modify this disclaimer at any time. Your continued interaction with the Portal or submission of a franchise application constitutes acceptance of any modifications.
            </p>
        </div>

        <div class="contact-info">
            <h3>For More Information</h3>
            <p>
                For detailed information about the franchise opportunity, request the Franchise Disclosure Document (FDD) and speak with our franchise development team:
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:franchise@tinytechnotoddlers.com">franchise@tinytechnotoddlers.com</a><br>
                <strong>Phone:</strong> <a href="tel:+918000333555">+91 8000 333 555</a><br>
                <strong>Address:</strong> #102 above, Kai Ruchi Hotel, 3rd floor, Konanakunte Main Road, Bengaluru, Karnataka 560062, India
            </p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
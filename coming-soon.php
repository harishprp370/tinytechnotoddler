<?php
$page_key = 'comingsoon';
include 'includes/header.php';
?>
<style>
body {
    background: linear-gradient(135deg, #7B3FA0 0%, #FFD700 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.coming-soon-container {
    max-width: 500px;
    margin: 120px auto 0 auto;
    background: rgba(255,255,255,0.95);
    border-radius: 32px;
    box-shadow: 0 8px 32px rgba(123,63,160,0.15);
    padding: 48px 32px 32px 32px;
    text-align: center;
    position: relative;
}
.coming-soon-logo {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin-bottom: 18px;
    box-shadow: 0 4px 16px rgba(123,63,160,0.10);
    border: 4px solid #FFD700;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: auto;
    margin-right: auto;
}
.coming-soon-logo img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}
.coming-soon-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 38px;
    font-weight: 700;
    color: #7B3FA0;
    margin-bottom: 12px;
    letter-spacing: 1px;
}
.coming-soon-subtitle {
    font-size: 20px;
    color: #5B2D8F;
    margin-bottom: 28px;
    font-weight: 500;
}
.coming-soon-section {
    margin-bottom: 28px;
    text-align: left;
}
.coming-soon-section h3 {
    font-size: 20px;
    color: #FFD700;
    margin-bottom: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
}
.coming-soon-contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.coming-soon-contact-list li {
    font-size: 17px;
    color: #5B2D8F;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.coming-soon-contact-list .label {
    font-weight: 600;
    color: #7B3FA0;
    min-width: 120px;
    display: inline-block;
}
.coming-soon-contact-list .phone {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    color: #E53935;
    font-size: 18px;
    letter-spacing: 1px;
}
.coming-soon-franchise .phone {
    color: #2196F3;
}
.coming-soon-footer {
    margin-top: 32px;
    font-size: 15px;
    color: #888;
    text-align: center;
}
@media (max-width: 600px) {
    .coming-soon-container {
        padding: 32px 10px 24px 10px;
        margin: 80px 8px 0 8px;
    }
    .coming-soon-title {
        font-size: 28px;
    }
    .coming-soon-subtitle {
        font-size: 16px;
    }
}
</style>
<main>
    <div class="coming-soon-container">
        <div class="coming-soon-logo">
            <img src="assets/img/logo.jpeg" alt="TinyToddlers Logo">
        </div>
        <div class="coming-soon-title">
            Coming Soon
        </div>
        <div class="coming-soon-subtitle">
            We're working hard to bring you something amazing.<br>
            For admissions and franchise enquiries, contact us below!
        </div>
        <div class="coming-soon-section">
            <h3><i class="fas fa-user-graduate"></i> Admission</h3>
            <ul class="coming-soon-contact-list">
                <li>
                    <span class="label">Thalagattapura</span>
                    <span class="phone"><i class="fas fa-phone"></i> 9739563332</span>
                </li>
                <li>
                    <span class="label">Anjanapura</span>
                    <span class="phone"><i class="fas fa-phone"></i> 9739563335</span>
                </li>
            </ul>
        </div>
        <div class="coming-soon-section coming-soon-franchise">
            <h3><i class="fas fa-handshake"></i> For Franchise</h3>
            <ul class="coming-soon-contact-list">
                <li>
                    <span class="label">Franchise 1</span>
                    <span class="phone"><i class="fas fa-phone"></i> 9739561697</span>
                </li>
                <li>
                    <span class="label">Franchise 2</span>
                    <span class="phone"><i class="fas fa-phone"></i> 9739561245</span>
                </li>
            </ul>
        </div>
        <div class="coming-soon-footer">
            &copy; <?= date('Y') ?> TinyToddlers Preschool. All rights reserved.
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>

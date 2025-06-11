@php
    $compro = \App\Models\CompanyParameter::first();
    $brand = \App\Models\BrandPartner::where('type', 'brand', 'nama')->get();
@endphp

<style>
/* Footer Container */
.footer-container {
    position: relative;
    margin-top: 50px;
}

/* Newsletter Section */
.newsletter-wrapper {
    display: flex;
    justify-content: center;
    position: relative;
    z-index: 10;
    margin-bottom: -90px; /* Increased overlap */
}

.newsletter-box {
    width: 1240px;
    height: 180px;
    background-color: #070528;
    border-radius: 18px;
    padding: 0 80px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.newsletter-content {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.newsletter-title {
    color: white;
    font-family: sans-serif;
    font-weight: 800;
    font-size: 48px;
    line-height: 1.1;
    text-transform: uppercase;
    margin: 0;
    letter-spacing: -1px;
}

.newsletter-form {
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
    max-width: 320px;
}

.newsletter-form input {
    text-align: center;
    height: 45px;
    border-radius: 50px;
    padding: 0 20px;
    width: 100%;
    border: none;
    font-size: 14px;
    box-shadow: none;
    outline: none;
}

.newsletter-form button {
    height: 45px;
    border-radius: 50px;
    background-color: white;
    color: #000;
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Main Footer */
.footer-main {
    background-color: #DDE0FF;
    width: 100%;
    min-height: 450px;
    padding-top: 150px; /* Increased top padding to accommodate newsletter overlap */
    padding-bottom: 30px;
    font-family: sans-serif;
}

.footer-content {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 100px; /* Increased horizontal padding */
}

.footer-grid {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

/* Company Info Column */
.footer-company-info {
    width: 32%; /* Slightly increased width */
    padding-right: 30px;
}

.footer-logo {
    display: block;
    margin-bottom: 5px;
    max-width: 200px; /* Control logo width */
}

.footer-logo img {
    width: 100%;
    height: auto;
}

.company-tagline {
    color: #000;
    font-size: 13px;
    margin-bottom: 30px; /* Increased spacing */
    font-style: italic;
}

.company-title {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    color: #000;
    margin-bottom: 15px;
    margin-top: 0;
}

.company-address {
    font-size: 13px;
    color: #000;
    margin-bottom: 5px;
    line-height: 1.6;
}

.copyright-text {
    font-size: 13px;
    color: #000;
    margin: 20px 0; /* Increased spacing */
}

.social-icons {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.social-icons a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #fff;
    color:rgb(0, 0, 0);
    transition: all 0.3s ease;
    font-size: 14px; /* Control icon size */
}

.social-icons a:hover {
    background-color: #f0f0f0;
}

/* Footer Link Columns */
.footer-links-column {
    width: 18%; /* Adjusted column width */
    padding-top: 5px; /* Align with logo */
}

.footer-column-title {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    color: #000;
    margin-bottom: 25px;
    margin-top: 0;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 14px; /* Increased spacing between links */
}

.footer-links a {
    color: #000;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
}

.footer-links a:hover {
    color: #f0f0f0;
}

/* Utility classes */
.section-heading {
    margin-bottom: 10px;
    font-weight: 700;
}

/* Enhanced Responsive Styles */
@media (max-width: 1440px) {
    .footer-content {
        padding: 0 70px;
    }
    
    .newsletter-box {
        width: 90%;
        max-width: 1200px;
    }
}

@media (max-width: 1200px) {
    .footer-content {
        padding: 0 50px;
    }
    
    .newsletter-box {
        width: 90%;
        padding: 0 50px;
    }
    
    .newsletter-title {
        font-size: 38px;
    }
    
    .footer-company-info {
        width: 35%;
    }
    
    .footer-links-column {
        width: 20%;
    }
}

@media (max-width: 992px) {
    .newsletter-box {
        width: 90%;
        height: auto;
        padding: 30px;
    }
    
    .newsletter-content {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }
    
    .newsletter-title {
        margin-bottom: 20px;
        font-size: 32px;
    }
    
    .newsletter-form {
        margin: 0 auto;
    }
    
    .footer-main {
        min-height: auto;
        padding-top: 120px;
    }
    
    .footer-grid {
        flex-wrap: wrap;
    }
    
    .footer-company-info {
        width: 100%;
        margin-bottom: 40px;
        padding-right: 0;
    }
    
    .footer-links-column {
        width: 47%;
        margin-bottom: 30px;
    }
    
    .newsletter-wrapper {
        margin-bottom: -60px;
    }
}

@media (max-width: 768px) {
    .newsletter-wrapper {
        margin-bottom: -50px;
    }
    
    .newsletter-box {
        padding: 25px;
    }
    
    .newsletter-title {
        font-size: 28px;
    }
    
    .footer-main {
        padding-top: 100px;
    }
    
    .footer-content {
        padding: 0 40px;
    }
    
    .footer-company-info {
        padding-right: 0;
    }
}

@media (max-width: 576px) {
    .newsletter-wrapper {
        margin-bottom: -40px;
    }
    
    .newsletter-title {
        font-size: 24px;
    }
    
    .footer-main {
        padding-top: 90px;
    }
    
    .footer-links-column {
        width: 100%;
        margin-bottom: 30px;
    }
    
    .newsletter-form {
        max-width: 100%;
    }
    
    .footer-content {
        padding: 0 30px;
    }
    
    .footer-logo {
        max-width: 160px;
    }
    
    .company-address br {
        display: inline;
    }
    
    .company-address {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .newsletter-box {
        padding: 20px;
    }
    
    .newsletter-title {
        font-size: 20px;
    }
    
    .footer-main {
        padding-top: 80px;
    }
    
    .newsletter-form input,
    .newsletter-form button {
        height: 40px;
        font-size: 13px;
    }
    
    .footer-content {
        padding: 0 20px;
    }
    
    .footer-column-title {
        margin-bottom: 15px;
    }
    
    .footer-links li {
        margin-bottom: 10px;
    }
}

@media (max-width: 375px) {
    .newsletter-wrapper {
        margin-bottom: -30px;
    }
    
    .newsletter-title {
        font-size: 18px;
    }
    
    .newsletter-box {
        padding: 15px;
    }
    
    .footer-main {
        padding-top: 70px;
    }
    
    .social-icons a {
        width: 24px;
        height: 24px;
        font-size: 12px;
    }
}
</style>

<!-- Footer Start -->
<div class="footer-container">
    <!-- Newsletter Section -->
    <div class="newsletter-wrapper">
        <div class="newsletter-box">
            <div class="newsletter-content">
                <h2 class="newsletter-title">STAY UPTO DATE ABOUT<br>OUR LATEST OFFERS</h2>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your message">
                    <button type="submit">Submit Your Email</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Footer -->
    <div class="footer-main">
        <div class="footer-content">
            <div class="footer-grid">
                <!-- Company Info Column -->
                <div class="footer-company-info">
                    <a href="#" class="footer-logo">
                        <img src="{{ asset('assets/img/Logo.png') }}" alt="Simplay">
                    </a>
                    <p class="company-tagline">YOUR FLIGHT BUDDY, YOUR SOLUTION</p>
                    
                    <h4 class="company-title section-heading">COMPANY</h4>
                    <p class="company-address">
                        Rajawali Selatan Raya Blok A No.33 Gunung<br>
                        Sahari Utara Sawah Besar Kota Adm.<br>
                        Jakarta Pusat DKI Jakarta 10720
                    </p>
                    <p class="copyright-text">Status: © 2020-2023. All Rights Reserved</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Company Column -->
                <div class="footer-links-column">
                    <h4 class="footer-column-title section-heading">COMPANY</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('product.index') }}">Our Product</a></li>
                        <li><a href="{{ route('activity') }}">Activity</a></li>
                        <li><a href="{{ route('home') }}#brand">Our Brand</a></li>
                        <li><a href="{{ route('about') }}#user">Our Customer</a></li>
                    </ul>
                </div>
                
                <!-- Quick Access Column -->
                <div class="footer-links-column">
                    <h4 class="footer-column-title section-heading">QUIC ACCESS</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Delivery Details</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <!-- FAQ Column -->
                <div class="footer-links-column">
                    <h4 class="footer-column-title section-heading">FAQ</h4>
                    <ul class="footer-links">
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Manage Deliveries</a></li>
                        <li><a href="#">Orders</a></li>
                        <li><a href="#">Payments</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<link href="{{ asset('assets/lib/boxicons-master/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/lib/flickity/css/flickity.min.css')}}" rel="stylesheet">

<!-- Template Javascript -->
<script src="{{ asset('assets/js/member/main.js') }}"></script>
</body>

</html>
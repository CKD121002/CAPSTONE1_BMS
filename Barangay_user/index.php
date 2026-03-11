<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Isidro</title>
    <link rel="stylesheet" href="css/landing.css">
</head>
<body>
    <header class="topnav">
        <div class="logo-area">
            <img src="picture/silogo.png" alt="San Isidro Logo" class="logo1">
            <img src="picture/Home.png" alt="One Cainta Logo" class="logo2">
        </div>
        
        <ul class="nav-links">
            <li><a href="#" id="homeBtn">Home</a></li>
            <li><a href="#" id="aboutBtn">About</a></li>
            <li><a href="#" id="contactBtn">Contact</a></li>
            <li><a href="Frontend/login.php">Account</a></li>
        </ul>
    </header>

    <div class="fullbg">
        <section class="topp">
            <div class="top-text">
                <h1>Welcome to</h1>
                <h1>Barangay</h1>
                <h1 class="san">SAN <span>ISIDRO</span></h1>
            </div>

            <div class="top-logo">
                <img src="picture/silogo.png" alt="silogo">
            </div>
        </section>

        <section class="features">
            <div class="feature-title">
                <h2>Features</h2>
            </div>
            <div class="boxcontainer">
                <a href="Frontend/login.php">
                    <div class="box">
                        <img src="picture/e-certificate.png">
                        <h3>E-Certificate</h3>
                        <p>Online Request</p>
                    </div>
                </a>
                <a href="Frontend/login.php">
                    <div class="box">
                        <img src="picture/report.png">
                        <h3>Incident Report</h3>
                        <p>Quick and Secure</p>
                    </div>
                </a>
                <a href="Frontend/login.php">
                    <div class="box">
                        <img src="picture/alert.png">
                        <h3>Barangay Alert</h3>
                        <p>Updates and News</p>
                    </div>
                </a>
                <a href="#">
                    <div class="box">
                        <img src="picture/bot.png">
                        <h3>AI ChatBot</h3>
                        <p>24/7 Assistance</p>
                    </div>
                </a>
            </section> <br><br><br>

        <section class="about">
            <h2>History Barangay San Isidro</h2>
            <div class="about-container">
                <div class="about-text">
                    <p>
                        <strong>Barangay San Isidro</strong>, located in the Municipality of Cainta, Rizal,
                        was originally an agricultural community named after San Isidro Labrador,
                        the patron saint of farmers. The barangay was known for its rice fields
                        and traditional delicacies such as bibingka and suman, which remain
                        part of its cultural identity.
                    </p>

                    <p>
                        In the 1960s and 1970s, with the expansion of Metro Manila,
                        Barangay San Isidro gradually transformed from a quiet farming
                        village into a bustling residential and commercial community.
                        Today, it is one of the most populated barangays in Cainta,
                        providing essential public services and managing community
                        records for its residents.
                    </p>
                </div>
                <div class="about-image">
                    <img src="picture/San Isidro.jpg" alt="Barangay Hall">
                </div>
            </div>
        </section>

        <section class="misvis">
            <div class="card mission">
                <h2>Mission</h2>
                <p>
                    To provide fast, transparent, and reliable public service
                    through an organized digital system that promotes
                    efficiency and community participation.
                </p>
            </div>
            <div class="card vision">
                <h2>Vision</h2>
                <p>
                    To become a modern and digitally empowered barangay that
                    ensures accessible services, promotes unity, and supports
                    sustainable community development.
                </p>
            </div>
        </section>

        <section class="contact">
            <h1 class="contact-title">Contact Us</h1>
            <div class="contact-container">

                <div class="contact-left">
                    <img src="picture/balanti.png" alt="Barangay Hall">

                    <div class="contact-info">
                        <p>📍 Barangay Hall, San Isidro, Cainta Rizal</p>
                        <p>📞 09123456789</p>
                        <p>✉️ sanisidrobarangay@gmail.com</p>
                        <p>🕒 Office Hours: Monday - Friday | 8:00 AM - 5:00 PM</p>
                    </div>
                </div>

                <div class="contact-form">
                    <h2>Message Us</h2>
                    <form>
                        <label>Name</label>
                        <input type="text" placeholder="Enter your name" required>

                        <label>Email</label>
                        <input type="email" placeholder="Enter your email" required>

                        <label>Contact No.</label>
                        <input type="text" placeholder="Enter your contact number" required>

                        <label>Message</label>
                        <textarea rows="4" placeholder="Enter your message"></textarea>

                        <button type="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </section>

        <footer>
            <ul class="social-icon">
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-shopify"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            </ul>
            <p>© 2026 Barangay San Isidro Cainta Rizal | All Rights Reserved</p>
        </footer>
    </div>
    <script src="js/landing.js"></script>
</body>
</html>
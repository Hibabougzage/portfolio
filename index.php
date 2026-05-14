<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiba Bougzage | Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="header">
        <a href="#" class="logo">Hiba <span>Bougzage</span></a>
        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#education">Education</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <h1>Hi, It's <span>Hiba</span></h1>
            <h3>I'm a <span>Software Engineer</span></h3>
            <p>I'm a 22-year-old Software Engineering student at Haliç University focused on building modern web applications.</p>
            <div class="social-media">
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <div class="btn-group">
                <a href="#" class="btn">Hire</a>
                <a href="#contact" class="btn">Contact</a>
            </div>
        </div>

        <div class="home-img">
            <img src="assets/images/me.png" alt="Hiba">
        </div>
    </section>

    <section class="education" id="education">
        <h2 class="heading">Education</h2>
        <div class="timeline-items">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">2020</div>
                <div class="timeline-content">
                    <h3>Primary School</h3>
                    <p>Boomgoti School - Foundational education and early interest in technology.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">2023</div>
                <div class="timeline-content">
                    <h3>High School</h3>
                    <p>Lycée Mohammed V - Focused on technical sciences and mathematics.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">2026</div>
                <div class="timeline-content">
                    <h3>University</h3>
                    <p>Haliç University - Currently pursuing a degree in Software Engineering.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <h2 class="heading">Contact <span>Me</span></h2>
        <form action="contact_handler.php" method="POST">
            <div class="input-box">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="number" name="phone" placeholder="Phone Number">
                <input type="text" name="subject" placeholder="Subject">
            </div>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn">
        </form>
    </section>

    <footer class="footer">
        <div class="social">
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#"><i class="fa-brands fa-github"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <ul class="list">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About Me</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <p class="copyright">© Hiba Bougzage | All Rights Reserved</p>
    </footer>

</body>
</html>
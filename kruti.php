<?php
// Load uploaded images - FIXED: Changed from image_data.txt to image_data.json
$images = array();
if (file_exists('image_data.json')) {
    $image_data = file_get_contents('image_data.json');
    $images = $image_data ? json_decode($image_data, true) : array();
}

// Set variables for each image type with fallback images
$modern_kitchens_image = isset($images['modern_kitchens']) && file_exists($images['modern_kitchens']) ? $images['modern_kitchens'] : '';
$modern_bathroom_image = isset($images['modern_bathroom']) && file_exists($images['modern_bathroom']) ? $images['modern_bathroom'] : '';
$decorative_hardware_image = isset($images['decorative_hardware']) && file_exists($images['decorative_hardware']) ? $images['decorative_hardware'] : '';
$woodspace_cabinetry_image = isset($images['woodspace_cabinetry']) && file_exists($images['woodspace_cabinetry']) ? $images['woodspace_cabinetry'] : '';
$modern_rooms_image = isset($images['modern_rooms']) && file_exists($images['modern_rooms']) ? $images['modern_rooms'] : '';
$minimal_offices_image = isset($images['minimal_offices']) && file_exists($images['minimal_offices']) ? $images['minimal_offices'] : '';
$modern_kitchens2_image = isset($images['modern_kitchens2']) && file_exists($images['modern_kitchens2']) ? $images['modern_kitchens2'] : '';
$working_places_image = isset($images['working_places']) && file_exists($images['working_places']) ? $images['working_places'] : '';
$modern_bedrooms_image = isset($images['modern_bedrooms']) && file_exists($images['modern_bedrooms']) ? $images['modern_bedrooms'] : '';
$archive_main_image = isset($images['archive_main']) && file_exists($images['archive_main']) ? $images['archive_main'] : '';
$archive_thumb1_image = isset($images['archive_thumb1']) && file_exists($images['archive_thumb1']) ? $images['archive_thumb1'] : '';
$archive_thumb2_image = isset($images['archive_thumb2']) && file_exists($images['archive_thumb2']) ? $images['archive_thumb2'] : '';
$testimonial1_image = isset($images['testimonial1']) && file_exists($images['testimonial1']) ? $images['testimonial1'] : '';
$testimonial2_image = isset($images['testimonial2']) && file_exists($images['testimonial2']) ? $images['testimonial2'] : '';
$achievement1_image = isset($images['achievement1']) && file_exists($images['achievement1']) ? $images['achievement1'] : '';
$achievement2_image = isset($images['achievement2']) && file_exists($images['achievement2']) ? $images['achievement2'] : '';
$achievement3_image = isset($images['achievement3']) && file_exists($images['achievement3']) ? $images['achievement3'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTADS - The Architectural Design Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        /* Header Styles */
        .header-section {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
            min-height: 80vh;
        }
        
        .navbar {
            background: transparent !important;
            padding: 20px 0;
            position: relative;
            z-index: 10;
        }
        
        .navbar-nav .nav-link {
            color: #f5f5dc !important;
            font-weight: 400;
            margin: 0 15px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        
        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }
        
        .hero-content {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        
        .hero-image {
            background-image: url('image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 80vh;
            width: 100%;
            top: 0;
            left: 0;
        }
        
        .hero-overlay {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        
        .hero-text {
            position: absolute;
            bottom: 50px;
            left: 50px;
            z-index: 3;
            color: white;
            max-width: 500px;
        }
        
        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        /* About Section */
        .about-section {
            background-color: #ffecb8ff;
            padding: 80px 0;
        }
        
        .about-text {
            font-size: 18px;
            line-height: 1.6;
            color: #703e15ff;
            text-align: center;
        }
        
        /* Portfolio Grid */
        .portfolio-section {
            background-color: #ffecb8ff;
            padding: 60px 0;
        }
        
        .portfolio-item {
            background-color: #999;
            height: 150px;
            width:370px;
            margin-bottom: 70px;
            border-radius: 5px;
            position: relative;
            /* overflow: hidden; */
        }
        
        .portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .portfolio-title {
            position: absolute;
            top: -48px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.7);
            color: black;
            padding: 15px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
        }
        
        /* Archive Section */
        .archive-section {
            background: linear-gradient(135deg, #8B4513 0%, #654321 100%);
            padding: 80px 0;
            color: #f5f5dc;
        }
        
        .archive-image {
            background-color: #666;
            height: 300px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .archive-content h2 {
            color: #D2B48C;
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .archive-content p {
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        
        .archive-list {
            list-style: none;
            padding: 0;
        }
        
        .archive-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(245, 245, 220, 0.2);
            font-size: 13px;
        }
        
        .archive-thumbnails {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .archive-thumb {
            background-color: #666;
            width: 80px;
            height: 60px;
            border-radius: 3px;
            overflow: hidden;
        }
        
        /* Testimonials */
        .testimonials-section {
            background-color: #f5f5dc;
            padding: 80px 0;
        }
        
        .testimonials-section h2 {
            text-align: center;
            margin-bottom: 50px;
            color: #8B4513;
            font-size: 28px;
        }
        
        .testimonial-item {
            text-align: center;
            padding: 0 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            padding: 30px 20px;
        }
        
        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #999;
            margin: 0 auto 20px;
            overflow: hidden;
        }
        
        .testimonial-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .testimonial-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            font-style: italic;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: #8B4513;
            font-size: 13px;
            margin-bottom: 10px;
        }
        
        .stars {
            color: #FFD700;
            font-size: 16px;
        }
        
        /* Achievement Section */
        .achievement-section {
            background: linear-gradient(135deg, #8B4513 0%, #654321 100%);
            padding: 80px 0;
            color: #f5f5dc;
        }
        
        .achievement-section h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #D2B48C;
            font-size: 28px;
        }
        
        .achievement-subtitle {
            text-align: center;
            margin-bottom: 50px;
            font-size: 14px;
        }
        
        .achievement-item {
            background-color: #ccc;
            height: 200px;
            border-radius: 5px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .achievement-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Footer */
        .footer-section {
            background: #2b0f05ff;
            padding: 60px 0 20px;
            color: #f5f5dc;
            padding-left: 260px;
        }
        
        .footer-section h4 {
            color: #ffffffff;
            font-size: 22px;
            margin-bottom: 45px;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            padding: 5px 0;
            font-size: 14px;
        }
        
        .footer-section ul li a {
            color: #f5f5dc;
            text-decoration: none;
        }
        
        .footer-section ul li a:hover {
            color: #D2B48C;
        }
        
        .contact-info {
            font-size: 14px;
            line-height: 1.8;
        }
        
        .social-icons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 18px;
            padding-right: 298px;
        }

        .icon-box {
            width: 30px;
            background-color: #ffffff;
            color: #000000ff;
            height: 30px;
            border: 2px solid #ffffff;
            border-radius: 10%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }

        .icon-box:hover {
            background-color: #ffffff;
            color: #5e4528;
            transform: scale(1.1);
        }

        .copyright {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(245, 245, 220, 0.2);
            margin-top: 40px;
            font-size: 20px;
            padding-right: 250px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-text {
                bottom: 30px;
                left: 30px;
                right: 30px;
                max-width: none;
            }
            
            .hero-text h1 {
                font-size: 36px;
            }
            
            .hero-text p {
                font-size: 16px;
            }
            
            .portfolio-item {
                height: 150px;
            }
            
            .archive-image {
                height: 200px;
                margin-bottom: 30px;
            }
            
            .archive-thumbnails {
                justify-content: center;
            }
            
            .achievement-item {
                height: 150px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-nav .nav-link {
                margin: 5px 0;
                text-align: center;
            }
            
            .hero-text {
                bottom: 20px;
                left: 20px;
                right: 20px;
            }
            
            .hero-text h1 {
                font-size: 28px;
            }
            
            .hero-text p {
                font-size: 14px;
            }
            
            .about-text {
                font-size: 13px;
            }
            
            .portfolio-item {
                height: 120px;
            }
            
            .testimonial-item {
                margin-bottom: 40px;
            }
        }
        
        /* iPhone specific */
        @media (max-width: 414px) {
            .container {
                padding: 0 15px;
            }
            
            .hero-text h1 {
                font-size: 24px;
            }
            
            .portfolio-item {
                height: 100px;
            }
        }
        
        /* Small iPhone */
        @media (max-width: 375px) {
            .archive-thumbnails {
                flex-wrap: wrap;
            }
            
            .archive-thumb {
                width: 60px;
                height: 45px;
            }
        }
        
        /* Tablet */
        @media (min-width: 768px) and (max-width: 1024px) {
            .portfolio-item {
                height: 180px;
            }
            
            .archive-image {
                height: 250px;
            }
        }
        
        .navbar-toggler {
            border: 1px solid #f5f5dc;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28245, 245, 220, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <section class="header-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#archive">Archive</a></li>
                        <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                        <li class="nav-item"><a class="nav-link" href="#achievements">Achievement / Publications</a></li>
                        <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="#career">Career</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="hero-content">
            <div class="hero-image"></div>
            <div class="hero-overlay"></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="about-text">
                        <p>Kruti, The Architectural Design Studio is a multidisciplinary design firm founded by Ar. Ashish Pandya in 2005. Since then, KTADS is dedicatedly & passionately working on residential and commercial projects throughout Gujarat. We work closely with our clients to understand their lifestyle, needs and aspirations of end users and enhances the character of the space. Our design methodology is based on understanding of functional needs, form & spaces, climate & culture with integration of nature. As designers, we think beyond functional needs and spaces, we always look out for our design's impact on environment, social fabric and well being of the users. Our vision is to create innovative, sustainable and climate responsive designs. For KTADS, design is not just a profession but it is a passion and love for us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio-section" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($modern_kitchens_image): ?>
                            <img src="<?php echo htmlspecialchars($modern_kitchens_image); ?>" alt="Modern Kitchens">
                        <?php endif; ?>
                        <div class="portfolio-title">MODERN KITCHENS</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($modern_bathroom_image): ?>
                            <img src="<?php echo htmlspecialchars($modern_bathroom_image); ?>" alt="Modern Bathroom">
                        <?php endif; ?>
                        <div class="portfolio-title">MODERN BATHROOM</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($decorative_hardware_image): ?>
                            <img src="<?php echo htmlspecialchars($decorative_hardware_image); ?>" alt="Decorative Hardware">
                        <?php endif; ?>
                        <div class="portfolio-title">DECORATIVE HARDWARE</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($woodspace_cabinetry_image): ?>
                            <img src="<?php echo htmlspecialchars($woodspace_cabinetry_image); ?>" alt="Woodspace Cabinetry">
                        <?php endif; ?>
                        <div class="portfolio-title">WOODSPACE CABINETRY</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($modern_rooms_image): ?>
                            <img src="<?php echo htmlspecialchars($modern_rooms_image); ?>" alt="Modern Rooms">
                        <?php endif; ?>
                        <div class="portfolio-title">MODERN ROOMS</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($minimal_offices_image): ?>
                            <img src="<?php echo htmlspecialchars($minimal_offices_image); ?>" alt="Minimal Offices">
                        <?php endif; ?>
                        <div class="portfolio-title">MINIMAL OFFICES</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($modern_kitchens2_image): ?>
                            <img src="<?php echo htmlspecialchars($modern_kitchens2_image); ?>" alt="Modern Kitchens">
                        <?php endif; ?>
                        <div class="portfolio-title">MODERN KITCHENS</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($working_places_image): ?>
                            <img src="<?php echo htmlspecialchars($working_places_image); ?>" alt="Working Places">
                        <?php endif; ?>
                        <div class="portfolio-title">WORKING PLACES</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="portfolio-item">
                        <?php if($modern_bedrooms_image): ?>
                            <img src="<?php echo htmlspecialchars($modern_bedrooms_image); ?>" alt="Modern Bedrooms">
                        <?php endif; ?>
                        <div class="portfolio-title">MODERN BEDROOMS</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Archive Section -->
    <section class="archive-section" id="archive">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="archive-image">
                        <?php if($archive_main_image): ?>
                            <img src="<?php echo htmlspecialchars($archive_main_image); ?>" alt="Archive" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="archive-content">
                        <h2>Archive</h2>
                        <p>Etiam sit justo, vulputate luctus magna eget. Suspendisse risus facilisis volutpat est et.</p>
                        <p>Mauris quis pellentesque pretium, tincidunt vulputate risus. Ruat lorem vulputate rhoncus fringilla sapien. Ut sit vehuim, tristique lorem elit.</p>
                        
                        <ul class="archive-list">
                            <li>❖ Pulvinar rutrum venenatis</li>
                            <li>❖ Sed malesuada lorem sit blandit</li>
                            <li>❖ Quis vitae magna placerat et lectus</li>
                        </ul>
                        
                        <div class="archive-thumbnails">
                            <div class="archive-thumb">
                                <?php if($archive_thumb1_image): ?>
                                    <img src="<?php echo htmlspecialchars($archive_thumb1_image); ?>" alt="Archive Thumb 1" style="width: 100%; height: 100%; object-fit: cover; border-radius: 3px;">
                                <?php endif; ?>
                            </div>
                            <div class="archive-thumb">
                                <?php if($archive_thumb2_image): ?>
                                    <img src="<?php echo htmlspecialchars($archive_thumb2_image); ?>" alt="Archive Thumb 2" style="width: 100%; height: 100%; object-fit: cover; border-radius: 3px;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <h2>Testimonials</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="testimonial-item">
                        <div class="testimonial-avatar">
                            <?php if ($testimonial1_image): ?>
                                <img src="<?php echo htmlspecialchars($testimonial1_image); ?>" alt="Testimonial 1">
                            <?php endif; ?>
                        </div>
                        <p class="testimonial-text">"In hac habitasse platea dictumst quisque et metus pellentesque mi nullam."</p>
                        <div class="testimonial-author">@CatherineDoe</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="testimonial-item">
                        <div class="testimonial-avatar">
                            <?php if ($testimonial2_image): ?>
                                <img src="<?php echo htmlspecialchars($testimonial2_image); ?>" alt="Testimonial 2">
                            <?php endif; ?>
                        </div>
                        <p class="testimonial-text">"This has bolstered all the clients because people have just created it."</p>
                        <div class="testimonial-author">@CatherineDoe</div>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievement Section -->
    <section class="achievement-section" id="achievements">
        <div class="container">
            <h2>Achievement / Publications</h2>
            <p class="achievement-subtitle">Fusce mollis risus ut lacinia consectetur. Donec vehicula tincidunt dui ut vehicula. Donec et neht nulla mauris.</p>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="achievement-item">
                        <?php if($achievement1_image): ?>
                            <img src="<?php echo htmlspecialchars($achievement1_image); ?>" alt="Achievement 1">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="achievement-item">
                        <?php if($achievement2_image): ?>
                            <img src="<?php echo htmlspecialchars($achievement2_image); ?>" alt="Achievement 2">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="achievement-item">
                        <?php if($achievement3_image): ?>
                            <img src="<?php echo htmlspecialchars($achievement3_image); ?>" alt="Achievement 3">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                   <h4>Helpful Links</h4>
                    <ul>
                        <li><a href="#">&gt; About Us</a></li>
                        <li><a href="#">&gt; Services</a></li>
                        <li><a href="#">&gt; FAQs</a></li>
                        <li><a href="#">&gt; Blog</a></li>
                        <li><a href="#">&gt; Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">&gt; Worldwide</a></li>
                        <li><a href="#">&gt; Scalable</a></li>
                        <li><a href="#">&gt; Medicast</a></li>
                        <li><a href="#">&gt; Connectivity</a></li>
                        <li><a href="#">&gt; Corporate</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <h4>Contact Us</h4>
                    <div class="contact-info">
                        <p>445 West Orchard Street<br>
                        Kings Mountain, NC 28086</p>
                        <p>Phone: (272) 211-7370</p>
                        <p>E-Mail: support@yourbrand.com</p>
                    </div>
                    <div class="social-icons">
                        <a href="#" class="icon-box"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="icon-box"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="icon-box"><i class="fab fa-google"></i></a>
                        <a href="#" class="icon-box"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="icon-box"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>© 2024 KTADS. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Smooth Scrolling -->
    <script>
        // Smooth scrolling for navigation links
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
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    </script>
</body>
</html>
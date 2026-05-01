<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find your perfect home with PropConnect - The modern real estate platform.">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo/logoo.jpeg') }}">
    <title>PropConnect - Find Your Dream Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@400;500;600;700&family=Audiowide&display=swap" rel="stylesheet">
    
    <!-- Section CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/sections/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/scroll-section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/explore.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/clear-section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sections/footer.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/platform.css') }}">
</head>
<body class="has-dark-header">
    <!-- Preloader -->

    <div class="preloader" id="preloader">
        <div class="preloader-mask"></div>
    </div>
    
    <!-- Accessibility: Skip link for keyboard users -->
<a href="#main-content" class="skip-link">Skip to main content</a>

@include('components.dark-header')

<main id="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-images">
                <canvas id="heroSpiralCanvas" class="hero-img active"></canvas>
            </div>
            
            <div class="hero-text">
                <h1 class="reveal-text">
                    <span class="reveal-box"></span>
                    Renting made simple.
                </h1>
                <div class="hero-links">
                    <a href="/ai-assistant" class="reveal-text" data-delay="0.3"><span class="reveal-box"></span>Chat with Assistant</a>
                    <a href="/rental" class="reveal-text" data-delay="0.4"><span class="reveal-box"></span>Explore Rentals</a>
                </div>
            </div>
        </div>
        
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-field">
                <label for="looking-for">Looking For</label>
                <input type="text" id="looking-for" placeholder="What to look for ?">
            </div>
            <div class="search-field">
                <label for="type">Type</label>
                <select id="type">
                    <option value="">Property Type</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="condo">Condo</option>
                </select>
            </div>
            <div class="search-field">
                <label for="price">Price</label>
                <select id="price">
                    <option value="">Price</option>
                    <option value="0-1000">$0 - $1,000</option>
                    <option value="1000-2000">$1,000 - $2,000</option>
                    <option value="2000+">$2,000+</option>
                </select>
            </div>
            <div class="search-field">
                <label for="location">Location</label>
                <select id="location">
                    <option value="">All Cities</option>
                    <option value="manila">Manila</option>
                    <option value="cebu">Cebu</option>
                    <option value="davao">Davao</option>
                </select>
            </div>
            <button class="search-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                Search
            </button>
        </div>
    </section>

    <!-- Platform Section - Scrollable with Sticky Image -->
    <section class="scroll-section">
        <div class="scroll-header">
            <span class="scroll-label">MORE THAN A LISTING</span>
            <h2 class="scroll-title reveal-text">
                <span class="reveal-box"></span>
                Connecting you<br>to what matters most
            </h2>
        </div>
        
        <div class="scroll-container">
            <!-- Sticky Image Side -->
            <div class="scroll-image-wrapper">
                <div class="scroll-image" id="scrollImage">
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800" alt="Property" class="scroll-img active" data-index="0">
                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800" alt="Property" class="scroll-img" data-index="1">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800" alt="Property" class="scroll-img" data-index="2">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800" alt="Property" class="scroll-img" data-index="3">
                </div>
            </div>
            
            <!-- Scrollable Content Side -->
            <div class="scroll-content">
                <div class="scroll-progress" id="scrollProgress"></div>
                <div class="scroll-item active" data-index="0">
                    <div class="item-number">01</div>
                    <div class="item-content">
                        <h3><span>Find rental homes</span></h3>
                        <ul>
                            <li><span>Browse available rentals that match your budget</span></li>
                            <li><span>Filter by location, price, and amenities</span></li>
                            <li><span>View detailed property information instantly</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="scroll-item" data-index="1">
                    <div class="item-number">02</div>
                    <div class="item-content">
                        <h3><span>Connect with landlords</span></h3>
                        <ul>
                            <li><span>Direct messaging with property owners</span></li>
                            <li><span>Schedule property viewings easily</span></li>
                            <li><span>Get instant responses to your inquiries</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="scroll-item" data-index="2">
                    <div class="item-number">03</div>
                    <div class="item-content">
                        <h3><span>Explore neighborhoods</span></h3>
                        <ul>
                            <li><span>Interactive maps with nearby amenities</span></li>
                            <li><span>Travel time calculations to key locations</span></li>
                            <li><span>Discover the best areas for your lifestyle</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="scroll-item" data-index="3">
                    <div class="item-number">04</div>
                    <div class="item-content">
                        <h3><span>Become a landlord</span></h3>
                        <ul>
                            <li><span>List your property in minutes</span></li>
                            <li><span>Manage inquiries from your dashboard</span></li>
                            <li><span>Track views and performance analytics</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore Properties Section -->
    <section class="explore-section" id="exploreSection">
        
        <!-- Text-Only Intro Area - Text moves from top to bottom on scroll -->
        <div class="explore-intro" id="exploreIntro">
            <div class="explore-intro-content" id="exploreIntroText">
                <h2 class="explore-intro-title">Explore Rentals</h2>
            </div>
        </div>
        
        <div class="explore-container">
            <!-- Text is now provided by explore-intro and animates into position -->
            <!-- The intro text scrolls down and shrinks to become the title here -->
            
            <!-- Horizontal rows with randomized positions and mixed sizes -->
            <div class="explore-images" id="exploreImages">
                
                <!-- Row 1 -->
                <div class="explore-img img-big" data-scroll-speed="0.3" style="top: 10%; left: 15%;">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400" alt="Property">
                </div>
                
                <!-- Row 2 -->
                <div class="explore-img img-small" data-scroll-speed="0.35" style="top: 5%; left: 90%;">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400" alt="Property">
                </div>
                
                <!-- Row 3 -->
                <div class="explore-img img-medium" data-scroll-speed="0.4" style="top: 0%; left: 0%;">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400" alt="Property">
                </div>
                
                <!-- Row 4 -->
                <div class="explore-img img-big" data-scroll-speed="0.45" style="top: 50%; left: 80%;">
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400" alt="Property">
                </div>
                
                <!-- Row 5 -->
                <div class="explore-img img-small" data-scroll-speed="0.38" style="top: 100%; left: 50%;">
                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=400" alt="Property">
                </div>
                
                <!-- Row 6 -->
                <div class="explore-img img-medium" data-scroll-speed="0.5" style="top:70%; left: 25%;">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=400" alt="Property">
                </div>
                
                <!-- Row 7 -->
                <div class="explore-img img-big" data-scroll-speed="0.42" style="top: 100%; left: 0%;">
                    <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400" alt="Property">
                </div>
                
                <!-- Row 8 -->
                <div class="explore-img img-small" data-scroll-speed="0.55" style="top: 0%; left: 48%;">
                    <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=400" alt="Property">
                </div>
                
                <!-- Row 9 -->
                <div class="explore-img img-medium" data-scroll-speed="0.48" style="top: 90%; left: 63%;">
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=400" alt="Property">
                </div>
                
                <!-- Row 10 -->
                <div class="explore-img img-big" data-scroll-speed="0.52" style="top: 25%; left: 55%;">
                    <img src="https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=400" alt="Property">
                </div>
                
                <!-- Row 11 -->
                <div class="explore-img img-small" data-scroll-speed="0.58" style="top: 40%; left: 40%;">
                    <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=400" alt="Property">
                </div>
            </div>
            
            <!-- Bottom Center Expanding Image (Fixed at bottom, expands on scroll) -->
            <div class="expand-trigger-wrapper" id="expandTriggerWrapper">
                <div class="expand-trigger-img" id="expandTriggerImg">
                    <img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e?w=1920" alt="Property">
                </div>
            </div>
            
            <!-- Expanding Image Reveal Section - Why Us -->
            <div class="expand-reveal-section" id="expandRevealSection">
                <!-- Full screen background image -->
                <div class="expand-bg" id="expandBg">
                    <img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e?w=1920" alt="Vision">
                </div>
                
                <!-- Why Us Content - Vertical Layout -->
                <div class="why-us-wrapper">
                    <!-- Horizontal Sliding Titles -->
                    <div class="why-us-titles-container">
                        <div class="why-us-titles" id="whyUsTitles">
                            <h2 class="why-us-title active" data-panel="0">
                                <span class="why-us-ascend-wrapper">
                                    <span class="why-us-ascend-inner-title">Smart Search</span>
                                </span>
                            </h2>
                            <h2 class="why-us-title" data-panel="1">
                                <span class="why-us-ascend-wrapper">
                                    <span class="why-us-ascend-inner-title">Direct Connect</span>
                                </span>
                            </h2>
                            <h2 class="why-us-title" data-panel="2">
                                <span class="why-us-ascend-wrapper">
                                    <span class="why-us-ascend-inner-title">Trusted Platform</span>
                                </span>
                            </h2>
                        </div>
                    </div>
                    
                    <!-- Descriptions Below -->
                    <div class="why-us-descriptions" id="whyUsDescriptions">
                        <div class="why-us-desc active" data-panel="0">
                            <div class="why-us-ascend-wrapper">
                                <p class="why-us-ascend-inner">Find your perfect property with our AI-powered search that understands your preferences. Filter by location, price, amenities, and lifestyle—we match you with spaces that truly fit your needs.</p>
                            </div>
                        </div>
                        <div class="why-us-desc" data-panel="1">
                            <div class="why-us-ascend-wrapper">
                                <p class="why-us-ascend-inner">Skip the middleman. Connect directly with property owners through our integrated messaging system. Schedule viewings, ask questions, and negotiate terms—all in one place.</p>
                            </div>
                        </div>
                        <div class="why-us-desc" data-panel="2">
                            <div class="why-us-ascend-wrapper">
                                <p class="why-us-ascend-inner">Every listing is verified. Every landlord is authenticated. Our secure platform ensures transparent communication and protects both renters and property owners throughout the journey.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Sidebar Drawer (Panel 4) -->
                <div class="footer-sidebar" id="footerSidebar">
                    <div class="footer-sidebar-content">
                         <!-- Upper Footer -->
                        <div class="footer-upper">
                            <div class="footer-cta">
                                <p class="footer-cta-text">Talk to us about your property</p>
                                <a href="/contact" class="footer-cta-link">Contact us</a>
                            </div>
                            
                            <nav class="footer-nav">
                                <a href="/">Home</a>
                                <a href="/properties">Properties</a>
                                <a href="/about">About</a>
                                <a href="/how-it-works">How It Works</a>
                                <a href="/contact">Contact</a>
                            </nav>
                            
                            <div class="footer-contact">
                                <div class="contact-item">
                                    <span class="contact-label">L</span>
                                    <span class="contact-value">Manila, Philippines<br>Metro Manila 1000</span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-label">P</span>
                                    <span class="contact-value">+63 123 456 7890</span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-label">C</span>
                                    <span class="contact-value">contact@propconnect.ph</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Middle Footer -->
                        <div class="footer-middle">
                            <div class="footer-newsletter">
                                <span>Subscribe to our newsletter</span>
                                <form class="newsletter-form" action="#" method="POST">
                                    <input type="email" placeholder="Enter your email" required>
                                    <button type="submit">→</button>
                                </form>
                            </div>
                            
                            <div class="footer-social">
                                <a href="#" target="_blank">Instagram</a>
                                <a href="#" target="_blank">Facebook</a>
                            </div>
                        </div>

                        <!-- Bottom Footer -->
                        <div class="footer-bottom">
                            <span class="footer-copyright">All rights reserved © PropConnect 2026</span>
                        </div>
                    </div>
                </div>
                
                <!-- Swipe Navigation Dots - 4 total (intro + 3 panels) -->
                <div class="expand-nav">
                    <button class="expand-dot active" data-panel="0"></button>
                    <button class="expand-dot" data-panel="1"></button>
                    <button class="expand-dot" data-panel="2"></button>
                </div>
                
                <!-- Scroll hint -->
                <div class="swipe-hint">
                    <span>Scroll</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12l7 7 7-7"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer" id="siteFooter" style="display: none !important;">
        <!-- Upper Footer -->
        <div class="footer-upper">
            <div class="footer-cta">
                <p class="footer-cta-text">Talk to us about your property</p>
                <a href="/contact" class="footer-cta-link">Contact us</a>
            </div>
            
            <nav class="footer-nav">
                <a href="/">Home</a>
                <a href="/properties">Properties</a>
                <a href="/about">About</a>
                <a href="/how-it-works">How It Works</a>
                <a href="/contact">Contact</a>
            </nav>
            
            <div class="footer-contact">
                <div class="contact-item">
                    <span class="contact-label">L</span>
                    <span class="contact-value">Manila, Philippines<br>Metro Manila 1000</span>
                </div>
                <div class="contact-item">
                    <span class="contact-label">P</span>
                    <span class="contact-value">+63 123 456 7890</span>
                </div>
                <div class="contact-item">
                    <span class="contact-label">C</span>
                    <span class="contact-value">contact@propconnect.ph</span>
                </div>
            </div>
        </div>
        
        <!-- Middle Footer -->
        <div class="footer-middle">
            <div class="footer-newsletter">
                <span>Subscribe to our newsletter</span>
                <form class="newsletter-form" action="#" method="POST">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">→</button>
                </form>
            </div>
            
            <a href="#" class="back-to-top" id="backToTop">Back to top</a>
            
            <div class="footer-social">
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">Facebook</a>
            </div>
        </div>
        
        <!-- Large Logo Section -->
        <div class="footer-logo-section">
            <h2 class="footer-large-logo">PROPCONNECT</h2>
        </div>
        
        <!-- Bottom Footer -->
        <div class="footer-bottom">
            <span class="footer-copyright">All rights reserved © PropConnect 2025</span>
            <a href="/privacy">Privacy policy</a>
            <a href="/terms">Terms of services</a>
            <span class="footer-credit">Website by TM & GL</span>
        </div>
    </footer>
</main>

<script src="{{ asset('javascript/script.js') }}"></script>
<script src="{{ asset('javascript/platform.js') }}"></script>

<!-- Lenis Smooth Scroll -->
<script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
<script src="{{ asset('javascript/smooth-scroll.js') }}"></script>

<!-- GSAP for Scroll Animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script src="{{ asset('javascript/homepage-animations.js') }}"></script>
<script src="{{ asset('javascript/spiral-background.js') }}"></script>
<script src="{{ asset('javascript/dark-header.js') }}"></script>
<script src="{{ asset('javascript/homepage-search.js') }}"></script>
</body>
</html>
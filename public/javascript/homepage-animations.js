// ========================================
// HOMEPAGE GSAP ANIMATIONS
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    // ========================================
    // PRELOADER - Priority Handling
    // ========================================
    const preloader = document.getElementById('preloader');
    const hasLoaded = sessionStorage.getItem('preloaderDone');

    // Function to hide preloader
    const hidePreloader = () => {
        if (preloader) {
            preloader.classList.add('done');
            // Completely remove from DOM after transition to prevent clicks
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 600);
        }
        document.body.classList.remove('loading');
        sessionStorage.setItem('preloaderDone', 'true');
    };

    // Force hide after 5 seconds just in case
    setTimeout(hidePreloader, 5000);

    // Normal logic
    if (hasLoaded) {
        if (preloader) preloader.style.display = 'none';
        document.body.classList.remove('loading');
        // Defer animations slightly to ensure DOM is ready
        setTimeout(() => {
            startAscendAnimations();
            animateHero();
        }, 50);
    } else {
        document.body.classList.add('loading');
        setTimeout(() => {
            hidePreloader();
            startAscendAnimations();
            animateHero();
        }, 1500); // Increased slightly to 1.5s for smoother feel
    }

    // Register ScrollTrigger with safety check
    try {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        } else {
            console.warn('GSAP or ScrollTrigger not loaded');
        }
    } catch (e) {
        console.error('GSAP registration failed:', e);
        // Ensure preloader is hidden even if GSAP fails
        hidePreloader();
    }
    
    // Hero image entrance animation
    function animateHero() {
        gsap.from('.hero-img', {
            opacity: 0,
            scale: 1.05,
            duration: 1,
            ease: 'power3.out'
        });
        
        gsap.from('.search-container', {
            opacity: 0,
            y: 30,
            duration: 0.8,
            delay: 0.3,
            ease: 'power3.out'
        });

        // Mouse movement effect for Hero Image
        const heroSection = document.querySelector('.hero');
        const heroImg = document.querySelector('.hero-img');
        
        if (heroSection && heroImg) {
            heroSection.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();
                const mouseX = (e.clientX - rect.left - rect.width / 2) * 0.03; // Subtle movement
                const mouseY = (e.clientY - rect.top - rect.height / 2) * 0.03;
                
                gsap.to(heroImg, {
                    x: mouseX,
                    y: mouseY,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });
            
            heroSection.addEventListener('mouseleave', () => {
                gsap.to(heroImg, {
                    x: 0,
                    y: 0,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });
        }
    }
    
    function startAscendAnimations() {
        // ========================================
        // TEXT ASCEND ANIMATION (Slide up from below)
        // ========================================
        
        const ascendTexts = document.querySelectorAll('.reveal-text');
        
        ascendTexts.forEach((element, index) => {
            // Wrap text content in span if not already
            if (!element.querySelector('.ascend-inner')) {
                const text = element.innerHTML;
                // Remove old reveal-box
                const cleanText = text.replace(/<span class="reveal-box"><\/span>/g, '');
                element.innerHTML = `<span class="ascend-inner">${cleanText}</span>`;
            }
            
            const inner = element.querySelector('.ascend-inner');
            const delay = parseFloat(element.dataset.delay) || 0;
            
            // Start position: fully below (hidden by overflow:hidden)
            gsap.set(inner, { 
                y: '100%'
            });
            
            // Animate up - text is VISIBLE as it slides up
            gsap.to(inner, {
                y: '0%',
                duration: 0.8,
                delay: delay + (index * 0.1),
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 90%',
                    toggleActions: 'play none none none'
                }
            });
        });
    
    // ========================================
    // SCROLL ANIMATIONS FOR SECTIONS
    // ========================================
    
    // Fade up animation for sections
    gsap.utils.toArray('.fade-up').forEach(element => {
        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 85%',
                toggleActions: 'play none none none'
            },
            opacity: 0,
            y: 60,
            duration: 0.8,
            ease: 'power3.out'
        });
    });
    
    // ========================================
    // PROPERTY CARDS STAGGER ANIMATION
    // ========================================
    
    const propertySlides = document.querySelectorAll('.slide-content');
    
    propertySlides.forEach(slide => {
        gsap.from(slide, {
            scrollTrigger: {
                trigger: slide,
                start: 'top 80%',
                toggleActions: 'play none none none'
            },
            opacity: 0,
            y: 80,
            rotation: 3,
            duration: 0.8,
            ease: 'power3.out'
        });
    });
    
    // ========================================
    // NAVBAR SCROLL EFFECT
    // ========================================
    
    const navbar = document.querySelector('.navbar');
    
    if (navbar) {
        ScrollTrigger.create({
            start: 'top -100',
            end: 99999,
            onUpdate: (self) => {
                if (self.direction === 1) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });
    }
    
    // ========================================
    // PARALLAX EFFECT FOR HERO
    // ========================================
    
    gsap.to('.hero-img', {
        scrollTrigger: {
            trigger: '.hero',
            start: 'top top',
            end: 'bottom top',
            scrub: 1
        },
        y: 100,
        scale: 1.05,
        ease: 'none'
    });
    
    // ========================================
    // COUNTER ANIMATION (for stats if any)
    // ========================================
    
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        
        gsap.from(counter, {
            scrollTrigger: {
                trigger: counter,
                start: 'top 80%',
                onEnter: () => {
                    animateCounter(counter, target);
                }
            }
        });
    });
    
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 30);
    }
    
    // ========================================
    // SCROLL SECTION - Pinned with Progress Bar
    // ========================================
    
    const scrollSection = document.querySelector('.scroll-section');
    const scrollItems = document.querySelectorAll('.scroll-item');
    const scrollImages = document.querySelectorAll('.scroll-img');
    const scrollProgress = document.getElementById('scrollProgress');
    
    if (scrollSection && scrollItems.length > 0) {
        const totalItems = scrollItems.length;
        let lastItemIndex = 0; // Track the last active index for direction detection
        
        // Pin the section and create scroll-triggered timeline
        // Reduced scroll distance: 50% per item instead of 100%
        ScrollTrigger.create({
            trigger: scrollSection,
            start: 'top top',
            end: `+=${totalItems * 30}%`,
            pin: true,
            scrub: 0.5,
            onUpdate: (self) => {
                const progress = self.progress;
                const direction = self.direction; // 1 = scrolling down, -1 = scrolling up
                
                // Update progress bar
                if (scrollProgress) {
                    scrollProgress.style.width = `${progress * 100}%`;
                }
                
                // Calculate which item should be active
                const itemIndex = Math.min(
                    Math.floor(progress * totalItems),
                    totalItems - 1
                );
                
                // Update items
                scrollItems.forEach((item, i) => {
                    if (i === itemIndex) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
                
                // Update images with layered cube effect
                // Background image depends on scroll direction
                scrollImages.forEach((img, i) => {
                    img.classList.remove('active', 'bg-image');
                    
                    if (i === itemIndex) {
                        // Current active image - expands from cube to full
                        img.classList.add('active');
                    } else if (direction >= 0 && i === itemIndex - 1) {
                        // Scrolling DOWN: Previous image stays full as background
                        img.classList.add('bg-image');
                    } else if (direction < 0 && i === itemIndex + 1) {
                        // Scrolling UP: Next image stays full as background
                        img.classList.add('bg-image');
                    }
                    // All other images stay as small cubes (default state)
                });
                
                lastItemIndex = itemIndex;
            }
        });
    }
    
    // ========================================
    // EXPLORE INTRO - Text moves down through images and disappears behind them
    // ========================================
    
    const exploreIntro = document.getElementById('exploreIntro');
    const exploreIntroText = document.getElementById('exploreIntroText');
    const exploreIntroTitle = document.querySelector('.explore-intro-title');
    
    if (exploreIntro && exploreIntroText) {
        // Keep text centered at all times
        exploreIntroText.style.top = '50%';
        exploreIntroText.style.transform = 'translateY(-50%)';
        
        // Fade IN when entering the section
        ScrollTrigger.create({
            trigger: exploreIntro,
            start: 'top 50%',  // Start fade in when section is 80% down viewport
            end: 'top 20%',    // Fully visible when section is 20% down viewport
            scrub: true,
            onUpdate: (self) => {
                // Only handle fade in here
                if (self.progress < 1) {
                    exploreIntroText.style.opacity = self.progress;
                }
            },
            onLeaveBack: () => { exploreIntroText.style.opacity = 0; }
        });
        
        // Fade OUT when approaching the trigger image
        ScrollTrigger.create({
            trigger: '.explore-section',
            start: '50% top',   // Start fading when 50% through explore section
            end: '70% top',     // Fully hidden by 70%
            scrub: true,
            onUpdate: (self) => {
                const fadeOutProgress = self.progress;
                exploreIntroText.style.opacity = 1 - fadeOutProgress;
            }
        });
    }
    
    // ========================================
    // EXPLORE PROPERTIES SECTION - Animated Text & Parallax
    // ========================================
    
    const exploreSection = document.getElementById('exploreSection');
    const exploreImages = document.querySelectorAll('.explore-img');
    const exploreText = document.getElementById('exploreText');
    const exploreTitle = document.querySelector('.explore-title');
    const exploreContainer = document.querySelector('.explore-container');
    
    if (exploreSection && exploreImages.length > 0) {
        // Images are always visible - no fade in
        
        // Mouse parallax effect
        exploreSection.addEventListener('mousemove', (e) => {
            const rect = exploreSection.getBoundingClientRect();
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const mouseX = e.clientX - rect.left - centerX;
            const mouseY = e.clientY - rect.top - centerY;
            
            exploreImages.forEach((img) => {
                const speed = parseFloat(img.dataset.scrollSpeed) || 0.3; // Use data-scroll-speed instead of nonexistent data-speed
                const movementFactor = 0.02; // Reduced from implied higher value for subtler effect
                const x = mouseX * speed * movementFactor;
                const y = mouseY * speed * movementFactor;
                img.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
        
        // Reset on mouse leave
        exploreSection.addEventListener('mouseleave', () => {
            exploreImages.forEach((img) => {
                img.style.transform = 'translate(0, 0)';
            });
        });
        
        // Get title for scale animation
        const exploreTitle = document.querySelector('.explore-title');
        
        // Set initial state - text uses transform for positioning
        if (exploreText) {
            exploreText.style.opacity = 0; // Start hidden, let ScrollTrigger handle it
            exploreText.style.transform = 'translate(-50%, -50%) translateY(-30vh)';
        }
        
        ScrollTrigger.create({
            trigger: exploreSection,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.3,
            onEnter: () => {
                if (exploreText) exploreText.style.opacity = 1;
            },
            onLeave: () => {
                if (exploreText) exploreText.style.opacity = 0;
            },
            onEnterBack: () => {
                if (exploreText) exploreText.style.opacity = 1;
            },
            // REMOVED onLeaveBack so text stays visible when scrolling up out of section
            onUpdate: (self) => {
                const progress = self.progress;
                
                // Simple parallax scroll effect - images are ALWAYS visible, just move up
                exploreImages.forEach((img, index) => {
                    const scrollSpeed = parseFloat(img.dataset.scrollSpeed) || 0.5;
                    
                    // Parallax: move images UP based on scroll progress
                    const translateY = -progress * scrollSpeed * 40;
                    img.style.transform = `translateY(${translateY}vh)`;
                });
                
                // Text animation - fades out earlier to make room for expansion
                if (exploreText && exploreTitle) {
                    // Phase 1 (0-25%): Text moves from top to center, shrinks
                    if (progress <= 0.25) {
                        const moveProgress = progress / 0.25;
                        const offsetY = -30 + (moveProgress * 30);
                        const scale = 1 - (moveProgress * 0.4);
                        
                        exploreText.style.transform = `translate(-50%, -50%) translateY(${offsetY}vh)`;
                        exploreTitle.style.transform = `scale(${scale})`;
                        exploreText.style.opacity = 1;
                    }
                    // Phase 2 (25-45%): Text stays centered
                    else if (progress <= 0.45) {
                        exploreText.style.transform = 'translate(-50%, -50%)';
                        exploreTitle.style.transform = 'scale(0.6)';
                        exploreText.style.opacity = 1;
                    }
                    // Phase 3 (45-55%): Text fades out AND moves down
                    else if (progress <= 0.55) {
                        const fadeProgress = (progress - 0.45) / 0.1;
                        
                        // Move down as it fades (0 to 150px)
                        const moveDown = fadeProgress * 150;
                        
                        exploreText.style.transform = `translate(-50%, calc(-50% + ${moveDown}px))`;
                        exploreTitle.style.transform = `scale(${0.6 - fadeProgress * 0.1})`;
                        exploreText.style.opacity = 1 - fadeProgress;
                    }
                    else {
                        exploreText.style.opacity = 0;
                    }
                }
                
                // ========================================
                // BOTTOM CENTER IMAGE EXPANSION (scroll-driven)
                // Image always visible at bottom, expands on scroll
                // No fade effects
                // ========================================
                const expandWrapper = document.getElementById('expandTriggerWrapper');
                const expandImg = document.getElementById('expandTriggerImg');
                const expandReveal = document.getElementById('expandRevealSection');
                
                // Helper function to get responsive trigger dimensions based on viewport
                function getTriggerDimensions() {
                    const vw = window.innerWidth;
                    if (vw <= 420) return { width: 100, height: 140 };
                    if (vw <= 694) return { width: 115, height: 160 };
                    if (vw <= 798) return { width: 130, height: 180 };
                    if (vw <= 870) return { width: 145, height: 200 };
                    if (vw <= 1270) return { width: 160, height: 230 };
                    return { width: 180, height: 260 };
                }
                
                if (expandWrapper && expandImg) {
                    const triggerSize = getTriggerDimensions();
                    // Phase 1 (0-50%): Image scrolls from below into view at bottom
                    if (progress <= 0.50) {
                        // Scroll from -300px to 30px
                        const scrollProgress = progress / 0.50;
                        const startBottom = -300;
                        const endBottom = 30;
                        const currentBottom = startBottom + (endBottom - startBottom) * scrollProgress;
                        
                        expandWrapper.style.position = 'absolute';
                        expandWrapper.style.bottom = `${currentBottom}px`;
                        expandWrapper.style.left = '50%';
                        
                        expandWrapper.style.right = '';
                        expandWrapper.style.transform = 'translateX(-50%)';
                        expandWrapper.style.width = 'auto';
                        expandWrapper.style.height = 'auto';
                        expandWrapper.style.zIndex = '50';
                        expandWrapper.classList.remove('expanded');
                        
                        expandImg.style.width = `${triggerSize.width}px`;
                        expandImg.style.height = `${triggerSize.height}px`;
                        expandImg.style.borderRadius = '8px';
                    }
                    // Phase 2 (50-70%): Image stays at bottom center, small size
                    else if (progress <= 0.70) {
                        expandWrapper.style.position = 'absolute';
                        expandWrapper.style.bottom = '30px';
                        expandWrapper.style.left = '50%';
                        expandWrapper.style.right = '';
                        expandWrapper.style.transform = 'translateX(-50%)';
                        expandWrapper.style.width = 'auto';
                        expandWrapper.style.height = 'auto';
                        expandWrapper.style.zIndex = '50';
                        expandWrapper.classList.remove('expanded');
                        
                        expandImg.style.width = `${triggerSize.width}px`;
                        expandImg.style.height = `${triggerSize.height}px`;
                        expandImg.style.borderRadius = '8px';
                    }
                    // Phase 3 (70-95%): Image gradually expands FROM BOTTOM
                    else if (progress <= 0.95) {
                        const expandProgress = (progress - 0.70) / 0.25;
                        
                        // Easing for smooth expansion
                        const eased = 1 - Math.pow(1 - expandProgress, 2);
                        
                        // Calculate dimensions - use responsive base size
                        const startW = triggerSize.width;
                        const startH = triggerSize.height;
                        const endW = window.innerWidth;
                        const endH = window.innerHeight;
                        
                        const currentW = startW + (endW - startW) * eased;
                        const currentH = startH + (endH - startH) * eased;
                        
                        // Calculate border radius (8px to 0px)
                        const currentRadius = 8 * (1 - eased);
                        
                        // Calculate bottom position (starts at 30px, goes to 0px)
                        const currentBottom = 30 * (1 - eased);
                        
                        expandWrapper.style.position = 'fixed'; // Use fixed during expansion for smoothness
                        expandWrapper.style.bottom = `${currentBottom}px`;
                        expandWrapper.style.left = '50%';
                        expandWrapper.style.top = 'auto'; // Reset top
                        expandWrapper.style.right = 'auto';
                        expandWrapper.style.transform = 'translateX(-50%)'; // Center horizontally only
                        
                        expandWrapper.style.width = `${currentW}px`;
                        expandWrapper.style.height = `${currentH}px`;
                        expandWrapper.style.zIndex = '100';
                        expandWrapper.classList.remove('expanded');
                        
                        expandImg.style.width = '100%';
                        expandImg.style.height = '100%';
                        expandImg.style.borderRadius = `${currentRadius}px`;
                    }
                    // Phase 4 (95-100%): Image is full screen, show overlay content
                    else {
                        expandWrapper.style.position = 'fixed';
                        expandWrapper.style.top = '0';
                        expandWrapper.style.left = '0';
                        expandWrapper.style.bottom = '0';
                        expandWrapper.style.right = '0';
                        expandWrapper.style.transform = 'none';
                        expandWrapper.style.width = '100vw';
                        expandWrapper.style.height = '100vh';
                        expandWrapper.style.zIndex = '100'; // Keep this below Section 6 (z-index 5 wrapper, 10 content)
                        expandWrapper.classList.add('expanded');
                        
                        expandImg.style.width = '100%';
                        expandImg.style.height = '100%';
                        expandImg.style.borderRadius = '0';
                        
                        // Show the reveal overlay content ONLY if we haven't scrolled past
                        if (expandReveal && progress < 0.99) {
                            expandReveal.classList.add('visible');
                            
                            // RESET EXIT STATE if we are back in range (scrolled up from footer)
                            if (expandReveal.dataset.exited === 'true') {
                                expandReveal.dataset.exited = 'false';
                                document.body.classList.remove('parallax-exited');
                            }
                        }
                    }
                }
                
                // Reset expand reveal when scrolling back
                if (progress < 0.95 && expandReveal) {
                    expandReveal.classList.remove('visible');
                    // Also ensure body class is removed if present
                    document.body.classList.remove('parallax-exited');
                }
            }
        });
        
        // ========================================
        // EXPAND REVEAL SWIPE NAVIGATION
        // ========================================
        
        initExpandSwipeNavigation();
    }
    
    // Scroll-driven navigation for horizontal title row
    function initExpandSwipeNavigation() {
        const titlesContainer = document.getElementById('whyUsTitles');
        const titles = document.querySelectorAll('.why-us-titles .why-us-title');
        const descriptions = document.querySelectorAll('.why-us-desc');
        const dots = document.querySelectorAll('.expand-dot');
        const expandReveal = document.getElementById('expandRevealSection');
        const expandBg = document.getElementById('expandBg');
        const expandBgImg = expandBg ? expandBg.querySelector('img') : null;
        const header = document.querySelector('.dark-header');
        const sidebar = document.getElementById('footerSidebar'); // Sidebar Drawer
        
        if (titles.length === 0) return;
        
        let currentPanel = 0;
        let wheelCooldown = false;
        let scrollDownCount = 0; // Count scrolls down
        let scrollUpCount = 0;   // Count scrolls up
        let readyToExit = false; // Flag to allow smooth exit after resistance
        
        // Split text for word-by-word reveal (run once)
        function splitTextForReveal() {
            descriptions.forEach(desc => {
                const p = desc.querySelector('.why-us-ascend-inner');
                if (!p) return;
                
                // Use textContent instead of innerText to ensure we get text even if hidden
                const text = p.textContent.trim();
                if (!text) return;
                
                const words = text.split(' ');
                
                let html = '';
                words.forEach((word, index) => {
                    // Stagger delay: 0.02s per word
                    // Add extra delay based on panel index? No, reset when active.
                    // But we want it to replay? CSS transition plays on class add.
                    const delay = index * 0.015; 
                    html += `<span class="why-us-word-mask"><span class="why-us-word-inner" style="transition-delay: ${delay}s">${word}</span></span> `;
                });
                
                p.innerHTML = html;
                // Add class to p to indicate it's split (optional, for styling)
                p.classList.add('split-ready');
            });
        }
        
        // Run split immediately
        splitTextForReveal();
        // scrollUpCount already declared above
        
        // Use WHEEL event instead of scroll (works even when page is fixed)
        // NOT passive so we can prevent default scroll
        window.addEventListener('wheel', (e) => {
            // Check if section 5 is visible
            // BUT if we have exited (isSection5Exited), we want to allow normal scroll
            // unless we are scrolling UP from the exit point?
            
            if (!expandReveal || !expandReveal.classList.contains('visible')) {
                if (header) {
                    header.classList.remove('section-5-active');
                }
                return;
            }
            
            // If we have exited (dataset.exited is set), allow default scroll
            if (expandReveal.dataset.exited === 'true') {
                 // Allow default scroll so footer can slide
                 return;
            }
            
            // Sidebar Drawer Internal Scroll Handling
            if (currentPanel === 3 && sidebar && sidebar.contains(e.target)) {
                const content = sidebar.querySelector('.footer-sidebar-content');
                if (content && content.scrollHeight > content.clientHeight) {
                     // Check boundaries
                     const atTop = content.scrollTop <= 0;
                     const atBottom = Math.abs(content.scrollHeight - content.clientHeight - content.scrollTop) < 2;
                     
                     if (e.deltaY < 0 && atTop) {
                         // User scrolling UP at top: Fall through to swipe logic (to close drawer)
                         // Don't return, let preventDefault happen below
                     } else if (e.deltaY > 0 && atBottom) {
                         // User scrolling DOWN at bottom: Block it
                         e.preventDefault();
                         return;
                     } else {
                         // Middle of content: Allow native scroll
                         return; 
                     }
                }
            }


            // SMOOTH EXIT FROM PANEL 0 WITH RESISTANCE
            // Reset ready flag if not applicable (e.g. scrolling down or changed panel)
            if (currentPanel !== 0 || e.deltaY >= -10) {
                 readyToExit = false;
            }
            
            // If ready (resistance met), allow native scroll to exit section smoothly
            if (readyToExit && currentPanel === 0 && e.deltaY < -10) {
                return;
            }
            
            // If we are here, we are in INTERACTIVE mode.
            // PREVENT page scroll while in Section 5
            e.preventDefault();
            
            // Set header to white (stays white while in Section 5)
            if (header) {
                header.classList.add('section-5-active');
            }
            
            // Prevent cooldown rapid switching
            if (wheelCooldown) return;
            
            // Set cooldown for individual scroll detection
            wheelCooldown = true;
            setTimeout(() => { wheelCooldown = false; }, 300);
            
            // Scroll DOWN = next panel or exit to footer
            if (e.deltaY > 30) {
                scrollUpCount = 0; // Reset up counter when scrolling down
                scrollDownCount++;
                
                // Logic: 2 ticks to switch panels
                // Allow going up to index 3 (Sidebar)
                if (currentPanel < 3) {
                    // Moving between panels needs 2 ticks
                    if (scrollDownCount >= 2) {
                        goToPanel(currentPanel + 1);
                        scrollDownCount = 0;
                    }
                } 
                // If at panel 3 (Sidebar), block scrolling down (end of page)
            }
            // Scroll UP = previous panel or exit (need 2 scrolls)
            else if (e.deltaY < -30) {
                scrollDownCount = 0; // Reset down counter when scrolling up
                scrollUpCount++;
                
                if (scrollUpCount >= 2) {
                    if (currentPanel > 0) {
                        // Go to previous panel
                        goToPanel(currentPanel - 1);
                    } else {
                        // On panel 0, exit Section 5 by allowing NEXT scroll to pass through
                        // Set flag to unlock exit
                        readyToExit = true;
                        
                        // Force clean exit state visually
                        closeSection5();
                        
                        // We also need to let the natural scroll happen NOW if possible,
                        // but since prevention has already happened, the user needs to scroll again.
                        // This corresponds to "resistance" logic.
                    }
                    scrollUpCount = 0;
                }
            }
        }, { passive: false }); // NOT passive - we need to prevent default
        
        // Function to close Section 5 interactive mode and allow natural scrolling
        function closeSection5() {
            // PARALLAX EXIT: Keep the content visible so footer slides over it
            // if (expandReveal) {
            //    expandReveal.classList.remove('visible');
            // }
            
            // Set exit flag using dataset to share state
            if (expandReveal) {
                expandReveal.dataset.exited = 'true';
            }
            // Add body class to force footer visibility via CSS
            document.body.classList.add('parallax-exited');
            
            // Remove header active state
            if (header) {
                header.classList.remove('section-5-active');
            }
            
            // PARALLAX EXIT STRATEGY:
            // Keep the wrapper FIXED (sticky) so it stays on screen
            // But lower the z-index so the Footer (z-index 200) can slide OVER it
            const expandWrapper = document.getElementById('expandTriggerWrapper');
            if (expandWrapper) {
                // Keep fixed positioning
                expandWrapper.style.position = 'fixed';
                expandWrapper.style.top = '0'; // Ensure it stays top-aligned
                expandWrapper.style.left = '0';
                expandWrapper.style.width = '100vw'; // Ensure full width
                expandWrapper.style.height = '100vh'; // Ensure full height
                expandWrapper.style.zIndex = '1'; // Move to background layer so footer covers it
                expandWrapper.style.transform = 'none';
            }
            
            // DO NOT reset to panel 0. Keep current panel (Trusted Platform) visible.
            // goToPanel(0); 
            scrollDownCount = 0;
            scrollUpCount = 0;
            
            // The page will now scroll naturally, with Footer sliding over the fixed image
            closeSection5();
        }
        
        // Touch swipe as fallback
        let startX = 0;
        let isDragging = false;
        
        document.addEventListener('touchstart', (e) => {
            if (!expandReveal || !expandReveal.classList.contains('visible')) return;
            startX = e.touches[0].clientX;
            isDragging = true;
        }, { passive: true });
        
        document.addEventListener('touchend', (e) => {
            if (!isDragging || !expandReveal || !expandReveal.classList.contains('visible')) return;
            const diff = startX - e.changedTouches[0].clientX;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0 && currentPanel < titles.length - 1) {
                    goToPanel(currentPanel + 1);
                } else if (diff < 0 && currentPanel > 0) {
                    goToPanel(currentPanel - 1);
                }
            }
            isDragging = false;
        }, { passive: true });
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToPanel(index));
        });
        
        // Title click navigation
        titles.forEach((title, index) => {
            title.addEventListener('click', () => goToPanel(index));
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!expandReveal || !expandReveal.classList.contains('visible')) return;
            
            if (e.key === 'ArrowRight' && currentPanel < titles.length - 1) {
                goToPanel(currentPanel + 1);
            } else if (e.key === 'ArrowLeft' && currentPanel > 0) {
                goToPanel(currentPanel - 1);
            }
        });
        
        function goToPanel(index) {
            // Cap index
            if (index < 0) return;
            if (index > 3) return; // Allow 3 for Sidebar

            currentPanel = index;
            
            // Handle Index 3 (Sidebar/Drawer)
            if (index === 3) {
                 if (sidebar) sidebar.classList.add('active');
                 if (expandReveal) expandReveal.classList.add('drawer-open');
                 
                 // Update dots if you had a 4th dot, else maybe keep last active or none?
                 // Let's keep dots[2] active or clear all?
                 dots.forEach(d => d.classList.remove('active'));
                 // We stop here to avoid accessing titles[3] which is undefined
                 return;
            } else {
                 // Clean up sidebar if moving away from it
                 if (sidebar) sidebar.classList.remove('active');
                 if (expandReveal) expandReveal.classList.remove('drawer-open');
            }

            // Standard Logic (0-2)
            
            // Update titles - highlight active
            titles.forEach(t => t.classList.remove('active'));
            if (titles[index]) titles[index].classList.add('active');
            
            // Slide titles horizontally - move container left
            if (titlesContainer) {
                const slideAmount = index * 200; // Shift by 200px per panel
                titlesContainer.style.transform = `translateX(-${slideAmount}px)`;
            }
            
            // Update descriptions with ascend animation
            descriptions.forEach(d => d.classList.remove('active'));
            if (descriptions[index]) descriptions[index].classList.add('active');
            
            // Update dots
            dots.forEach(d => d.classList.remove('active'));
            if (dots[index]) dots[index].classList.add('active');
            
            // Update background image parallax with smooth translateY
            if (expandBgImg) {
                const panProgress = currentPanel / (titles.length - 1);
                const translateAmount = panProgress * -10; // Move up 10% max
                expandBgImg.style.transform = `translateY(${translateAmount}%)`;
            }
        }
    }
    } // End of startRevealAnimations function
    
    // Cleanup ScrollTriggers on page unload to prevent memory leaks
    function cleanup() {
        ScrollTrigger.getAll().forEach(trigger => trigger.kill());
        gsap.killTweensOf("*");
    }
    
    window.addEventListener('beforeunload', cleanup);
    window.addEventListener('pagehide', cleanup);
});

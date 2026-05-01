// Platform Slider - Auto Swipe with Manual Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.nav-prev');
    const nextBtn = document.querySelector('.nav-next');
    const indicator = document.querySelector('.nav-indicator');
    
    if (!slider || slides.length === 0) return;
    
    let currentIndex = 0;
    const totalSlides = slides.length;
    let autoPlayInterval;
    const autoPlayDelay = 4000; // 4 seconds between slides
    
    // Update slide display with animation
    function updateSlider(direction = 'next') {
        slides.forEach((slide, index) => {
            // Remove all animation classes
            slide.classList.remove('active', 'slide-in-right', 'slide-in-left', 'slide-out-left', 'slide-out-right');
            
            if (index === currentIndex) {
                // Add entrance animation based on direction
                if (direction === 'next') {
                    slide.classList.add('active', 'slide-in-right');
                } else {
                    slide.classList.add('active', 'slide-in-left');
                }
            }
        });
        
        // Update indicator
        if (indicator) {
            indicator.textContent = `0${currentIndex + 1}`;
        }
    }
    
    // Navigate to next slide
    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider('next');
    }
    
    // Navigate to previous slide
    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider('prev');
    }
    
    // Start auto-play
    function startAutoPlay() {
        stopAutoPlay(); // Clear any existing interval
        autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
    }
    
    // Stop auto-play
    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
        }
    }
    
    // Reset auto-play timer (for manual navigation)
    function resetAutoPlay() {
        stopAutoPlay();
        startAutoPlay();
    }
    
    // Button click handlers
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoPlay(); // Reset timer when user clicks
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoPlay(); // Reset timer when user clicks
        });
    }
    
    // Pause auto-play on hover
    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);
    
    // Touch events for swipe
    let touchStartX = 0;
    let touchEndX = 0;
    
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoPlay();
    }, { passive: true });
    
    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoPlay();
    }, { passive: true });
    
    // Handle swipe direction
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
            nextSlide();
            resetAutoPlay();
        } else if (e.key === 'ArrowLeft') {
            prevSlide();
            resetAutoPlay();
        }
    });
    
    // Initialize first slide and start auto-play
    updateSlider('next');
    startAutoPlay();
});

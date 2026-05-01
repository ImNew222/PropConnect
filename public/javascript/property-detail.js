/* ========================================
   PROPERTY DETAIL PAGE SCRIPTS
   Image Gallery & Mobile Swiper
   ======================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // ========================================
    // MOBILE GALLERY SWIPER
    // ========================================
    
    const mobileSwiper = document.querySelector('.mobile-swiper');
    if (mobileSwiper) {
        const mobileSlides = mobileSwiper.querySelector('.mobile-slides');
        const mobileSlideItems = mobileSwiper.querySelectorAll('.mobile-slide');
        const mobileDots = mobileSwiper.querySelectorAll('.mobile-dots .dot');
        const mobilePrev = mobileSwiper.querySelector('.mobile-prev');
        const mobileNext = mobileSwiper.querySelector('.mobile-next');
        
        let mobileCurrentSlide = 0;
        const mobileTotalSlides = mobileSlideItems.length;
        
        function goToMobileSlide(index) {
            if (index < 0) index = mobileTotalSlides - 1;
            if (index >= mobileTotalSlides) index = 0;
            
            mobileCurrentSlide = index;
            mobileSlides.style.transform = `translateX(-${mobileCurrentSlide * 100}%)`;
            
            mobileDots.forEach((dot, i) => {
                dot.classList.toggle('active', i === mobileCurrentSlide);
            });
        }
        
        // Click navigation zones
        if (mobilePrev) {
            mobilePrev.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                goToMobileSlide(mobileCurrentSlide - 1);
            });
        }
        
        if (mobileNext) {
            mobileNext.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                goToMobileSlide(mobileCurrentSlide + 1);
            });
        }
        
        // Click dots
        mobileDots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                goToMobileSlide(index);
            });
        });
        
        // Touch/Swipe for mobile
        let mobileTouchStartX = 0;
        let mobileTouchEndX = 0;
        
        mobileSwiper.addEventListener('touchstart', (e) => {
            mobileTouchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        mobileSwiper.addEventListener('touchend', (e) => {
            mobileTouchEndX = e.changedTouches[0].screenX;
            const diff = mobileTouchStartX - mobileTouchEndX;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    goToMobileSlide(mobileCurrentSlide + 1);
                } else {
                    goToMobileSlide(mobileCurrentSlide - 1);
                }
            }
        }, { passive: true });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            // Only if mobile gallery is visible
            if (window.getComputedStyle(mobileSwiper.parentElement).display !== 'none') {
                if (e.key === 'ArrowLeft') {
                    goToMobileSlide(mobileCurrentSlide - 1);
                } else if (e.key === 'ArrowRight') {
                    goToMobileSlide(mobileCurrentSlide + 1);
                }
            }
        });
    }
    
    // ========================================
    // DESKTOP GALLERY - Click to open modal (future)
    // ========================================
    
    // ========================================
    // DESKTOP GALLERY - Click to open modal (future)
    // ========================================
    
    const galleryThumbs = document.querySelectorAll('.gallery-thumb img, .gallery-main img');
    galleryThumbs.forEach(img => {
        img.addEventListener('click', () => {
            // Future: Open lightbox modal
            console.log('Image clicked:', img.alt);
        });
    });
    
});

// Global favorite toggle function
function toggleFavorite(propertyId) {
    const btn = document.getElementById(`fav-btn-${propertyId}`);
    if (!btn) return;

    // Optimistic UI update
    const isActive = btn.classList.contains('active');
    const newState = !isActive;
    
    btn.classList.toggle('active');
    const svg = btn.querySelector('svg');
    if (newState) {
        svg.setAttribute('fill', 'currentColor');
    } else {
        svg.setAttribute('fill', 'none');
    }

    // Send API request
    fetch(`/tenant/properties/${propertyId}/toggle`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        }
    })
    .catch(error => {
        console.error('Error toggling favorite:', error);
        // Revert UI on error
        btn.classList.toggle('active');
        if (!newState) {
            svg.setAttribute('fill', 'currentColor'); 
        } else {
            svg.setAttribute('fill', 'none');
        }
    });
}

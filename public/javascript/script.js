// Mobile Menu Toggle with null safety
(function() {
    'use strict';
    
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('mobile-active');
            menuToggle.classList.toggle('open');
            
            const isOpen = menuToggle.classList.contains('open');
            menuToggle.setAttribute('aria-expanded', isOpen);
        });
    }
})();
/* ========================================
   DARK HEADER MENU TOGGLE
   Dropdown menu with mobile close button
   ======================================== */

(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', () => {
        const hamburger = document.getElementById('hamburgerMenu');
        const darkSection = document.getElementById('headerDarkSection');
        const menu = document.getElementById('headerMenu');
        const mobileCloseBtn = document.getElementById('mobileCloseBtn');
        
        if (!hamburger || !darkSection || !menu) return;
        
        function openMenu() {
            darkSection.classList.add('active');
            menu.classList.add('active');
        }
        
        function closeMenu() {
            darkSection.classList.remove('active');
            menu.classList.remove('active');
        }
        
        // Toggle menu
        hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            if (menu.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
        
        // Mobile close button
        if (mobileCloseBtn) {
            mobileCloseBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeMenu();
            });
        }
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
        
        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!darkSection.contains(e.target) && !menu.contains(e.target)) {
                closeMenu();
            }
        });
        
        // ========================================
        // MENU ITEM CLICK - Animate Welcome Text
        // ========================================
        
        const welcomeText = document.getElementById('headerWelcome');
        const menuLinks = menu.querySelectorAll('ul a[data-title]');
        
        // Set initial text based on current page
        if (welcomeText) {
            const path = window.location.pathname;
            if (path.includes('/rental') || path.includes('/property')) {
                welcomeText.textContent = 'Properties';
            } else if (path.includes('/ai-assistant')) {
                welcomeText.textContent = 'AI Assistant';
            } else if (path.includes('/dashboard')) {
                welcomeText.textContent = 'Dashboard';
            } else if (path === '/homepage' || path === '/') {
                welcomeText.textContent = 'Home';
            }
            // Otherwise keep "Welcome" as default
        }
        
        if (welcomeText && menuLinks.length > 0) {
            menuLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const newTitle = link.getAttribute('data-title');
                    const href = link.getAttribute('href');
                    
                    // Skip animation if same title or no href
                    if (welcomeText.textContent === newTitle || !href || href === '#') {
                        return; // Let normal navigation happen
                    }
                    
                    // Prevent immediate navigation
                    e.preventDefault();
                    
                    // Close menu
                    closeMenu();
                    
                    // Animate out (ascend up)
                    welcomeText.classList.add('ascend-out');
                    
                    // After animation, change text and navigate
                    setTimeout(() => {
                        welcomeText.textContent = newTitle;
                        welcomeText.classList.remove('ascend-out');
                        welcomeText.classList.add('ascend-in');
                        
                        // Navigate after text appears
                        setTimeout(() => {
                            window.location.href = href;
                        }, 200);
                    }, 400);
                });
            });
        }
    });
})();

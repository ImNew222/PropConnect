<!-- PandaPay-Style Dark Header -->
<header class="dark-header">
    <!-- Left Dark Section: Logo + Hamburger -->
    <div class="header-dark-section" id="headerDarkSection">
        <a href="/homepage" class="header-logo">
            PropConnect <span class="logo-icon">@</span>
        </a>
        
        <button class="hamburger-menu" id="hamburgerMenu" aria-label="Toggle menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>
    
    <!-- White Section: Welcome + Support -->
    <div class="header-white-section">
        <div class="header-welcome-wrapper">
            <span class="header-welcome" id="headerWelcome">Welcome</span>
        </div>
        <hr class="header-hr-mobile">
        
        <div class="header-right-links">
            @auth
                <a href="/dashboard" class="header-link {{ Auth::user()->role === 'landlord' ? 'user-landlord' : 'user-tenant' }}">
                    {{ Auth::user()->name }}
                    <span class="role-badge">{{ Auth::user()->role === 'landlord' ? 'Landlord' : 'User' }}</span>
                </a>
            @else
                <a href="/login" class="header-link">Login</a>
            @endauth
        </div>
    </div>
</header>

<!-- Dropdown Menu (positioned below header on desktop, above on mobile) -->
<nav class="header-menu" id="headerMenu">
    <!-- Mobile: Logo + Close button at top of menu -->
    <div class="header-menu-logo">
        <a href="/homepage" class="header-logo">
            PropConnect <span class="logo-icon">@</span>
        </a>
        <button class="mobile-close-btn" id="mobileCloseBtn" aria-label="Close menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <ul>
        <li style="--delay: 0"><a href="/homepage" data-title="Home" class="{{ request()->is('homepage') ? 'active' : '' }}">Home</a></li>
        <li style="--delay: 1"><a href="#" data-title="About">About</a></li>
        <li style="--delay: 2"><a href="/rental" data-title="Properties" class="{{ request()->is('rental*') || request()->is('property*') ? 'active' : '' }}">Properties</a></li>
        <li style="--delay: 3"><a href="/ai-assistant" data-title="AI Assistant">AI Assistant</a></li>
        @auth
            <li style="--delay: 4"><a href="/messages" data-title="Message" class="{{ request()->is('messages*') ? 'active' : '' }}">Message</a></li>
            <li style="--delay: 5"><a href="/dashboard" data-title="Dashboard">Dashboard</a></li>
        @else
            <li style="--delay: 4"><a href="/login" data-title="Login" class="login-link">Login</a></li>
            <li style="--delay: 5"><a href="/register" data-title="Register" class="register-link">Register</a></li>
        @endauth
    </ul>
    
    <div class="header-menu-footer">
        <div class="social-icons">
            <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg></a>
            <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
        </div>
    </div>
</nav>

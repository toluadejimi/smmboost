<!-- Header -->
<header class="header">
    <a href="#" class="logo selectable-text">{{ basicControl()->site_title }}</a>
    
    <!-- Desktop Navigation -->
    <nav class="nav-links">
        <a href="{{route('login')}}" class="nav-link">
            Sign In
        </a>
        <a href="{{route('register')}}" class="nav-link primary">
            Get Started
        </a>
    </nav>
    
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>
</header>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobile-overlay"></div>

<!-- Mobile Sidebar -->
<nav class="mobile-sidebar" id="mobile-sidebar">
    <div class="mobile-nav-links">
        <a href="#services" class="mobile-nav-link">Our Services</a>
        <a href="#testimonials" class="mobile-nav-link">Testimonials</a>
        <a href="#faq" class="mobile-nav-link">FAQ</a>
        <a href="{{route('login')}}" class="mobile-nav-link">Sign In</a>
        <a href="{{route('register')}}" class="mobile-nav-link primary">Get Started</a>
    </div>
</nav>
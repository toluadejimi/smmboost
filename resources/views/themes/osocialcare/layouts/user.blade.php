<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ getFile(basicControl()->favicon_driver, basicControl()->favicon) }}" rel="icon">

    <title>@yield('title') | {{ basicControl()->site_title }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Default to dark mode
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark')
        } else {
            document.documentElement.classList.add('dark')
            localStorage.setItem('theme', 'dark')
        }
    </script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* KEY FIX: Ensure full height layout */
        html, body {
            height: 100%;
            overflow-x: hidden;
            max-width: 100vw;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-track {
            background: #374151;
        }
        ::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 2px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
            box-sizing: border-box;
        }

        /* Prevent zoom on input focus (iOS Safari) */
        input, select, textarea {
            font-size: 16px !important;
        }
        
        @media screen and (min-width: 768px) {
            input, select, textarea {
                font-size: 12px !important;
            }
        }

        /* Additional styles for custom components */
        .bg-gray-850 {
            background-color: #1f2937;
        }

        /* SweetAlert2 dark theme customizations */
        .swal2-popup.bg-gray-800 {
            background-color: #1f2937 !important;
            border: 1px solid #374151;
        }
        
        .swal2-title.text-gray-100 {
            color: #f3f4f6 !important;
            font-size: 14px !important;
        }
        
        .swal2-content.text-gray-300 {
            color: #d1d5db !important;
            font-size: 12px !important;
        }

        /* Smooth gradient animations */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .bg-gradient-to-r {
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }

        /* KEY FIXES for full height layout */
        .main-container {
            width: 100vw;
            max-width: 100vw;
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }

        .sidebar-container {
            width: 224px;
            min-width: 224px;
            max-width: 224px;
            height: 100vh;
        }

        @media (max-width: 639px) {
            .sidebar-container {
                width: 224px;
                min-width: 224px;
                max-width: 224px;
            }
        }

        .content-container {
            flex: 1;
            min-width: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Main content should fill remaining space */
        .main-content-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            height: 0; /* This forces flex-grow to work properly */
        }

        /* Bottom navigation styles */
        .bottom-nav-item {
            transition: all 0.2s ease-in-out;
        }
        
        .bottom-nav-item.active {
            transform: translateY(-2px);
        }
        
        .bottom-nav-item.active .nav-icon {
            color: #fb923c;
        }
        
        .bottom-nav-item.active .nav-text {
            color: #fb923c;
        }

        /* Add padding bottom to main content on mobile to account for bottom nav */
        @media (max-width: 1023px) {
            .main-content-mobile {
                padding-bottom: 70px;
            }
        }
    </style>
    </style>

    @stack('css-lib')

    @stack('style')

</head>

<body class="overflow-hidden">

    <div class="main-container flex bg-gray-900">

        @include(template() . 'partials.dash-sidebar')

        <!-- Main Content -->
        <div class="content-container bg-gray-900">
            @include(template() . 'partials.mobile-header')

            @include(template() . 'partials.dash-header')

            <!-- Main Content Area -->
            <main class="main-content-area bg-gray-900 main-content-mobile">
                @yield('content')
            </main>

            @include(template() . 'partials.footer')
        </div>

        @include(template() . 'partials.bottom-navigation')
    </div>

    @stack('js-lib')

    @stack('script')

    @include('plugins')

    <!-- JavaScript for Sidebar Toggle and Theme Toggle -->
    <script>
        // Sidebar functionality
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");
        const openSidebar = document.getElementById("openSidebar");
        const closeSidebar = document.getElementById("closeSidebar");

        function showSidebar() {
            sidebar.classList.remove("-translate-x-full");
            sidebarOverlay.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
        }

        function hideSidebar() {
            sidebar.classList.add("-translate-x-full");
            sidebarOverlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }

        if (openSidebar) openSidebar.addEventListener("click", showSidebar);
        if (closeSidebar)
            closeSidebar.addEventListener("click", hideSidebar);
        if (sidebarOverlay)
            sidebarOverlay.addEventListener("click", hideSidebar);

        // Close sidebar on resize to desktop
        window.addEventListener("resize", function() {
            if (window.innerWidth >= 1024) {
                hideSidebar();
            }
        });

        // Mobile Menu functionality
        const mobileMenuToggle =
            document.getElementById("mobileMenuToggle");
        const mobileMenuOverlay =
            document.getElementById("mobileMenuOverlay");

        function showMobileMenu() {
            mobileMenuOverlay.classList.remove("hidden");
        }

        function hideMobileMenu() {
            mobileMenuOverlay.classList.add("hidden");
        }

        if (mobileMenuToggle)
            mobileMenuToggle.addEventListener("click", showMobileMenu);
        if (mobileMenuOverlay)
            mobileMenuOverlay.addEventListener("click", hideMobileMenu);

        // Theme toggle functionality
        const themeToggle = document.getElementById("themeToggle");
        const htmlElement = document.documentElement;
        const toggleDot = document.getElementById("toggleDot");
        const lightIcon = document.getElementById("lightIcon");
        const darkIcon = document.getElementById("darkIcon");
        const themeTextLight = document.getElementById("themeTextLight");
        const themeTextDark = document.getElementById("themeTextDark");

        function updateThemeUI() {
            const isDark = htmlElement.classList.contains("dark");

            if (isDark) {
                // Dark mode active (default)
                toggleDot.style.transform = "translateX(14px)"; // Move toggle to right
                toggleDot.style.backgroundColor = "#fb923c"; // Orange color
                lightIcon.style.display = "block"; // Show sun icon
                darkIcon.style.display = "none"; // Hide moon icon
                themeTextLight.style.display = "none"; // Hide "Dark Mode" text
                themeTextDark.style.display = "block"; // Show "Light Mode" text
            } else {
                // Light mode active
                toggleDot.style.transform = "translateX(2px)"; // Move toggle to left
                toggleDot.style.backgroundColor = "#6b7280"; // Gray color
                lightIcon.style.display = "none"; // Hide sun icon
                darkIcon.style.display = "block"; // Show moon icon
                themeTextLight.style.display = "block"; // Show "Dark Mode" text
                themeTextDark.style.display = "none"; // Hide "Light Mode" text
            }
        }

        function toggleTheme() {
            const isDark = htmlElement.classList.contains("dark");

            if (isDark) {
                htmlElement.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                htmlElement.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }

            updateThemeUI();
        }

        // Initialize theme UI on page load - default to dark
        document.addEventListener("DOMContentLoaded", function() {
            // Ensure dark mode is set by default
            if (!localStorage.getItem("theme")) {
                localStorage.setItem("theme", "dark");
                htmlElement.classList.add("dark");
            }
            updateThemeUI();
        });

        if (themeToggle) {
            themeToggle.addEventListener("click", toggleTheme);
        }

        // Prevent zoom on input focus for iOS Safari
        const allInputs = document.querySelectorAll(
            "input, select, textarea"
        );
        allInputs.forEach((input) => {
            input.addEventListener("focus", () => {
                input.style.fontSize = "16px";
            });
            input.addEventListener("blur", () => {
                if (window.innerWidth >= 768) {
                    input.style.fontSize = "12px";
                } else {
                    input.style.fontSize = "16px";
                }
            });
        });
    </script>

    <!-- SweetAlert2 Flash Messages -->
    <script>
        // Configure SweetAlert2 for dark theme
        const swalWithDarkTheme = Swal.mixin({
            customClass: {
                popup: "bg-gray-800 text-gray-100",
                title: "text-gray-100",
                content: "text-gray-300",
                confirmButton: "bg-orange-600 hover:bg-orange-700 text-white px-3 py-2 rounded-lg font-medium transition-colors text-xs",
                cancelButton: "bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg font-medium transition-colors text-xs",
            },
            buttonsStyling: false,
        });
    </script>

    @if ($errors->any())
        <script>
            let errorMessages = `{!! implode('\n', $errors->all()) !!}`;
            swalWithDarkTheme.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessages,
                confirmButtonText: 'Okay',
                iconColor: '#f87171'
            });
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            swalWithDarkTheme.fire({
                icon: 'success',
                title: 'Success',
                text: "@lang(session('success'))",
                confirmButtonText: 'Okay',
                iconColor: '#10b981'
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            swalWithDarkTheme.fire({
                icon: 'error',
                title: 'Error',
                text: "@lang(session('error'))",
                confirmButtonText: 'Okay',
                iconColor: '#10b981'
            });
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            swalWithDarkTheme.fire({
                icon: 'warning',
                title: 'Warning',
                text: "@lang(session('warning'))",
                confirmButtonText: 'Okay',
                iconColor: '#10b981'
            });
        </script>
    @endif

     <div
        class="fixed bottom-2 pb-28 left-6 flex flex-col items-center space-y- z-50"
    >
        <!-- WhatsApp Button -->
        <a
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg transition duration-300"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="white"
                viewBox="0 0 24 24"
            >
                <path
                    d="M20.52 3.48A11.86 11.86 0 0012 0a11.94 11.94 0 00-10.38 6.13 11.81 11.81 0 00-1.1 4.94 11.94 11.94 0 001.65 6L0 24l6.25-2.05a11.86 11.86 0 0011.53-1.48 12 12 0 002.74-2.74 11.91 11.91 0 000-16.95zM12 22a9.94 9.94 0 01-5.09-1.4l-.36-.22-3.71 1.22 1.22-3.61-.23-.37A10 10 0 1112 22zm5.4-7.6c-.3-.15-1.76-.86-2.04-.96s-.48-.15-.69.15-.79.96-.96 1.16-.36.23-.66.08a8.3 8.3 0 01-2.44-1.5 9.3 9.3 0 01-1.72-2.12c-.18-.3 0-.46.13-.61.13-.14.3-.36.45-.54s.23-.3.3-.51a.59.59 0 000-.57c-.07-.15-.69-1.65-.96-2.27s-.51-.51-.69-.51-.38 0-.58 0a1.13 1.13 0 00-.82.38 3.42 3.42 0 00-1 2.54A6.5 6.5 0 009.07 14a11.6 11.6 0 005.37 1.5c.39 0 .78-.02 1.17-.05.36-.03 1.1-.43 1.26-.85s.16-1.03.08-1.12-.27-.19-.57-.34z"
                />
            </svg>
        </a>

        <!-- Telegram Button -->
        <!--<a href="https://t.me/oprimeaccsdigital" target="_blank" rel="noopener noreferrer"-->
        <!--   class="bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-full shadow-lg transition duration-300">-->
        <!--    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24">-->
        <!--        <path d="M9.042 16.555l-.389 3.875c.557 0 .798-.238 1.09-.524l2.614-2.497 5.416 3.943c.993.547 1.702.26 1.958-.921l3.546-16.652c.314-1.464-.518-2.032-1.486-1.677L1.99 10.062c-1.45.567-1.432 1.368-.252 1.736l5.667 1.77 13.127-8.27c.617-.375 1.177-.167.717.208l-10.05 9.11z"/>-->
        <!--    </svg>-->
        <!--</a>-->
    </div>

    @if (session()->has('success'))
        <script>
            Notiflix.Notify.success("@lang(session('success'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Notiflix.Notify.failure("@lang(session('error'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            Notiflix.Notify.warning("@lang(session('warning'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

</body>

</html>

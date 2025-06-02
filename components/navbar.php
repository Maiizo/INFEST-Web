<script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'dropdown-enter': 'dropdown-enter 0.2s ease-out',
                    'dropdown-exit': 'dropdown-exit 0.2s ease-in',
                    'mobile-menu-enter': 'mobile-menu-enter 0.3s ease-out',
                    'mobile-menu-exit': 'mobile-menu-exit 0.3s ease-in'
                },
                keyframes: {
                    'dropdown-enter': {
                        '0%': { opacity: '0', transform: 'translateY(-10px) scale(0.95)' },
                        '100%': { opacity: '1', transform: 'translateY(0) scale(1)' }
                    },
                    'dropdown-exit': {
                        '0%': { opacity: '1', transform: 'translateY(0) scale(1)' },
                        '100%': { opacity: '0', transform: 'translateY(-10px) scale(0.95)' }
                    },
                    'mobile-menu-enter': {
                        '0%': { opacity: '0', transform: 'scaleY(0)' },
                        '100%': { opacity: '1', transform: 'scaleY(1)' }
                    },
                    'mobile-menu-exit': {
                        '0%': { opacity: '1', transform: 'scaleY(1)' },
                        '100%': { opacity: '0', transform: 'scaleY(0)' }
                    }
                }
            }
        }
    }
</script>

<style>
    .navbar-default {
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .navbar-scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-scrolled .nav-link {
        color: #374151 !important;
    }
    
    .navbar-scrolled .nav-link:hover {
        color: #14b8a6 !important;
    }
    
    .navbar-scrolled .brand-text {
        color: #1F2937 !important;
    }
    
    .navbar-scrolled .mobile-btn {
        color: #374151 !important;
    }
    
    .navbar-scrolled .profile-btn {
        color: #6B7280 !important;
    }
    
    .navbar-scrolled .profile-btn:hover {
        color: #14b8a6 !important;
    }
</style>

<nav id="navbar" class="fixed top-0 left-0 w-full z-30 navbar-default transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Brand -->
            <div class="flex items-center">
                <a href="/views/home.php" class="flex items-center space-x-2 transform transition-all duration-300 hover:scale-105">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-amber-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">UG</span>
                    </div>
                    <span class="text-xl font-bold text-white brand-text transition-colors duration-300">UnityGrid</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/views/home.php"
                    class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="/views/browse_offers.php"
                    class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                    Browse Offers
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="/views/post_offers.php"
                    class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                    Post Offers
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Profile Dropdown & Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <!-- Profile Dropdown (Desktop) -->
                <div class="hidden md:block relative">
                    <button id="profile-btn" type="button"
                        class="profile-btn p-2 text-gray-300 hover:text-teal-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 focus:ring-offset-transparent rounded-full transition-all duration-300 transform hover:scale-110"
                        aria-label="Profile menu" aria-expanded="false" aria-haspopup="true">
                        <svg class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>

                    <div id="profile-dropdown"
                        class="absolute top-full right-0 mt-2 w-48 bg-white/95 backdrop-blur-sm shadow-xl rounded-lg py-2 z-10 opacity-0 scale-95 transform transition-all duration-200 ease-out pointer-events-none border border-gray-200">
                        <a href="/components/signup.php"
                            class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                            Sign Up
                        </a>
                        <a href="/components/sign_in.php"
                            class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                            Sign In
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn"
                        class="mobile-btn text-white hover:text-teal-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 focus:ring-offset-transparent rounded-lg p-2 transition-all duration-300 transform hover:scale-110 active:scale-95"
                        aria-label="Toggle mobile menu" aria-expanded="false">
                        <svg id="menu-icon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="md:hidden bg-white/95 backdrop-blur-sm shadow-lg border-t border-gray-200 transform origin-top scale-y-0 opacity-0 transition-all duration-300 ease-out overflow-hidden">
        <div class="px-4 py-6 space-y-3">
            <!-- Navigation Links -->
            <div class="space-y-2 mb-6">
                <a href="/views/home.php"
                    class="block py-3 px-4 text-gray-800 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                    Home
                </a>
                <a href="/views/browse_offers.php"
                    class="block py-3 px-4 text-gray-800 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                    Browse Offers
                </a>
                <a href="/views/post_offers.php"
                    class="block py-3 px-4 text-gray-800 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                    Post Offers
                </a>
            </div>
            
            <!-- Divider -->
            <hr class="border-gray-300">
            
            <!-- Auth Links -->
            <div class="space-y-2 pt-4">
                <a href="/components/signup.php"
                    class="block py-3 px-4 text-center bg-gradient-to-r from-orange-500 to-red-500 text-white hover:from-orange-600 hover:to-red-600 rounded-lg transition-all duration-200 font-medium">
                    Sign Up
                </a>
                <a href="/components/sign_in.php"
                    class="block py-3 px-4 text-center border border-teal-500 text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                    Sign In
                </a>
            </div>
        </div>
    </div>
</nav>


<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    mobileMenuBtn.addEventListener('click', function () {
        const isHidden = mobileMenu.classList.contains('scale-y-0');

        if (isHidden) {
            mobileMenu.classList.remove('scale-y-0', 'opacity-0');
            mobileMenu.classList.add('scale-y-100', 'opacity-100');
            menuIcon.classList.add('hidden', 'rotate-90');
            closeIcon.classList.remove('hidden', 'rotate-90');
            closeIcon.classList.add('rotate-0');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
        } else {
            mobileMenu.classList.remove('scale-y-100', 'opacity-100');
            mobileMenu.classList.add('scale-y-0', 'opacity-0');
            menuIcon.classList.remove('hidden', 'rotate-90');
            menuIcon.classList.add('rotate-0');
            closeIcon.classList.add('hidden', 'rotate-90');
            closeIcon.classList.remove('rotate-0');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');
    let dropdownTimeout;

    function showDropdown() {
        clearTimeout(dropdownTimeout);
        profileDropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
        profileDropdown.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
        profileBtn.setAttribute('aria-expanded', 'true');
    }

    function hideDropdown() {
        dropdownTimeout = setTimeout(() => {
            profileDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            profileDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            profileBtn.setAttribute('aria-expanded', 'false');
        }, 150);
    }

    profileBtn.addEventListener('mouseenter', showDropdown);
    profileBtn.addEventListener('mouseleave', hideDropdown);
    profileDropdown.addEventListener('mouseenter', showDropdown);
    profileDropdown.addEventListener('mouseleave', hideDropdown);
    profileBtn.addEventListener('focus', showDropdown);
    profileBtn.addEventListener('blur', hideDropdown);

    document.addEventListener('click', function (event) {
        if (!profileBtn.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            profileDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            profileBtn.setAttribute('aria-expanded', 'false');
        }

        if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.remove('scale-y-100', 'opacity-100');
            mobileMenu.classList.add('scale-y-0', 'opacity-0');
            menuIcon.classList.remove('hidden', 'rotate-90');
            closeIcon.classList.add('hidden', 'rotate-90');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            mobileMenu.classList.remove('scale-y-100', 'opacity-100');
            mobileMenu.classList.add('scale-y-0', 'opacity-0');
            menuIcon.classList.remove('hidden', 'rotate-90');
            closeIcon.classList.add('hidden', 'rotate-90');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');

            profileDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            profileDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            profileBtn.setAttribute('aria-expanded', 'false');
        }
    });


   window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    const section1 = document.getElementById('hero'); 
    if (section1) {
        const section1Bottom = section1.offsetTop + section1.offsetHeight;
        
        if (window.scrollY > section1Bottom) {
            navbar.classList.remove('navbar-default');
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
            navbar.classList.add('navbar-default');
        }
    } else {
        // Fallback if no hero section exists
        if (window.scrollY > 50) {
            navbar.classList.remove('navbar-default');
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
            navbar.classList.add('navbar-default');
        }
    }
});
</script>
<?php

include_once 'controller.php';

// Get current user
$currentUser = getCurrentUser();

?>

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
                        '0%': {
                            opacity: '0',
                            transform: 'translateY(-10px) scale(0.95)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'translateY(0) scale(1)'
                        }
                    },
                    'dropdown-exit': {
                        '0%': {
                            opacity: '1',
                            transform: 'translateY(0) scale(1)'
                        },
                        '100%': {
                            opacity: '0',
                            transform: 'translateY(-10px) scale(0.95)'
                        }
                    },
                    'mobile-menu-enter': {
                        '0%': {
                            opacity: '0',
                            transform: 'scaleY(0)'
                        },
                        '100%': {
                            opacity: '1',
                            transform: 'scaleY(1)'
                        }
                    },
                    'mobile-menu-exit': {
                        '0%': {
                            opacity: '1',
                            transform: 'scaleY(1)'
                        },
                        '100%': {
                            opacity: '0',
                            transform: 'scaleY(0)'
                        }
                    }
                }
            }
        }
    }
</script>

<style>
    @media (min-width: 768px) {
        .navbar-default {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
        }

        .navbar-scrolled .nav-link {
            color: #374151 !important;
        }

        .navbar-scrolled .nav-link:hover {
            color: #14b8a6 !important;
        }

        .navbar-scrolled .brand-text {
            color: rgb(255, 255, 255) !important;
        }

        .navbar-scrolled .mobile-btn {
            color: #14b8a6 !important;
        }

        .navbar-scrolled .profile-btn {
            color: #6B7280 !important;
        }

        .navbar-scrolled .profile-btn:hover {
            color: #14b8a6 !important;
        }
    }
</style>

<div class="m-0 p-0 relative w-screen">
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
                    <!-- In your navbar.php, replace the profile link with: -->
                    <?php if ($currentUser): ?>
                        <a href="/views/profile.php"
                            class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                            Profile
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    <?php else: ?>
                        <a href="/components/sign_in.php?message=Please log in to access your profile"
                            class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                            Profile
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    <?php endif; ?>
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
                            <?php if (isset($_SESSION['name'])): ?>
                                <div class="px-4 py-2 text-gray-800 font-medium border-b border-gray-200">
                                    Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>
                                </div>
                                <a href="/views/profile.php"
                                    class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                                    Profile
                                </a>
                                <a href="/components/logout.php"
                                    class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                                    Logout
                                </a>
                            <?php else: ?>
                                <a href="/components/signup.php"
                                    class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                                    Sign Up
                                </a>
                                <a href="/components/sign_in.php"
                                    class="block px-4 py-2 text-gray-800 hover:bg-teal-50 hover:text-teal-600 transition-colors duration-200 rounded-md mx-1 font-medium">
                                    Sign In
                                </a>
                            <?php endif; ?>
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
            class="md:hidden bg-white/95 overflow-hidden">
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
                    <!-- In your navbar.php, replace the profile link with: -->
                    <?php if ($currentUser): ?>
                        <a href="/views/profile.php"
                            class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                            Profile
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    <?php else: ?>
                        <a href="/components/sign_in.php?message=Please log in to access your profile"
                            class="nav-link text-white hover:text-teal-400 transition-all duration-300 font-medium relative group">
                            Profile
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Divider -->
                <hr class="border-gray-300">

                <!-- Auth Links -->
                <div class="space-y-2 pt-4">
                    <?php if (isset($_SESSION['name'])): ?>
                        <div class="py-3 px-4 text-gray-800 font-medium">
                            Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>
                        </div>
                        <a href="/components/logout.php"
                            class="block py-3 px-4 text-center border border-teal-500 text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="/components/signup.php"
                            class="block py-3 px-4 text-center bg-gradient-to-r from-orange-500 to-red-500 text-white hover:from-orange-600 hover:to-red-600 rounded-lg transition-all duration-200 font-medium">
                            Sign Up
                        </a>
                        <a href="/components/sign_in.php"
                            class="block py-3 px-4 text-center border border-teal-500 text-teal-600 hover:bg-teal-50 rounded-lg transition-all duration-200 font-medium">
                            Sign In
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Shopping Cart Button (if user is logged in) -->
    <?php if ($currentUser): ?>
        <button
            class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-orange-500 to-teal-400 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-3xl hover:scale-110 group glassmorphism border border-white/30"
            onclick="openCart()" aria-label="Open exchange cart">
            <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M9 19h.01M20 19h.01"></path>
            </svg>
            <span id="cart-badge"
                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold animate-pulse shadow-lg">
                0
            </span>
        </button>
    <?php else: ?>
        <button
            class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-blue-500 to-purple-500 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-3xl hover:scale-110 group glassmorphism border border-white/30"
            onclick="window.location.href='/components/sign_in.php'" aria-label="Login">
            <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110 text-white" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>
    <?php endif; ?>


    <!-- Include Shopping Cart if user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php include 'shopping_cart.php'; ?>
    <?php endif; ?>
</div>



<script>
    // NEW: JavaScript functions for enhanced functionality

    // Shopping cart functionality
    let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

    function updateCartBadge() {
        const badge = document.getElementById('cart-badge');
        if (badge) {
            console.log("cartItems length : " + cartItems.length)
            badge.textContent = cartItems.length;
            badge.style.display = cartItems.length > 0 ? 'flex' : 'none';
        }
    }

    function makeOffer(requestId) {
        // Add to cart functionality
        const existingItem = cartItems.find(item => item.id === requestId);
        if (!existingItem) {
            cartItems.push({
                id: requestId,
                timestamp: new Date().toISOString()
            });
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartBadge();

            // Show success message
            showNotification('Added to exchange cart!', 'success');
        } else {
            showNotification('Already in cart!', 'info');
        }
    }

    function viewDetails(requestId) {
        // Redirect to details page (to be created)
        window.location.href = `offer_details.php?id=${requestId}`;
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

        if (type === 'success') {
            notification.classList.add('bg-green-500', 'text-white');
        } else if (type === 'error') {
            notification.classList.add('bg-red-500', 'text-white');
        } else {
            notification.classList.add('bg-blue-500', 'text-white');
        }

        notification.textContent = message;
        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        // Animate out and remove
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Shopping cart functions (from original shopping_cart.php)
    function openCart() {
        const overlay = document.getElementById('cartOverlay');
        const slider = document.getElementById('cartSlider');

        if (overlay && slider) {
            console.log("Buka. Cart items: " + cartItems.length)
            overlay.classList.remove('opacity-0', 'invisible');
            overlay.classList.add('opacity-100', 'visible');
            slider.classList.remove('translate-x-full');
            slider.classList.add('translate-x-0');
            document.body.classList.add('overflow-hidden');

            // Load cart items
            loadCartItems();
        }
    }

    function closeCart() {
        const overlay = document.getElementById('cartOverlay');
        const slider = document.getElementById('cartSlider');

        if (overlay && slider) {
            overlay.classList.remove('opacity-100', 'visible');
            overlay.classList.add('opacity-0', 'invisible');
            slider.classList.remove('translate-x-0');
            slider.classList.add('translate-x-full');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function loadCartItems() {
        const cartContainer = document.getElementById('cartItems');
        if (!cartContainer) return;

        if (cartItems.length === 0) {
            cartContainer.innerHTML = `
                    <div class="flex flex-col items-center justify-center text-center py-16 px-5 text-gray-500">
                        <div class="text-6xl mb-6 opacity-50">🤝</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-700">No Exchange Requests Yet</h3>
                        <p class="text-sm text-gray-500 max-w-xs">Start connecting with your community!</p>
                    </div>
                `;
            return;
        }

        // In a real application, you would fetch item details from the server
        // For now, we'll show placeholder content
        cartContainer.innerHTML = cartItems.map(item => `
                <div class="exchange-item bg-orange-50 rounded-2xl p-5 border-l-4 border-orange-500 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-500 to-teal-400 flex items-center justify-center text-white font-bold text-lg mr-4 flex-shrink-0">
                            ID
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-800 mb-1 truncate">Request #${item.id}</h3>
                            <p class="text-sm text-gray-600">Added to cart</p>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button onclick="viewDetails(${item.id})" class="flex-1 py-2 px-4 bg-orange-500 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:bg-orange-600">
                            View Details
                        </button>
                        <button onclick="removeFromCart(${item.id})" class="flex-1 py-2 px-4 bg-white text-red-500 border-2 border-red-500 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-red-500 hover:text-white">
                            Remove
                        </button>
                    </div>
                </div>
            `).join('');
    }

    function removeFromCart(requestId) {
        console.log("in remove cart cart items is currently : " + cartItems.length)
        cartItems = cartItems.filter(item => item.id !== requestId);
        console.log("in remove cart cart items is now : " + cartItems.length)
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartBadge();
        loadCartItems();
        showNotification('Removed from cart', 'info');
    }

    // Initialize cart badge on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartBadge();
    });

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    mobileMenuBtn.addEventListener('click', function() {
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

    document.addEventListener('click', function(event) {
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

    document.addEventListener('keydown', function(event) {
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


    window.addEventListener('scroll', function() {
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
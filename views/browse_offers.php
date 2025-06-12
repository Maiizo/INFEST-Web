<?php
// ENHANCED BROWSE OFFERS PAGE: Modified from .php to .php for database integration
// Added dynamic content loading from database and session management

include_once '../components/controller.php';

// Get current user
$currentUser = getCurrentUser();

// Get filter parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

// Get help requests from database
$helpRequests = getHelpRequestsForBrowse($filter, $category, $location);

// Get categories for dropdown
$categories = getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnityGrid Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glassmorphism-white {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        .floating-animation-delayed {
            animation: floating 6s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .floating-animation-delayed-2 {
            animation: floating 6s ease-in-out infinite;
            animation-delay: 4s;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(-10px) rotate(-3deg); }
            75% { transform: translateY(-15px) rotate(3deg); }
        }
        
        .feature-card {
            transition: all 0.3s ease;
            transform: perspective(1000px) rotateY(0deg);
        }
        
        .feature-card:hover {
            transform: perspective(1000px) rotateY(5deg) translateZ(20px);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
        }
    </style>
</head>

<body>
    <!-- Include navbar with session management -->
    <?php include '../components/navbar.php'; ?>

    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen pt-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-32 h-32 bg-teal-400 rounded-full blur-3xl floating-animation"></div>
            <div class="absolute bottom-40 right-20 w-40 h-40 bg-orange-500 rounded-full blur-3xl floating-animation-delayed"></div>
            <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-yellow-400 rounded-full blur-2xl floating-animation-delayed-2"></div>
            <div class="absolute top-1/3 left-1/3 w-28 h-28 bg-purple-500 rounded-full blur-2xl floating-animation"></div>
        </div>
        
        <div class="relative z-10">
            <!-- Header -->
            <header class="glassmorphism-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                        Professional 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-teal-400">Exchange Marketplace</span>
                    </h1>
                    <p class="text-gray-300 text-xl">Connect with verified professionals and exchange high-quality goods and services</p>
                </div>
            </header>

        <!-- Filters Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="" class="glassmorphism rounded-xl p-6 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-2 items-center">
                        <span class="text-sm font-medium text-white mr-2">Filter by:</span>

                        <button type="submit" name="filter" value="all" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105
                                   <?php echo ($filter == 'all') ? 'bg-gradient-to-r from-orange-500 to-teal-400 text-white shadow-lg' : 'glassmorphism text-white hover:bg-white/20'; ?>">
                            All
                        </button>

                        <button type="submit" name="filter" value="goods" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105
                                   <?php echo ($filter == 'goods') ? 'bg-gradient-to-r from-orange-500 to-teal-400 text-white shadow-lg' : 'glassmorphism text-white hover:bg-white/20'; ?>">
                            Goods
                        </button>

                        <button type="submit" name="filter" value="services" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105
                                   <?php echo ($filter == 'services') ? 'bg-gradient-to-r from-orange-500 to-teal-400 text-white shadow-lg' : 'glassmorphism text-white hover:bg-white/20'; ?>">
                            Services
                        </button>
                    </div>

                    <!-- Location Filters -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select name="location" onchange="this.form.submit()"
                            class="px-3 py-2 glassmorphism border border-white/30 rounded-xl text-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 text-white bg-transparent">
                            <option value="" class="bg-gray-800 text-white">All Locations</option>
                            <?php foreach ($availableLocations as $availableLocation): ?>
                                <option value="<?php echo htmlspecialchars($availableLocation); ?>" 
                                        <?php echo ($location == $availableLocation) ? 'selected' : ''; ?> 
                                        class="bg-gray-800 text-white">
                                    <?php echo htmlspecialchars($availableLocation); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <?php if (empty($helpRequests)): ?>
                    <!-- No results message -->
                    <div class="col-span-2 text-center py-12">
                        <div class="glassmorphism rounded-2xl p-12 max-w-md mx-auto">
                            <div class="text-teal-400 text-6xl mb-4">🔍</div>
                            <h3 class="text-xl font-semibold text-white mb-2">No offers found</h3>
                            <p class="text-gray-300">Try adjusting your filters or check back later for new offers.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($helpRequests as $request): ?>
                        <!-- Dynamic Card Generation -->
                        <div class="glassmorphism rounded-xl shadow-lg hover:shadow-2xl card-hover feature-card border border-white/20">
                            <!-- User Info -->
                            <div class="p-6 pb-4">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-teal-400 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                        <?php echo strtoupper(substr($request['user_name'] ?? 'U', 0, 2)); ?>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-white text-base"><?php echo htmlspecialchars($request['user_name'] ?? 'Anonymous'); ?></h3>
                                        <p class="text-sm text-gray-300"><?php echo htmlspecialchars($request['help_request_location']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Two Column Layout: Offering & Seeking -->
                            <div class="px-6 pb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- OFFERING Section -->
                                    <div>
                                        <div class="mb-4">
                                            <span class="px-3 py-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs rounded-full font-medium shadow-lg">OFFERING</span>
                                        </div>

                                        <!-- Image Placeholder -->
                                        <div class="glassmorphism rounded-xl h-36 mb-4 flex items-center justify-center relative overflow-hidden group">
                                            <?php if (!empty($request['help_request_image_url'])): ?>
                                                <img src="<?php echo htmlspecialchars($request['help_request_image_url']); ?>" 
                                                     alt="Product Image" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                            <?php else: ?>
                                                <span class="text-orange-400 font-bold text-base">NO IMAGE</span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Content -->
                                        <div>
                                            <h4 class="font-bold text-white mb-2 text-lg"><?php echo htmlspecialchars($request['name_of_product']); ?></h4>
                                            <div class="flex gap-1 mb-3">
                                                <span class="px-2 py-1 bg-teal-400/20 text-teal-400 text-xs rounded-full border border-teal-400/30">
                                                    <?php echo htmlspecialchars($request['category_name'] ?? 'General'); ?>
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-300 mb-4 leading-relaxed"><?php echo htmlspecialchars(substr($request['product_description'], 0, 100)); ?>...</p>

                                            <?php if ($currentUser): ?>
                                                <button onclick="makeOffer(<?php echo $request['id']; ?>)"
                                                    class="w-full px-4 py-3 rounded-xl text-sm font-semibold bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                                                    Make Offer
                                                </button>
                                            <?php else: ?>
                                                <button onclick="window.location.href='/components/sign_in.php'"
                                                    class="w-full px-4 py-3 rounded-xl text-sm font-semibold glassmorphism text-white hover:bg-white/20 transition-all duration-300">
                                                    Login to Make Offer
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- SEEKING Section -->
                                    <div>
                                        <div class="mb-4">
                                            <span class="px-3 py-1 bg-gradient-to-r from-teal-500 to-green-500 text-white text-xs rounded-full font-medium shadow-lg">SEEKING</span>
                                        </div>

                                        <!-- Image Placeholder -->
                                        <div class="glassmorphism rounded-xl h-36 mb-4 flex items-center justify-center relative overflow-hidden group">
                                            <span class="text-teal-400 font-bold text-sm text-center">SEEKING</span>
                                        </div>

                                        <!-- Content -->
                                        <div>
                                            <h4 class="font-bold text-white mb-2 text-lg"><?php echo htmlspecialchars($request['exchange_product_name']); ?></h4>
                                            <div class="flex gap-1 mb-3">
                                                <span class="px-2 py-1 bg-yellow-400/20 text-yellow-400 text-xs rounded-full border border-yellow-400/30">Exchange</span>
                                            </div>
                                            <p class="text-sm text-gray-300 mb-4 leading-relaxed"><?php echo htmlspecialchars(substr($request['exchange_product_description'], 0, 100)); ?>...</p>

                                            <button onclick="viewDetails(<?php echo $request['id']; ?>)"
                                                class="w-full glassmorphism border border-white/30 text-white px-4 py-3 rounded-xl text-sm font-semibold hover:bg-white/20 transition-all duration-300 hover:scale-105">
                                                Learn More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


    <script>
        
        // Shopping cart functionality
        let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
        
        function updateCartBadge() {
            const badge = document.getElementById('cart-badge');
            if (badge) {
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
            cartItems = cartItems.filter(item => item.id !== requestId);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            updateCartBadge();
            loadCartItems();
            showNotification('Removed from cart', 'info');
        }
        
        // Initialize cart badge on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
        });
    </script>

</body>
</html>
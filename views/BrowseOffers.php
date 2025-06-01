<?php
// ENHANCED BROWSE OFFERS PAGE: Modified from .html to .php for database integration
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
</head>

<body>
    <!-- Include navbar with session management -->
    <?php include '../components/navbar.html'; ?>

    <section class="bg-gray-50 min-h-screen pt-24">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Professional Exchange Marketplace</h1>
                <p class="text-secondary text-sm underline">Connect with verified professionals and
                    exchange high-quality goods and services</p>
            </div>
        </header>

        <!-- Filters Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="" class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-2 items-center">
                        <span class="text-sm font-medium text-gray-700 mr-2">Filter by:</span>

                        <button type="submit" name="filter" value="all" class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                   <?php echo ($filter == 'all') ? 'bg-gradient-to-r from-primary to-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                            All
                        </button>

                        <button type="submit" name="filter" value="goods" class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                   <?php echo ($filter == 'goods') ? 'bg-gradient-to-r from-primary to-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                            Goods
                        </button>

                        <button type="submit" name="filter" value="services" class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                   <?php echo ($filter == 'services') ? 'bg-gradient-to-r from-primary to-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                            Services
                        </button>
                    </div>

                    <!-- Category and Location Filters -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select name="category" onchange="this.form.submit()"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat['name']); ?>" 
                                        <?php echo ($category == $cat['name']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="location" onchange="this.form.submit()"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">All Locations</option>
                            <option value="sarkanika" <?php echo ($location == 'sarkanika') ? 'selected' : ''; ?>>Sarkanika</option>
                            <option value="sarikaya" <?php echo ($location == 'sarikaya') ? 'selected' : ''; ?>>Sarikaya</option>
                            <option value="nearby" <?php echo ($location == 'nearby') ? 'selected' : ''; ?>>Nearby</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <?php if (empty($helpRequests)): ?>
                    <!-- No results message -->
                    <div class="col-span-2 text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No offers found</h3>
                        <p class="text-gray-500">Try adjusting your filters or check back later for new offers.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($helpRequests as $request): ?>
                        <!-- Dynamic Card Generation -->
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <!-- User Info -->
                            <div class="p-4 pb-2">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-unity-orange rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        <?php echo strtoupper(substr($request['user_name'] ?? 'U', 0, 2)); ?>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-sm"><?php echo htmlspecialchars($request['user_name'] ?? 'Anonymous'); ?></h3>
                                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($request['help_request_location']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Two Column Layout: Offering & Seeking -->
                            <div class="px-4 pb-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- OFFERING Section -->
                                    <div>
                                        <div class="mb-3">
                                            <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">OFFERING</span>
                                        </div>

                                        <!-- Image Placeholder -->
                                        <div class="bg-amber-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                            <?php if (!empty($request['help_request_image_url'])): ?>
                                                <img src="<?php echo htmlspecialchars($request['help_request_image_url']); ?>" 
                                                     alt="Product Image" class="w-full h-full object-cover rounded-lg">
                                            <?php else: ?>
                                                <span class="text-amber-800 font-bold text-base">NO IMAGE</span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Content -->
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1"><?php echo htmlspecialchars($request['name_of_product']); ?></h4>
                                            <div class="flex gap-1 mb-2">
                                                <span class="px-2 py-1 bg-[#85CDCA] text-white text-xs rounded">
                                                    <?php echo htmlspecialchars($request['category_name'] ?? 'General'); ?>
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3"><?php echo htmlspecialchars(substr($request['product_description'], 0, 100)); ?>...</p>

                                            <?php if ($currentUser): ?>
                                                <button onclick="makeOffer(<?php echo $request['id']; ?>)"
                                                    class="w-full px-4 py-2 rounded-md text-sm font-medium bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 text-white transition-all duration-300 shadow-lg hover:shadow-xl">
                                                    Make Offer
                                                </button>
                                            <?php else: ?>
                                                <button onclick="window.location.href='../components/SignIn.html'"
                                                    class="w-full px-4 py-2 rounded-md text-sm font-medium bg-gray-400 text-white">
                                                    Login to Make Offer
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- SEEKING Section -->
                                    <div>
                                        <div class="mb-3">
                                            <span class="px-2 py-1 bg-secondary/10 text-secondary text-xs rounded-full font-medium">SEEKING</span>
                                        </div>

                                        <!-- Image Placeholder -->
                                        <div class="bg-yellow-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                            <span class="text-yellow-800 font-bold text-sm text-center">SEEKING</span>
                                        </div>

                                        <!-- Content -->
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1"><?php echo htmlspecialchars($request['exchange_product_name']); ?></h4>
                                            <div class="flex gap-1 mb-2">
                                                <span class="px-2 py-1 bg-[#85CDCA] text-white text-xs rounded">Exchange</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3"><?php echo htmlspecialchars(substr($request['exchange_product_description'], 0, 100)); ?>...</p>

                                            <button onclick="viewDetails(<?php echo $request['id']; ?>)"
                                                class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
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

            <!-- Shopping Cart Button (if user is logged in) -->
            <?php if ($currentUser): ?>
                <button
                    class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-orange-500 to-teal-400 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-3xl hover:scale-110 group"
                    onclick="openCart()" aria-label="Open exchange cart">
                    <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110 text-white" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M9 19h.01M20 19h.01"></path>
                    </svg>
                    <span id="cart-badge"
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold animate-pulse">
                        0
                    </span>
                </button>
            <?php endif; ?>
        </div>
    </section>

    <!-- Include Shopping Cart if user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php include '../components/ShoppingCart.html'; ?>
    <?php endif; ?>

    <script>
        // NEW: JavaScript functions for enhanced functionality
        
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
        
        // Shopping cart functions (from original ShoppingCart.html)
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
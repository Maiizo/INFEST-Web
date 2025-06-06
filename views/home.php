<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnityGrid - Community Exchange Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="is-home">
    <!-- <h1>halo ini home bro</h1> -->
    <?php include '../components/navbar.php' ?>
    <?php include '../components/home/hero.php' ?>
    <?php include '../components/home/section2.php' ?>
    <?php include '../components/home/section3.php' ?>
    <?php include '../components/home/review.php' ?>
    <?php include '../components/footer.php' ?>

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
            <?php endif; ?>

            <!-- Include Shopping Cart if user is logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php include '../components/shopping_cart.php'; ?>
    <?php endif; ?>

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
    </script>
</body>

</html>
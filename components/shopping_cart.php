<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Exchange Cart Button</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">

    <button
        class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-orange-500 to-teal-400 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-3xl hover:scale-110 group"
        onclick="openCart()" aria-label="Open exchange cart">
        <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110 text-white" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M9 19h.01M20 19h.01"></path>
        </svg>

        <span
            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold animate-pulse"
            id="cartBadge">
            0
        </span>
    </button>

    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 opacity-0 invisible transition-all duration-300"
        id="cartOverlay" onclick="closeCart()"></div>

    <div class="fixed top-0 right-0 max-w-full h-screen bg-white z-50 flex flex-col shadow-2xl transform translate-x-full transition-transform duration-500 ease-out"
        style="width: 28rem;" id="cartSlider">

        <div class="bg-gradient-to-r from-orange-500 to-teal-400 text-white p-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Exchange Hub</h2>
                <p class="text-sm opacity-90 mt-1">Your community connections</p>
            </div>
            <button
                class="bg-white bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center text-xl leading-none text-center transition-all duration-300 hover:bg-opacity-30 hover:rotate-90"
                onclick="closeCart()">×</button>
        </div>

        <div class="bg-gradient-to-r from-teal-400 to-blue-400 text-white px-6 py-5 text-center">
            <div class="text-lg font-semibold mb-1" id="exchangeCount">0 Active Exchange Requests</div>
            <div class="text-sm opacity-90" id="exchangeSubtitle">Ready to connect with your neighbors</div>
        </div>

        <div class="flex-1 overflow-y-auto p-5 space-y-5" id="cartItems">
            <!-- sample  -->

        </div>

        <div class="p-6 bg-orange-50 border-t border-gray-200">
            <div class="flex gap-4">
                <button
                    class="flex-1 py-4 px-6 bg-white text-orange-500 border-2 border-orange-500 rounded-xl text-base font-semibold transition-all duration-300 hover:bg-orange-500 hover:text-white">Browse
                    More</button>
                <button
                    class="flex-1 py-4 px-6 bg-gradient-to-r from-orange-500 to-teal-400 text-white rounded-xl text-base font-semibold transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">Start
                    Exchange</button>
            </div>
        </div>
    </div>

    <script>
        /**
         * Opens the exchange cart
         */

        // let items = JSON.parse(localStorage.getItem('cartItems') || '[]');
        const items = document.querySelectorAll('.exchange-item');

        console.log("Cart items length: " + items.length);

        function openCart() {
            console.log("buka bang")
            const overlay = document.getElementById('cartOverlay');
            const slider = document.getElementById('cartSlider');

            // Show overlay and cart
            overlay.classList.remove('opacity-0', 'invisible');
            overlay.classList.add('opacity-100', 'visible');

            slider.classList.remove('translate-x-full');
            slider.classList.add('translate-x-0');

            // Prevent body scrolling
            document.body.classList.add('overflow-hidden');
        }

        /**
         * Closes the exchange cart
         */
        function closeCart() {
            const overlay = document.getElementById('cartOverlay');
            const slider = document.getElementById('cartSlider');

            // Hide overlay and cart
            overlay.classList.remove('opacity-100', 'visible');
            overlay.classList.add('opacity-0', 'invisible');

            slider.classList.remove('translate-x-0');
            slider.classList.add('translate-x-full');

            // Restore body scrolling
            document.body.classList.remove('overflow-hidden');
        }

        /**
         * Removes an exchange item
         */
        function removeItem(button) {
            const item = button.closest('.exchange-item');
            item.style.transform = 'translateX(100%)';
            item.style.opacity = '0';

            setTimeout(() => {
                item.remove();
                updateCartCount();
            }, 300);
        }

        /**
         * Updates the cart count and badge
         */
        function updateCartCount() {

            const count = items.length;
            const badge = document.getElementById('cartBadge');
            const countElement = document.getElementById('exchangeCount');

            badge.textContent = count;
            countElement.textContent = `${count} Active Exchange Request${count !== 1 ? 's' : ''}`;

            // Hide badge if no items
            if (count === 0) {
                badge.style.display = 'none';
                document.getElementById('cartItems').innerHTML = `
                    <div class="flex flex-col items-center justify-center text-center py-16 px-5 text-gray-500">
                        <div class="text-6xl mb-6 opacity-50">🤝</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-700">No Exchange Requests Yet</h3>
                        <p class="text-sm text-gray-500 max-w-xs">Start connecting with your community!</p>
                    </div>
                `;
            } else {
                badge.style.display = 'flex';
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
            cartContainer.innerHTML = cartItems.map(item => 
            console.log("di dalem cart items: " + item)
            `
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

        // Call updateCartCount on page load
        window.addEventListener('DOMContentLoaded', updateCartCount);

        // Close cart with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCart();
            }
        });

        // Close cart when clicking outside
        document.addEventListener('click', function(e) {
            const cartSlider = document.getElementById('cartSlider');
            const overlay = document.getElementById('cartOverlay');

            if (overlay.classList.contains('opacity-100') &&
                !cartSlider.contains(e.target) &&
                !e.target.closest('[onclick="openCart()"]')) {
                closeCart();
            }
        });
    </script>
</body>

</html>
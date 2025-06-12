<?php
// OFFER_DETAILS.PHP - Individual offer details page
// NEW FILE: Shows detailed view of a specific offer

include_once '../components/controller.php';

// Get current user
$currentUser = getCurrentUser();

// Get offer ID from URL
$offerId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$offerId) {
    header("Location: /views/browse_offers.php?error=invalid_id");
    exit();
}

// Get offer details
$offer = getHelpRequestById($offerId);

if (!$offer) {
    header("Location: /views/browse_offers.php?error=not_found");
    exit();
}

// Get user details for the offer
$offerUser = getUserById($offer['users_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Details - UnityGrid</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Include navbar -->
    <?php include '../components/navbar.php'; ?>

    <div class="pt-24 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back button -->
            <div class="mb-6">
                <a href="/views/browse_offers.php" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Browse Offers
                </a>
            </div>

            <!-- Main content -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6">
                    <h1 class="text-3xl font-bold text-white"><?php echo htmlspecialchars($offer['name_of_product']); ?></h1>
                    <p class="text-orange-100 mt-2">Posted by <?php echo htmlspecialchars($offerUser['name'] ?? 'Anonymous'); ?></p>
                </div>

                <div class="p-8">
                    <!-- User info -->
                    <div class="flex items-center mb-8 p-4 bg-gray-50 rounded-lg">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-6">
                            <?php echo strtoupper(substr($offerUser['name'] ?? 'U', 0, 2)); ?>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($offerUser['name'] ?? 'Anonymous'); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($offer['help_request_location']); ?></p>
                            <p class="text-gray-500 text-sm">Contact: <?php echo htmlspecialchars($offer['help_request_email']); ?></p>
                            <?php if (!empty($offer['help_request_phone'])): ?>
                                <p class="text-gray-500 text-sm">Phone: <?php echo htmlspecialchars($offer['help_request_phone']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Main content grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- What they're offering -->
                        <div class="space-y-6">
                            <div class="border-l-4 border-orange-500 pl-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">What They're Offering</h2>
                                
                                <!-- Image -->
                                <?php if (!empty($offer['help_request_image_url'])): ?>
                                    <div class="mb-6">
                                        <img src="<?php echo htmlspecialchars($offer['help_request_image_url']); ?>" 
                                             alt="Offer Image" 
                                             class="w-full h-64 object-cover rounded-lg shadow-md">
                                    </div>
                                <?php else: ?>
                                    <div class="mb-6 bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-500 text-lg">No image available</span>
                                    </div>
                                <?php endif; ?>

                                <!-- Product details -->
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Product/Service Name</h3>
                                        <p class="text-gray-700"><?php echo htmlspecialchars($offer['name_of_product']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                                        <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($offer['product_description'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- What they're seeking -->
                        <div class="space-y-6">
                            <div class="border-l-4 border-teal-500 pl-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4">What They're Seeking</h2>
                                
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Looking For</h3>
                                        <p class="text-gray-700"><?php echo htmlspecialchars($offer['exchange_product_name']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <h3 class="font-semibold text-gray-900 mb-2">Exchange Description</h3>
                                        <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($offer['exchange_product_description'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <?php if ($currentUser): ?>
                                <?php if ($currentUser['id'] != $offer['users_id']): ?>
                                    <!-- User can contact the offer creator -->
                                    <button onclick="contactUser()" 
                                            class="flex-1 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Contact <?php echo htmlspecialchars($offerUser['name'] ?? 'User'); ?>
                                    </button>
                                    
                                    <button onclick="addToCart(<?php echo $offer['id']; ?>)" 
                                            class="flex-1 px-6 py-3 bg-gradient-to-r from-teal-500 to-green-500 hover:from-teal-600 hover:to-green-600 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Add to Exchange Cart
                                    </button>
                                <?php else: ?>
                                    <!-- This is the user's own offer -->
                                    <div class="flex-1 px-6 py-3 bg-gray-100 text-gray-600 font-medium rounded-lg text-center">
                                        This is your offer
                                    </div>
                                    
                                    <button onclick="editOffer()" 
                                            class="flex-1 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-all duration-200">
                                        Edit Offer
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- User not logged in -->
                                <button onclick="window.location.href='/components/sign_in.php'" 
                                        class="flex-1 px-6 py-3 bg-gray-400 hover:bg-gray-500 text-white font-medium rounded-lg transition-all duration-200">
                                    Sign In to Contact
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Similar offers section -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Similar Offers</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Placeholder for similar offers -->
                            <div class="bg-gray-100 rounded-lg p-6 text-center">
                                <p class="text-gray-500">Similar offers will be shown here</p>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-6 text-center">
                                <p class="text-gray-500">Coming soon...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Contact Information</h3>
                    <button onclick="closeContactModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900"><?php echo htmlspecialchars($offer['help_request_email']); ?></p>
                    </div>
                    
                    <?php if (!empty($offer['help_request_phone'])): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <p class="text-gray-900"><?php echo htmlspecialchars($offer['help_request_phone']); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="pt-4">
                        <a href="mailto:<?php echo htmlspecialchars($offer['help_request_email']); ?>?subject=Interest in your offer: <?php echo urlencode($offer['name_of_product']); ?>" 
                           class="w-full inline-block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200">
                            Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Contact modal functions
        function contactUser() {
            document.getElementById('contactModal').classList.remove('hidden');
        }
        
        function closeContactModal() {
            document.getElementById('contactModal').classList.add('hidden');
        }
        
        // Add to cart function
        function addToCart(offerId) {
            let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
            const existingItem = cartItems.find(item => item.id === offerId);
            
            if (!existingItem) {
                cartItems.push({
                    id: offerId,
                    timestamp: new Date().toISOString()
                });
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                showNotification('Added to exchange cart!', 'success');
            } else {
                showNotification('Already in cart!', 'info');
            }
        }
        
        // Edit offer function (placeholder)
        function editOffer() {
            alert('Edit functionality coming soon!');
        }
        
        // Notification function
        function showNotification(message, type) {
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
            
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // Close modal when clicking outside
        document.getElementById('contactModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeContactModal();
            }
        });
    </script>
</body>
</html>
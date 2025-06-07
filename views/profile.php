<?php
session_start();
include_once '../components/controller.php';

// Check if user is logged in
$currentUser = getCurrentUser();

if (!$currentUser) {
    // User not logged in, redirect to sign in page
    header("Location: /components/sign_in.php?error=login_required&message=Please log in to access your profile");
    exit();
}

// Get user's activity data
$userId = $currentUser['id'];
$userOffers = getUserPostedOffers($userId);
$userResponses = getUserExchangeResponses($userId);
$receivedResponses = getUserReceivedResponses($userId);
$activitySummary = getUserActivitySummary($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - UnityGrid</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white p-6 flex flex-col shadow-lg rounded-r-lg">
        <div class="flex items-center mb-10">
            <div class="bg-orange-500 p-2 rounded-full mr-3">
                <i class="fas fa-grip-horizontal text-white text-lg"></i>
            </div>
            <span class="text-xl font-semibold text-gray-900">UNITYGRID</span>
        </div>

        <div class="flex flex-col items-center mb-10">
            <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-teal-400 rounded-full mb-3 flex items-center justify-center text-white text-2xl font-bold">
                <?php echo strtoupper(substr($currentUser['name'], 0, 2)); ?>
            </div>
            <span class="text-lg font-medium text-gray-900"><?php echo htmlspecialchars($currentUser['name']); ?></span>
            <span class="text-sm text-gray-500"><?php echo htmlspecialchars($currentUser['email']); ?></span>
        </div>

        <!-- Activity Summary -->
        <div class="mb-8 bg-gradient-to-r from-orange-50 to-teal-50 p-4 rounded-lg">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">ACTIVITY SUMMARY</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Offers Posted:</span>
                    <span class="font-semibold text-orange-600"><?php echo $activitySummary['total_offers_posted']; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Active Offers:</span>
                    <span class="font-semibold text-green-600"><?php echo $activitySummary['active_offers']; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Responses Made:</span>
                    <span class="font-semibold text-blue-600"><?php echo $activitySummary['total_responses_made']; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Responses Received:</span>
                    <span class="font-semibold text-purple-600"><?php echo $activitySummary['total_responses_received']; ?></span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-10">
            <h3 class="text-xs font-semibold text-gray-500 uppercase mb-4">OVERVIEW</h3>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="#offers" onclick="showSection('offers')" class="flex items-center p-3 rounded-lg text-orange-500 bg-orange-500/10 font-medium hover:bg-orange-500/20 transition-colors">
                            <i class="fas fa-handshake mr-3"></i>
                            My Offers
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#responses" onclick="showSection('responses')" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors">
                            <i class="fas fa-reply mr-3"></i>
                            My Responses
                        </a>
                    </li>
                    <li>
                        <a href="#received" onclick="showSection('received')" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors">
                            <i class="fas fa-inbox mr-3"></i>
                            Received Responses
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mt-auto">
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="/views/home.php" class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors">
                            <i class="fas fa-home mr-3"></i>
                            Back to Home
                        </a>
                    </li>
                    <li>
                        <a href="/components/logout.php" class="flex items-center p-3 rounded-lg text-red-600 hover:bg-red-100 transition-colors">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Your Profile</h1>
            <a href="/views/post_offers.php" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-teal-400 text-white rounded-lg font-medium hover:from-orange-600 hover:to-teal-500 transition-all duration-200">
                Post New Offer
            </a>
        </header>

        <!-- My Offers Section -->
        <section id="offers-section" class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Your Posted Offers</h2>
            
            <?php if (empty($userOffers)): ?>
                <div class="bg-white rounded-lg p-8 text-center">
                    <div class="text-gray-400 text-6xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Offers Posted Yet</h3>
                    <p class="text-gray-500 mb-4">Start sharing what you have to offer with your community!</p>
                    <a href="/views/post_offers.php" class="inline-block px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                        Post Your First Offer
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php foreach ($userOffers as $offer): ?>
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <?php if (!empty($offer['help_request_image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($offer['help_request_image_url']); ?>" 
                                     alt="Offer Image" class="w-full h-40 object-cover rounded-lg mb-4">
                            <?php else: ?>
                                <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded-full font-medium">
                                    <?php echo htmlspecialchars($offer['category_name'] ?? 'General'); ?>
                                </span>
                                <span class="px-2 py-1 <?php echo ($offer['status_name'] == 'Active') ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600'; ?> text-xs rounded-full font-medium">
                                    <?php echo htmlspecialchars($offer['status_name'] ?? 'Unknown'); ?>
                                </span>
                            </div>
                            
                            <h3 class="font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($offer['name_of_product']); ?></h3>
                            <p class="text-sm text-gray-600 mb-3"><?php echo htmlspecialchars(substr($offer['product_description'], 0, 100)); ?>...</p>
                            
                            <div class="border-t pt-3">
                                <p class="text-xs text-gray-500 mb-2">Seeking: <?php echo htmlspecialchars($offer['exchange_product_name']); ?></p>
                                
                                <div class="flex gap-2">
                                    <a href="/views/offer_details.php?id=<?php echo $offer['id']; ?>" 
                                       class="flex-1 px-3 py-2 bg-blue-500 text-white text-sm rounded text-center hover:bg-blue-600 transition-colors">
                                        View
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- My Responses Section -->
        <section id="responses-section" class="mb-12 hidden">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Your Exchange Responses</h2>
            
            <?php if (empty($userResponses)): ?>
                <div class="bg-white rounded-lg p-8 text-center">
                    <div class="text-gray-400 text-6xl mb-4">💬</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Responses Made Yet</h3>
                    <p class="text-gray-500">Browse offers and respond to items you're interested in!</p>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original Offer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Your Response</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($userResponses as $response): ?>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($response['original_product_name']); ?></div>
                                        <div class="text-sm text-gray-500">Seeking: <?php echo htmlspecialchars($response['sought_product_name']); ?></div>
                                        <div class="text-xs text-gray-400"><?php echo htmlspecialchars($response['location']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($response['exchange_name']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($response['exchange_description'], 0, 50)); ?>...</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($response['offer_owner_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="mailto:<?php echo htmlspecialchars($response['exchange_email']); ?>" 
                                           class="text-blue-600 hover:text-blue-900 text-sm">
                                            Email Owner
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

        <!-- Received Responses Section -->
        <section id="received-section" class="mb-12 hidden">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Responses to Your Offers</h2>
            
            <?php if (empty($receivedResponses)): ?>
                <div class="bg-white rounded-lg p-8 text-center">
                    <div class="text-gray-400 text-6xl mb-4">📥</div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Responses Received Yet</h3>
                    <p class="text-gray-500">Keep posting great offers to attract interested community members!</p>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Your Offer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Their Response</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responder</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($receivedResponses as $response): ?>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($response['product_name']); ?></div>
                                        <div class="text-sm text-gray-500">You wanted: <?php echo htmlspecialchars($response['sought_product_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($response['exchange_name']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($response['exchange_description'], 0, 50)); ?>...</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($response['responder_name']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($response['exchange_email']); ?></div>
                                        <?php if (!empty($response['exchange_phone'])): ?>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($response['exchange_phone']); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="mailto:<?php echo htmlspecialchars($response['exchange_email']); ?>" 
                                           class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            Contact
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script>
        function showSection(sectionName) {
            // Hide all sections
            document.getElementById('offers-section').classList.add('hidden');
            document.getElementById('responses-section').classList.add('hidden');
            document.getElementById('received-section').classList.add('hidden');
            
            // Show selected section
            document.getElementById(sectionName + '-section').classList.remove('hidden');
            
            // Update navigation active state
            const navLinks = document.querySelectorAll('aside nav a');
            navLinks.forEach(link => {
                link.classList.remove('text-orange-500', 'bg-orange-500/10');
                link.classList.add('text-gray-700');
            });
            
            // Set active link
            const activeLink = document.querySelector(`a[href="#${sectionName}"]`);
            if (activeLink) {
                activeLink.classList.remove('text-gray-700');
                activeLink.classList.add('text-orange-500', 'bg-orange-500/10');
            }
        }

        function editOffer(offerId) {
            // Redirect to edit page (you'll need to create this)
            window.location.href = `/views/edit_offer.php?id=${offerId}`;
        }

        function deleteOffer(offerId) {
            if (confirm('Are you sure you want to delete this offer? This action cannot be undone.')) {
                // Create a form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/components/delete_offer.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'offer_id';
                input.value = offerId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Initialize with offers section visible
        document.addEventListener('DOMContentLoaded', function() {
            showSection('offers');
        });
    </script>
</body>
</html>
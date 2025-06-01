<?php
// POST_OFFERS.PHP - PHP version with authentication check
// FIXED: Proper include path and authentication handling

include_once '../components/controller.php';

// Check if user is logged in
$currentUser = getCurrentUser();

// If not logged in, redirect to login with message
if (!$currentUser) {
    header("Location: ../components/SignIn.html?error=login_required&message=Please log in to post an offer");
    exit();
}

// Get categories for dropdown
$categories = getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Your Offer - UnityGrid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Include navbar -->
    <?php include '../components/navbar.html'; ?>
    
    <div class="container mx-auto px-4 py-8 pt-24">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
           
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">Post Your Offer</h1>
                <p class="text-orange-100 mt-2">Share what you have to offer and what you're looking for in exchange</p>
                <p class="text-orange-100 text-sm mt-1">Welcome back, <?php echo htmlspecialchars($currentUser['name']); ?>!</p>
            </div>

            <!-- Display success/error messages -->
            <div id="message-container" class="mx-8 mt-4"></div>

            <form class="p-8 space-y-8" id="offerForm" method="POST" action="/components/submit_offer.php"
                enctype="multipart/form-data">
                <!-- What You're Offering -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800">What You're Offering</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <div class="lg:col-span-2">
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Product/Service Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="Enter product or service name">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category" id="category" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                City <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="city" name="city" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="Enter your city">
                        </div>
                    </div>

                     <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                            placeholder="Describe your product or service in detail"></textarea>
                    </div>

                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                        <button type="button" id="uploadimage"
                            class="w-full border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-orange-500 transition-colors duration-200">
                            <div class="space-y-2">
                                <div class="mx-auto w-12 h-12 text-gray-400">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span class="text-orange-500 hover:text-orange-600 font-medium" id="uploadText">
                                        Click to upload image
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                            </div>
                        </button>
                        <input type="file" name="offer_image" accept="image/*" class="hidden" id="imageUpload">
                    </div>
                </div>

                <!-- What You're Seeking -->
                <div class="space-y-6 border-t pt-8">
                    <h2 class="text-2xl font-semibold text-gray-800">What You're Seeking</h2>

                    <div class="space-y-6">
                         <div>
                            <label for="exchange_product" class="block text-sm font-medium text-gray-700 mb-2">
                                Exchange Product/Service <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="exchange_product" name="exchange_product" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="What are you looking for in exchange?">
                        </div>

                        <div>
                            <label for="exchange_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Exchange Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="exchange_description" name="exchange_description" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="Describe what you're looking for in detail"></textarea>
                        </div>
                    </div>
                </div>

                 <div class="space-y-6 border-t pt-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Contact Information</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="contact_email" name="contact_email" required
                                value="<?php echo htmlspecialchars($currentUser['email']); ?>"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="your.email@example.com">
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Number
                            </label>
                            <input type="tel" id="contact_number" name="contact_number"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                placeholder="+123 (123) 123-4567">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t">
                    <button type="submit"
                        class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-medium rounded-lg transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Post Your Offer
                    </button>
                    <a href="../views/BrowseOffers.php"
                        class="flex-1 px-8 py-4 bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 text-white font-medium rounded-lg transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Image upload functionality
            $('#uploadimage').on('click', function () {
                $('#imageUpload').click();
            });

            $('#imageUpload').on('change', function (e) {
                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name;
                    $('#uploadText').text(fileName);
                }
            });

            // Form validation
            $('#offerForm').on('submit', function(e) {
                const requiredFields = ['product_name', 'category', 'city', 'description', 'exchange_product', 'exchange_description', 'contact_email'];
                let isValid = true;
                
                requiredFields.forEach(function(field) {
                    const value = $(`#${field}`).val().trim();
                    if (!value) {
                        isValid = false;
                        $(`#${field}`).addClass('border-red-500');
                    } else {
                        $(`#${field}`).removeClass('border-red-500');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    showMessage('Please fill in all required fields.', 'error');
                }
            });
        });

        // Message display function
        function showMessage(message, type) {
            const messageContainer = document.getElementById('message-container');
            const alertClass = type === 'error' ? 'bg-red-100 border-red-500 text-red-700' : 'bg-green-100 border-green-500 text-green-700';
            
            messageContainer.innerHTML = `
                <div class="border-l-4 ${alertClass} p-4 rounded mb-4">
                    <p class="font-medium">${message}</p>
                </div>
            `;
        }

        // Check for URL parameters to show messages
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success')) {
            showMessage('Your offer has been posted successfully!', 'success');
        }
        if (urlParams.get('error')) {
            const errorMsg = urlParams.get('error');
            if (errorMsg === 'upload_failed') {
                showMessage('Failed to upload image. Please try again.', 'error');
            } else if (errorMsg === 'database_error') {
                showMessage('Database error occurred. Please try again.', 'error');
            } else {
                showMessage('An error occurred. Please try again.', 'error');
            }
        }
    </script>
</body>

</html>
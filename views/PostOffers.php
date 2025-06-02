<?php
// POST_OFFERS.PHP - PHP version with authentication check
// FIXED: Proper include path and authentication handling

include_once '../components/controller.php';

// Check if user is logged in
$currentUser = getCurrentUser();

// If not logged in, redirect to login with message
if (!$currentUser) {
    header("Location: /components/SignIn.html?error=login_required&message=Please log in to post an offer");
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
        
        .form-section {
            transition: all 0.3s ease;
        }
        
        .form-section:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-32 h-32 bg-teal-400 rounded-full blur-3xl floating-animation"></div>
        <div class="absolute bottom-40 right-20 w-40 h-40 bg-orange-500 rounded-full blur-3xl floating-animation-delayed"></div>
        <div class="absolute top-1/2 right-1/4 w-24 h-24 bg-yellow-400 rounded-full blur-2xl floating-animation-delayed-2"></div>
        <div class="absolute top-1/3 left-1/3 w-28 h-28 bg-purple-500 rounded-full blur-2xl floating-animation"></div>
    </div>
    
    <!-- Include navbar -->
    <?php include '../components/navbar.html'; ?>
    
    <div class="relative z-10 container mx-auto px-4 py-8 pt-24">
        <div class="max-w-4xl mx-auto glassmorphism rounded-2xl shadow-2xl overflow-hidden border border-white/20">
           
            <div class="glassmorphism-white px-8 py-6 border-b border-white/20">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                    Post Your 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-teal-400">Offer</span>
                </h1>
                <p class="text-gray-300 text-lg">Share what you have to offer and what you're looking for in exchange</p>
                <p class="text-teal-400 text-sm mt-2 font-semibold">Welcome back, <?php echo htmlspecialchars($currentUser['name']); ?>!</p>
            </div>

            <!-- Display success/error messages -->
            <div id="message-container" class="mx-8 mt-4"></div>

            <form class="p-8 space-y-8" id="offerForm" method="POST" action="/components/submit_offer.php"
                enctype="multipart/form-data">
                <!-- What You're Offering -->
                <div class="space-y-6 form-section glassmorphism rounded-xl p-6 border border-white/20">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-semibold text-white">What You're Offering</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <div class="lg:col-span-2">
                            <label for="product_name" class="block text-sm font-medium text-white mb-2">
                                Product/Service Name <span class="text-orange-400">*</span>
                            </label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="Enter product or service name">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-white mb-2">
                                Category <span class="text-orange-400">*</span>
                            </label>
                            <select name="category" id="category" required
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white bg-transparent">
                                <option value="" class="bg-gray-800 text-white">Select a category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" class="bg-gray-800 text-white">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-white mb-2">
                                City <span class="text-orange-400">*</span>
                            </label>
                            <input type="text" id="city" name="city" required
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="Enter your city">
                        </div>
                    </div>

                     <div>
                        <label for="description" class="block text-sm font-medium text-white mb-2">
                            Description <span class="text-orange-400">*</span>
                        </label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                            placeholder="Describe your product or service in detail"></textarea>
                    </div>

                     <div>
                        <label class="block text-sm font-medium text-white mb-2">Upload Image</label>
                        <button type="button" id="uploadimage"
                            class="w-full glassmorphism border-2 border-dashed border-white/30 rounded-xl p-6 text-center hover:border-teal-400 transition-all duration-200 hover:bg-white/10">
                            <div class="space-y-2">
                                <div class="mx-auto w-12 h-12 text-gray-300">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text-sm text-gray-300">
                                    <span class="text-teal-400 hover:text-teal-300 font-medium" id="uploadText">
                                        Click to upload image
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG up to 10MB</p>
                            </div>
                        </button>
                        <input type="file" name="offer_image" accept="image/*" class="hidden" id="imageUpload">
                    </div>
                </div>

                <!-- What You're Seeking -->
                <div class="space-y-6 form-section glassmorphism rounded-xl p-6 border border-white/20">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-teal-500 to-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-semibold text-white">What You're Seeking</h2>
                    </div>

                    <div class="space-y-6">
                         <div>
                            <label for="exchange_product" class="block text-sm font-medium text-white mb-2">
                                Exchange Product/Service <span class="text-orange-400">*</span>
                            </label>
                            <input type="text" id="exchange_product" name="exchange_product" required
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="What are you looking for in exchange?">
                        </div>

                        <div>
                            <label for="exchange_description" class="block text-sm font-medium text-white mb-2">
                                Exchange Description <span class="text-orange-400">*</span>
                            </label>
                            <textarea id="exchange_description" name="exchange_description" rows="4" required
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="Describe what you're looking for in detail"></textarea>
                        </div>
                    </div>
                </div>

                 <div class="space-y-6 form-section glassmorphism rounded-xl p-6 border border-white/20">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-semibold text-white">Contact Information</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-white mb-2">
                                Contact Email <span class="text-orange-400">*</span>
                            </label>
                            <input type="email" id="contact_email" name="contact_email" required
                                value="<?php echo htmlspecialchars($currentUser['email']); ?>"
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="your.email@example.com">
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-white mb-2">
                                Contact Number
                            </label>
                            <input type="tel" id="contact_number" name="contact_number"
                                class="w-full px-4 py-3 glassmorphism border border-white/30 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200 text-white placeholder-gray-300 bg-transparent"
                                placeholder="+123 (123) 123-4567">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8">
                    <button type="submit"
                        class="flex-1 px-8 py-4 bg-gradient-to-r from-orange-500 to-teal-400 hover:from-orange-600 hover:to-teal-500 text-white font-semibold rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Post Your Offer
                    </button>
                    <a href="/views/BrowseOffers.php"
                        class="flex-1 px-8 py-4 glassmorphism text-gray-300 border border-white/30 hover:bg-white/20 font-semibold rounded-xl transform hover:scale-105 transition-all duration-300 text-center">
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
                        $(`#${field}`).addClass('border-red-400').removeClass('border-white/30');
                    } else {
                        $(`#${field}`).removeClass('border-red-400').addClass('border-white/30');
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
            const alertClass = type === 'error' ? 'glassmorphism border-red-400/50 text-red-400' : 'glassmorphism border-green-400/50 text-green-400';
            
            messageContainer.innerHTML = `
                <div class="border-l-4 ${alertClass} p-4 rounded-xl mb-4">
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
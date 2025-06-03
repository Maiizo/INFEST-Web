<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
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
        
        .gradient-text {
            background: linear-gradient(135deg, #f97316, #06b6d4, #eab308);
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        .floating-animation-delayed {
            animation: floating 6s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16 px-4 sm:px-6 md:px-8 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-20 h-20 bg-orange-500 rounded-full blur-2xl floating-animation"></div>
            <div class="absolute bottom-10 right-10 w-24 h-24 bg-teal-400 rounded-full blur-2xl floating-animation-delayed"></div>
            <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-yellow-400 rounded-full blur-xl floating-animation"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between md:gap-12 items-center md:items-start space-y-10 md:space-y-0">
                <!-- left  -->
                <div class="flex-[2] w-full space-y-6">
                    <div>
                        <h2 class="text-3xl sm:text-4xl md:text-4xl font-bold text-white mb-6">
                            Let's <span class="gradient-text">work together</span>
                        </h2>
                    </div>
                    <div class="mb-8">
                        <p class="text-gray-300 text-lg mb-4 leading-relaxed max-w-xl">
                            Connect with us and let's create a <span class="text-teal-400 font-semibold">supportive community</span> for all. 
                            Join thousands of neighbors making a difference.
                        </p>
                    </div>
                    <!-- Enhanced Social Links -->
                    <div class="flex space-x-4 justify-start">
                        <!-- Instagram -->
                        <a href="#" class="group">
                            <div class="w-12 h-12 glassmorphism rounded-xl flex items-center justify-center hover:border-orange-500/50 transition-all duration-300 transform group-hover:scale-110 group-hover:bg-orange-500/20">
                                <svg class="w-6 h-6 text-orange-400 group-hover:text-orange-300 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </div>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="group">
                            <div class="w-12 h-12 glassmorphism rounded-xl flex items-center justify-center hover:border-teal-400/50 transition-all duration-300 transform group-hover:scale-110 group-hover:bg-teal-400/20">
                                <svg class="w-6 h-6 text-teal-400 group-hover:text-teal-300 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                        </a>
                        <!-- Discord -->
                        <a href="#" class="group">
                            <div class="w-12 h-12 glassmorphism rounded-xl flex items-center justify-center hover:border-yellow-400/50 transition-all duration-300 transform group-hover:scale-110 group-hover:bg-yellow-400/20">
                                <svg class="w-6 h-6 text-yellow-400 group-hover:text-yellow-300 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419-.0002 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1568 2.4189Z"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Community Stats -->
                    <div class="glassmorphism p-4 rounded-xl border border-white/10 mt-8">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="group">
                                <div class="text-2xl font-bold text-teal-400 mb-1 transform group-hover:scale-110 transition-transform duration-300">10K+</div>
                                <div class="text-gray-400 text-xs uppercase tracking-wide">Active Members</div>
                            </div>
                            <div class="group">
                                <div class="text-2xl font-bold text-orange-400 mb-1 transform group-hover:scale-110 transition-transform duration-300">98%</div>
                                <div class="text-gray-400 text-xs uppercase tracking-wide">Happy Users</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Enhanced Navigation -->
                <div class="flex-1 w-full">
                    <div class="glassmorphism p-6 rounded-2xl border border-white/10">
                        <!-- Directory Section -->
                        <div>
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 text-teal-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Quick Links
                            </h3>
                            <ul class="space-y-4">
                                <li>
                                    <a href="/views/home.php" class="group flex items-center text-gray-300 hover:text-teal-400 transition-all duration-300">
                                        <div class="w-2 h-2 bg-orange-400 rounded-full mr-3 group-hover:bg-teal-400 transition-colors"></div>
                                        <span class="group-hover:translate-x-1 transition-transform">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/views/browse_offers.php" class="group flex items-center text-gray-300 hover:text-teal-400 transition-all duration-300">
                                        <div class="w-2 h-2 bg-orange-400 rounded-full mr-3 group-hover:bg-teal-400 transition-colors"></div>
                                        <span class="group-hover:translate-x-1 transition-transform">Browse Offers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/views/post_offers.php" class="group flex items-center text-gray-300 hover:text-teal-400 transition-all duration-300">
                                        <div class="w-2 h-2 bg-orange-400 rounded-full mr-3 group-hover:bg-teal-400 transition-colors"></div>
                                        <span class="group-hover:translate-x-1 transition-transform">Post Offers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="mt-8 pt-6 border-t border-white/10">
                            <div class="flex items-center justify-between text-center">
                                <div class="flex items-center space-x-2 group">
                                    <svg class="w-4 h-4 text-green-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs text-gray-300 group-hover:text-green-400 transition-colors">Verified</span>
                                </div>
                                <div class="flex items-center space-x-2 group">
                                    <svg class="w-4 h-4 text-teal-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs text-gray-300 group-hover:text-teal-400 transition-colors">Secure</span>
                                </div>
                                <div class="flex items-center space-x-2 group">
                                    <svg class="w-4 h-4 text-yellow-400 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs text-gray-300 group-hover:text-yellow-400 transition-colors">Rated</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Copyright -->
            <div class="border-t border-white/10 mt-12 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © 2025 <span class="text-teal-400 font-semibold">UnityGrid Community</span>. All rights reserved. 
                    <span class="text-orange-400">Building stronger neighborhoods together.</span>
                </p>
            </div>
        </div>
    </section>
</body>
</html>
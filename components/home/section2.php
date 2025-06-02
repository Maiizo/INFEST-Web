<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section 2</title>
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
        
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.3); }
            50% { box-shadow: 0 0 40px rgba(249, 115, 22, 0.6), 0 0 60px rgba(249, 115, 22, 0.3); }
        }
    </style>
</head>
<body>
    <section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-32 h-32 bg-orange-500 rounded-full blur-3xl floating-animation"></div>
            <div class="absolute bottom-40 right-20 w-40 h-40 bg-teal-400 rounded-full blur-3xl floating-animation-delayed"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-yellow-400 rounded-full blur-2xl floating-animation-delayed-2"></div>
        </div>
        
        <div class="relative z-10 py-20 px-4 md:px-8 h-full">
            <div class="flex flex-col md:flex-row justify-between md:gap-12 max-w-7xl mx-auto items-center space-y-12 md:space-y-0">
                <!-- Left Side - Image -->
                <div class="flex-1 w-full mb-8 md:mb-0">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-teal-400/20 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-300"></div>
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDF8fGNvbW11bml0eSUyMGdhdGhlcmluZ3xlbnwwfHx8fDE2ODk1Njc3NDI&ixlib=rb-4.0.3&q=80&w=800"
                            alt="Community gathering showing diverse group of neighbors"
                            class="relative w-full h-auto rounded-2xl shadow-2xl transition-transform duration-300 hover:scale-105 border border-white/10">
                    </div>
                </div>
                
                <!-- Right Side - Content -->
                <div class="flex-1 w-full space-y-8 md:space-y-10">
                    <div>
                        <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                            Join the Movement for a 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-teal-400">Stronger Neighborhood</span> 
                            Community!
                        </h3>
                    </div>
                    
                    <div class="space-y-6">
                        <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
                            Discover how easy it is to connect with neighbors who are ready to help. Whether you need
                            assistance or can lend a hand, this platform is built for you.
                        </p>
                        <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
                            Help your neighbors, exchange skills, and build a stronger community. Sign up today to
                            experience the <span class="text-teal-400 font-semibold">power of local support</span> and connection.
                        </p>
                    </div>
                    
                    <!-- Call to Action -->
                    <div class="pt-4">
                        <a href="/components/signup.php" class="group">
                            <button class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl pulse-glow">
                                <span class="flex items-center space-x-2">
                                    <span>Get Started Today</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
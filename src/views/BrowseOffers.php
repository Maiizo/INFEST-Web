<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnityGrid Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const locationSelect = document.getElementById('location');
        const otherInput = document.getElementById('otherLocation');
        const submitBtn = document.getElementById('submitBtn');

        function handleLocationChange() {
            if (locationSelect.value === 'other') {
                otherInput.classList.remove('hidden');
                otherInput.required = true;
                submitBtn.classList.remove('hidden');

            } else {
                otherInput.classList.add('hidden');
                otherInput.required = false;
                otherInput.value = '';
                submitBtn.classList.add('hidden');

            }
        }

        handleLocationChange();
        locationSelect.addEventListener('change', handleLocationChange);
    });
</script>

<body>
    <?php include '../components/navbar.html'; ?>
    <section class="bg-gray-50 min-h-screen mt-16">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Professional Exchange Marketplace</h1>
                <p class="text-secondary text-sm underline">Connect with verified professionals and
                    exchange
                    high-quality goods and services</p>
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
                                   bg-gradient-to-r from-primary to-secondary text-white hover:opacity-90">
                            All
                        </button>

                        <button type="submit" name="filter" value="goods" class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                   bg-gray-100 text-gray-700 hover:bg-gray-200">
                            Goods
                        </button>

                        <button type="submit" name="filter" value="services" class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                   bg-gray-100 text-gray-700 hover:bg-gray-200">
                            Services
                        </button>
                        <select name="location" id="location"
                            class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Select Location</option>
                            <option value="tokyo">Tokyo, Japan</option>
                            <option value="shanghai">Shanghai, China</option>
                            <option value="mumbai">Mumbai, India</option>
                            <option value="new-york">New York City, USA</option>
                            <option value="sao-paulo">São Paulo, Brazil</option>
                            <option value="dhaka">Dhaka, Bangladesh</option>
                            <option value="karachi">Karachi, Pakistan</option>
                            <option value="lagos">Lagos, Nigeria</option>
                            <option value="istanbul">Istanbul, Turkey</option>
                            <option value="moscow">Moscow, Russia</option>
                            <option value="manila">Manila, Philippines</option>
                            <option value="cairo">Cairo, Egypt</option>
                            <option value="mexico-city">Mexico City, Mexico</option>
                            <option value="london">London, United Kingdom</option>
                            <option value="paris">Paris, France</option>
                            <option value="berlin">Berlin, Germany</option>
                            <option value="tehran">Tehran, Iran</option>
                            <option value="riyadh">Riyadh, Saudi Arabia</option>
                            <option value="jakarta">Jakarta, Indonesia</option>
                            <option value="rome">Rome, Italy</option>
                            <option value="madrid">Madrid, Spain</option>
                            <option value="toronto">Toronto, Canada</option>
                            <option value="sydney">Sydney, Australia</option>
                            <option value="buenos-aires">Buenos Aires, Argentina</option>
                            <option value="seoul">Seoul, South Korea</option>
                            <option value="bangkok">Bangkok, Thailand</option>
                            <option value="johannesburg">Johannesburg, South Africa</option>
                            <option value="kinshasa">Kinshasa, DR Congo</option>
                            <option value="addis-ababa">Addis Ababa, Ethiopia</option>
                            <option value="casablanca">Casablanca, Morocco</option>
                            <option value="other">Other</option>
                        </select>

                        <input type="text"
                            id="otherLocation"
                            name="other_location"
                            placeholder="Enter your location"
                            class="other-input p-2 rounded-md border border-gray-300 focus:ring-primary focus:border-transparent hidden">
                        <button type="submit" class="submit-btn hidden" id="submitBtn">Submit</button>
                    </div>
                </div>
            </form>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Card 1: Artisan Bread & Garden Produce -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <!-- User Info -->
                    <div class="p-4 pb-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-unity-orange rounded-full flex items-center justify-center text-white font-bold text-sm">
                                SJ
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">Emma Rodriguez</h3>
                                <p class="text-xs text-gray-500">Sarkanika</p>
                            </div>
                        </div>
                    </div>

                    <!-- Two Column Layout: Offering & Seeking -->
                    <div class="px-4 pb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- OFFERING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">OFFERING</span>
                                </div>

                                <!-- Image Placeholder -->
                                <div class="bg-amber-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-amber-800 font-bold text-base">IMAGE PLACEHOLDER</span>
                                </div>

                                <!-- Content -->
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Artisan Sourdough Bread</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#85CDCA] text-white text-xs rounded">Goods</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Fresh baked sourdough bread made with my
                                        5-year
                                        starter. Organic ingredients, baked twice weekly.</p>

                                    <button
                                        class="w-full px-4 py-2 rounded-md text-sm font-medium  bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 text-white  transition-all duration-300 shadow-lg hover:shadow-xl bg-size-200 bg-pos-0 hover:bg-pos-100 animate-gradient-x">
                                        Make Offer
                                    </button>
                                </div>
                            </div>

                            <!-- SEEKING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-secondary/10 text-secondary text-xs rounded-full font-medium">SEEKING</span>
                                </div>

                                <!-- Image Placeholder -->
                                <div class="bg-yellow-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-yellow-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <!-- Content -->
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Garden Produce</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#85CDCA] text-white text-xs rounded">Goods</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Fresh vegetables from your garden, homemade
                                        jams,
                                        or basic home repair help. bla bla bla bla lba</p>


                                    <button
                                        class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Coding Lessons & Piano Instruction -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 pb-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-unity-cool rounded-full flex items-center justify-center text-white font-bold text-sm">
                                MC
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">Emma Rodriguez</h3>
                                <p class="text-xs text-gray-500">Sarkanika</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- OFFERING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">OFFERING</span>
                                </div>

                                <div class="bg-blue-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-blue-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Coding Lessons</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#E8A87C] text-white text-xs rounded">Service</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Professional web developer offering 1-on-1
                                        coding
                                        sessions. HTML, CSS, JavaScript, React. </p>

                                    <button
                                        class="w-full px-4 py-2 rounded-md text-sm font-medium  bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 text-white  transition-all duration-300 shadow-lg hover:shadow-xl bg-size-200 bg-pos-0 hover:bg-pos-100 animate-gradient-x">
                                        Make Offer
                                    </button>
                                </div>
                            </div>

                            <!-- SEEKING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-secondary/10 text-secondary text-xs rounded-full font-medium">SEEKING</span>
                                </div>

                                <div class="bg-amber-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-amber-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Piano Instruction</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#E8A87C] text-white text-xs rounded">Service</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Piano lessons, homemade meals, or help with
                                        gardening and plant care work.</p>

                                    <button
                                        class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Ceramic Mugs & Photo Session -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 pb-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                ER
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">Emma Rodriguez</h3>
                                <p class="text-xs text-gray-500">Sarkanika</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- OFFERING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">OFFERING</span>
                                </div>

                                <div class="bg-amber-200 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-amber-800 font-bold text-base">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Ceramic Mugs Set</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#85CDCA] text-white text-xs rounded">Goods</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Set of 4 handcrafted ceramic mugs in your
                                        choice
                                        of glaze colors. Each piece is unique and food-safe.</p>

                                    <button
                                        class="w-full px-4 py-2 rounded-md text-sm font-medium  bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 text-white  transition-all duration-300 shadow-lg hover:shadow-xl bg-size-200 bg-pos-0 hover:bg-pos-100 animate-gradient-x">
                                        Make Offer
                                    </button>
                                </div>
                            </div>

                            <!-- SEEKING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-secondary/10 text-secondary text-xs rounded-full font-medium">SEEKING</span>
                                </div>

                                <div class="bg-purple-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-purple-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Photo Session</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#E8A87C] text-white text-xs rounded">Service</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Photography session, knitted items, or
                                        babysitting
                                        services for have two kids, ages 3 and 7.</p>

                                    <button
                                        class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Bicycle Maintenance & Fresh Baking -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 pb-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-white font-bold text-sm">
                                DW
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">David Wilson</h3>
                                <p class="text-xs text-gray-500">Sarikaya</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- OFFERING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-primary/10 text-primary text-xs rounded-full font-medium">OFFERING</span>
                                </div>

                                <div class="bg-green-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-green-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Bicycle Maintenance</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-[#E8A87C] text-white text-xs rounded">Service</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Experienced bicycle mechanic offering
                                        tune-ups,
                                        brake adjustments, gear fixing and general maintenance.</p>

                                    <button
                                        class="w-full px-4 py-2 rounded-md text-sm font-medium  bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-600 hover:to-pink-600 text-white  transition-all duration-300 shadow-lg hover:shadow-xl bg-size-200 bg-pos-0 hover:bg-pos-100 animate-gradient-x">
                                        Make Offer
                                    </button>
                                </div>
                            </div>

                            <!-- SEEKING Section -->
                            <div>
                                <div class="mb-3">
                                    <span
                                        class="px-2 py-1 bg-secondary/10 text-secondary text-xs rounded-full font-medium">SEEKING</span>
                                </div>

                                <div class="bg-yellow-100 rounded-lg h-32 mb-3 flex items-center justify-center">
                                    <span class="text-yellow-800 font-bold text-sm text-center">IMAGE PLACEHOLDER</span>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Fresh Baking</h4>
                                    <div class="flex gap-1 mb-2">
                                        <span class="px-2 py-1 bg-secondary text-white text-xs rounded">Goods</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Homemade baked goods, fresh eggs, or help with
                                        basic car maintenance.</p>

                                    <button
                                        class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </section>


</body>

</html>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Discover the Marudi Mountains in Guyana – a unique destination for eco-tourism, research, and sustainable investment.">
    <title>Marudi Mountains — Guyana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        palmeiras: {
                            100: '#007E3A',
                            200: '#006E32',
                            300: '#005E2A',
                            400: '#004E22',
                            500: '#003E1A',
                        },
                    },
                },
            },
        };

    </script>
    <style>
        <blade keyframes|%20fade-in%20%7B>0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
        }

        <blade keyframes|%20slide-down%20%7B>0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .animate-slide-down {
            animation: slide-down 0.8s ease-out forwards;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out both;
    }

    .animate-slide-up {
        animation: slide-up 1s ease-out both;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-500 { animation-delay: 0.5s; }
    </style>

</head>

<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans leading-relaxed">

    <!-- Navbar -->
    <nav class="bg-green-700 dark:bg-green-900 text-white fixed w-full z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo / Brand -->
                <div class="flex-shrink-0 font-bold text-lg tracking-wide">
                    <a href="#" class="hover:text-green-300 transition">Marudi Mountains</a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#details"
                        class="hover:text-green-300 transition px-3 py-2 rounded-md text-sm font-medium">Details</a>
                    <a href="#about"
                        class="hover:text-green-300 transition px-3 py-2 rounded-md text-sm font-medium">About</a>
                    <a href="#gallery"
                        class="hover:text-green-300 transition px-3 py-2 rounded-md text-sm font-medium">Gallery</a>
                    <a href="#contact"
                        class="hover:text-green-300 transition px-3 py-2 rounded-md text-sm font-medium">Contact</a>

                    <!-- Language Selector Desktop -->
                    <div class="relative" id="language-selector-desktop">
                        <button id="language-button-desktop" aria-haspopup="true" aria-expanded="false"
                            class="flex items-center space-x-1 hover:text-green-300 focus:outline-none focus:ring-2 focus:ring-white rounded px-3 py-2 text-sm font-medium">
                            <span>Language</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="language-menu-desktop"
                            class="absolute right-0 mt-2 w-32 bg-green-700 dark:bg-green-900 border border-green-600 rounded-md shadow-lg py-1 hidden z-50">
                            <a href="?lang=en" class="block px-4 py-2 hover:bg-green-600">English</a>
                            <a href="?lang=es" class="block px-4 py-2 hover:bg-green-600">Español</a>
                            <a href="?lang=pt" class="block px-4 py-2 hover:bg-green-600">Português</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    <!-- Language Selector Mobile -->
                    <div class="relative" id="language-selector-mobile">
                        <button id="language-button-mobile" aria-haspopup="true" aria-expanded="false"
                            class="flex items-center space-x-1 hover:text-green-300 focus:outline-none focus:ring-2 focus:ring-white rounded px-3 py-2 text-sm font-medium">
                            <span>Lang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="language-menu-mobile"
                            class="absolute right-0 mt-10 w-32 bg-green-700 dark:bg-green-900 border border-green-600 rounded-md shadow-lg py-1 hidden z-50">
                            <a href="?lang=en" class="block px-4 py-2 hover:bg-green-600">English</a>
                            <a href="?lang=es" class="block px-4 py-2 hover:bg-green-600">Español</a>
                            <a href="?lang=pt" class="block px-4 py-2 hover:bg-green-600">Português</a>
                        </div>
                    </div>

                    <!-- Hamburger Menu Button -->
                    <button id="mobile-menu-button"
                        class="focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-label="Toggle menu">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path id="menu-icon" class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-green-600 dark:bg-green-800 px-2 pt-2 pb-3 space-y-1">
            <a href="#details" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-green-500">Details</a>
            <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-green-500">About</a>
            <a href="#gallery" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-green-500">Gallery</a>
            <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-green-500">Contact</a>
        </div>
    </nav>


    <!-- Spacer for fixed navbar -->
    <div class="h-16"></div>

    <!-- Hero Section -->
    <section class="min-h-screen flex flex-col justify-center items-center px-6 text-center 
    bg-gradient-to-br from-green-200 to-green-500 dark:from-green-900 dark:to-green-700 
    animate-fade-in">

        <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-slide-down">Marudi Mountains</h1>

        <p class="text-xl md:text-2xl max-w-2xl mb-6 animate-fade-in delay-200">
            A Natural Treasure in the Heart of Guyana
        </p>

        <a href="#details" class="bg-white text-green-700 dark:bg-gray-800 dark:text-green-300 px-6 py-3 rounded-full shadow-lg 
        transform transition duration-300 hover:scale-110 hover:shadow-2xl hover:bg-green-100 dark:hover:bg-green-900">
            Explore More ↓
        </a>
    </section>


    <!-- 🌍 About the Region -->
    <section id="about" class="px-6 py-16 max-w-5xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6">🌍 About the Region</h2>
        <p class="mb-4">Upper Takutu - Upper Essequibo is the largest region in Guyana by land area, known for its dense
            forests, indigenous communities, and limited infrastructure — making it a crucial area for biodiversity and
            sustainable development.</p>
        <p>Due to its remoteness, many areas remain unexplored, making it a living laboratory for biological and
            geological studies.</p>
    </section>

    <!-- 🧪 Scientific Potential -->
    <section class="px-6 py-16 max-w-5xl mx-auto bg-gray-100 dark:bg-gray-800 rounded-xl">
        <h2 class="text-3xl font-semibold mb-6">🧪 Scientific Potential</h2>
        <ul class="list-disc list-inside space-y-2">
            <li>Untapped flora and fauna — likely endemic species</li>
            <li>Part of the Guiana Shield, a geologically significant area</li>
            <li>Opportunities for academic collaboration and conservation research</li>
        </ul>
    </section>

    <!-- 📸 Gallery -->
    <section id="gallery" class="px-6 py-16 max-w-6xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6 animate-fade-in">📸 Gallery</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Imagen 1 -->
            <div
                class="bg-gray-200 dark:bg-gray-700 aspect-video rounded-lg overflow-hidden animate-slide-up delay-100">
                <img class="rounded-lg w-full h-full object-cover transform transition duration-500 hover:scale-105 hover:shadow-2xl"
                    src="https://www.brasilmineral.com.br/sites/default/files/styles/image_in_article/public/2024-07/mina_tucano__0.jpeg.webp?itok=1Ui6nJsh"
                    alt="Mina Tucano">
            </div>
            <!-- Imagen 2 -->
            <div
                class="bg-gray-200 dark:bg-gray-700 aspect-video rounded-lg overflow-hidden animate-slide-up delay-300">
                <img class="rounded-lg w-full h-full object-cover transform transition duration-500 hover:scale-105 hover:shadow-2xl"
                    src="https://imgs.mongabay.com/wp-content/uploads/sites/20/2021/12/21165359/DSC_0216-768x512.jpg"
                    alt="Floresta">
            </div>
            <!-- Imagen 3 -->
            <div
                class="bg-gray-200 dark:bg-gray-700 aspect-video rounded-lg overflow-hidden animate-slide-up delay-500">
                <img class="rounded-lg w-full h-full object-cover transform transition duration-500 hover:scale-105 hover:shadow-2xl"
                    src="https://cisp.cachefly.net/assets/articles/images/resized/0000733767_resized_marudiguyanagoldstrike06181022.jpg"
                    alt="Marudi Project">
            </div>
        </div>
    </section>

    <!-- Sección Mapa -->
    <section class="mt-12 max-w-5xl mx-auto px-6">
        <h2 class="text-3xl font-semibold mb-6">🗺️ Location Map</h2>
        <div class="w-full h-64 md:h-96 rounded-lg overflow-hidden shadow-lg">
            <iframe class="w-full h-full" loading="lazy" allowfullscreen
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD3me2F4YjCTY3f4aEEAURn4sP46L866Cs&q=Marudi+Mountains,Guyana&zoom=8">
            </iframe>
        </div>
    </section>

    <!-- 🧭 Getting There -->
    <section class="px-6 py-16 max-w-5xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6">🧭 Getting There</h2>
        <p class="mb-4">Access to Marudi Mountains is currently limited but improving. Most visitors travel via air or
            river transport to Lethem, then overland by 4x4 vehicles to remote encampments near the mountain range.</p>
        <ul class="list-disc list-inside space-y-1">
            <li>Nearest town: Lethem (accessible by air)</li>
            <li>Off-road travel required; best during dry season</li>
            <li>Helicopter charters may be available for researchers</li>
        </ul>
    </section>

    <!-- (El resto del contenido permanece igual, omito aquí para brevedad) -->

    <!-- Details Section -->
    <section id="details" class="px-6 py-16 max-w-5xl mx-auto">
        <h2 class="text-3xl font-semibold mb-6">📍 Location Overview</h2>
        <ul class="space-y-2">
            <li><strong>Region:</strong> Upper Takutu - Upper Essequibo, Guyana</li>
            <li><strong>Coordinates:</strong> 2.3° N, -59.01667° W</li>
            <li><strong>Elevation:</strong> ~273 meters above sea level</li>
            <li><strong>GeoNames ID:</strong> 3377036</li>
        </ul>

        <h2 class="text-3xl font-semibold mt-12 mb-6">🌿 Biodiversity Hotspot</h2>
        <p class="mb-4">Part of the ancient Guiana Shield, Marudi Mountains are surrounded by untouched tropical
            forests, home to diverse flora and fauna. A hidden gem for scientists and eco-tourists alike.</p>
        <ul class="list-disc list-inside space-y-1">
            <li>Untouched tropical ecosystems</li>
            <li>Possible endemic species</li>
            <li>Key freshwater sources and rivers</li>
        </ul>

        <h2 class="text-3xl font-semibold mt-12 mb-6">🛠️ Investment & Exploration</h2>
        <p class="mb-4">Known for potential gold reserves, the Marudi region is increasingly attracting interest from
            sustainable investors. Infrastructure is improving, and the region is ideal for ethical exploration
            projects.</p>

        <ul class="list-disc list-inside space-y-1">
            <li>Mineral exploration opportunities</li>
            <li>Remote but increasingly accessible</li>
            <li>Growing government interest in sustainable development</li>
        </ul>

        <h2 class="text-3xl font-semibold mt-12 mb-6">🌐 Why Choose Marudi?</h2>
        <ul class="list-disc list-inside space-y-1">
            <li>One of Guyana’s last untouched natural frontiers</li>
            <li>Scientific discovery potential</li>
            <li>Eco-tourism development opportunities</li>
            <li>Rich cultural and ecological value</li>
        </ul>
    </section>

    <!-- Call to Action -->
    <section id="contact" class="bg-green-100 dark:bg-green-800 px-6 py-12 text-center">
        <h2 class="text-2xl font-bold mb-4">📞 Get in Touch</h2>
        <p class="mb-6 max-w-xl mx-auto">Interested in eco-tourism, conservation, or responsible investment in the
            Marudi Mountains? Contact us to learn how you can be part of this unique journey.</p>
        <a href="mailto:info@example.com"
            class="bg-green-700 text-white px-6 py-3 rounded-full hover:bg-green-800 transition">Contact Us</a>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-sm bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400">
        &copy; 2025 Marudi Project. All rights reserved.
    </footer>

    <!-- Script for mobile menu toggle -->
    <script>
        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Language menu desktop toggle
        const langBtnDesktop = document.getElementById('language-button-desktop');
        const langMenuDesktop = document.getElementById('language-menu-desktop');

        langBtnDesktop.addEventListener('click', (e) => {
            e.stopPropagation();
            langMenuDesktop.classList.toggle('hidden');
        });

        // Language menu mobile toggle
        const langBtnMobile = document.getElementById('language-button-mobile');
        const langMenuMobile = document.getElementById('language-menu-mobile');

        langBtnMobile.addEventListener('click', (e) => {
            e.stopPropagation();
            langMenuMobile.classList.toggle('hidden');
        });

        // Close menus if clicking outside
        window.addEventListener('click', () => {
            if (!langMenuDesktop.classList.contains('hidden')) {
                langMenuDesktop.classList.add('hidden');
            }
            if (!langMenuMobile.classList.contains('hidden')) {
                langMenuMobile.classList.add('hidden');
            }
        });

    </script>

</body>

</html>

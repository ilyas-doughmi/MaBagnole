<?php
require_once '../includes/guard.php';
require_login();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Véhicules | MaBagnole</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito Sans', 'sans-serif'],
                    },
                    colors: {
                        'locar-orange': '#FF5F00',
                        'locar-black': '#1a1a1a',
                        'locar-dark': '#0F0F0F',
                    },
                    boxShadow: {
                        'neon': '0 0 20px rgba(255, 95, 0, 0.4)',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navigation -->
    <?php $root_path = '../'; include 'header.php'; ?>

    <!-- Header Section -->
    <div class="bg-locar-dark text-white pt-32 pb-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-2/3 h-full bg-gradient-to-l from-[#151515] to-transparent z-0"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black uppercase mb-4">Notre Flotte</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">Découvrez notre large gamme de véhicules adaptés à tous vos besoins. De la citadine économique au SUV luxueux.</p>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white border-b border-gray-200 sticky top-20 z-30 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                
                <!-- Categories -->
                <div class="flex overflow-x-auto pb-2 md:pb-0 gap-2 w-full md:w-auto no-scrollbar">
                    <button onclick="filterCategory('all')" class="filter-btn active px-6 py-2 rounded-full text-sm font-bold bg-black text-white transition whitespace-nowrap" data-cat="all">Tout</button>
                    <button onclick="filterCategory('Citadine')" class="filter-btn px-6 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition whitespace-nowrap" data-cat="Citadine">Citadine</button>
                    <button onclick="filterCategory('Confort')" class="filter-btn px-6 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition whitespace-nowrap" data-cat="Confort">Confort</button>
                    <button onclick="filterCategory('SUV')" class="filter-btn px-6 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition whitespace-nowrap" data-cat="SUV">SUV</button>
                    <button onclick="filterCategory('Luxe')" class="filter-btn px-6 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition whitespace-nowrap" data-cat="Luxe">Luxe</button>
                </div>

                <!-- Search -->
                <div class="relative w-full md:w-64">
                    <input type="text" id="searchInput" placeholder="Rechercher un modèle..." 
                        class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-full text-sm font-bold focus:ring-2 focus:ring-locar-orange outline-none transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle Grid -->
    <section class="py-12 min-h-screen">
        <div class="container mx-auto px-4">
            
            <!-- Loading State -->
            <div id="loader" class="hidden text-center py-20">
                <i class="fa-solid fa-circle-notch fa-spin text-4xl text-locar-orange"></i>
            </div>

            <!-- Grid -->
            <div id="vehicleGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Vehicles will be injected here via JS -->
            </div>

            <!-- No Results -->
            <div id="noResults" class="hidden text-center py-20">
                <i class="fa-solid fa-car-crash text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-500">Aucun véhicule trouvé</h3>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center gap-2" id="pagination">
                <!-- Pagination buttons injected via JS -->
            </div>
        </div>
    </section>

    <footer class="bg-locar-dark text-white py-10 border-t border-gray-800">
        <div class="container mx-auto px-4 text-center">
            <p class="font-bold tracking-wider text-sm">© 2025 MA BAGNOLE. TOUS DROITS RÉSERVÉS</p>
        </div>
    </footer>

    <script>
        let currentPage = 1;
        let currentCategory = 'all';
        let currentSearch = '';

        // Initial Load
        document.addEventListener('DOMContentLoaded', () => {
            fetchVehicles();

            // Search Listener (Debounced)
            let timeout = null;
            document.getElementById('searchInput').addEventListener('input', (e) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    currentSearch = e.target.value;
                    currentPage = 1;
                    fetchVehicles();
                }, 500);
            });
        });

        function filterCategory(cat) {
            currentCategory = cat;
            currentPage = 1;
            
            // Update UI
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if(btn.dataset.cat === cat) {
                    btn.classList.remove('bg-gray-100', 'text-gray-600');
                    btn.classList.add('bg-black', 'text-white');
                } else {
                    btn.classList.add('bg-gray-100', 'text-gray-600');
                    btn.classList.remove('bg-black', 'text-white');
                }
            });

            fetchVehicles();
        }

        async function fetchVehicles() {
            const grid = document.getElementById('vehicleGrid');
            const loader = document.getElementById('loader');
            const noResults = document.getElementById('noResults');
            const pagination = document.getElementById('pagination');

            // Show Loader
            grid.classList.add('opacity-50');
            loader.classList.remove('hidden');

            try {
                const response = await fetch(`fetch_vehicles.php?page=${currentPage}&category=${currentCategory}&search=${currentSearch}`);
                const data = await response.json();

                grid.innerHTML = '';
                pagination.innerHTML = '';

                if (data.vehicles.length === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                    
                    data.vehicles.forEach(vehicle => {
                        const card = `
                            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 group border border-gray-100">
                                <div class="relative h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <div class="absolute top-4 left-4 bg-black text-white text-xs font-bold px-3 py-1 rounded uppercase">
                                        ${vehicle.categorie}
                                    </div>
                                    <img src="${vehicle.image}" alt="${vehicle.marque}" class="w-3/4 transform group-hover:scale-110 transition duration-500">
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-gray-800 uppercase">${vehicle.marque}</h3>
                                            <p class="text-sm text-gray-500 font-bold">${vehicle.modele}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-2xl font-black text-locar-orange">${vehicle.prix_jour}$</span>
                                            <span class="text-xs font-bold text-gray-400">/ JOUR</span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-2 mb-6 text-xs font-bold text-gray-500 border-t border-b border-gray-100 py-4">
                                        <div class="flex flex-col items-center gap-1">
                                            <i class="fa-solid fa-gas-pump text-locar-orange"></i>
                                            <span>${vehicle.carburant}</span>
                                        </div>
                                        <div class="flex flex-col items-center gap-1 border-l border-r border-gray-100">
                                            <i class="fa-solid fa-gears text-locar-orange"></i>
                                            <span>${vehicle.boite}</span>
                                        </div>
                                        <div class="flex flex-col items-center gap-1">
                                            <i class="fa-solid fa-user-group text-locar-orange"></i>
                                            <span>${vehicle.passagers} Places</span>
                                        </div>
                                    </div>

                                    <a href="vehicle-details.php?id=${vehicle.id}" class="block w-full bg-black hover:bg-locar-orange text-white font-bold py-3 rounded-lg transition shadow-lg text-center">
                                        RÉSERVER
                                    </a>
                                </div>
                            </div>
                        `;
                        grid.innerHTML += card;
                    });

                    // Render Pagination
                    if (data.pagination.total_pages > 1) {
                        for (let i = 1; i <= data.pagination.total_pages; i++) {
                            const activeClass = i === data.pagination.current_page ? 'bg-locar-orange text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200';
                            const btn = `<button onclick="changePage(${i})" class="${activeClass} w-10 h-10 rounded-full font-bold transition">${i}</button>`;
                            pagination.innerHTML += btn;
                        }
                    }
                }

            } catch (error) {
                console.error('Error fetching vehicles:', error);
            } finally {
                grid.classList.remove('opacity-50');
                loader.classList.add('hidden');
            }
        }

        function changePage(page) {
            currentPage = page;
            fetchVehicles();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>

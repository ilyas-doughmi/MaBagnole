<?php
require_once '../includes/guard.php';
require_once '../Classes/db.php';
require_once '../Classes/vehicle.php';

require_login();

$db = DB::connect();
$vehicleObj = new vehicle($db);

$data = $vehicleObj->getVehicles();
$vehicles = $data['vehicles'];
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Flotte | MaBagnole Premium</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        'brand-orange': '#FF3B00',
                        'brand-black': '#0a0a0a',
                        'brand-gray': '#121212',
                        'surface': '#ffffff',
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-image: radial-gradient(#FF3B00 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="bg-gray-50 text-brand-black antialiased selection:bg-brand-orange selection:text-white">

    <!-- Navigation -->
    <?php $root_path = '../'; include 'header.php'; ?>

    <!-- Hero Section -->
    <header class="relative bg-brand-black text-white pt-40 pb-24 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-brand-orange/10 to-transparent"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block py-1 px-3 border border-brand-orange/50 rounded-full text-brand-orange text-xs font-bold tracking-widest uppercase mb-6 bg-brand-orange/5 backdrop-blur-sm">
                Collection 2025
            </span>
            <h1 class="text-5xl md:text-7xl font-black uppercase mb-6 tracking-tight leading-tight">
                Trouvez votre <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">Route</span>
            </h1>
            <p class="text-gray-400 max-w-xl mx-auto text-lg font-light leading-relaxed">
                Une sélection exclusive de véhicules pour transformer chaque déplacement en expérience inoubliable.
            </p>
        </div>
    </header>

    <!-- Filter Bar -->
    <div class="bg-white border-b border-gray-100 sticky top-0 z-40 backdrop-blur-md bg-white/80">
        <div class="container mx-auto px-6 py-4 overflow-x-auto no-scrollbar">
            <div class="flex justify-center min-w-max gap-4">
                <?php
                $cats = ['all' => 'Tous les modèles', 'Citadine' => 'Citadines', 'Confort' => 'Berlines', 'SUV' => 'SUV & 4x4', 'Luxe' => 'Prestige'];
                foreach ($cats as $key => $label): 
                    $isActive = ($key === 'all'); // Default active state visual just for demo since filtering is removed
                    $btnClass = $isActive 
                        ? 'bg-brand-black text-white shadow-lg shadow-brand-black/20' 
                        : 'bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-brand-black';
                ?>
                    <button class="<?= $btnClass ?> px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 transform hover:scale-105">
                        <?= $label ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Vehicle Grid -->
    <section class="py-20 min-h-screen bg-gray-50">
        <div class="container mx-auto px-6">
            
            <?php if (empty($vehicles)): ?>
                <div class="flex flex-col items-center justify-center py-32 text-center opacity-50">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-car text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun véhicule disponible</h3>
                    <p class="text-gray-500">Notre flotte est actuellement en cours de mise à jour.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <div class="group relative bg-white rounded-3xl overflow-hidden cursor-pointer hover:shadow-2xl transition-all duration-500 ease-out flex flex-col h-full border border-gray-100">
                            
                            <!-- Image Container -->
                            <div class="relative h-64 overflow-hidden bg-gray-100/50">
                                <div class="absolute top-4 left-4 z-20">
                                    <span class="bg-brand-black/90 backdrop-blur text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                                        <?= htmlspecialchars($vehicle['category_name']) ?>
                                    </span>
                                </div>
                                
                                <img src="<?= htmlspecialchars($vehicle['image']) ?>" 
                                     alt="<?= htmlspecialchars($vehicle['brand']) ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                                
                                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-8 flex-1 flex flex-col relative">
                                <div class="mb-6">
                                    <div class="flex justify-between items-end mb-2">
                                        <h3 class="text-2xl font-black text-brand-black uppercase tracking-tight group-hover:text-brand-orange transition-colors">
                                            <?= htmlspecialchars($vehicle['brand']) ?>
                                        </h3>
                                        <div class="text-right">
                                            <span class="text-sm font-bold text-gray-400 line-through decoration-brand-orange/50"><?= number_format($vehicle['price_per_day'] * 1.2, 0) ?>$</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-gray-500 font-medium"><?= htmlspecialchars($vehicle['model']) ?></p>
                                        <p class="text-3xl font-black text-brand-black">
                                            <?= htmlspecialchars($vehicle['price_per_day']) ?><span class="text-base align-top text-brand-orange">$</span><span class="text-xs text-gray-400 font-bold ml-1">/Jour</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Specs (Mock) -->
                                <div class="flex justify-between items-center mb-8 p-4 bg-gray-50 rounded-2xl border border-gray-100 group-hover:border-brand-orange/10 transition-colors">
                                    <div class="flex flex-col items-center gap-1.5 flex-1 border-r border-gray-200/50 last:border-0">
                                        <i class="fa-solid fa-gauge-high text-gray-400 group-hover:text-brand-orange transition-colors"></i>
                                        <span class="text-[10px] uppercase font-bold text-gray-600">Auto</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1.5 flex-1 border-r border-gray-200/50 last:border-0">
                                        <i class="fa-solid fa-droplet text-gray-400 group-hover:text-brand-orange transition-colors"></i>
                                        <span class="text-[10px] uppercase font-bold text-gray-600">Diesel</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1.5 flex-1">
                                        <i class="fa-solid fa-user text-gray-400 group-hover:text-brand-orange transition-colors"></i>
                                        <span class="text-[10px] uppercase font-bold text-gray-600">5 Places</span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <a href="vehicle-details.php?id=<?= $vehicle['vehicle_id'] ?>" 
                                       class="block w-full bg-brand-black text-white font-bold py-4 rounded-xl text-center shadow-lg transform group-hover:translate-y-[-2px] group-hover:shadow-xl group-hover:bg-brand-orange transition-all duration-300">
                                        Réserver ce véhicule
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-brand-black text-white py-12 border-t border-white/5">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl font-black uppercase mb-6 tracking-widest">Ma Bagnole</h2>
            <div class="flex justify-center gap-6 mb-8 text-gray-400">
                <a href="#" class="hover:text-brand-orange transition"><i class="fa-brands fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-brand-orange transition"><i class="fa-brands fa-twitter text-xl"></i></a>
                <a href="#" class="hover:text-brand-orange transition"><i class="fa-brands fa-facebook text-xl"></i></a>
            </div>
            <p class="text-gray-600 text-xs font-bold tracking-widest uppercase">© 2025 Ma Bagnole Premium. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

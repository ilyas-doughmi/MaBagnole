<?php
session_start();

// Get Vehicle ID
$vehicle_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// MOCK DATA: Vehicle Details (Replace with SQL Query)
// $stmt = $pdo->prepare("SELECT * FROM ListeVehicules WHERE id = ?");
// $stmt->execute([$vehicle_id]);
// $vehicle = $stmt->fetch();
$vehicle = [
    'id' => $vehicle_id,
    'marque' => 'Volvo',
    'modele' => 'V60',
    'categorie' => 'Confort',
    'prix_jour' => 75,
    'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
    'carburant' => 'Diesel',
    'boite' => 'Automatique',
    'passagers' => 5,
    'portes' => 4,
    'bagages' => 3,
    'description' => 'La Volvo V60 est un break familial polyvalent qui allie confort, sécurité et performance. Idéale pour les longs trajets comme pour la ville, elle offre un espace généreux et des finitions haut de gamme.',
    'rating' => 4.5,
    'review_count' => 12
];

// MOCK DATA: Reviews (Replace with SQL Query)
// $stmt = $pdo->prepare("SELECT * FROM Avis WHERE id_vehicule = ? ORDER BY date_avis DESC");
$reviews = [
    ['user' => 'Ahmed Benali', 'note' => 5, 'date' => '12 Déc 2025', 'comment' => 'Service impeccable et voiture très propre. Je recommande vivement !'],
    ['user' => 'Sarah K.', 'note' => 4, 'date' => '05 Déc 2025', 'comment' => 'Très bonne conduite, mais le GPS n\'était pas à jour.'],
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $vehicle['marque'] . ' ' . $vehicle['modele'] ?> | MaBagnole</title>
    
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
                }
            }
        }
    </script>
    <style>
        .glass-nav { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navigation -->
    <?php $root_path = '../'; include 'header.php'; ?>

    <!-- Main Content -->
    <div class="pt-32 pb-20">
        <div class="container mx-auto px-4">
            
            <!-- Breadcrumb -->
            <div class="mb-8 text-sm font-bold text-gray-400">
                <a href="vehicles.php" class="hover:text-locar-orange">Véhicules</a> 
                <span class="mx-2">/</span> 
                <span class="text-gray-800"><?= $vehicle['marque'] . ' ' . $vehicle['modele'] ?></span>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Left Column: Images & Details -->
                <div class="lg:w-2/3">
                    <!-- Main Image -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl mb-8 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 bg-locar-orange text-white font-black text-lg px-6 py-3 rounded-bl-3xl z-10">
                            <?= $vehicle['categorie'] ?>
                        </div>
                        <button class="absolute top-6 left-6 w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-300 hover:text-red-500 shadow-lg transition z-20" title="Ajouter aux favoris">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                        <img src="<?= $vehicle['image'] ?>" class="w-full transform group-hover:scale-105 transition duration-700" alt="Car Image">
                    </div>

                    <!-- Specs Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center">
                            <i class="fa-solid fa-gas-pump text-2xl text-locar-orange mb-2"></i>
                            <p class="text-xs font-bold text-gray-400 uppercase">Carburant</p>
                            <p class="font-black"><?= $vehicle['carburant'] ?></p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center">
                            <i class="fa-solid fa-gears text-2xl text-locar-orange mb-2"></i>
                            <p class="text-xs font-bold text-gray-400 uppercase">Boite</p>
                            <p class="font-black"><?= $vehicle['boite'] ?></p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center">
                            <i class="fa-solid fa-users text-2xl text-locar-orange mb-2"></i>
                            <p class="text-xs font-bold text-gray-400 uppercase">Passagers</p>
                            <p class="font-black"><?= $vehicle['passagers'] ?></p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 text-center">
                            <i class="fa-solid fa-suitcase text-2xl text-locar-orange mb-2"></i>
                            <p class="text-xs font-bold text-gray-400 uppercase">Bagages</p>
                            <p class="font-black"><?= $vehicle['bagages'] ?></p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg mb-12">
                        <h3 class="text-2xl font-black uppercase mb-4">Description</h3>
                        <p class="text-gray-500 leading-relaxed">
                            <?= $vehicle['description'] ?>
                        </p>
                    </div>

                    <!-- Reviews Section -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-black uppercase">Avis Clients (<?= count($reviews) ?>)</h3>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <span class="font-bold text-xl"><?= $vehicle['rating'] ?></span>
                            </div>
                        </div>

                        <!-- Review List -->
                        <div class="space-y-8 mb-12">
                            <?php foreach($reviews as $review): ?>
                            <div class="border-b border-gray-100 pb-8 last:border-0 last:pb-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                                            <?= substr($review['user'], 0, 1) ?>
                                        </div>
                                        <div>
                                            <h5 class="font-bold"><?= $review['user'] ?></h5>
                                            <p class="text-xs text-gray-400"><?= $review['date'] ?></p>
                                        </div>
                                    </div>
                                    <div class="text-yellow-400 text-sm">
                                        <?php for($i=0; $i<$review['note']; $i++) echo '<i class="fa-solid fa-star"></i>'; ?>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm pl-14 mb-3"><?= $review['comment'] ?></p>
                                <div class="pl-14 flex gap-4 text-xs font-bold text-gray-400">
                                    <button class="hover:text-green-500 transition"><i class="fa-regular fa-thumbs-up mr-1"></i> Utile (2)</button>
                                    <button class="hover:text-red-500 transition"><i class="fa-regular fa-thumbs-down mr-1"></i> Pas utile</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Add Review Form -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="font-bold uppercase mb-4">Ajouter un avis</h4>
                            <form action="submit_review.php" method="POST">
                                <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-gray-400 mb-2">NOTE</label>
                                    <div class="flex gap-2 text-2xl text-gray-300 hover:text-yellow-400 cursor-pointer transition">
                                        <!-- Simple star rating implementation would go here, using select for now -->
                                        <select name="rating" class="w-full p-3 bg-white rounded border border-gray-200 font-bold">
                                            <option value="5">5 - Excellent</option>
                                            <option value="4">4 - Très bien</option>
                                            <option value="3">3 - Bien</option>
                                            <option value="2">2 - Moyen</option>
                                            <option value="1">1 - Mauvais</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-gray-400 mb-2">COMMENTAIRE</label>
                                    <textarea name="comment" rows="3" class="w-full p-3 bg-white rounded border border-gray-200 focus:ring-2 focus:ring-locar-orange outline-none font-bold" placeholder="Partagez votre expérience..."></textarea>
                                </div>
                                <button type="submit" class="bg-black text-white font-bold py-3 px-8 rounded hover:bg-locar-orange transition">
                                    PUBLIER L'AVIS
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Reservation Form -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 sticky top-24 border-t-4 border-locar-orange">
                        <div class="text-center mb-8">
                            <p class="text-gray-400 font-bold text-sm uppercase mb-1">Prix par jour</p>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-5xl font-black text-locar-orange"><?= $vehicle['prix_jour'] ?>$</span>
                            </div>
                        </div>

                        <form action="submit_reservation.php" method="POST" class="space-y-4">
                            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Lieu de prise en charge</label>
                                <select name="lieu" class="w-full p-4 bg-gray-50 rounded-lg font-bold border border-gray-100 focus:border-locar-orange outline-none transition">
                                    <option>Agence Centre Ville</option>
                                    <option>Aéroport</option>
                                    <option>Gare Centrale</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Date de départ</label>
                                <input type="date" name="date_debut" required class="w-full p-4 bg-gray-50 rounded-lg font-bold border border-gray-100 focus:border-locar-orange outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Date de retour</label>
                                <input type="date" name="date_fin" required class="w-full p-4 bg-gray-50 rounded-lg font-bold border border-gray-100 focus:border-locar-orange outline-none transition">
                            </div>

                            <!-- Options (Bonus) -->
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase">Options Supplémentaires</label>
                                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                                    <input type="checkbox" name="options[]" value="gps" class="w-5 h-5 text-locar-orange rounded focus:ring-locar-orange">
                                    <span class="font-bold text-sm"><i class="fa-solid fa-location-dot mr-2 text-gray-400"></i> GPS (+10$/j)</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                                    <input type="checkbox" name="options[]" value="siege" class="w-5 h-5 text-locar-orange rounded focus:ring-locar-orange">
                                    <span class="font-bold text-sm"><i class="fa-solid fa-baby mr-2 text-gray-400"></i> Siège Enfant (+5$/j)</span>
                                </label>
                            </div>

                            <!-- Total Calculation Placeholder -->
                            <div class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                                <span class="font-bold text-gray-500">Total estimé</span>
                                <span class="font-black text-xl">--- $</span>
                            </div>

                            <button type="submit" class="w-full bg-locar-orange hover:bg-black text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                RÉSERVER MAINTENANT
                            </button>
                            
                            <p class="text-center text-xs text-gray-400 font-bold mt-4">
                                <i class="fa-solid fa-shield-halved mr-1"></i> Paiement sécurisé sur place
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-locar-dark text-white py-10 border-t border-gray-800 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="font-bold tracking-wider text-sm">© 2025 MA BAGNOLE. TOUS DROITS RÉSERVÉS</p>
        </div>
    </footer>

</body>
</html>

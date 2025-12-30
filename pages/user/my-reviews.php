<?php
session_start();
// Mock Data for Frontend Design
$reviews = [
    [
        'id' => 1,
        'vehicle' => 'Volvo V60',
        'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
        'date' => '12 Déc 2025',
        'rating' => 5,
        'comment' => 'Service impeccable et voiture très propre. Je recommande vivement !'
    ],
    [
        'id' => 2,
        'vehicle' => 'BMW X5',
        'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
        'date' => '05 Nov 2025',
        'rating' => 4,
        'comment' => 'Très bonne conduite, mais le GPS n\'était pas à jour.'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Avis | MaBagnole</title>
    
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
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100 fixed w-full z-40">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="../../index.php" class="flex items-center gap-2">
                    <div class="bg-locar-orange text-white w-10 h-10 flex items-center justify-center rounded text-xl font-bold">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <span class="font-black text-2xl tracking-tighter">Ma<span class="text-locar-orange">Bagnole</span></span>
                </a>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-500">Bonjour, Ahmed</span>
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                        A
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-20 min-h-screen flex">
        
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 p-8">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-black uppercase text-gray-900">Mes Avis</h1>
                        <p class="text-gray-500 font-medium mt-1">Gérez vos avis et commentaires sur nos véhicules.</p>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <?php foreach($reviews as $review): ?>
                    <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition group">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Vehicle Image -->
                            <div class="w-full md:w-32 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="<?= $review['image'] ?>" class="w-full h-full object-cover">
                            </div>

                            <!-- Content -->
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-black text-lg uppercase"><?= $review['vehicle'] ?></h3>
                                        <p class="text-xs text-gray-400 font-bold"><?= $review['date'] ?></p>
                                    </div>
                                    <div class="text-yellow-400 text-sm">
                                        <?php for($i=0; $i<$review['rating']; $i++) echo '<i class="fa-solid fa-star"></i>'; ?>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    "<?= $review['comment'] ?>"
                                </p>

                                <!-- Actions -->
                                <div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <button onclick="openEditModal(<?= $review['id'] ?>)" class="text-xs font-bold bg-gray-100 hover:bg-black hover:text-white px-4 py-2 rounded transition">
                                        <i class="fa-solid fa-pen mr-1"></i> MODIFIER
                                    </button>
                                    <button onclick="openDeleteModal(<?= $review['id'] ?>)" class="text-xs font-bold bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded transition">
                                        <i class="fa-solid fa-trash mr-1"></i> SUPPRIMER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-2xl p-8 relative">
            <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black">✕</button>
            
            <h3 class="font-black text-2xl uppercase mb-6">Modifier l'avis</h3>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2">NOTE</label>
                    <select class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none focus:border-locar-orange">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Très bien</option>
                        <option value="3">3 - Bien</option>
                        <option value="2">2 - Moyen</option>
                        <option value="1">1 - Mauvais</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2">COMMENTAIRE</label>
                    <textarea rows="4" class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none focus:border-locar-orange"></textarea>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 rounded transition">ANNULER</button>
                    <button type="submit" class="flex-1 bg-locar-orange hover:bg-black text-white font-bold py-3 rounded transition">ENREGISTRER</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-2xl p-8 text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-trash text-2xl text-red-500"></i>
            </div>
            
            <h3 class="font-black text-xl uppercase mb-2">Supprimer cet avis ?</h3>
            <p class="text-gray-500 text-sm mb-8">Cette action est irréversible. L'avis ne sera plus visible sur la page du véhicule.</p>
            
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 rounded transition">NON, GARDER</button>
                <button class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded transition">OUI, SUPPRIMER</button>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id) {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>
</html>

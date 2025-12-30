<?php
session_start();
// Mock Data
$vehicles = [
    ['id' => 1, 'marque' => 'Volvo', 'modele' => 'V60', 'categorie' => 'Confort', 'prix' => 75, 'status' => 'Disponible'],
    ['id' => 2, 'marque' => 'BMW', 'modele' => 'X5', 'categorie' => 'SUV', 'prix' => 150, 'status' => 'Loué'],
    ['id' => 3, 'marque' => 'Peugeot', 'modele' => '208', 'categorie' => 'Citadine', 'prix' => 40, 'status' => 'Maintenance'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Véhicules | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Nunito Sans', 'sans-serif'] },
                    colors: { 'locar-orange': '#FF5F00', 'locar-black': '#1a1a1a' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
        <div class="container mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-gray-700 text-3xl font-black uppercase">Véhicules</h3>
                <div class="flex gap-3">
                    <button onclick="openModal('importModal')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
                        <i class="fa-solid fa-file-import mr-2"></i> Import Masse
                    </button>
                    <button onclick="openModal('addModal')" class="bg-locar-orange hover:bg-black text-white font-bold py-2 px-4 rounded shadow transition">
                        <i class="fa-solid fa-plus mr-2"></i> Ajouter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                            <th class="p-4">ID</th>
                            <th class="p-4">Marque & Modèle</th>
                            <th class="p-4">Catégorie</th>
                            <th class="p-4">Prix/Jour</th>
                            <th class="p-4">Statut</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($vehicles as $v): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-500">#<?= $v['id'] ?></td>
                            <td class="p-4 font-bold"><?= $v['marque'] . ' ' . $v['modele'] ?></td>
                            <td class="p-4 text-sm"><?= $v['categorie'] ?></td>
                            <td class="p-4 font-bold text-locar-orange"><?= $v['prix'] ?>$</td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                    <?= $v['status'] == 'Disponible' ? 'bg-green-100 text-green-600' : ($v['status'] == 'Loué' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') ?>">
                                    <?= $v['status'] ?>
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-blue-500 hover:text-blue-700"><i class="fa-solid fa-pen"></i></button>
                                <button class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-black text-xl uppercase">Ajouter un véhicule</h3>
                <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-black">✕</button>
            </div>
            <form class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" placeholder="Marque" class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none">
                    <input type="text" placeholder="Modèle" class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <select class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none">
                        <option>Catégorie...</option>
                        <option>Citadine</option>
                        <option>SUV</option>
                    </select>
                    <input type="number" placeholder="Prix/Jour" class="w-full p-3 bg-gray-50 rounded border border-gray-200 font-bold outline-none">
                </div>
                <button type="submit" class="w-full bg-locar-orange text-white font-bold py-3 rounded hover:bg-black transition">ENREGISTRER</button>
            </form>
        </div>
    </div>

    <!-- Import Modal -->
    <div id="importModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-xl p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-file-csv text-2xl text-green-600"></i>
            </div>
            <h3 class="font-black text-xl uppercase mb-2">Importation en masse</h3>
            <p class="text-gray-500 text-sm mb-6">Sélectionnez un fichier CSV ou JSON pour ajouter plusieurs véhicules.</p>
            <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 mb-6"/>
            <button class="w-full bg-green-600 text-white font-bold py-3 rounded hover:bg-green-700 transition">IMPORTER</button>
            <button onclick="closeModal('importModal')" class="mt-3 text-gray-400 text-xs font-bold hover:text-gray-600">ANNULER</button>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    </script>
</body>
</html>

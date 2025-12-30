<?php
session_start();
// Mock Data
$categories = [
    ['id' => 1, 'nom' => 'Citadine', 'count' => 12],
    ['id' => 2, 'nom' => 'SUV', 'count' => 8],
    ['id' => 3, 'nom' => 'Luxe', 'count' => 4],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Catégories | Admin</title>
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
                <h3 class="text-gray-700 text-3xl font-black uppercase">Catégories</h3>
                <div class="flex gap-3">
                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
                        <i class="fa-solid fa-file-import mr-2"></i> Import Masse
                    </button>
                    <button class="bg-locar-orange hover:bg-black text-white font-bold py-2 px-4 rounded shadow transition">
                        <i class="fa-solid fa-plus mr-2"></i> Ajouter
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                            <th class="p-4">ID</th>
                            <th class="p-4">Nom de la catégorie</th>
                            <th class="p-4">Véhicules</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($categories as $c): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-500">#<?= $c['id'] ?></td>
                            <td class="p-4 font-bold"><?= $c['nom'] ?></td>
                            <td class="p-4 text-sm text-gray-500"><?= $c['count'] ?> véhicules</td>
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
</body>
</html>

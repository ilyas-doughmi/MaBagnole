<?php
session_start();
// Mock Data
$reviews = [
    ['id' => 1, 'client' => 'Ahmed Benali', 'vehicule' => 'Volvo V60', 'rating' => 5, 'comment' => 'Super voiture !', 'status' => 'Publié'],
    ['id' => 2, 'client' => 'Spam User', 'vehicule' => 'BMW X5', 'rating' => 1, 'comment' => 'Buy cheap rolex...', 'status' => 'Masqué'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Avis | Admin</title>
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
            <h3 class="text-gray-700 text-3xl font-black uppercase mb-8">Modération Avis</h3>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                            <th class="p-4">Client</th>
                            <th class="p-4">Véhicule</th>
                            <th class="p-4">Note</th>
                            <th class="p-4">Commentaire</th>
                            <th class="p-4">Statut</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($reviews as $r): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold"><?= $r['client'] ?></td>
                            <td class="p-4 text-sm text-gray-500"><?= $r['vehicule'] ?></td>
                            <td class="p-4 text-yellow-500 text-sm">
                                <?php for($i=0; $i<$r['rating']; $i++) echo '<i class="fa-solid fa-star"></i>'; ?>
                            </td>
                            <td class="p-4 text-sm italic text-gray-600">"<?= $r['comment'] ?>"</td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                    <?= $r['status'] == 'Publié' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' ?>">
                                    <?= $r['status'] ?>
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-green-500 hover:text-green-700" title="Publier"><i class="fa-solid fa-check"></i></button>
                                <button class="text-red-500 hover:text-red-700" title="Masquer/Supprimer"><i class="fa-solid fa-trash"></i></button>
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

<?php
session_start();
// Mock Data for Clients
$clients = [
    ['id' => 1, 'nom' => 'Benali', 'prenom' => 'Ahmed', 'email' => 'ahmed@example.com', 'telephone' => '0612345678', 'statut' => 'Actif', 'inscriptions' => '2024-01-15'],
    ['id' => 2, 'nom' => 'Dubois', 'prenom' => 'Marie', 'email' => 'marie@example.com', 'telephone' => '0698765432', 'statut' => 'Actif', 'inscriptions' => '2024-02-20'],
    ['id' => 3, 'nom' => 'Martin', 'prenom' => 'Jean', 'email' => 'jean@example.com', 'telephone' => '0655443322', 'statut' => 'Banni', 'inscriptions' => '2023-11-05'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Clients | Admin</title>
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
                <h3 class="text-gray-700 text-3xl font-black uppercase">Gestion des Clients</h3>
                <div class="relative">
                    <input type="text" placeholder="Rechercher un client..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:border-locar-orange">
                    <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                            <th class="p-4">Nom Complet</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Téléphone</th>
                            <th class="p-4">Date Inscription</th>
                            <th class="p-4">Statut</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($clients as $c): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xs">
                                        <?= substr($c['prenom'], 0, 1) . substr($c['nom'], 0, 1) ?>
                                    </div>
                                    <?= $c['prenom'] . ' ' . $c['nom'] ?>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-500"><?= $c['email'] ?></td>
                            <td class="p-4 text-sm text-gray-500"><?= $c['telephone'] ?></td>
                            <td class="p-4 text-sm text-gray-500"><?= $c['inscriptions'] ?></td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                    <?= $c['statut'] == 'Actif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' ?>">
                                    <?= $c['statut'] ?>
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Voir détails"><i class="fa-solid fa-eye"></i></button>
                                <button class="text-red-500 hover:text-red-700" title="Bannir/Supprimer"><i class="fa-solid fa-ban"></i></button>
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
